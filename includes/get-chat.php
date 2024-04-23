<?php
    require_once('connection.php');
        // $unique_id = $_SESSION['unique_id'];
        $sender = $_POST['sender'];
        $receiver = $_POST['receiver'];

        $output = '';

        $sql = "SELECT * FROM messeges WHERE (outgoing_msg_id = '$sender' AND incoming_msg_id = '$receiver') OR (outgoing_msg_id = '$receiver' AND incoming_msg_id = '$sender') ORDER BY id ASC";

        $res = mysqli_query($connect, $sql);
        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
                if($row['outgoing_msg_id'] === $sender){
                    $output .= '
                    
                    <div class="chat outgoing">
                    
                    <div class="details">
                    <div>
                        <p>'.$row['msg'].' <span class="text-left" style="font-size: 0.5rem; color: grey;">'.$row['time'].'</span></p>
                    </div>
                        
                        
                    </div>
                    
                    </div>
                    ';
                } else {
                    $output .= '
                    <div class="chat incoming">
                    <div class="details">
                        <p>'.$row['msg'].'</p>
                    </div>
                    </div>
                    ';
                }
            }
            echo $output;
            return false;
        }
    
?>