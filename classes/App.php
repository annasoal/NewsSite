<?php
namespace App\General;

class App
{

    public static function getCurrentUserRole()
    {
        return $_SESSION['role'];
    }
}