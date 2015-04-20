<?php

class DataB
{
    protected $dbh;

    public function __construct()
    {
        $config = include __DIR__ . '/../configs/db.php';
        $dsn = 'mysql:dbname=' . $config['dname'] . ';host=' . $config['host'];
        $this->dbh = new PDO($dsn, $config['user'], $config['password']);
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
    public function getData($class,$sql,$params=[])

    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        $arr = $sth->fetchAll(PDO::FETCH_CLASS, $class);

        return $arr;
    }
}
 echo $arr;