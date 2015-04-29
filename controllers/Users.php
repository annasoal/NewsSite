<?php
namespace App\Controllers;
use App\Models\User;
use App\ViewModel\View;

class Users
{
    protected $view;
    //public static $model = 'User';

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../views/users/');
    }

    public function showRegistrationForm()
    {
        $this->view->display('registration');
    }

    public function addUser()
    {
        if (isset($_POST['register'])) {
            if ($_POST['email'] != '' && $_POST['password'] != '') {
                $users = new User();
                $users->firstname = $_POST['firstname'];
                $users->lastname = $_POST['lastname'];
                $users->login = $_POST['email'];
                $users->password = $_POST['password'];
                $users->gender = $_POST['optionsGender'];
                $users->role = 'registered user';
                $users->values = $users->data();
                $users->insert();
                if ($users->id !== false) {
                    $_SESSION['ok'] = 'Пользователь добавлен, перейдите  <a href="?ctrl=users&action=showProfile&id=' .
                        $users->id . '"> на  страницу для просмотра профиля </a>. Id пользователя:' . $users->id;
                }
            } elseif ($_POST['email'] == '' || $_POST['password'] == '') {
                $_SESSION['errors'] = 'Не введены обязательные данные';
            }
            header('Location: http://newssite/index.php?ctrl=users&action=showRegistrationForm');
            exit;
        }
    }

    public function showAuthorizationForm()
    {
        $this->view->display('authorization');
    }

    public function findUser()
    {
        if (isset($_POST['authorize'])) {
            if ($_POST['login'] != '' && $_POST ['pass'] != '') {
                $login = $_POST['login'];

                $password = $_POST['pass'];
                $user = User::findOneByLogin($login)[0];

                if ($user != false) {
                    if ($user->password == $password) {
                        $_SESSION['authorizeok'] = 'Вы авторизованы';
                        $_SESSION['id'] = $user->id;
                        $_SESSION['role'] = $user->role;
                        //var_dump($_SESSION['id']);
                        //setcookie('id', $_SESSION['id'], time() + 86400 * 5);
                        //setcookie('role', $user->role, time() + 86400 * 5);
                        //var_dump($_COOKIE['role']);
                        $this->view->items = User::findOneByLogin($login);
                        $this->view->display('profile');


                    } elseif ($user->password != $password) {

                        $_SESSION['authorizeerrors'] = 'Неверный пароль';
                    }
                } else {
                    $_SESSION['authorizeerrors'] = 'Неверный логин';
                }
            } else {
                $_SESSION['authorizeerrors'] = 'Не заполнены обязательные поля';
            }
            header('Location: http://newssite/index.php?ctrl=users&action=showAuthorizationForm');
            exit;

        }
    }

    public function showProfile()
    {
        $id = $_GET['id'];
        $this->view->items = User::findOne($id);
        $this->view->display('profile');
    }
}