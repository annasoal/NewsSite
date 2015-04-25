<?php
//require_once __DIR__ . '/../models/News.php';
//require_once __DIR__ . '/AbsController.php';
//require_once __DIR__ . '/../classes/View.php';
//require_once __DIR__ . '/NewsController.php';

class AdminController
    //extends AbsController
{
    protected $view;
    public static $model = 'News';

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../views/news/');
    }

    public function showpost()
    {
        $this->view->display('post');
    }

    public function addOne()
    {
        if (!empty($_POST)&& $_POST['title'] != '' && $_POST['text'] != '') {
            $news = new News();
            $news->title = $_POST['title'];
            $news->text = $_POST['text'];
            $news->author = $_POST['author'];
            $news->values = $news->data();
            $news->insert();
            if ($news->id !== false) {
                $_SESSION['ok'] = 'Новость добавлена, перейдите на главную страницу для просмотра. Id новости:' . $news->id;
            }
        } elseif ($_POST['title'] == '' || $_POST['text'] == '') {
            $_SESSION['errors'] = 'Не введены обязательные данные';
        }
        header('Location: http://newssite/index.php?ctrl=admin&action=addOne');
        exit;
    }

    public function showupdate()
    {
        $this->id = $_GET['id'];
        $model = static::$model;
        $this->view->items = $model::findOne($this->id);//получили массив новости
        $this->view->display('update');
    }
    public function update()
    {

        $this->id = $_GET['id'];
        $model = static::$model;
        $news = $model::findOne($this->id)[0];
        if (!empty($_POST)&& $_POST['title'] != '' && $_POST['text'] != '') {
            $news->title = $_POST['title'];
            $news->text = $_POST['text'];
            $news->author = $_POST['author'];
            //var_dump($_POST);
            //var_dump($news);
            $news->values = $news->data();
            $res = $news->update();

            if ($res !== false) {
                $this->view->items = News::findOne($news->id);
                $this->view->display('one');
            }

        } elseif ($_POST['title'] == '' || $_POST['text'] == '') {
            $_SESSION['updateerrors'] = 'Не введены обязательные данные';
            $this->showupdate();
        }
        exit;
    }

    public function delete()
    {
        $this->id = $_GET['id'];
        $model = static::$model;
        $news = $model::findOne($this->id)[0];
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
