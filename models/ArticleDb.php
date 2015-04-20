<?php
require_once __DIR__ . '/../classes/DataB.php';

abstract class ArticleDb
{


    // VARIABLES
    public $id;
    public $title;
    public $text;
    public $author;
    public $date;
    protected $db;
    /**
     * var DataB $db;
     */

    // FUNCTIONS
    public function __construct($title = null, $text = null, $author = null, $date = null)
    {
        $this->title = $title;
        $this->text = $text;
        $this->author = $author;
        $this->date = $date;
        $this->db = new DataB;

    }


    abstract public function setTableName();

    public function getAllData()
    {

        return $this->db->getData("SELECT * FROM `" . $this->setTableName() . "` ORDER BY `date` DESC");
    }


    public function addOneRecord()
    {
        return $this->db->changeData("INSERT INTO `" . $this->setTableName() . "`(`title`, `text`, `author`,`date`) VALUES ('" .
            $this->title . "','" . $this->text . "','" . $this->author . "','" . $this->date . "')");
    }


    public function getOneRecord($id)
    {
        return $this->db->getData("SELECT * FROM `" . $this->setTableName() . "` WHERE `id` = " . $id);
    }

    public function deleteRecord($id)
    {
        return $this->db->changeData("DELETE * FROM `" . $this->setTableName() . "` WHERE `id` = " . $id);
    }

    public function changeRecord($id, $newtitle, $newtext, $newauthor)
    {
        $newdate = date('Y-m-d H-m-s');
        return $this->db->changeData("UPDATE `" . $this->setTableName() . "` SET `title` = '" . $newtitle . "',`text` = '" . $newtext . "',
                               `author` = '" . $newauthor . "',`date`= '" . $newdate . "' WHERE `id` = " . $id);
    }

}
