<?php

namespace App\Models;



class News
    extends Model

{
    protected static $table = 'news';
    public $id;
    public $title;
    public $text;
    public $author;
    public $date;


    public function data()
    {
        return $this->data = get_object_vars($this);
    }
}

