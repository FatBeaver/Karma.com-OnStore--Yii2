<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\UploadFiles;
use backend\models\ProductParametrs;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * ProductrController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'create', 'update', 'view', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 10
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {   
        return $this->render('view', [
            'model' => $this->findModel($id),  
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
        $paramModel = new ProductParametrs();
        $model = new Product();
        $fileModel = new UploadFiles();
        
        if ($model->images) {
            $oldImages = unserialize($model->images);
        } else {
            $oldImages = null;
        }

        if($paramModel->load(Yii::$app->request->post()) && $paramModel->save()) {
            $paramModelID = Yii::$app->db->getLastInsertID();
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->parametrs_id = $paramModelID;
            
            $fileModel->images = UploadedFile::getInstances($fileModel, 'images');
            $fileModel->main_image = UploadedFile::getInstance($fileModel, 'main_image');
            $fileModel->recomm_image = UploadedFile::getInstance($fileModel, 'recomm_image');
           // $this->debug($fileModel->recomm_image);
            if ($fileModel->main_image || $fileModel->images || $fileModel->recomm_image) {
                $model->images = $fileModel->upload('products', $oldImages);        
            }

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'fileModel' => $fileModel,
            'paramModel' => $paramModel,
            'oldImages' => $oldImages,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $fileModel = new UploadFiles();
        $paramModel = ProductParametrs::findOne(['id' => $model->parametrs_id]);

        if ($model->images) {
            $oldImages = unserialize($model->images);
        } else {
            $oldImages = null;
        }
       // print_r($oldImages); exit;

        if ($model->load(Yii::$app->request->post()) && $paramModel->load(Yii::$app->request->post()))
        {
            $fileModel->images = UploadedFile::getInstances($fileModel, 'images');
            $fileModel->main_image = UploadedFile::getInstance($fileModel, 'main_image');
            $fileModel->recomm_image = UploadedFile::getInstance($fileModel, 'recomm_image');
           // $this->debug($fileModel->recomm_image);
            if ($fileModel->main_image || $fileModel->images || $fileModel->recomm_image) {
                $model->images = $fileModel->upload('products', $oldImages);        
            }
            $model->save();
            $paramModel->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'fileModel' => $fileModel,
            'paramModel' => $paramModel,
            'oldImages' => $oldImages,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $paramModel = ProductParametrs::findOne(['id' => $model->parametrs_id]);
       // $this->debug($paramModel);
        if ($paramModel != null) {
            $paramModel->delete();
        }

        if ($model->images) {
            $images = unserialize($model->images);

            @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/products/" . $images['main']);
            @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/products/main/" . $images['main']);
            
            @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/products/" 
            . $images['recommended']['fileName']);
            @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/products/recommended/" 
            . $images['recommended']['fileName']);
            
            if (isset($images['additional'])) 
            {
                foreach($images['additional'] as $image) {
                    @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/products/" . $image);
                    @unlink(Yii::getAlias('@frontend') . "/web/uploads/images/products/additional/" . $image);
                }
            }      
        }

        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public static function debug($arr)
    {
        echo '<pre>' . print_r($arr, true) . '</pre>';
        exit;
    }
}
