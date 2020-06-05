<?php
//gets the server adress
$httpProtocol = !isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ? 'http' :'https';

//defines the address so we only need to use base."directory/" to get where we want
define("base", $httpProtocol.'://'.$_SERVER['HTTP_HOST'].'/lab4/');




?>