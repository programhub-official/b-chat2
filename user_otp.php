<?php
session_start();

if (!isset($_SESSION['otp'])) {
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
    <title>ChatApp - OTP</title>
</head>
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="bootstrap/css/index.css">
<body>
    <div class="text-center">
        <img class="mb-4" src="images/logo.ico" alt="" width="100" height="100">
    </div>
    <form action="code.php" class="form-signin" method="post">
        <div class="text-center mb-4">
            <label class="wh" for="inputText"><h3>User Verification</h3></label><br>
            <input type="text" id="inputText" class="form-control mb-3" name="otp" placeholder="Enter OTP" required>
            <button type="submit" class="btn btn-primary btn-block" name="otpbtn" >Done</button><br><br>
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
</html>