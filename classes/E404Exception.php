<?php

class E404Exception
    extends MyExceptions
{

    protected  $message = ['message' => 'Ошиибка 404. Запрашиваемая страница не найдена.'] ;

    protected $view;



}