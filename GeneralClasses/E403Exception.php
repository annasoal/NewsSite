<?php
namespace App\GeneralClasses;

class E403Exception
    extends MyExceptions
{
    protected  $message = ['message' => 'Ошибка 403. Доступ запрещен.'];

}
