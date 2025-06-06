<?php 

class NewsController extends Controller {
    private $model_news;

    public function __construct() {
        $this->model_news = $this->model('newsModel');
    }

    public function index() {
        $this->renderAdmin('layout', ['page' => 'tabs/news']);
    }
}