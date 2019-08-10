<?php
    //level 2 store
    $salt = "duknfkljabu3h2o3i8fwi98fnj";
    echo md5($salt."password")."<br>";
    // some commonly used password can be easily decode, put salt in front of the string
    //make it more secure


    //level 3 store
    $row["id"] = 73;
    echo md5(md5($row["id"])."password");
    //row id is static per user, so the salt string is always changing

    // here is more secure method in PHP 5.5
    $hash = password_hash("myPassword",PASSWORD_DEFAULT);
    echo $hash."<br>";
    if (password_verify("myPassword",$hash)) {
        echo "password is valid!";
    }
    else {
        echo "Invalid password!";
    }
?>
