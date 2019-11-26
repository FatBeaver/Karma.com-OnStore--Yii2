<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use frontend\models\BlogCategory;
use frontend\models\BlogPost;
use yii\web\Controller;
use frontend\models\BlogComment;
use common\components\Pagination;

class BlogController extends Controller 
{   

    public $enableCsrfValidation = false;

    public function actionIndex()
    {   
        $limit = 5;
        if (!$page = Yii::$app->request->get('page')) {
            $page = 1;
        }
        $offset = ($page - 1) * $limit;
        $total = BlogPost::find()->count();

        if ($limit < $total) {
            $pagination = new Pagination($total, $limit, $page, 'blog');
        } else {
            $pagination = null;
        }

        $posts = BlogPost::find()->with('categories')->limit($limit)->offset($offset)
            ->orderBy(['id' => SORT_DESC])->all();

        $popularPosts = BlogPost::find()->with('categories')
            ->orderBy(['viewed' => SORT_DESC])->limit(4)->all();

        $lastCategories = BlogCategory::find()->limit(3)
            ->orderBy(['id' => SORT_DESC])->all();

        $blogAdmin = User::findOne(['blog_admin' => 1]);
        $allCategories = BlogCategory::find()->with('posts')->all();
         
        return $this->render('index', [
            'posts' => $posts,
            'popularPosts' => $popularPosts,
            'lastCategories' => $lastCategories,
            'allCategories' => $allCategories,
            'pagination' => $pagination,
            'blogAdmin' => $blogAdmin,
        ]);
    }

    public function actionCategory()
    {
        $category_id = Yii::$app->request->get('id');
        $category = BlogCategory::findOne(['id' => $category_id]);

        $limit = 5;
        if (!$page = Yii::$app->request->get('page')) {
            $page = 1;
        }
        $offset = ($page - 1) * $limit;
        $total = count($category->posts);

        if ($limit < $total) {
            $pagination = new Pagination($total, $limit, $page, 'blog-category', "/$category_id");
        } else {
            $pagination = null;
        }
        
        $posts = $category->getPaginationPostsForCategory($offset, $limit);
        
        $popularPosts = BlogPost::find()->orderBy(['viewed' => SORT_DESC])
            ->limit(4)->all();

        $lastCategories = BlogCategory::find()->limit(3)
            ->orderBy(['id' => SORT_DESC])->all();

        $blogAdmin = User::findOne(['blog_admin' => 1]);
        $allCategories = BlogCategory::find()->all();
       
        return $this->render('index', [
            'posts' => $posts,
            'popularPosts' => $popularPosts,
            'lastCategories' => $lastCategories,
            'allCategories' => $allCategories,
            'pagination' => $pagination,
            'blogAdmin' => $blogAdmin,
            'category' => $category,
        ]);
    }

    public function actionDetail()
    {   
        $id = Yii::$app->request->get('id');
        $post = BlogPost::findOne(['id' => $id]);

        if (isset($_POST['submit']))
        {
            $comment = new BlogComment();
            $comment->text = Yii::$app->request->post('message');
            $comment->user_id = Yii::$app->user->identity['id'];
            $comment->blog_id = $post->id;
            $comment->status = 0;
            $comment->save();
            
            $post->viewed -= 1;
        } 

        $post->viewed += 1;
        $post->save();

        $popularPosts = BlogPost::find()->orderBy(['viewed' => SORT_DESC])
            ->limit(4)->all();

        $blogAdmin = User::findOne(['blog_admin' => 1]);
        $allCategories = BlogCategory::find()->all();

        $navPosts['prev_post'] = BlogPost::find()->where(['id' => $id - 1])->one();
        
        if (BlogPost::find()->where(['id' => $id + 1])->one()) {
            $navPosts['next_post'] = BlogPost::find()->where(['id' => $id + 1])->one();
        }

        $pagination = $this->getPaginationCommentAndNav($post, $id);

        return $this->render('detail', [
            'post' => $post,
            'blogAdmin' => $blogAdmin,
            'popularPosts' => $popularPosts,
            'allCategories' => $allCategories,
            'navPosts' => $navPosts,
            'pagination' => $pagination,
        ]);
    }

    protected function getPaginationCommentAndNav($post, $id)
    {   
        $limit = 8;
        if (!$page = Yii::$app->request->get('page')) {
            $page = 1;
        }
        $offset = ($page - 1) * $limit;
        $total = count($post->comments);

        if ($limit < $total) {
            $pagination = new Pagination($total, $limit, $page, "blog/detail/$id/blog-comment");
        } else {
            $pagination = null;
        }

        $paginateData['comments_page'] = $post->getCommentsForPage($limit, $offset);
        $paginateData['nav_pages'] = $pagination;

        return $paginateData;
    }


    // =================== AJAX ACTIONS ========================
    public function actionSearch()
    {
        $value = Yii::$app->request->get('value');

        $posts = BlogPost::find()->where(['like', 'name', $value])
            ->orderBy(['id' => SORT_DESC])->all();

        return $this->renderPartial('search_post', [
            'posts' => $posts,
        ]);
    }


    protected function debug($val, $exit = true)
    {
        echo "<pre>";
        print_r($val);
        echo "</pre>";
        if ($exit === true) {
            exit();
        }
    }
}