<?php
session_start();
include('config/db.php');

// Live Email Check
if (isset($_REQUEST['cmd'])) {
    $email = $_REQUEST['email'];
    $query = "SELECT * FROM users where email='$email'";
    $res = mysqli_query($conn,$query);
    if (mysqli_num_rows($res) > 0) {
        echo "Email Already Taken";
    }
}



// Auto Fill Register Form
if (isset($_REQUEST['name']) and isset($_REQUEST['email']) ) {
    $_SESSION['user_name'] = $_REQUEST['name'];
    $_SESSION['user_email'] = $_REQUEST['email'];
    header('Location: register.php');
}

// Login user
if (isset($_REQUEST['loginbtn'])) {
    $name = mysqli_real_escape_string($conn,$_REQUEST['name']);
    $pass = mysqli_real_escape_string($conn,$_REQUEST['passwd']);
    $query = "SELECT * FROM users where email='$name' or name='$name' and password='$pass' and status='1'";
    $res = mysqli_query($conn,$query);
    foreach($res as $row){
        $username = $row['name'];
    }
    if (mysqli_num_rows($res) > 0) {
        $query = "UPDATE users set online='1' where name='$name' or email='$name'";
        $res = mysqli_query($conn,$query);
        $_SESSION['auth'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $username;
        header('Location: room.php');
    }else {
        $_SESSION['status'] = "Username & Password Incorrect";
        header('Location: login.php');
    }
        
}


// Register new user
if (isset($_REQUEST['registerbtn'])) {
    $name = mysqli_real_escape_string($conn,$_REQUEST['name']);
    $email = mysqli_real_escape_string($conn,$_REQUEST['email']);
    $pass = mysqli_real_escape_string($conn,$_REQUEST['passwd']);
    if (strlen($pass) < 7) {
        $_SESSION['status'] = "Increase Password Length";
        header('Location: register.php');
    }else {
        if ($name != '' and $email != '' and $pass != '') {
            $query = "SELECT email from users where email='$email'";
            $res = mysqli_query($conn,$query);
            if (mysqli_num_rows($res) > 0) {
                $_SESSION['status'] = "Email Already Exists";
                header('Location: register.php');
            }else {
                $otp = random_int(100000,999999);
                $query = "INSERT INTO users(name,email,password,otp)VALUES('$name','$email','$pass','$otp')";
                if (mysqli_query($conn,$query)) {
                    $_SESSION['email'] = $email;
                    $_SESSION['status'] = "Check MailBox";
                    $_SESSION['otp'] = true;
                    header('Location: user_otp.php');
                }
            }
        }else {
            header('Location: register.php');
            $_SESSION['status'] = "All Fields are Required..";
        }
    }
}

// User OTP Confirmation
if (isset($_REQUEST['otpbtn'])) {
    $otp = mysqli_real_escape_string($conn,$_POST['otp']);
    if ($otp != '') {
        $query = "SELECT email FROM users where otp='$otp'";
        $res = mysqli_query($conn,$query);
        if (mysqli_num_rows($res) > 0) {
            foreach($res as $row){
                $email = $row['email'];
            }
            $query1 = "UPDATE users set status='1' where email='$email'";
            mysqli_query($conn,$query1);
            $_SESSION['status'] = "User Active Success";
            unset($_SESSION['otp']);
            header('Location: login.php');
        }else {
            $em = $_SESSION['email'];
            $query2 = "DELETE from users where email='$em'";
            mysqli_query($conn,$query2);
            unset($_SESSION['otp']);
            unset($_SESSION['email']);
            $_SESSION['status'] = "Invalid OTP Try Again";
            header('Location: register.php');
        }
    }
}


// Reset Chat
if (isset($_REQUEST['res'])) {
    $person = mysqli_real_escape_string($conn,$_SESSION['name']);
    $query = "DELETE FROM chats where person='$person'";
    mysqli_query($conn,$query);
    header('Location: room.php');
}


// Logout User
if (isset($_REQUEST['logout'])) {
    $name = mysqli_real_escape_string($conn,$_SESSION['name']);
    $query = "UPDATE users set online='0' where name='$name' or email='$name'";
    mysqli_query($conn,$query);
    session_destroy();
    header('Location: index.php');
}

if (isset($_REQUEST['usr'])) {
    header('Location: users.php');
}
?>