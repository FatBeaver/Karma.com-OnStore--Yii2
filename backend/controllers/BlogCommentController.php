<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use backend\models\BlogComment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlogCommentController implements the CRUD actions for BlogComment model.
 */
class BlogCommentController extends Controller
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
     * Lists all BlogComment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $comments = BlogComment::find()->all();

        return $this->render('index', [
            'comments' => $comments,
        ]);
    }

    public function actionAllow()
    {
        $comment_id = Yii::$app->request->get('id');

        $comment = BlogComment::findOne(['id' => $comment_id]);
        $comment->status = 0;
        $comment->save();

        $comment = BlogComment::findOne(['id' => $comment_id]);
        return $this->renderPartial('change_status', [
            'comment' => $comment,
        ]);
    }

    public function actionDisallow()
    {
        $comment_id = Yii::$app->request->get('id');

        $comment = BlogComment::findOne(['id' => $comment_id]);
        $comment->status = 1;
        $comment->save();

        $comment = BlogComment::findOne(['id' => $comment_id]);
        return $this->renderPartial('change_status', [
            'comment' => $comment,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BlogComment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogComment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogComment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
