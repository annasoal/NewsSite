<?php

class NewsController


{
    protected $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../views/news/');
    }

    public function actionAll()
    {
        $this->view->items = News::findAll();
        $this->view->display('all');
    }


    public function actionOne()
    {
        $id = $_GET['id'];
        $this->view->items = News::findOne($id);//получили массив новости
        $this->view->display('one');

    }


}
