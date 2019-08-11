<?php
    session_start();
    $hostName = "sql104.epizy.com";
    $userName = "epiz_22438332";
    $password = "yL8UIUdFE";
    $databaseName = "epiz_22438332_Secret_Diary";
    if(array_key_exists("content",$_POST)) {
        $link = mysqli_connect($hostName, $userName, $password, $databaseName);
        if (mysqli_connect_error()) {
            die ("Database Connection Error!");
        }// check if connecting successful

        $query = "UPDATE users SET diary = '".
            mysqli_real_escape_string($link, $_POST['content'])."' WHERE id = ".
            mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
        mysqli_query($link, $query);
    }
?>