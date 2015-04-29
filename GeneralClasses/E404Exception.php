<?php
namespace App\GeneralClasses;

class E404Exception
    extends MyExceptions
{
    protected  $message = ['message' => 'Ошиибка 404. Запрашиваемая страница не найдена.'] ;

}
