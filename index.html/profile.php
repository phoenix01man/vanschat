<?php
    require_once('../includes/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Favicons -->
    <link href="../public/img/apple-touch-icon.png" rel="icon">
    <link href="../public/img/favicon.png" rel="apple-touch-icon">

    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../index.css/index.css">
    <link rel="stylesheet" href="../index.css/lightbox.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.4.2-web/css/all.min.css">
    <title>VansChat Messenger</title>
</head>
<body class="body">
    <div class="wrapper">
        <!-- <div class="container-fluid"> -->
            <div class="nav-container">
                <div class="d-flex chat-nav">
                    <div class="logo-link dropdown">
                        <a href="messenger.php?mid=<?=$_GET['mid']?>" class="d-flex align-items-center w-auto">
                            <button class="btn btn-secondary" type="button" style="background: transparent; color: black; border: none;"><i class="fa-solid fa-arrow-left"></i>
                              </button>
                            
                            
                        </a>
                    </div>
                    <div class="profile-icon">
                        <p class="pt-2">Active now</p>
                    </div>
                    <div class="logout">
                        <div class="dropdown">
                            <!-- <a href="messenger.php">
                                <button class="btn btn-secondary" type="button">
                                    <i class="fa-solid fa-comment"></i>
                                  </button>
                            </a> -->
                            
                            <!-- <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="messenger.html"><i class="fa-solid fa-chat"></i> Message</a></li>
                              <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear"></i> Settings</a></li> -->
                            </ul>
                          </div>
                  </div><!-- End Logo -->
                  
                </div>
                
                <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
                    <strong>Update Successful</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                </div>
                <div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                    <strong>Error updating Account</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                </div>
                <br>
                <!-- <hr> -->

                <?php
                    if(isset($_GET['mid'])){
                    $mid = $_GET['mid'];
                    $sql = "SELECT * FROM users WHERE unique_id = '$mid'";
                    $res = mysqli_query($connect, $sql);
                    $rows = mysqli_fetch_assoc($res);
                    $mid = $rows['unique_id'];
                    $img = $rows['img'];
                    $fname = $rows['fname'];
                    $lname = $rows['lname'];
                    $phone = $rows['phone'];
                    $email = $rows['email'];
                    $username = $rows['username'];
                    // echo $mid;
                    }else{
                    header('Location: chat.php');
                    return false;
                };
                
                ?>
                <div class="profile-details">
                    <div class="row d-flex" style="display: flex;">
                        <div class="col-md-6 gallery">
                            <div class="profile-icon">
                                <a href="#profile-icon">
                                    <img src="../includes/dp/<?=$img?>" width="140" height="140" class="rounded-pill" alt="">
                                </a>
                            </div>
                            <div class="lightbox" id="profile-icon">
                                <a href="" class="close"><i class="fa-solid fa-x-mark">&times;</i></a>
                                <!-- <button class="close"><i class="fa-solid fa-xmark"></i></button> -->
                                <div class="lightbox-content">
                                    <img src="../includes/dp/<?=$img?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <div>
                                <b>Name: </b><span> <?=$fname?> <?=$lname?></span>
                            </div>
                            <div>
                                <b>Phone: </b><span> <?=$phone?></span>
                            </div>
                            <div>
                                <b>Email: </b><span> <?=$email?></span>
                            </div>
                            <div>
                                <b>Username: </b><span> <?=$username?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="encrypt d-flex p-3">
                    <div>
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="" style="margin-left: 35px;">
                        <b>Encryption</b>
                        <p style="color: rgb(112, 112, 112);">Messages and file sharing are end-to-end encrypted. Tap to learn more.</p>
                    </div>
                </div>
                
            </div>
            
            
        <!-- </div> -->
    </div>
</body>
<script src="../index.js/index.js"></script>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</html>