<?php
    $hostName = "sql104.epizy.com";
    $userName = "epiz_22438332";
    $password = "yL8UIUdFE";
    $databaseName = "epiz_22438332_Undemy_WebCourse";
    $link = mysqli_connect($hostName,$userName,$password,$databaseName);
    if(mysqli_connect_error()) {
        die("Database connecting error!");
    }
    else {
        echo "Database connecting successful!<br>";
    }

    if (array_key_exists('email',$_POST) OR array_key_exists('password',$_POST)) {
        if ($_POST['email'] == '') {
            echo "<p>Email address is required.</p>";
        }
        else if ($_POST['password'] == ''){
            echo "<p>Password is required</p>";
        }
        else {
            $query = "SELECT id FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
            $result = mysqli_query($link, $query);
            if(mysqli_num_rows($result) > 0) {
                echo "<p>That email address has already been taken.</p>";
            }
            else {
                $query = "INSERT INTO users (email, password) 
                    VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."',
                    '".mysqli_real_escape_string($link, $_POST['password'])."')";
                if (mysqli_query($link, $query)) {
                    echo "<p>You have been signed up!</p>";
                }
                else {
                    echo "<p>There was a problem signing you up - please try again later</p>";
                }
            }
        }
    }


    //$query = "SELECT * FROM users WHERE email LIKE '%qq.com'";
    // SELECT LIKE
    //$query = "SELECT email FROM users WHERE email LIKE '%qq.com'";
    //$query = "SELECT email FROM users WHERE id >= 2 AND email LIKE '%T%'";
    /*$name = "Yihe'Wang";
    $query = "SELECT email FROM users WHERE name = '".mysqli_real_escape_string($link, $name)."'";
    //avoiding symbol ' corrupting our sql and sql injection
    if ($result = mysqli_query($link, $query)) {
        while($row = mysqli_fetch_array($result)) {
            print_r($row);
            echo "<br>";
        }
    }*/

?>

<form method = "post">
    <input name="email" type="text" placeholder="Email address">
    <input name="password" type="password" placeholder="Password">
    <input type="submit" value="Sign Up">
</form>
