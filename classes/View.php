<?php


class View
    implements Countable

{
    protected $path;
    public $data = [];



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

    public function render($template)
    {
        foreach ($this->data as $k => $v) {
        $$k = $v;
        }

        //$obj = new ArrayObject($this->data);
        //$items = $obj->getIterator();

        //$quantity = count($this->data);

        ob_start();

        include($this->path . '/' . $template . '.php');

        $content = ob_get_contents();
        ob_end_clean();

        //If ($quantity>=2) {
            //$content .= 'Всего новостей: ' . $quantity;
        //}
        return str_replace('<copyright>', '<p> &copy; I LOVE PHP 2015 </p>', $content);
    }
    public function display ($template)
    {
       echo $this->render($template);
    }
}