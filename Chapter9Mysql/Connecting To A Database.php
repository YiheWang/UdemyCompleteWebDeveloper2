<?php
    $hostName = "sql104.epizy.com";
    $userName = "epiz_22438332";
    $password = "yL8UIUdFE";
    $databaseName = "epiz_22438332_Undemy_WebCourse";
    mysqli_connect($hostName,$userName,$password,$databaseName);
    if(mysqli_connect_error()) {
        echo "Database connecting error!";
    }
    else {
        echo "Database connecting successful!";
    }

?>
