<?php
require __DIR__ . '/../classes/DataB.php';

abstract class Model
{
    protected static $table;

    public static function setTableName()
    {
        return static::$table;
    }
    public static function findAll()
    {
        $class = static::class;
        $sql = 'SELECT * FROM ' .static::setTableName();
        $db = new DataB();
        return $db->getData($class, $sql);
    }
    public static function findOne($id)
    {
        $class = static::class;
        $sql = 'SELECT * FROM ' .static::setTableName() . ' WHERE id=:id';
        $db = new DataB();
        return $db->getData($class, $sql, [':id' => $id]);
    }
}
