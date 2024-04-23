<?php
    require_once('../includes/connection.php');
    session_start();
    if(isset($_SESSION['unique_id'])){ //session will be set when user login or sign up. if it is not set, they will be redirected to the login page.
        $id = $_SESSION['unique_id'];
        $sql = "SELECT * FROM users WHERE unique_id = '$id'";
        $result = mysqli_query($connect, $sql);
        $rows = mysqli_fetch_assoc($result);
        
        // $fname = $rows['fname'];
        // $lname = $rows['lname'];
        $img = $rows['img'];
        // echo $id; die; 
    }else{
        $error = 'unauthorized user';
        header('Location: login.php?error='.$error);
        return false;
    }
?>
<?php
    require_once('header.php');
    // require_once('../includes/message-alert.php');
?>
<body class="body">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="nav-container">
                <div class="d-flex chat-nav">
                    <div class="logo-link">
                        <!-- <a href="index.html" class="logo d-flex align-items-center w-auto"> -->
                            <img src="../public/img/logo.png" alt="" width="30" height="30`">
                            
                        <!-- </a> -->
                    </div>
                    <div class="search">
                        <input type="text" id="search" name="search" placeholder="Search user here...">
                        <button id="searchbtn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    <div class="profile-icon">
                        <img src="../includes/dp/<?=$img?>" width="50" height="50" class="rounded-pill align-items-center" alt="">
                        <span><i class="fa-solid fa-circle"></i></span> 
                    </div>
                    <div class="logout">
                        <div class="dropdown">
                            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fa-solid fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="myprofile.php"><i class="fa-solid fa-user"></i> Profile</a></li>
                                
                                <li><a class="dropdown-item" href="../includes/logout.php"><i class="fa-solid fa-arrow-left"></i> Log Out</a></li>
                              </ul>
                          </div>
                  </div><!-- End Logo -->
            </div>
            <div class="user mb-2"  id="searchresult"></div>
            <hr>
            <h6 class="text-center pb-0" style="font-weight: 700;" id="available">Available Users.</h6>
            <div class="chat-body" id="chat-body">
                <div class="user-lists">
                    <div class="user mb-2">
                        <?php
                            $sql2 = "SELECT * FROM users WHERE unique_id != '$id' ORDER BY fname ASC";
                            $res2 = mysqli_query($connect, $sql2);
                            if(mysqli_num_rows($res2) > 0){ 
                                $result = '';
                                while($rows2 = mysqli_fetch_assoc($res2)){

                                    $receiver = $rows2['unique_id'];
                                    $sender = $_SESSION['unique_id'];
                                    
                                    $sql12 = "SELECT * FROM messeges WHERE (outgoing_msg_id = '$sender' AND incoming_msg_id = '$receiver') OR (outgoing_msg_id = '$receiver' AND incoming_msg_id = '$sender') ORDER BY id DESC LIMIT 1";
                                    $res12 = mysqli_query($connect, $sql12);
                                    $rows12 = mysqli_fetch_assoc($res12);
                                    if(mysqli_num_rows($res12) > 0){
                                        $result = $rows12['msg'];
                                        $time = $rows12['time'];

                                        if($rows12['outgoing_msg_id'] == $sender){
                                            $result = 'You: '.$result;
                                        }
                                        
                                        
                                    }elseif(mysqli_num_rows($res12) == 0){
                                        $time = "";
                                        $result = "No Messages! Click to start Conversation...";
                                    }
                                    else{
                                        $result = "No Messages! Click to start Conversation...";
                                    }

                                    if(strlen($result) > 28){
                                        $newmsg = substr($result, 0, 28).'...';
                                    }else{
                                        $newmsg = $result; 
                                    }
                                    

                                    // (strlen($result) > 28) ? $newmsg = substr($result, 0, 28).'...' : $newmsg = $result;                                    

                        ?>
                        <a href="messenger.php?mid=<?=$receiver?>" id="user">
                            <div class="user-img">
                                <img src="../includes/dp/<?=$rows2['img']?>" alt="" width="35" height="35" class="rounded-pill">
                                <div class="user-name">
                                    <span><?=$rows2['fname']?> <?=$rows2['lname']?></span>
                                    <p><?=$newmsg?></p>
                                </div>
                            </div>
                            <div class="user-active">
                                <span style="color: green; font-weight: 600;"><?=$time?></span>
                            </div>
                            
                        </a>
                        <?php } ?>
                    <?php }else{ ?>

                        <div class="col-md-4 justify-content-center mt-3 w-100">
                        <h5 class="text-dark text-center">"No Users to chat."</h5>
                        </div>

                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../index.js/jquery-3.2.1.min.js"></script>
<script src="../index.js/index.js"></script>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        $("#search").keyup(function(){
            let chatDisplay = document.getElementById('chat-body');
            let availDisplay = document.getElementById('available');

            chatDisplay.style.display = 'none';
            availDisplay.innerHTML = 'Searching Users...';
            var input = $(this).val();
            
            if(input != ""){
                $.ajax({
                    url: "../includes/search.php",
                    method: "POST",
                    data: {input:input},

                    success:function(data){
                        $("#searchresult").html(data);
                        $("#searchresult").css("display","block");
                    }
                });
            }else{
                $("#searchresult").css("display","none");

                chatDisplay.style.display = 'block';
                availDisplay.innerHTML = 'Available Users.';
            }
        });
    });
</script>
</html>