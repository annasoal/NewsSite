<?php

namespace App\GeneralClasses;


class MyExceptions
    extends \Exception
{
protected $message;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../views/exceptions/');
    }

    public function showException()
    {
        $this->view->items = $this->message;
        $this->view->display('exception');
    }
}