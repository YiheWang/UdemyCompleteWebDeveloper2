<?php
    session_start();
    //$_SESSION['username'] = "YiheWang";
    //echo $_SESSION['username'];
    if ($_SESSION['email']) {
        echo "You are logged in!";
    }
    else {
        header("Location:index.php");
    }
?>
