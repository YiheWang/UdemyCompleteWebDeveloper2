<?php
    /*print_r($_GET);
    echo "Hi there ".$_GET["name"]."!";*/

    if(is_numeric($_GET["number"]) && $_GET["number"] > 0 && $_GET["number"] == round($_GET["number"], 0)) {
        $i = 2;
        $isPrime = true;
        while ($i < $_GET["number"]) {
            if($_GET["number"] % $i == 0){
                //number is not prime
                $isPrime = false;
            }
            $i++;
        }
        if($isPrime) {
            echo "<p>".$i." is a prime number!</p>";
        }
        else{
            echo "<p>".$i." is not a prime number</p>";
        }
    }
    else {
        echo "<p>Please enter a positive whole number</p>";
    }


?>

<p>Please enter a whole number</p>
<form>
    <input name ="number" type="text">
    <input type="submit" value="Go!">
</form>
