<?php

include('config/db.php');

$query = "SELECT * FROM users";
$result = mysqli_query($conn,$query);

$res = '';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['online']==1) {
            $res = $res . '<article class="msg-container msg-remote wh" id="msg-0"><div class="msg-box"><div class="flr"><div class="messages">';
            $res = $res . $row['name'];
        }
    }
    echo $res;
}
?>