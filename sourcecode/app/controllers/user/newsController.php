<?php

class NewsController extends Controller
{
    private $category;
    private $model_category;

    private $general;
    private $model_general;

    private $model_news;

    public function __construct()
    {
        $this->model_category = $this->model('CategoryModel');
        $this->model_general = $this->model('GeneralModel');
        $this->model_news = $this->model('NewsModel');

        $this->category = $this->model_category->getAll();
        $this->general = $this->model_general->getAll();
    }

    public function list_news($page = 1, $search = '')
    {
        $each_page = 6;

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $maxSearch = $this->model_news->getTotalNews($search);
        } else if ($search != '') {
            $maxSearch = $this->model_news->getTotalNews($search);
        } else {
            $maxSearch = $this->model_news->getTotalNews();
        }

        $maxPage = ceil($maxSearch / $each_page);

        $start = ($page - 1) * $each_page;
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $news = $this->model_news->getAllByPage($start, $each_page, $search);
            $head = "Tìm kiếm: $search";
        } else if ($search != '') {
            $news = $this->model_news->getAllByPage($start, $each_page, $search);
            $head = "Tìm kiếm: $search";
        } else {
            $news = $this->model_news->getAllByPage($start, $each_page);
            $head = "Tất cả tin tức";
        }
        $this->renderUser('layout', ['page' => 'news/list', 'category' => $this->category, 'general' => $this->general, 'news' => $news, 'maxPage' => $maxPage, 'currentPage' => $page, 'search' => $search, 'heading' => $head]);
    }

    public function detail_news($nid)
    {
        $news = $this->model_news->getAllByID($nid);
        $restaurant = $this->model_news->getRelatedRes($nid);
        $this->renderUser('layout', ['page' => 'news/detail', 'category' => $this->category, 'news' => $news, 'restaurant' => $restaurant, 'general' => $this->general]);
    }
}
