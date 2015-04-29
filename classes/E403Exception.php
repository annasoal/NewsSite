<?php
namespace App\Exceptions;

class E403Exception
    extends MyExceptions
{
    protected  $message = ['message' => 'Ошибка 403. Доступ запрещен.'];

}
