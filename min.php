<?php

include_once ("CcMvc/bootstrap.php");
$min = new \Cc\MinScript();

echo '<pre>';
print_r($min->FileMin(array("src_orig/css/style.css", "src_orig/css/catalogo.css"), 'min', "src/css/sysunefa.min.css", 'css'));
print_r($min->FileMin("src_orig/css/font-awesome.css", '', "src/css/font-awesome.css", 'css'));
print_r($min->FileMin("src_orig/css/login_form.css", '', "src/css/login_form.min.css", 'css')); /**/
var_dump($_SERVER);
/*
ECHO '<PRE>';
var_dump($GLOBALS);*/
