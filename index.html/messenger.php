<?php
    require_once('../includes/connection.php');
    session_start();
    if(isset($_SESSION['unique_id'])){
        $id = $_SESSION['unique_id'];
        $sql = "SELECT * FROM users WHERE unique_id = '$id'";
        $result = mysqli_query($connect, $sql);
        $rows = mysqli_fetch_assoc($result);
        // echo $id;
    }else{
        header('Location: login.php');
    }
    ?>

    <?php
    if(isset($_GET['mid'])){
    $mid = $_GET['mid'];
    $sql = "SELECT * FROM users WHERE unique_id = '$mid'";
    $res = mysqli_query($connect, $sql);
    $rows = mysqli_fetch_assoc($res);
    $mid = $rows['unique_id'];
    $img = $rows['img'];
    // echo $mid;
     }else{
    header('Location: chat.php');
    return false;
  };
  require_once('header.php');
  
?>

<body class="body">
    <div class="wrapper">
        <!-- <div class="container-fluid"> -->
            <div class="nav-container">
                <div class="d-flex chat-nav">
                    <div class="logo-link justify-content-center">
                        <a href="chat.php" class="logo d-flex align-items-center w-auto" style="font-size: 1.5rem; text-decoration: none; color: black;">
                        <button class=" mt-3" style="font-size: 1.5rem; color: black; background: transparent; padding: 0.5rem; border: none;">
                        <i class="fa-solid fa-arrow-left text-dark"></i>
                        </button>
                            
                            
                        </a>
                        <p class="demo"></p>
                    </div>
                    <!-- <div class="search">
                        <input type="text" id="search" placeholder="Search user here...">
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div> -->
                    <?php
                        
                    ?>
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
                              <li><a class="dropdown-item" href="profile.php?mid=<?=$mid?>"><i class="fa-solid fa-user"></i> Profile</a></li>
                              <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear"></i> Settings</a></li>
                            </ul>
                          </div>
                  </div><!-- End Logo -->
                  
                </div>
                <br>
                <!-- <hr> -->
            </div>
            
            <div class="chat-box">
                
            </div>
            <form action="" method="" class="typing-area">
                <input type="hidden" name="incoming_id" value="<?=$mid?>" id="incoming">
                <input type="hidden" name="outgoing_id" value="<?=$id?>" id="outgoing">
                <input type="text" name="message" placeholder="Type a message here..." id="msg-input">
                <!-- <a href="javascript:void(0)"> -->
                    <button type="send" name="submit" id="submit"><i class="fa-solid fa-paper-plane"></i></button>
                <!-- </a> -->
                
            </form>
        <!-- </div> -->
    </div>
</body>
<script src="../index.js/jquery-3.2.1.min.js"></script>
<script>
    

    //   getting the chat
    $(document).ready(function(){
        const chatArea = document.querySelector('.chat-box')
        let sender = '<?php echo $id ?>'
        let receiver = '<?php echo $mid ?>'

        function scrolltoBottom(){
        chatArea.scrollTop = chatArea.scrollHeight;
        }

        let formdata = new FormData()
        formdata.append('sender', sender)
        formdata.append('receiver', receiver)

        setInterval(()=>{
            $.ajax({
                type: 'POST',
                url: '../includes/get-chat.php',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(data){
                    chatArea.innerHTML = data;
                    scrolltoBottom();
                }
              })
          }, 500);
    })
</script>
<script src="../index.js/index.js"></script>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
</script>
</html>