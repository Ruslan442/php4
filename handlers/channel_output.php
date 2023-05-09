<?php
    session_start();
    $user_id = $_SESSION['user_id'];

    $channelId = $_POST['channel_id'];

    $mysqli = mysqli_connect('localhost','root','','rk2');

    $sql = "SELECT * FROM `sms` WHERE `channel_id` = $channelId";
    $res = mysqli_query($mysqli,$sql);
    if(mysqli_errno($mysqli)) {
        echo "Ошибка запроса".mysqli_error($mysqli);
    }
    else {
        $sms = '';
        while($arr = mysqli_fetch_assoc($res)){
            $userQuery = "SELECT `name` FROM `users` WHERE `id` = " . $arr['user_id'];
            $userResult = mysqli_query($mysqli, $userQuery);
            $userName = '';
            if ($userResult) {
                $user = mysqli_fetch_assoc($userResult);
                $userName = $user['name'];
            }
            
            if($arr['save'] == 1 and $user_id != $arr['user_id']) {
                continue;
            };

            $sms .= '<div class="sms w-[200px] my-3 mx-auto px-3 py-3 rounded-md bg-white">
            <p><b>'.$userName.'</b></p>
            <p>'.$arr['message'].'</p>';
            if ($arr['save']) {
                $sms.='<p><br/><i>Сообщение видите только вы</i><p>';
            };
            $sms.='</div>';
        }
        if ($sms != ''){
            echo $sms;
        }
        else {
            echo 'сообщений пока нет...';
        };
    }
?>