<?php
require_once __DIR__ . '/../classes/Model.php';

class News
    extends Model

{
    protected static $table = 'news';
    public $id;
    public $title;
    public $text;
    public $author;
    public $date;

    public function values()
    {
        return $vals = get_object_vars($this);
    }
}

