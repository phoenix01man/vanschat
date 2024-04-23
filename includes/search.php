<?php
    require_once('connection.php');
    session_start();
    if(isset($_POST['input'])){
        $id = $_SESSION['unique_id'];
        $search = $_POST['input'];
        $sql = "SELECT * FROM users WHERE unique_id != '$id' AND fname LIKE '{$search}%' OR  lname LIKE '{$search}%' ORDER BY fname ASC"; 
        $res = mysqli_query($connect, $sql);
        if(mysqli_num_rows($res) > 0){?>
         
         <div class=" mb-2">
            <?php
                while($rows2 =mysqli_fetch_assoc($res)){
            ?>
            <a href="messenger.php?mid=<?=$rows2['unique_id']?>">
                <div class="user-img">
                    <div class="user-name">
                        <span><?=$rows2['fname']?> <?=$rows2['lname']?></span>
                    </div>
                </div>
            </a>
            
         </div>

            <?php } ?>
    <?php 
        }else{
            echo "<h5 class='text-center text-dark'>No result found</h5>";
        };
    }
?>