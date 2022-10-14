<?php

$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db_name = 'b-chat2';

$conn = mysqli_connect($host,$user,$pass,$db_name);
if (!$conn) {
    die("Databases Connection ERROR 500");
}


?>