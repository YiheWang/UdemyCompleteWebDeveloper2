<?php
    setcookie("customerID","1234", time() + 60  * 60 * 24);
    //cookie set for a day
    //setcookie("customerID", "", time() - 60 * 60);
    //remove a cookie
    $_COOKIE["customerID"] = "test";
    //change cookie
    echo $_COOKIE["customerID"];
?>