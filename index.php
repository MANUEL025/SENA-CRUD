<?php 
$controller = isset($_GET['c']) ?  $_GET['c'] : 'login';
$controller= $controller.'Controller';

$method = isset($_GET['m']) ? $_GET['m'] : 'login';
require_once('./controllers/'.$controller.'.php');
$obj = new $controller();
$obj->$method();
