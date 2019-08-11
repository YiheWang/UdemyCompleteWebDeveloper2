<?php
    session_start();
    $hostName = "sql104.epizy.com";
    $userName = "epiz_22438332";
    $password = "yL8UIUdFE";
    $databaseName = "epiz_22438332_Secret_Diary";
    $diaryContent = "";

    if (array_key_exists("id",$_COOKIE) AND $_COOKIE["id"]) {
        $_SESSION["id"] = $_COOKIE["id"];
        //pass cookie id to session id
        //session id was usually stored in cookie
    }
    if (array_key_exists("id",$_SESSION) AND $_SESSION["id"]) {
        echo "<p>Logged In! <a href='Project%20Secret%20Diary.php?logout=1'>Log out</a></p>";
        //?logout=1 is used to pass GET variables, logout

        $link = mysqli_connect($hostName, $userName, $password, $databaseName);
        if (mysqli_connect_error()) {
            die ("Database Connection Error!");
        }// check if connecting successful
        $query = "SELECT diary FROM users WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
        $row = mysqli_fetch_array(mysqli_query($link, $query));
        $diaryContent = $row["diary"];
        //this part is to load diary content in database

    }//logged in case
    else {
        header("Location: Project%20Secret%20Diary.php");
    }// not logged in case. For example, people want to access to diary url
    //without logging in. In that case, page will be redirect to home page

    include("Header.php");
?>
    <nav class="navbar fixed-top bg-light">
        <a class="navbar-brand" href="#">Secret Diary</a>

        <!-- <div class="collapse navbar-collapse">
            <ul class="nav navbar navbar-right">
                <li><a href='Project%20Secret%20Diary.php?logout=1'><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button></a></li>
            </ul>
        </div> -->
        <div class="pull-xs-right">
            <a href='Project%20Secret%20Diary.php?logout=1'><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button></a>
        </div>
    </nav>

    <!-- container fluid makes it full screen-->
    <div class="container-fluid" id="containerLogInPage">
        <textarea id="diary" class="form-control"><?php echo $diaryContent; ?></textarea>
    </div>

<?php
    include("Footer.php");
?>