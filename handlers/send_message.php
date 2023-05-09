<?php
    session_start();
    $message = $_POST['message'];
    $channel = $_POST['channel'];
    $save = $_POST['save'];
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    
    $mysqli = mysqli_connect('localhost', 'root', '', 'rk2');
    
    preg_match_all('/#(\w+)/', $message, $matches);
    $hashtags = $matches[1];

    foreach ($hashtags as $tag) {
        $tag = mysqli_real_escape_string($mysqli, $tag);
        $sql = "SELECT * FROM `#` WHERE `name` = '$tag'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $id_hash = $row['id'];
            $id_field = $row['field_id'];
            
            $sql = "INSERT INTO `field_#` (`id_#`, `id_field`,`id_sms`) VALUES ('$id_hash','$id_field',LAST_INSERT_ID())";
            mysqli_query($mysqli, $sql);
        }
    }

    
    $sql = "INSERT INTO `sms`(`id`, `#_id`, `user_id`, `channel_id`, `message`, `save`) VALUES ('','$id_hash','$user_id','$channel','$message','$save')";
    $res = mysqli_query($mysqli, $sql);

    $sql = "INSERT INTO `field_#` (`id_#`, `id_field`,`id_sms`) VALUES ('$id_hash','$id_field',LAST_INSERT_ID())";
    $res = mysqli_query($mysqli, $sql);
    
    if (mysqli_errno($mysqli)) {
        echo "Ошибка запроса".mysqli_error($mysqli);
    }
?>