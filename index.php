<?php
session_start();
require_once __DIR__ . '/autoload.php';
$ctrl = !empty($_GET['ctrl']) ? $_GET['ctrl'] : 'news';
$action = !empty($_GET['action']) ? $_GET['action'] : 'actionAll';

try {
    $ctrlClassName = ucfirst($ctrl) . 'Controller';
    $model = new $ctrlClassName();
    $model->$action();

} catch (E404Exception $e) {

    $e->showException();

}catch (E403Exception $e) {

    $e->showException();

}