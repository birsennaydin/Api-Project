<?php 
$startTime = date("Y-m-d H:i:s");

$convertedTime = date('Y-m-d H:i:s', strtotime('+10 minutes', strtotime($startTime)));
var_dump($convertedTime);
?>
