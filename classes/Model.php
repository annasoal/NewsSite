<?php
require __DIR__ . '/../classes/DataB.php';

abstract class Model
{
    protected static $table;

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
        return $db->getData($class, $sql, [':id' => $id]);
    }

    public function insert()
    {
        $values = $this->values;

        foreach ($values as $k => $el) {
            if (($el != null)) {
                $cols = $cols . ', ' . $k;
                $vals = $vals . ', :' . $k;
                $params[':' . $k] = $el;
            }
        }


        $sql = 'INSERT INTO ' . static::setTableName() . ' (' . trim($cols, ', ') . ') VALUES (' . trim($vals, ', ') . ')';

        $db = new DataB();
        return $id = $db->addRecord($sql, $params);
    }

    public function delete($id)
    {

        $sql = 'DELETE FROM ' . static::setTableName() . ' WHERE id=:id';
        $db = new DataB();
        return $db->deleteRecord($sql, [':id' => $id]);
    }

    public
    function update()
    {
        $values = $this->values;

        foreach ($values as $k => $el) {
            if (($el != null)) {
                $str = $str . ', ' . $k . '=:' . $k;
                $params[':' . $k] = $el;
            }
        }

        $sql = 'UPDATE ' . static::setTableName() . ' SET ' . (trim($str, ', ')) . ' WHERE id=:id';

        $db = new DataB();
        return $db->updateRecord($sql, $params);
    }
}

