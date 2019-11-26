<?php 

namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class CategoryWidget extends Widget
{
    public $viewHtml = '';
    public $categories;

    public function init()
    {
        parent::init();
        if (!is_array($this->categories)) return die('Property ' . $this->categories . ' non array');
        if (empty($this->categories)) return $this->htmlViews = '<h3>Категорий нет</h3>';

        foreach($this->categories as $key => &$category) 
        {   
            foreach($this->categories as &$child) {
                if($category->id == $child->parent_id) {
                    $category->childs[] = $child;
                } 
            }
            if($category->parent_id != 0) unset($this->categories[$key]);
        }
       // echo phpinfo();
         //echo '<pre>';
        // print_r($x);
        // echo '</pre>';
        // exit;
        $this->viewHtml .= '<div class="head">Категории товаров</div>';
        $this->viewHtml .= '<ul class="main-categories">';
        foreach ($this->categories as $category) 
        {
            if (!isset($category->childs)) {
                $this->viewHtml .= '<li class="main-nav-list">
                <a href="/category/'.$category->id.'">'. $category->name .
                '<span class="number">( ' . count($category->products). ' )</span>
                </a></li>';
            } else {
                $this->viewHtml .= '<li class="main-nav-list"><a data-toggle="collapse" href="#'. $category->name.'" 
                aria-expanded="false" aria-controls="'. $category->name .'"><span class="lnr lnr-arrow-right">
                </span>'. $category->name .'<span class="number">( ' . count($category->products). ' )</span></a>
                    <ul class="collapse" id="'.$category->name . '" data-toggle="collapse" aria-expanded="false" 
                    aria-controls="' . $category->name . '">';
                        foreach($category['childs'] as $child) 
                        {
                            $this->viewHtml .=  '<li class="main-nav-list child">
                            <a href="/category/'.$child->id.'">' . $child->name. 
                            '<span class="number">( ' . count($category->products). ' )</span>
                            </a></li>';
                        }
                $this->viewHtml .= '</ul>';
                $this->viewHtml .= '</li>';
            }
        }
        $this->viewHtml .= '</ul>';
    }

    public function run() 
    {
        return $this->viewHtml;
    }
}