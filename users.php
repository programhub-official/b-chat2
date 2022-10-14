<?php
session_start();
if (empty($_SESSION['auth'])) {
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo.ico" type="image/gif"/>
    <title>B-ChatApp </title>
</head>
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="bootstrap/css/index.css">
<body>
    <h2 class="wh">Online Users</h2>
    <div class="container text-center">
        <div class="anyClass">
            <h3 class="wh">0 Users Found</h3>
        </div>
    </div>
</body>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="bootstrap/js/jquery.js"></script>
<script>
    setInterval(() => {
    $.post('getusers.php',
    function(data,status) {
      document.getElementsByClassName('anyClass')[0].innerHTML = data;
    }
  );
  }, 600);
</script>
</html>