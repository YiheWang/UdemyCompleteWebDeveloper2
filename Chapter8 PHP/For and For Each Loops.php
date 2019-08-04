<?php
    $family = array("Rob", "Kirsten", "Tommy", "Ralphie");
    for ($i = 0; $i < sizeof($family); $i++) {
        echo $family[$i]."<br>";
    }

    foreach ($family as $key => $value) {
        $family[$key] = $value." Percival";
        echo "Array item ".$key." is ".$value."<br>";
    }// $value itself does't change in each loop

    for ($i = 2; $i < 30; $i = $i +2) {
        echo $i."<br>";
    }

