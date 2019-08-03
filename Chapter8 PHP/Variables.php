<?php
    $name = "Rob";
    echo " My name is $name";
    $string1 = "<p>This is the first part";
    $string2 ="of a sentence</p>";
    echo $string1."".$string2;
    $myNumber = 45;
    $calculation = $myNumber * 31 / 97 + 4;
    echo "This result of the calculation is ".$calculation;

    $myBool = true;
    echo "<p> This statement is true? ".$myBool."</p>";
    // true consider to be 1 in php, and false consider to be nothing

    $variableName = "name";
    echo $$variableName;
    //$variableName means name, $name means Rob
    //php can store variable in a variable