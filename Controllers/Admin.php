<?php

namespace App\Controllers;

use App\Models\News as Model;
use App\GeneralClasses\E403Exception as E403;
use App\GeneralClasses\Application as App;
use App\GeneralClasses\View;

class Admin

{
    protected $view;
    protected $userrole;
    public static $model = 'News';

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../views/news/');
        $this->userrole = App::getCurrentUserRole();
        if ($this->userrole != 'admin') {
            throw new E403();
        }
    }

    public function showAddOne()
    {
        $this->view->display('post');
    }

    public function addOne()
    {
        if (isset($_POST['postit'])) {
            if ($_POST['title'] != '' && $_POST['text'] != '') {
                $news = new Model();
                $news->title = $_POST['title'];
                $news->text = $_POST['text'];
                $news->author = $_POST['author'];
                $news->values = $news->data();
                $news->insert();
                if ($news->id !== false) {
                    $_SESSION['postok'] = 'Новость добавлена. Id новости:' .
                        $news->id;
                }
            } elseif ($_POST['title'] == '' || $_POST['text'] == '') {
                $_SESSION['posterrors'] = 'Не введены обязательные данные';
            }
            $id = $news->id;
            $this->view->items =  Model::findOne($id);
            $this->view->display('one');
            exit;
        }
    }

    public function showUpdateOne()
    {

        $this->id = $_GET['id'];
        $this->view->items = Model::findOne($this->id);//получили массив новости
        $this->view->display('update');
    }

    public function update()
    {
        if (isset($_POST['updateit'])) {
            $id = $_GET['id'];
            $news = Model::findOne($id)[0];
            if ($_POST['title'] != '' && $_POST['text'] != '') {
                $news->title = $_POST['title'];
                $news->text = $_POST['text'];
                $news->author = $_POST['author'];
                $news->values = $news->data();
                $res = $news->update();

                if ($res !== false) {
                    $_SESSION['updateok'] = 'Новость изменена';
                    $this->view->items = Model::findOne($news->id);
                    $this->view->display('one');
                }

            } elseif ($_POST['title'] == '' || $_POST['text'] == '') {
                $_SESSION['updateerrors'] = 'Не введены обязательные данные';
                $this->showUpdateOne();
            }
            exit;
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $news = Model::findOne($id)[0];
        $res = $news->delete();

        $this->view->display('delete');
        if (false !== $res) {
            $_SESSION['delok'] = 'Новость удалена';
        } else {
            $_SESSION['delerrors'] = 'Новость невозможно удалить';
        }
        exit;
    }
}
