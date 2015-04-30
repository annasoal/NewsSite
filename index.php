<?php
session_start();
var_dump($_GET);
//die;
use App\GeneralClasses\E403Exception;
use App\GeneralClasses\E404Exception;

require_once __DIR__ . '/autoload.php';
$ctrl = !empty($_GET['ctrl']) ? $_GET['ctrl'] : 'news';
$action = !empty($_GET['action']) ? $_GET['action'] : 'actionAll';

try {
    $ctrlClassName = 'App\\Controllers\\' . ucfirst($ctrl);
    $model = new $ctrlClassName();
    $model->$action();

} catch (E404Exception $e) {

    $e->showException();

} catch (E403Exception $e) {

    $e->showException();

}