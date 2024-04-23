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
                        <a href="chat.php" class="d-flex align-items-center w-auto">
                            <button class="btn btn-secondary" type="button" style="background: transparent; color: black; border: none;"><i class="fa-solid fa-arrow-left"></i>
                              </button>
                            
                            
                        </a>
                    </div>
                    <div class="profile-icon">
                        <p class="pt-2">Active now</p>
                        <!-- <span><i class="fa-solid fa-circle"></i></span>  -->
                    </div>
                    <div class="logout">
                        <div class="dropdown">
                            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fa-solid fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#profile"><i class="fa-solid fa-pencil"></i> Update details</a></li>
                                
                                <li><a class="dropdown-item" href="../includes/logout.php"><i class="fa-solid fa-arrow-left"></i> Log Out</a></li>
                              </ul>
                        </div>
                  </div><!-- End Logo -->
                  
                </div>
                
                <?php if(isset($_GET['error'])){ ?>
                        <div class="alert alert-danger alert-dismissible">
                        <button class="btn-close" data-bs-dismiss="alert"></button>
                        <p><?=$_GET['error']; ?></p>
                        </div>
                    <?php } else if(isset($_GET['success'])){ ?>
                        <div class="alert alert-success alert-dismissible">
                        <button class="btn-close" data-bs-dismiss="alert"></button>
                        <p><?=$_GET['success']; ?></p>
                        </div>
                    <?php } ?>
                <br>
                <hr>
                <?php
                    session_start();
                    if(isset($_SESSION['unique_id'])){
                        $id = $_SESSION['unique_id'];
                        $sql = "SELECT * FROM users WHERE unique_id = '$id'";
                        $result = mysqli_query($connect, $sql);
                        $rows = mysqli_fetch_assoc($result);
                        $img = $rows['img'];
                        $fname = $rows['fname'];
                        $lname = $rows['lname'];
                        $phone = $rows['phone'];
                        $email = $rows['email'];
                        $username = $rows['username'];
                        // echo $id;
                    }else{
                        header('Location: login.php');
                    }
                ?>
                <div class="profile-details">
                    <div class="row d-flex" style="display: flex;">
                        <div class="col-md-12 justify-content-center text-center gallery">
                            <div class="profile-icon">
                                <a href="#profile-icon">
                                    <img src="../includes/dp/<?=$img?>" width="140" height="140" class="rounded-pill" alt="">
                                </a>
                            </div>
                            <div class="lightbox" id="profile-icon">
                                <a href="" class="close"><i class="fa-solid fa-x-mark">&times;</i></a>
                                <div class="lightbox-content">
                                    <img src="../includes/dp/<?=$img?>" alt="">
                                </div>
                            </div>
                            <div class="upload-account w-100">
                                <!--photo file changing -->
                                    
                                <!-- <button id="photo_btn"><i class="fa-solid fa-camera" ></i></button> -->
                                <?php
                                if(isset($_GET['unique_id'])){
                                    $pid = $_GET['unique_id'];
                                    $sql = "SELECT * FROM users WHERE unique_id = '$pid'";
                                    $res = mysqli_query($connect, $sql);
                                    $rows = mysqli_fetch_assoc($res);
                                    $pid = $rows['unique_id'];
                                    $img = $rows['img'];
                                    

                                }
                                ?>
    
                                
                                    <!-- <form action="../includes/photosub.php" method="POST" enctype="multipart/form-data" class="d-flex text-center" style="position: relative; left: 20%; width: 100%; margin-bottom: 10px;">
                                        <input type="file" name="file" id="file" class="" style="width: 60%; border: none;">
                                        <input type="text" name="file" id="file" class="" style="width: 60%; border: none;">
                                         <button type="button" name="file_submit" class=""  id="photo_btn"><i class="fa-solid fa-camera text-dark" ></i></button>
                                        <input  value="Upload" id="editbtn" > -->
                                             
                                    <!-- </form>        -->
                                        
                                <!-- Modal -->
                                <div class="modal fade" id="profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="border: none;">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Profile</h1>
                                            <button type="button" class="" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                            </div>
                                            <div class="modal-body" style="border: none;">
                                                <form action="../includes/editsub.php" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                                                    <div class="col-12">
                                                        <label for="yourName" class="form-label">First Name</label>
                                                        <input type="text" name="fname" class="form-control" id="yourFname" value="<?=$fname?>" required>
                                                        <input type="hidden" name="unique_id" class="form-control" id="yourFname" value="<?=$id?>" required>
                                                        <input type="hidden" name="img" class="form-control" id="yourFname" value="<?=$img?>" required>
                                                        <div class="invalid-feedback">Please, enter your name!</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="yourName" class="form-label">Last Name</label>
                                                        <input type="text" name="lname" class="form-control" id="yourLname" value="<?=$lname?>" required>
                                                        <div class="invalid-feedback">Please, enter your name!</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="yourEmail" class="form-label">Your Email</label>
                                                        <input type="email" name="email" class="form-control" id="yourEmail" value="<?=$email?>" required>
                                                        <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="yourUsername" class="form-label">Username</label>
                                                        <div class="input-group has-validation">
                                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                            <input type="text" name="username" class="form-control" id="yourUsername" value="<?=$username?>" required>
                                                            <div class="invalid-feedback">Please choose a username.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="yourName" class="form-label">Phone Number</label>
                                                        <input type="number" name="phone" class="form-control" id="phone" value="<?=$phone?>" required>
                                                        <div class="invalid-feedback">Please, enter your Phone Number!</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="image" class="form-label">Profile Picture</label>
                                                        <input type="file" name="file" id="file" class="form-control" value="<?=$img?>" style="width: 100%; border: none;">
                                                    </div>
                                                    <div class="" style="border: none;">
                                                        <button type="submit" name="submit" id="editbtn"><i class="fa-solid fa-circle-check"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 px-3 text-center">
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