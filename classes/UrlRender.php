<?php


class UrlRender
{

    public function renderUrl()
    {
        $url = $_SERVER['REQUEST_URI'];
        //var_dump($url);

        $arr = explode('/', (parse_url($url)['query']));
        // var_dump($arr);
        return $arr;

    }
}

