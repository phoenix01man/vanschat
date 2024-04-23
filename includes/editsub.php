<?php
    require_once('connection.php');
    if(isset($_POST['submit'])){
        $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
        $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $id = $_POST['unique_id'];
        $img = $_POST['img'];

        if($fname == "" || $lname == "" || $email == "" || $username == "" || $phone == "" ){
            $error = 'All fields are required';
            header('Location: ../index.html/myprofile.php?error='.$error.'&unique_id='.$id);
            return false;
        }

        $fname = sanitize($connect, $fname);
        $lname = sanitize($connect, $lname);
        $email = sanitize($connect, $email);
        $username = sanitize($connect, $username);
        $phone = sanitize($connect, $phone);

        if($_FILES['file']['name'] != ''){
            $allow = array('png', 'jpeg', 'jpg', 'gif', 'heic');
            $filename = $_FILES['file']['name'];
            $fileTmp = $_FILES['file']['tmp_name'];
            $filesize = $_FILES['file']['size'];
            $fileext = explode('.', $filename);
            $fileActualext = strtolower(end($fileext));
            
            // print_r($_FILES);
            if($filesize < 800000){
                if(in_array($fileActualext, $allow)){
                    $pic = uniqid('',true).'.'.$fileActualext;
                    $location2 = 'dp/'.$pic;
                    if(move_uploaded_file($fileTmp, $location2)){
                        $sql = "UPDATE `users` SET `fname` = '$fname', `lname` = '$lname', `email` = '$email', `username` = '$username', `phone` = '$phone', `img` = '$pic', `createddate` = '$today' WHERE `unique_id` = '$id'";
                        $result = mysqli_query($connect, $sql);

                        if($result){
                            unlink('dp/'.$img);
                            $success = 'Post Updated successfully.';
                            header('Location: ../index.html/myprofile.php?success='.$success.'&unique_id='.$id);
                            return false;
                        }else{
                            $error = 'error updating post';
                            header('Location: ../index.html/myprofile.php?error='.$error.'&unique_id='.$id);
                            return false;
                        }
                    }else{
                        $error = 'error uploading file';
                        header('Location: ../index.html/myprofile.php?error='.$error.'&unique_id='.$id);
                        return false;
                    }
                }else{
                    $error = 'upload pictures only';
                    header('Location: ../index.html/myprofile.php?error='.$error.'&unique_id='.$id);
                    return false;
                }
            }else{
                $error = 'File uploaded is too large';
                header('Location: ../index.html/myprofile.php?error='.$error.'&unique_id='.$id);
                return false;
            }
        }
        else{
            $sql = "UPDATE `users` SET `fname` = '$fname', `lname` = '$lname', `email` = '$email', `username` = '$username', `phone` = '$phone', `createddate` = '$today' WHERE `unique_id` = '$id'";
            $result = mysqli_query($connect, $sql);

            if($result){
                $success = 'Post Edited Successfully.';
                header('Location: ../index.html/myprofile.php?success='.$success);
                return false;
            }else{
                $error = 'error editing post';
                header('Location: ../index.html/myprofile.php?error='.$error);
                return false;
            }
        }
    }else{
        header('Location: ../');
        return false;
    }

?>