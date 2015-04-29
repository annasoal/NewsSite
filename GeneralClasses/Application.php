<?php
namespace App\GeneralClasses;

class Application
{

    public static function getCurrentUserRole()
    {
        return $_SESSION['role'];
    }
}