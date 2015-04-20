<?php
require_once __DIR__ . '/DataIterator.php';

class View
    implements Countable

{
    protected $path;
    protected $data = [];

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function __set($k, $v)
    {
        $this->data[$k] = $v;
    }

    public function __get($k)
    {
        return $this->data[$k];
    }

    public function count()
    {
        return count($this->data);
    }

    public function display($template, $quantity = null)
    {
        /*foreach ($this->data as $k => $v) {
         $$k = $v;
        }
        */
        //$obj = new ArrayObject($this->data);
        //$items = $obj->getIterator();

        $items = new DataIterator($this->data);

        ob_start();

        include($this->path . '/' . $template . '.php');

        $content = ob_get_contents();
        ob_end_clean();

        If (isset ($quantity)) {
            $content .= 'Всего новостей: ' . $quantity;
        }
        echo preg_replace('<copyright>', 'p> &copy; I LOVE PHP 2015 </p', $content);
    }
}