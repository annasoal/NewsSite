<?php
session_start();
require_once __DIR__ . '/autoload.php';
$ctrl = !empty($_GET['ctrl']) ? $_GET['ctrl'] : 'news';
$action = !empty($_GET['action']) ? $_GET['action'] : 'actionAll';

if ($ctrl == 'news') {
    if (!empty ($_GET['id']) && ($_GET['action'] == 'actionOne')) {
        $action = 'actionOne';
    }
} elseif ($ctrl == 'admin') {
    if ($_GET['action'] == 'addOne') {
        $action = 'showpost';
        If (isset ($_POST['postit'])) {
            $action = 'addOne';
        }
    } elseif ($_GET['action'] == 'update') {
        $action = 'showupdate';
        If (isset ($_POST['updateit'])) {
            $action = 'update';
        }
    }
} elseif ($ctrl == 'users') {
    if ($_GET['action'] == 'addUser') {
        $action = 'showRegistrationForm';
        If (isset ($_POST['register'])) {
            $action = 'addUser';
        }
    }
    if ($_GET['action'] == 'findUser') {
        $action = 'showAuthorizationForm';
        If (isset ($_POST['authorize'])) {
            $action = 'findUser';
        }
    }
}

try {
    $ctrlClassName = ucfirst($ctrl) . 'Controller';
    if ($ctrl == 'admin') {
        if ($_SESSION['role'] != 'admin') {
            throw new E403Exception();
        }
    }
    $model = new $ctrlClassName();
    $act = $model->$action();

} catch (E404Exception $e) {

    echo $e->getMessage();


} catch (E403Exception $e) {

    echo $e->getMessage();

}
