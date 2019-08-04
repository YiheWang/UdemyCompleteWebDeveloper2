<?php
    $myArray = array("Rob","Kristen","Tom","Ralphie");
    $myArray[] = "Katie";
    print_r($myArray);
    echo $myArray[1];
    echo "<br><br>";

    $anotherArray[0] = "pizza";
    $anotherArray[1] = "yoghurt";
    $anotherArray[5] = "coffee";
    $anotherArray["myFavouriteFood"] = "ice cream";
    print_r($anotherArray);

    //create associated arrays
    echo "<br><br>";
    $thirdArray = array(
        "France" => "French",
        "USA" => "English",
        "Germany" => "German");
    $thirdArray["China"] = "Chinese";
    print_r($thirdArray);
    echo sizeof($thirdArray);

    echo "<br><br>";
    unset($thirdArray["France"]);
    print_r($thirdArray);
    //delete element from array

