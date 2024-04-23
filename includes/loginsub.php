<?php
    session_start();
    require_once('connection.php');
    if(isset($_POST['submit'])){
        $username = isset($_POST['username'])? $_POST['username']: "";
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if($username == "" || $password == ""){
            $error = 'All fields are required';
            header('Location: ../index.html/login.php?error='.$error);
            return false;
        }

        $username = sanitize($connect, $username);
        $password = sanitize($connect, $password);
        
        $password = md5($password);

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $res = mysqli_query($connect, $sql);
        if(mysqli_num_rows($res) > 0){
            $rows = mysqli_fetch_assoc($res);
            $id = $rows['unique_id'];
            $username = $rows['username'];

            $_SESSION['unique_id'] = $id;
            $_SESSION['username'] = $username;

            header('Location: ../index.html/chat.php');
            return false;
        }else{
            $error = 'user does not exist';
            header('Location: ../index.html/index.php?error='.$error);
            return false;
        }

        
    }else{
        $error = 'unauthorized access. Please create an Account!';
        header('Location: ../index.html/login.php?error='.$error);
        return false;
    }

?>