<?php

namespace App\Controllers;

use App\Models\News as Model;
use App\GeneralClasses\View;

class News

{
    protected $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../views/news/');
    }


    public function actionAll( )
    {
        $this->view->items = Model::findAll();
        $this->view->display('all');
    }


    public function actionOne()
    {
        $id = $_GET['id'];
        $this->view->items = Model::findOne($id);//получили массив новости
        $this->view->display('one');

    }

}
