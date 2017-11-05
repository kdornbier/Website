<?php

// PHP Contact Form
// https://bootstraptemple.com/p/how-to-build-a-working-bootstrap-contact-form
$from = 'Contact Form <contact@kdornbier.com>';
$sendTo = 'Personal Email <kaitlyndornbier@gmail.com>';
$subject = 'New Message From Website';
$fields = array('name' => 'Name', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message'); // array variable name => Text to appear in email
$okMessage = 'Thank you so much, I\'ll get back to you soon!';
$errorMessage = 'There was an error with contacting me. Please try again later';

// let's do the sending

try
{
    $emailText = "You have new message from contact form\n=============================\n";

    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    mail($sendTo, $subject, $emailText, "From: " . $from);

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);
    
    header('Content-Type: application/json');
    
    echo $encoded;
}
else {
    echo $responseArray['message'];
}