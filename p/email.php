<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format'); window.location.href='contact-us.html';</script>";
        exit;
    }

    // Email parameters
    $to = 'info@techleafe.com';  // Replace with your email address
    $subject = 'KENews Contact Us Message from ' . $name;
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Compose the email body
    $emailBody = "Name: $name\n";
    $emailBody .= "Email: $email\n";
    $emailBody .= "Message:\n$message\n";

    // Send the email
    if (mail($to, $subject, $emailBody, $headers)) {
        echo "<script>alert('Your message has been sent successfully.'); window.location.href='contact-us.html';</script>";
    } else {
        echo "<script>alert('Sorry, something went wrong. We couldn\'t send your message. Please try again later.'); window.location.href='contact-us.html';</script>";
    }
} else {
    echo "<script>alert('Invalid request method.'); window.location.href='contact-us.html';</script>";
}
?>
