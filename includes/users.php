<?php
    session_start();
    require_once('connection.php');
    $id = $_SESSION['unique_id'];
    
    $sql2 = "SELECT * FROM users WHERE unique_id != '$id' ORDER BY fname ASC";
                            // echo $id;
    $res2 = mysqli_query($connect, $sql2);
    $return = "";

    if(mysqli_num_rows($res2) > 0){
        $return .= "No users are available to chat.";
    }elseif(mysqli_num_rows($res2) > 0){
        while($row2 = mysqli_fetch_assoc($res2)){
            $return .= '
                    <a href="">
                        <div class="user-img">
                            <img src="../includes/dp/'.$rows2['img'].'" alt="" width="40" height="40" class="rounded-pill">
                            <div class="user-name">
                                <span>'.$rows2['fname'].' '.$rows2['lname'].'</span>
                                <p>This is a testing message...</p>
                            </div>
                        </div>
                        <div class="user-active">
                            <span><i class="fa-solid fa-circle"></i></span>
                        </div>
                    </a>';
        }
    }
    echo $return;
?>