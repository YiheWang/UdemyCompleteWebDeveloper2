
<?php
    $hostName = "sql104.epizy.com";
    $userName = "epiz_22438332";
    $password = "yL8UIUdFE";
    $databaseName = "epiz_22438332_Secret_Diary";
    //check if submit in array $_POST
    if (array_key_exists("submit",$_POST)) {
        //print_r($_POST);
        $link = mysqli_connect($hostName, $userName, $password, $databaseName);
        if (mysqli_connect_error()) {
            die ("Database Connection Error!");
        }// check if connecting successful

        $error = "";
        if (!$_POST["email"]) {
            $error = "An email address is required!<br>";
        }
        if(!$_POST["password"]) {
            $error = "A password is required!<br>";
        }
        if($error != "") {
            $error = "<p>There were errors(s) in your form:</p>".$error;
        }
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
                    echo "<p>Sign up successful!</p>";
                }//query run successful; sign up successful
            }
        }
    }
?>

<form method="post">
    <input type="email" name="email" placeholder="Your email">
    <input type="password" name="password" placeholder="Password">
    <input type="checkbox" name="stayLoggedIn" value=1>
    <input type="submit" name="submit" value="Sign Up!">
</form>
<div id="error"><?php echo $error; ?></div>
