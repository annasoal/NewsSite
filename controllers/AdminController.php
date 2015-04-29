<?php


class AdminController

{
    protected $view;
    protected $userrole;
    public static $model = 'News';

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../views/news/');
        $this->userrole = App::getCurrentUserRole();
        if ($this->userrole != 'admin') {
            throw new E403Exception;
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
                $news = new News();
                $news->title = $_POST['title'];
                $news->text = $_POST['text'];
                $news->author = $_POST['author'];
                $news->values = $news->data();
                $news->insert();
                if ($news->id !== false) {
                    $_SESSION['postok'] = 'Новость добавлена, перейдите на главную страницу для просмотра. Id новости:' . $news->id;
                }
            } elseif ($_POST['title'] == '' || $_POST['text'] == '') {
                $_SESSION['posterrors'] = 'Не введены обязательные данные';
            }
            header('Location: http://newssite/index.php?ctrl=admin&action=showaddOne');
            exit;
        }
    }

    public function showUpdateOne()
    {

        $this->id = $_GET['id'];
        $model = static::$model;
        $this->view->items = $model::findOne($this->id);//получили массив новости
        $this->view->display('update');
    }

    public function update()
    {
        if (isset($_POST['updateit'])) {
            $id = $_GET['id'];
            $model = static::$model;
            $news = $model::findOne($id)[0];
            if ($_POST['title'] != '' && $_POST['text'] != '') {
                $news->title = $_POST['title'];
                $news->text = $_POST['text'];
                $news->author = $_POST['author'];
                $news->values = $news->data();
                $res = $news->update();

                if ($res !== false) {
                    $this->view->items = News::findOne($news->id);
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
        $model = static::$model;
        $news = $model::findOne($id)[0];
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
