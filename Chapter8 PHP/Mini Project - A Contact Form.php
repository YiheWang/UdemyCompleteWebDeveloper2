<?php
    $error = "";
    $successMessage = "";
    if ($_POST) {
        if (!$_POST["email"]) {
            $error .= "The email is required. ";
        }
        if (!$_POST["email"]) {
            $error .= "The content field is required. ";
        }
        if (!$_POST["email"]) {
            $error .= "The subject is required.";
        }

        if ($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
            $error .= "The email address is invalid.";
        }
        if ($error != "") {
            $error = '<div class="alert alert-danger" role="alert">'
                .'<strong> A simple danger alert! </strong>'
                .$error.
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
        else {
            $emailTo = "2470080342@qq.com";
            $subject = $_POST["subject"];
            $content = $_POST["content"];
            $headers = $_POST["email"];
            if (mail($emailTo, $subject, $content, $headers)) {
                $successMessage = '<div class="alert alert-success" role="alert">'.
                    'Your email was sent '.
                    '</div>';
            }
            else {
                $successMessage = '<div class="alert alert-danger" role="alert">'.
                    'Your email could not be sent. Please try again later. '.
                    '</div>';
            }
        }
    }
    // we need both server side error message and javascript error message
    // because we don't need to wait for the page to reload to get
    // the error message
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Mini Project - A Contact Form</title>
</head>
<body>
    <div class="container">
        <h1>Get in touch!</h1>
        <form method="post">
            <div class="form-group">
                <label for="inputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp" placeholder="Enter your email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="inputSubject1">Subject</label>
                <input type="text" name="subject" class="form-control" id="inputSubject1">
            </div>
            <div class="form-group">
                <label for="formControlTextarea1">What would you like to ask us?</label>
                <textarea class="form-control" name="content" id="formControlTextarea1" rows="3"></textarea>
            </div>
            <button id="submit-button" type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div id="error" style="margin-top:10px;"><? echo $error.$successMessage; ?></div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $("form").submit(function (e) {
            e.preventDefault();
            //stop button to submit the form, which will refresh the page

            var error = "";
            if ($("#inputEmail1").val() == "") {
                error = error + " The email field is required!";
            }
            if ($("#inputSubject1").val() == "") {
                error = error + " The subject field is required!";
            }
            if ($("#formControlTextarea1").val() == "") {
                error = error + " The content field is required!";
            }

            if(error != "") {
                $("#error").html('<div class="alert alert-danger" role="alert">\n' +
                    ' <strong> A simple danger alert!\n</strong>' +
                    error +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '    <span aria-hidden="true">&times;</span>\n' +
                    '  </button>' +
                    '</div>');
            }
            else {
                $("form").unbind("submit").submit();
                //if we don't use unbind first, the function will run
                // recursively. Function unbind() unbinds the function
                //submit() and submit the form
            }

        });

    </script>
</body>
</html>