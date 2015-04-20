<?php

class DataB
{
    public function __construct()
    {
        $config = include __DIR__.'/../configs/db.php';
        mysql_connect($config['host'], $config['user'], $config['password']) or die(mysql_error());
        mysql_select_db($config['dname']);

    }
// функция работы с запросами к БД (добавление, изменение, удаление)
    public function changeData($sqlquery)
    {

        $res = mysql_query($sqlquery);
        If (false === $res) {
            return false;
        }

        return $res;
    }
// функция чтения данных в массив
    public function getData($sqlquery)
    {
        $res = mysql_query($sqlquery);
        If (false === $res) {
            return false;
        }
        while (false !== ($row = mysql_fetch_object($res))) {
            $arr[] = $row;
        }
        return $arr;
    }
}
