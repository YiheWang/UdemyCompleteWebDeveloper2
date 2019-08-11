<?php
    session_start();
    if (array_key_exists("id",$_COOKIE)) {
        $_SESSION["id"] = $_COOKIE["id"];
        //pass cookie id to session id
        //session id was usually stored in cookie
    }
    if (array_key_exists("id",$_SESSION)) {
        echo "<p>Logged In! <a href='Project%20Secret%20Diary.php?logout=1'>Log out</a></p>";
        //?logout=1 is used to pass GET variables, logout
    }//logged in case
    else {
        header("Location: Project%20Secret%20Diary.php");
    }// not logged in case. For example, people want to access to diary url
    //without logging in. In that case, page will be redirect to home page

    include("Header.php");
?>
    <!-- container fluid makes it full screen-->
    <div class="container-fluid">
        <textarea id="diary" class="form-control"></textarea>
    </div>

<?php
    include("Footer.php");
?>