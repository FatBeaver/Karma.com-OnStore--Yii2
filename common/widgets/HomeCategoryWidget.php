<?php
namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class HomeCategoryWidget extends Widget
{
    public $categories;
    public $htmlViews = '';

    public function init()
    {
        parent::init();
        if (!is_array($this->categories)) return die('Property ' . $this->categories . ' non array'); 
        if (empty($this->categories)) return $this->htmlViews = '<h3>Категорий нет</h3>';
        $categories = array_chunk($this->categories, 2);

        foreach($categories as $key => $category)
        {   
            if ($key % 2 == 0) {
                $this->htmlViews .= '<div class="col-lg-7 col-md-8">
                <div class="single-deal">
                    <div class="overlay"></div>
                    <img class="img-fluid w-100" 
                    src="/uploads/images/categories/'.$category[0]->image.'" alt="">
                    <a href="/uploads/images/categories/'.$category[0]->image.'" class="img-pop-up" 
                    target="_blank">
                        <div class="deal-details">
                        <h6>
                            <a href="/category/' . $category[0]->id. '" style="color:white;">'
                            . $category[0]->name .
                            '</a>
                        </h6>
                        </div>
                    </a>
                </div>
            </div>';

                $this->htmlViews .= '<div class="col-lg-5 col-md-4">
                <div class="single-deal">
                    <div class="overlay"></div>
                    <img class="img-fluid w-100" 
                    src="/uploads/images/categories/'.$category[1]->image.'" alt="">
                    <a href="/uploads/images/categories/'.$category[1]->image.'" class="img-pop-up" 
                    target="_blank">
                        <div class="deal-details">
                        <h6>
                            <a href="/category/' . $category[1]->id. '" style="color:white;">'
                            . $category[1]->name .
                            '</a>
                        </h6>
                        </div>
                    </a>
                </div>
            </div>';

            } else {

                $this->htmlViews .= '<div class="col-lg-5 col-md-4">
                <div class="single-deal">
                    <div class="overlay"></div>
                    <img class="img-fluid w-100" src="/uploads/images/categories/'.$category[0]->image.'" alt="">
                    <a href="/img/category/c1.jpg" class="img-pop-up" target="_blank">
                        <div class="deal-details">
                        <h6>
                            <a href="/category/' . $category[0]->id. '" style="color:white;">'
                            . $category[0]->name .
                            '</a>
                        </h6>
                        </div>
                    </a>
                </div>
            </div>';

                $this->htmlViews .= '<div class="col-lg-7 col-md-8">
                <div class="single-deal">
                    <div class="overlay"></div>
                    <img class="img-fluid w-100" src="/uploads/images/categories/'.$category[1]->image.'" alt="">
                    <a href="/img/category/c1.jpg" class="img-pop-up" target="_blank">
                        <div class="deal-details">
                        <h6>
                            <a href="/category/' . $category[1]->id. '" style="color:white;">'
                            . $category[1]->name .
                            '</a>
                        </h6>
                        </div>
                    </a>
                </div>
            </div>';
            }
        }
    }

    public function run() 
    {
        return $this->htmlViews;
    }
}