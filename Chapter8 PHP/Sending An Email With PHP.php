<?php
    $emailTo = "2470080342@qq.com";
    $subject = "I hope this works!";
    $body = "I think you are great";
    $headers = "From: 2470080342@qq.com";
    if (mail($emailTo, $subject, $body, $headers)) {
        echo "The email was sent successfully";
    }
    else {
        echo "The email could not be sent";
    }
?>
