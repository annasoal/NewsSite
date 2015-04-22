<?php
session_start();
$ctrl = !empty($_GET['ctrl']) ? $_GET['ctrl'] : 'news';
$action = !empty($_GET['action']) ? $_GET['action'] : 'actionAll';

if (!empty ($_GET['id']) && ($_GET['action'] == 'actionOne')) {
    $action = 'actionOne';

} elseif ($_GET['action'] == 'addOne') {
    $action = 'showpost';
    If (isset ($_POST['postit'])) {
        $action = 'addOne';
    }
}elseif ($_GET['action'] == 'update') {
    $action = 'showupdate';
    If (isset ($_POST['updateit'])) {
        $action = 'update';
    }
}
$ctrlClassName = ucfirst($ctrl) . 'Controller';
require_once __DIR__ . '/controllers/' . $ctrlClassName . '.php';
$news = new $ctrlClassName();
$act = $news->$action();

