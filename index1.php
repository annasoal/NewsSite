<?php

require_once __DIR__.'/indextest.php';
$data = [
1=>'a',
2=>'b',
3=>'Controllers'
];
$items = new DataIterator($data);
foreach ($items as $key=>$value) {
    echo $value, ' ';
}
