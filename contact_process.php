<?php
// Set the recipient email address
$to = "rodneytaremwa29@gmail.com";

// Retrieve form inputs and sanitize them to prevent security vulnerabilities
$from = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
$name = filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING);
$subject = filter_var($_REQUEST['subject'], FILTER_SANITIZE_STRING);
$number = filter_var($_REQUEST['number'], FILTER_SANITIZE_STRING);
$cmessage = filter_var($_REQUEST['message'], FILTER_SANITIZE_STRING);

// Validate the email address
if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

// Set up email headers
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: " . $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Define the email subject
$email_subject = "New Contact Form Submission: " . $subject;

// Create the email body in HTML format
$body = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Contact Form Message</title>
</head>
<body>
    <h2>New Message from Contact Form</h2>
    <p><strong>Name:</strong> {$name}</p>
    <p><strong>Email:</strong> {$from}</p>
    <p><strong>Phone Number:</strong> {$number}</p>
    <p><strong>Subject:</strong> {$subject}</p>
    <p><strong>Message:</strong><br>" . nl2br($cmessage) . "</p>
</body>
</html>";

// Send the email and check if it was successful
if (mail($to, $email_subject, $body, $headers)) {
    echo "Your message has been sent successfully.";
} else {
    echo "There was an error sending your message. Please try again.";
}
?>
