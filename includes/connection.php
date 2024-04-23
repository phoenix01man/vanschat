<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "vanschat";

    $connect = mysqli_connect($servername, $username, $password, $dbName);

    function sanitize($connectString, $data){
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripcslashes($data);
        $data = mysqli_real_escape_string($connectString, $data);
        
        return $data;
    }
?>