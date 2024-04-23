<?php
    session_start();
    require_once('connection.php');

    if(isset($_POST['submit'])){
        $fname = isset($_POST['fname'])? $_POST['fname']: "";
        $lname = isset($_POST['lname'])? $_POST['lname']: "";
        $email = isset($_POST['email'])? $_POST['email']: "";
        $username = isset($_POST['username'])? $_POST['username']: "";
        $phone = isset($_POST['phone'])? $_POST['phone']: "";
        $password = isset($_POST['password'])? $_POST['password']: "";
        $terms = isset($_POST['terms'])? $_POST['terms']: "";

       

        if($fname == '' || $lname == '' || $email =='' || $username == '' || $phone == '' || $password == '' || $terms == ''){
            $error = 'All fields are required';
            header('Location: ../index.html/index.php?error='.$error);
            return false;
        }

        $fname = sanitize($connect, $fname);
        $lname = sanitize($connect, $lname);
        $email = sanitize($connect, $email);
        $username = sanitize($connect, $username);
        $password = sanitize($connect, $password);
        $phone = sanitize($connect, $phone);
        $today = date('Y-m-d');

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($connect, $sql);
        if(mysqli_num_rows($res) > 0){
            $error = 'Email address already taken';
            header('Location: ../index.html/index.php?error='.$error);
            return false;
        }
        $sql1 = "SELECT * FROM users WHERE username = '$username'";
        $res = mysqli_query($connect, $sql1);
        if(mysqli_num_rows($res) > 0){
            $rows = mysqli_fetch_assoc($res);
            $id = $rows['unique_id'];
            $username = $rows['username'];

        //     $_SESSION['unique_id'] = $id;
        //     $_SESSION['username'] = $username;

        //     return false;
        // }else{
            $error = 'Username address already taken';
            header('Location: ../index.html/index.php?error='.$error);
            return false;
        }

        if(isset($_FILES['file'])){
            $permit = array('png', 'jpeg', 'jpg', 'heic', 'gif');
            $filename = $_FILES['file']['name'];
            $fileTmp = $_FILES['file']['tmp_name'];
            $filesize = $_FILES['file']['size'];
            $fileext = explode('.', $filename);
            $fileActualext = strtolower(end($fileext));

            if($filesize < 800000){
                if(in_array($fileActualext, $permit)){
                    $pic = uniqid('',true).'.'.$fileActualext;
                    $location = 'dp/'.$pic;
                    if(move_uploaded_file($fileTmp, $location)){
                        $random_id = rand(time(), 1000000);
                        $password = md5($password);
                        $sql = "INSERT INTO `users`(`unique_id`, `fname`, `lname`, `email`, `username`, `phone`, `password`, `img`, `terms`, `createddate`) VALUES('$random_id', '$fname', '$lname', '$email', '$username', '$phone', '$password', '$pic', '$terms', '$today')";
                        $result = mysqli_query($connect, $sql);
                        if($result){
                            $success = 'Registration successful';
                            header('Location: ../index.html/login.php?success='.$success);
                            return false;
                        }else{
                            $error = 'error creating account';
                            header('Location: ../index.html/index.php?error='.$error);
                            return false;
                        }
                    }else{
                        $error = 'error uploading file';
                        header('Location: ../index.html/index.php?error='.$error);
                        return false;
                    }
                }else{
                    $error = 'upload pictures only';
                    header('Location: ../index.html/index.php?error='.$error);
                    return false;
                }
            }else{
                $error = 'File uploaded is too large';
                header('Location: ../index.html/index.php?error='.$error);
                return false;
            }
        }
        }else{
        $error = 'unauthorized access';
        header('Location: ../index.html/index.php?error='.$error);
        return false;
    }
  
?>