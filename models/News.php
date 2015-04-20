<?php
require_once __DIR__ . '/ArticleDb.php';

class News
    extends ArticleDb
{
    public function setTableName()
    {
        return 'news';
    }
}