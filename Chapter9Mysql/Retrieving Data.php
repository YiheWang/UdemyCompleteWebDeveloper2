<?php
    $hostName = "sql104.epizy.com";
    $userName = "epiz_22438332";
    $password = "yL8UIUdFE";
    $databaseName = "epiz_22438332_Undemy_WebCourse";
    $link = mysqli_connect($hostName,$userName,$password,$databaseName);
    if(mysqli_connect_error()) {
        die("Database connecting error!");
    }

    $query = "SELECT * FROM users";
    if($result = mysqli_query($link, $query)) {
        $row = mysqli_fetch_array($result);
        print_r($row);
        /*
         Array
            (   [0] => 1
                [id] => 1
                [1] => 2470080342@qq.com
                [email] => 2470080342@qq.com
                [2] => 31415926aaSS_
                [password] => 31415926aaSS_
            ) // we can use index or variable name to refer to content
        */
        echo " Your email is ".$row["email"]." and your password is ".$row["password"];
    }
?>