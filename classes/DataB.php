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

    public function getData($class,$sql,$params=[])

    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        $arr = $sth->fetchAll(PDO::FETCH_CLASS, $class);
        return $arr;
    }
    public function addRecord($sql,$params=[])
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        $id  = $this->dbh->lastInsertId();
        return $id;

    }
    public function deleteRecord($sql,$params=[])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        return $res;
    }
    public function updateRecord($sql,$params=[])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        return $res;

    }
}

