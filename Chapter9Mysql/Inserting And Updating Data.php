<?php
    //$hostName = "47.52.226.197";
    //$hostName = "localhost";
    /*$hostName = "shareddb-q.hosting.stackcp.net";
    $userName = "WebDevCourse-3131378a13";
    $password = "31415926aaSS_";
    $databaseName = "WebDevCourse-3131378a13";*/
    $hostName = "sql104.epizy.com";
    $userName = "epiz_22438332";
    $password = "yL8UIUdFE";
    $databaseName = "epiz_22438332_Undemy_WebCourse";
    $link = mysqli_connect($hostName,$userName,$password,$databaseName);
    if(mysqli_connect_error()) {
        die("Database connecting error!");
    }
    else {
        echo "Database connecting successful!";
    }


    /*$query = "INSERT INTO users (email, password)
        VALUES ('24800S@qq.com','122334yes')";
    if(mysqli_query($link, $query)) {
        echo "Insert data successfully!";
    }
    else {
        echo "Insert data failed!";
    } */
    /*$query = "UPDATE users SET email = 'hahayw@qq.com' WHERE id = 1
        LIMIT 1";*/
    $query = "UPDATE users SET password = 'yehahe' WHERE id = 1 LIMIT 1";
    mysqli_query($link, $query);

    $query = "SELECT * FROM users";
    if($result = mysqli_query($link, $query)) {
        $row = mysqli_fetch_array($result);
        echo " Your email is ".$row["email"]." and your password is ".$row["password"];
    }
?>
