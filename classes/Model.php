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

    public function insert($values)
    {
        $class = static::class;

        $vars = $class::columns();

        foreach ($vars as $col => $val) {
            $tablecolumns[] = $col;
        }

        foreach ($tablecolumns as $key => $val) {
            foreach ($values as $k => $el) {
                if (($val == $k) && ($el != null)) {
                    $cols = $cols . ', ' . $val;
                    $vals = $vals . ', :' . $val;
                    $params[':' . $val] = $el;
                }
            }
        }

        $sql = 'INSERT INTO ' . static::setTableName() . ' (' . trim($cols, ', ') . ') VALUES (' . trim($vals, ', ') . ')';

        $db = new DataB();
        return $id = $db->addRecord($sql, $params);
    }

    public function delete($id)
    {
        //$class = static::class;
        $sql = 'DELETE FROM ' . static::setTableName() . ' WHERE id=:id';
        $db = new DataB();
        return $db->deleteRecord($sql, [':id' => $id]);
    }
    public function update($values)
    {
        $class = static::class;
        $vars = $class::columns();

        foreach ($vars as $col => $val) {
            $tablecolumns[] = $col;
        }

        foreach ($tablecolumns as $key => $val) {
            foreach ($values as $k => $el) {
                if (($val == $k) && ($el != null)) {
                    $str = $str . ', ' . $val . '=:' . $val;
                    $params[':' . $val] = $el;
                }
            }
        }
        $sql = 'UPDATE ' . static::setTableName() . ' SET ' .(trim($str,', ')) .' WHERE id=:id';
        var_dump($sql);
        var_dump($params);
        $db = new DataB();
        return $db->deleteRecord($sql,$params);
    }
}

