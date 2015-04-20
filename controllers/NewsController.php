<?php
require_once __DIR__ . '/../models/News.php';
require_once __DIR__ . '/../classes/View.php';
//require_once __DIR__ . '/AbsController.php';

class NewsController
   //extends AbsController

{
    protected $view;
    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../views/news/');
    }

    public function actionAll(){
        $news = new News();
        $this->view->items = $news->getAllData();//получили массив новостей
        $this->view->display('all',count($this->view->items));

    }
    public function actionOne(){
        $news = new News();
        $id = $_GET['id'];
        $this->view->items = $news->getOneRecord($id);//получили массив новости
        $this->view->display('one');

    }


}
