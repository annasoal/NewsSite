<?php
namespace App\GeneralClasses;

class Application
{

    public static function getCurrentUserRole()
    {
        return $_SESSION['role'];
    }
    public static function getCurrentUserLogin()
    {
        return $_SESSION['login'];
    }
}