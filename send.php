<?php

session_start();
include('config/db.php');

$name = $_SESSION['name'];
$msg = $_REQUEST['text'];

$query = "INSERT INTO chats(person,value)VALUES('$name','$msg')";
mysqli_query($conn,$query);


?>