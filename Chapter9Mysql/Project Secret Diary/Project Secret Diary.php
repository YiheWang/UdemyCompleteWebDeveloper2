
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
        //remove a cookie
        $_COOKIE["id"] = "";
        //set to empty in case it gets accessed later on
    }//check if logged put
    else if (array_key_exists("id",$_SESSION)
        OR array_key_exists("id",$_COOKIE)){
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
            $error = "An email address is required!<br>";
        }
        if(!$_POST["password"]) {
            $error = "A password is required!<br>";
        }
        if($error != "") {
            $error = "<p>There were errors(s) in your form:</p>".$error;
        }//check if user put in their email and password
        else {
            $query = "SELECT id FROM users WHERE email = '".
                mysqli_real_escape_string($link, $_POST["email"])."' LIMIT 1";
            $result = mysqli_query($link, $query);
            if(mysqli_num_rows($result) > 0) {
                $error = $error."This email is taken<br>";
            }// check if this email is used by others

            //The case that it is a new email address
            else {
                $query = "INSERT INTO users (email, password) VALUES 
                ('".mysqli_real_escape_string($link, $_POST["email"])."',
                '". mysqli_real_escape_string($link, $_POST["password"])."')";
                //insert email and password
                if(!mysqli_query($link, $query)) {
                    $error = $error."<p>Could not sign you up! Please try again later.</p>";
                }// check if query failed
                else {
                    $passwordHash =  password_hash($_POST["password"],PASSWORD_DEFAULT);
                    $query = "UPDATE users SET password = '".$passwordHash."' WHERE id = ".
                    mysqli_insert_id($link)." LIMIT 1";
                    //mysqli_insert_id($link) returns the id of most recently used element

                    //update the password to make it more securely
                    mysqli_query($link, $query);

                    $_SESSION["id"] = mysqli_insert_id($link);
                    if ($_POST["stayLoggedIn"] == '1') {
                        setcookie("id",mysqli_insert_id($link),time() + 60 * 60 * 24);
                        //set cookie for a day
                    }//checkbox is selected when equal to 1

                    header("Location: Logged%20In%20Page.php");
                    //sign up and take you to logged in page
                }//query run successful; sign up successful
            }
        }
    }
?>

<form method="post">
    <input type="email" name="email" placeholder="Your email">
    <input type="password" name="password" placeholder="Password">
    <input type="checkbox" name="stayLoggedIn" value='1'>
    <input type="submit" name="submit" value="Sign Up!">
</form>
<div id="error"><?php echo $error; ?></div>