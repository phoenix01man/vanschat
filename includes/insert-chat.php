<?php

require_once('connection.php');
session_start();
    if(isset($_SESSION['unique_id'])){

        $outgoing_id = $_POST['outgoing_id'];
        $incoming_id = $_POST['incoming_id'];
        $message = isset($_POST['message']) ? $_POST['message'] : '';

        
        
        if(!empty($message)){
            $message = sanitize($connect, $message);
            $time = date('h:ia'); 

            $sql = "INSERT INTO `messeges`(`incoming_msg_id`, `outgoing_msg_id`, `msg`, `time`) VALUES('$incoming_id', '$outgoing_id', '$message', '$time')";
            $res = mysqli_query($connect, $sql);
            if($res){
                $alert = "+1";
                echo $alert;
                return false;
            }
        }
    }else{
        header('../login.php');
    }
  
?>