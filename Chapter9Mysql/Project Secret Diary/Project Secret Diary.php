
<?php
    $hostName = "sql104.epizy.com";
    $userName = "epiz_22438332";
    $password = "yL8UIUdFE";
    $databaseName = "epiz_22438332_Secret_Diary";
    $error = "";

    session_start();
    if (array_key_exists("logout",$_GET)) {
        unset($_SESSION);
        setcookie("id", "", time() - 60 * 60 * 24);
        //remove a cookie when next time reload page
        $_COOKIE["id"] = "";
        //set to empty in case it gets accessed later on the rest of the page
    }//check if logged put

    //check if the key exists and if it has a value
    //check key first, then check the value to avoid error message
    else if ((array_key_exists("id",$_SESSION) AND $_SESSION["id"])
        OR (array_key_exists("id",$_COOKIE)) AND $_COOKIE["id"]){
        header("Location: Logged%20In%20Page.php");
    }// id already logged in. Taking id to logged in page

    //check if name submit in array $_POST, which means did user click submit
    if (array_key_exists("submit",$_POST)) {
        //print_r($_POST);
        $link = mysqli_connect($hostName, $userName, $password, $databaseName);
        if (mysqli_connect_error()) {
            die ("Database Connection Error!");
        }// check if connecting successful

        if (!$_POST["email"]) {
            $error = "An email address is required! ";
        }
        if(!$_POST["password"]) {
            $error = "A password is required! ";
        }
        if($error != "") {
            $error = "There were errors(s) in your form:".$error;
        }//check if user put in their email and password
        else {
            //Here is sign up section
            if($_POST["signUp"] == "1") {
                $query = "SELECT id FROM users WHERE email = '" .
                    mysqli_real_escape_string($link, $_POST["email"]) . "' LIMIT 1";
                $result = mysqli_query($link, $query);
                if (mysqli_num_rows($result) > 0) {
                    $error = $error . "This email is taken. ";
                }// check if this email is used by others

                //The case that it is a new email address
                else {
                    $query = "INSERT INTO users (email, password) VALUES 
                ('" . mysqli_real_escape_string($link, $_POST["email"]) . "',
                '" . mysqli_real_escape_string($link, $_POST["password"]) . "')";
                    //insert email and password
                    if (!mysqli_query($link, $query)) {
                        $error = $error . "<p>Could not sign you up! Please try again later.</p>";
                    }// check if query failed
                    else {
                        $passwordHash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                        $query = "UPDATE users SET password = '" . $passwordHash . "' WHERE id = " .
                            mysqli_insert_id($link) . " LIMIT 1";
                        //mysqli_insert_id($link) returns the id of most recently used element

                        //update the password to make it more securely
                        mysqli_query($link, $query);

                        $_SESSION["id"] = mysqli_insert_id($link);
                        if ($_POST["stayLoggedIn"] == '1') {
                            setcookie("id", mysqli_insert_id($link), time() + 60 * 60 * 24);
                            //set cookie for a day
                        }//checkbox is selected when equal to 1

                        header("Location: Logged%20In%20Page.php");
                        //sign up and take you to logged in page
                    }//query run successful; sign up successful
                }
            }
            else {
                $query = "SELECT * FROM users WHERE email = '".
                    mysqli_real_escape_string($link, $_POST["email"])."'";
                $result = mysqli_query($link, $query);
                $row = mysqli_fetch_array($result);
                //check if user exists, then use id info to decode password
                if (isset($row)) {
                    if (password_verify($_POST["password"],$row["password"])) {
                        $_SESSION["id"] = $row["id"];
                        if ($_POST["stayLoggedIn"] == '1') {
                            setcookie("id", $row["id"], time() + 60 * 60 * 24);
                            //set cookie for a day
                        }//checkbox is selected when equal to 1

                        header("Location: Logged%20In%20Page.php");
                    }
                    else {
                        $error = $error."That email and password combination could not be found!<br>";
                    }//This case is the enter password does not match password
                }
                else {
                    $error = $error."That email and password combination could not be found!<br>";
                }//This case is actually the entered email address does not exist
            }
        }
    }
?>

<?php include("Header.php");?>
    <div class="container" id="homePageContainer">
        <h1>Secret Diary</h1>
        <p><strong>Store your thoughts permanently and securely.</strong></p>
        <p>Log in with your username and password.</p>
        <form method="post" id="logInForm">
            <fieldset class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Your email">
            </fieldset>
            <fieldset class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </fieldset>
            <fieldset class="form-group form-check">
                <input type="checkbox" id="logInCheckbox" class="form-check-input" name="stayLoggedIn" value='1'>
                <label class="form-check-label" for="logInCheckbox">Stay log in</label>
            </fieldset>
            <fieldset class="form-group">
                <input type="hidden" name="signUp" value="0">
                <input type="submit" name="submit" class="btn btn-success" value="Log In!">
            </fieldset>
            <!-- submit all the stuff in form-->
            <p><a class="toggleForm" href="#">Sign Up</a></p>
            <!-- href="#" makes disable link to jump-->
        </form>
        <form method="post" id="signUpForm">
            <fieldset class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Your email">
            </fieldset>
            <fieldset class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </fieldset>
            <fieldset class="form-group form-check">
                <input type="checkbox" id=signUpCheckbox class="form-check-input" name="stayLoggedIn" value='1'>
                <label class="form-check-label" for="signUpCheckbox">Stay log in</label>
            </fieldset>
            <fieldset class="form-group">
                <input type="hidden" name="signUp" value="1">
                <input type="submit" name="submit" class="btn btn-success" value="Sign Up!">
            </fieldset>
            <!-- submit all the stuff in form-->
            <p><a class="toggleForm" href="#">Log In</a></p>
        </form>
    </div>
    <div class="container" style="width:600px">
        <div id="error"><?php
            if($error != "") {
                echo '<div class="alert alert-danger" role="alert">'.
                    $error.
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            } ?></div>
    </div>
<?php include("Footer.php"); ?>