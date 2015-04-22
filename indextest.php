<?php

class DataB
{
    protected $dbh;

    public function __construct()
    {
        $config = include_once __DIR__ . '/configs/db.php';
        $dsn = 'mysql:dbname=' . $config['dname'] . ';host=' . $config['host'];
        $this->dbh = new PDO($dsn, $config['user'], $config['password']);
    }
    public function addRecord($sql,$class,$params=[])
    {
        $sth = $this->dbh->prepare($sql);
        $sth-> execute($params);
        //$sth->fetchAll(PDO::FETCH_CLASS, $class);
        return $class->id = $sth->fetchColumn();
    }


}
abstract class Model
{
    public function addOneRecord()
    {
        $class = static::class;
        $sql = 'INSERT INTO ' .static::setTableName() . ' (id,title, text, author, date) VALUES (?, :title,:text,
               :author, :date)';
        $db = new DataB();
        return $db->addRecord($class, $sql, [ ':title' => $class->title, ':text'=> $class->text, ':autor'=>$class->author, ':date'=>$class->date]);
    }

}
require_once __DIR__ . '/classes/View.php';

class AdminController

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
            $news = new News();
            $news->title = $_POST['title'];
            $news->text = $_POST['text'];
            $news->author = $_POST['author'];
            $news->date = date('Y-m-d H:i:s');
            $news->addOneRecord();
            var_dump($news->title);
            echo $news->id;
        }
        /*

            If ($add !== false) {
                $_SESSION['ok'] = 'Новость добавлена, перейдите на главную страницу для просмотра';
            }
        } elseif ($_POST['title'] == '' || $_POST['text'] == '') {
            $_SESSION['errors'] = 'Не введены обязательные данные';
        }

        header('Location: http://php-lessons/index.php?ctrl=admin&action=addOne');

        exit;*/
    }
}
session_start();
$ctrl = !empty($_GET['ctrl']) ? $_GET['ctrl'] : 'news';
$action = !empty($_GET['action']) ? $_GET['action'] : 'actionAll';

if (!empty ($_GET['id']) && ($_GET['action'] == 'actionOne')) {
    $action = 'actionOne';

} elseif ($_GET['action'] == 'addOne') {
    $action = 'show';
    If (isset ($_POST['postit'])) {
        $action = 'addOne';
    }
}
$ctrlClassName = ucfirst($ctrl) . 'Controller';
require_once __DIR__ . '/controllers/' . $ctrlClassName . '.php';
$news = new $ctrlClassName();
$act = $news->$action();