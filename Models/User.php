<?php
namespace App\Models;
use App\GeneralClasses\DataB;


class User
    extends Model

{
    protected static $table = 'users';
    public $id;
    public $firstname;
    public $lastname;
    public $login;
    public $password;
    public $gender;
    public $role;


    public function data()
    {
        return $this->data = get_object_vars($this);
    }

    public static function findOneByLogin($login)
    {
        $class = self::class;
        $sql = 'SELECT * FROM ' . static::setTableName() . ' WHERE login=:login';
        $db = new DataB();
        return $db->getData($class, $sql, [':login' => $login]);

    }
}