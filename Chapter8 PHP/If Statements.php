<?php

    $user = "Rob";
    if ($user == "Rob") {
        echo "Hello Rob";
    }
    else {
        echo "I don't know you!";
    }
    echo "<br><br>";

    $age = 25;
    if ($age >= 18 && $user == "Rob") {
        echo "You may proceed...";
    }
    else {
        echo "You are too young!";
    }