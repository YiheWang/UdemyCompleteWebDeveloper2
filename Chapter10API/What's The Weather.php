<?php
    $city = $_GET["city"];
    $weather = "";
    if($city) {
        $urlContents = file_get_contents("https://samples.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=188940caab298072596888ee875d5f0a");
        //the content of API is a JSON file
        $weatherArray = json_decode($urlContents, true);
        //print_r($weatherArray);

        //start to extract data from json file
        $weather = "The weather in ".$_GET['city']." is currently 
        ".$weatherArray['weather'][0]['description'].".";
        $tempInCelcius = $weatherArray['main']['temp'] - 273.15;
        $weather = $weather." The temperature is ".$tempInCelcius."&deg;c and the wind speed is ".$weatherArray['wind']['speed']."m/s.";

    }

    function url_exists($url) {
        if (!$fp = curl_init($url)) return false;
        return true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Weather Scraper</title>
    <style type="text/css">
        html {
            background: url(Sunset.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        body {
            background: none;
            /* body background will cover html background*/
        }
        .container {
            text-align: center;
            margin-top:100px;
            width: 450px;
        }
        input {
            margin-top: 10px;
        }
        #weather {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>What's The Weather?</h1>
        <form>
            <div class="form-group">
                <label for="city">Enter the name of a city.</label>
                <input type="text" class="form-control" name="city" id="city" aria-describedby="emailHelp" placeholder="Eg.Beijing, London">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div id="weather">
            <?php
                /*if (!$city) {
                    echo '<div class="alert alert-danger" role="alert">'.
                        'Please enter a city name!'.
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span aria-hidden="true">&times;</span>'.
                        '</button>'.
                        '</div>';
                }*/
                if ($weather) {
                    echo '<div class="alert alert-success" role="alert">'.
                        '<h1>'.$city.'</h1>'.
                        $weather.
                        '</div>';
                }
                else {
                    echo '<div class="alert alert-danger" role="alert">'.
                        $city.
                        ' is not a country name !'.
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
                        '<span aria-hidden="true">&times;</span>'.
                        '</button>'.
                        '</div>';
                }
            ?>
        </div>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
