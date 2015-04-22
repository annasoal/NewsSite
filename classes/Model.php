<?php
require __DIR__ . '/../classes/DataB.php';

abstract class Model
{
    protected static $table;

    public static function setTableName()
    {
        return static::$table;
    }

    public static function columns()
    {
        return get_class_vars(static::class);
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
        $class = static::class;

        $values = $this->values;
        $vars = $class::columns();
        foreach ($vars as $key => $val) {
            foreach ($values as $k => $el) {
                if (($key == $k) && ($el != null)) {
                    $cols = $cols . ', ' . $key;//значения колонок из списка свойств класса
                    $vals = $vals . ', :' . $key;//значения ключей полей записи при совпадении со свойством класса
                    $params[':' . $key] = $el;// значения полей из списка свойств объекта
                }
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
    public function update()
    {
        $class = static::class;

        $values = $this->values;
        $vars = $class::columns();

        foreach ($vars as $key => $val) {
            foreach ($values as $k => $el) {
                if (($key == $k) && ($el != null)) {
                    $str = $str . ', ' . $key . '=:' . $key;
                    $params[':' . $key] = $el;
                }
            }
        }
        $sql = 'UPDATE ' . static::setTableName() . ' SET ' .(trim($str,', ')) .' WHERE id=:id';

        $db = new DataB();
        return $db->deleteRecord($sql,$params);
    }
}

