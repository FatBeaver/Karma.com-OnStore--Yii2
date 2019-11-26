<?php

namespace common\components;

class Pagination 
{
     /**
     * Общее количество записей в БД
     * 
     */
    public $total;
    /**
     * Лимит записей для вывода на 1 страницу;
     * 
     */
    public $limit;
    /**
     * Текущая страница
     * 
     */
    public $currentPage;
    /**
     * Количество странниц ссылок
     * 
     */
    public $countPage;
    /**
     * Индекс записи с которой необходимо начинать выборку данных из БД;
     * 
     */
    public $offset;
    
    public $countNavLinks;

    public $firstURIindex;

    public $secondURIindex;

    public function __construct($total, $limit, $currentPage, $first_index, $second_index = '')
    {
        $this->total = $total;
        $this->limit = $limit;
        $this->currentPage = $currentPage;
        $this->countPage = ceil($total / $limit); 
        $this->offset = ($currentPage - 1) * $limit;
        $this->firstURIindex = $first_index;
        $this->secondURIindex = $second_index;
    }

    public function getNavPageList($layout) 
    {
        if ($layout == 'category') require_once __DIR__ . '/pagination_layouts/category.php';
        if ($layout == 'review') require_once __DIR__ . '/pagination_layouts/review.php';
        if ($layout == 'blog') require_once __DIR__ . '/pagination_layouts/blog.php';
    }  
}