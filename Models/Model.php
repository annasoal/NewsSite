<?php

namespace App\Models;
use App\GeneralClasses\DataB;
use App\GeneralClasses\E404Exception;

abstract class Model
{
    protected static $table;
    protected $data;

    public static function setTableName()
    {
        return static::$table;
    }

    abstract public function data();


    public static function findAll()
    {
        $class = static::class;
        $sql = 'SELECT * FROM ' . static::setTableName() . ' ORDER BY date DESC';
        $db = new DataB();
        return $db->getData($class, $sql);
    }

    public static function findOne($id)
    {
        $class = static::class;
        $sql = 'SELECT * FROM ' . static::setTableName() . ' WHERE id=:id';
        $db = new DataB();
        $res = $db->getData($class, $sql, [':id' => $id]);
        if (false != $res) {
            return $res;
        } else {
            throw new E404Exception();
        }
    }

    public function insert()
    {
        $values = $this->data;

        foreach ($values as $k => $el) {
            if (($el != null)) {
                $cols[] = $k;
                $vals[] = ':' . $k;
                $params[':' . $k] = $el;
            }
        }
        $colsStr = implode(',', $cols);
        $valsStr = implode(',', $vals);


        $sql = 'INSERT INTO ' . static::setTableName() . ' (' . $colsStr . ') VALUES (' . $valsStr . ')';

        $db = new DataB();
        $db->execChanges($sql, $params);
        $this->id = $db->getInsertId();
    }

    public function delete()
    {

        $sql = 'DELETE FROM ' . static::setTableName() . ' WHERE id=:id';
        $db = new DataB();
        return $db->execChanges($sql, [':id' => $this->id]);
    }

    public function update()
    {
        $values = $this->data;

        foreach ($values as $k => $el) {
            if (($el != null)) {
                $str[] = $k . '=:' . $k;
                $params[':' . $k] = $el;
            }
        }
        $strStr = implode(',', $str);

        $sql = 'UPDATE ' . static::setTableName() . ' SET ' . $strStr . ' WHERE id=:id';

        $db = new DataB();
        return $db->execChanges($sql, $params);
    }
}

