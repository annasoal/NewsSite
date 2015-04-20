<?php
require_once __DIR__ . '/../models/News.php';
//require_once __DIR__ . '/AbsController.php';
require_once __DIR__ . '/../classes/Vie.php';

class AdminController
    //extends AbsController
{
    protected $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../views/news/');
    }

    public function show()
    {
        $this->view->display('post');
    }

    public function addOne()
    {
        If ($_POST['title'] != '' && $_POST['text'] != '') {
            $title = $_POST['title'];
            $text = $_POST['text'];
            $author = $_POST['author'];
            $date = date('Y-m-d H:i:s');

            $news = new News($title, $text, $author, $date);
            $add = $news->addOneRecord();

            If ($add !== false) {
                $_SESSION['ok'] = 'Новость добавлена, перейдите на главную страницу для просмотра';
            }
        } elseif ($_POST['title'] == '' || $_POST['text'] == '') {
            $_SESSION['errors'] = 'Не введены обязательные данные';
        }

        header('Location: http://php-lessons/index.php?ctrl=admin&action=addOne');

        exit;
    }
}