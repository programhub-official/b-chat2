<?php
session_start();
include('config/db.php');
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
<link rel="stylesheet" href="bootstrap/css/room.css">
<body>
  <section class="chatbox">
    <section class="chat-window">
      <article class="msg-container msg-remote" id="msg-0">
      </article>
      <div class="container">
        <div class="anyClass">
      <article class="msg-container msg-remote" id="msg-0">
        <h3>Welcome To</h3>
        <h4>B-ChatApp</h4>
      </article>  
        </div>
      </div>
    </section>
    <div class="chat-input">
      <input type="text" autocomplete="on" id="msg" placeholder="Type a message" />
      <button name="btn" id="btn">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="rgba(0,0,0,.38)" d="M17,12L12,17V14H8V10H12V7L17,12M21,16.5C21,16.88 20.79,17.21 20.47,17.38L12.57,21.82C12.41,21.94 12.21,22 12,22C11.79,22 11.59,21.94 11.43,21.82L3.53,17.38C3.21,17.21 3,16.88 3,16.5V7.5C3,7.12 3.21,6.79 3.53,6.62L11.43,2.18C11.59,2.06 11.79,2 12,2C12.21,2 12.41,2.06 12.57,2.18L20.47,6.62C20.79,6.79 21,7.12 21,7.5V16.5M12,4.15L5,8.09V15.91L12,19.85L19,15.91V8.09L12,4.15Z" /></svg>
                </button>
  </section>
</div>
  </section><br>
  <div class="more">
    <form action="code.php" method="post">
    <button type="submit" name="res" id="del" class="btn btn-success">Reset Chats</button>
    <button type="submit" name="usr" id="usr" class="btn btn-primary">Users</button>
    <button type="submit" name="logout" id="del" class="btn btn-danger">Logout</button>
    </form>
</div>
</body>


<script src="bootstrap/js/bootstrap.js"></script>
<script src="bootstrap/js/jquery.js"></script>
<script>

  // Check Message Box Empty OR Not ??
  $('.chat-input input').keyup(function(e) {
    if ($(this).val() == '')
        $(this).removeAttr('good');
    else
      $(this).attr('good', '');
  });

  // Get the input field
  var input = document.getElementById("msg");
  input.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
      event.preventDefault();
      document.getElementById("btn").click();
    }
  });

  // Send Messages
  $("#btn").click(function(e) {
      const msg = $('#msg').val();
      $.post('send.php',{text:msg},
      function(data,status) {
        }
        );
      $('#msg').val('');
  });

  // Fetch Message From Database
  setInterval(() => {
    $.post('recv.php',
    function(data,status) {
      document.getElementsByClassName('anyClass')[0].innerHTML = data;
    }
  );
  }, 600);
</script>
</html>