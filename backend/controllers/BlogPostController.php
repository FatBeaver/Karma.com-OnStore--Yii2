<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use backend\models\BlogPost;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\UploadFile;
use yii\web\UploadedFile;
use backend\models\BlogCategoryLink;

/**
 * BlogPostController implements the CRUD actions for BlogPost model.
 */
class BlogPostController extends Controller
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
     * Lists all BlogPost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => BlogPost::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogPost model.
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
     * Creates a new BlogPost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
        $model = new BlogPost();
        $imageModel = new UploadFile();
        $blog_category = new BlogCategoryLink();

        $oldImages = null;

        if ($model->load(Yii::$app->request->post())) {
        
            $model->user_id = Yii::$app->user->identity['id'];
            $imageModel->image = UploadedFile::getInstance($imageModel, 'image');
            if ($imageModel->image) {
                $model->image = $imageModel->upload('blog', $oldImages,'blog_post'); 
            }
            $model->save();

            if ($_POST['BlogCategoryLink']['category_id'] != null) {
                $blog_category->saveManyToManyLinks();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'imageModel' => $imageModel,
            'blog_category' => $blog_category,
        ]);
    }

    /**
     * Updates an existing BlogPost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {   
        $model = $this->findModel($id);
        $imageModel = new UploadFile();
        $blog_category = new BlogCategoryLink();

        if ($model->image) {
            $oldImages = $model->image;
        } else {
            $oldImages = null;
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity['id'];
            $imageModel->image = UploadedFile::getInstance($imageModel, 'image');
            if ($imageModel->image) {
                $model->image = $imageModel->upload('blog', $oldImages,'blog_post'); 
            }

            $model->save();

            $blog_category->deleteLinksBy($id);
            if ($_POST['BlogCategoryLink']['category_id'] != null) {
                $blog_category->saveManyToManyLinks($id);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'imageModel' => $imageModel,
            'blog_category' => $blog_category,
        ]);
    }

    /**
     * Deletes an existing BlogPost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $links = BlogCategoryLink::find()->where(['blog_id' => $id])->all();
        foreach ($links as $link)
        {
            $link->delete();
        }
        @unlink(Yii::getAlias('@frontend') . '/web/uploads/images/blog/' . $model->image );
        @unlink(Yii::getAlias('@frontend') . '/web/uploads/images/blog/main/' . $model->image );

        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the BlogPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogPost::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }



    protected function debug($val, $exit = true)
    {
        echo "<pre>";
        print_r($val);
        echo "</pre>";
        if ($exit == true) {
            exit();
        }
    }
}
