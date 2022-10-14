<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo.ico" type="image/gif"/>
    <title>B-ChatApp Register</title>
</head>
<style>
    .lin{
        color: white;
    }
</style>
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="bootstrap/css/index.css">
<body>
    <div class="text-center">
        <img class="mb-4" src="images/logo.ico" alt="" width="100" height="100">
    </div>
    <form action="code.php" class="form-signin" method="post">
        <div class="text-center mb-4">
            <label class="wh" for="inputText"><h3>Register</h3></label><br>
            <input type="text" id="inputText" class="form-control mb-3" name="name" placeholder="Username" value="<?php if (isset($_SESSION['user_name'])) {
                echo $_SESSION['user_name'];
                unset($_SESSION['user_name']);
            } ?>" required>
            <input type="email" id="inputText" class="form-control mb-3 email" name="email" placeholder="Email" value="<?php if (isset($_SESSION['user_email'])) {
                echo $_SESSION['user_email'];
                unset($_SESSION['user_email']);
            } ?>" required>
            <input type="password" id="inputText" class="form-control mb-3" name="passwd" placeholder="Password" required>
            <?php
            if (isset($_SESSION['status'])) {
                echo "<b class='wh' >". $_SESSION['status'] . "</b><br>";
                unset($_SESSION['status']);
            }
            ?>
            <button type="submit" class="btn btn-primary btn-block" name="registerbtn" >Register</button><br><br>
            <a class="lin" href="login.php">I Have Already Account</a>
        </div>
    </form>
    <footer class="wh">
        <div class="container">
            <div class="anyClass">
            </div>
        </div>
    </footer>
</body>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="bootstrap/js/jquery.js"></script>
<script>
    $(document).ready(function() {
        $('.email').keyup(function(e) {
            $.post('code.php',{cmd:true,email:$('.email').val()},
            function (data,status) {
                console.log(data);
            });
        });
    });
</script>
</html>