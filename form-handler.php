<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name     = htmlspecialchars($_POST['name']);
    $email    = htmlspecialchars($_POST['email']);
    $pickup   = htmlspecialchars($_POST['pickup']);
    $drop     = htmlspecialchars($_POST['drop']);
    $dateTime = htmlspecialchars($_POST['dateTime']);
    $message  = htmlspecialchars($_POST['message']);

    // Email subject and content
    $subject = "Cab Booking Confirmation - Dream-Drive";
    $body = "Hello $name,\n\nThank you for booking a cab with Dream-Drive!\n\n".
            "Your booking details are as follows:\n".
            "Pickup Location: $pickup\n".
            "Drop Location: $drop\n".
            "Date & Time: $dateTime\n\n".
            "Additional Message: $message\n\n".
            "We will contact you shortly with further updates.\n\n".
            "Regards,\nDream-Drive Team";

    $headers = "From: no-reply@dreamdrive.com\r\n" .
               "Reply-To: support@dreamdrive.com\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Send email
    if (mail($email, $subject, $body, $headers)) {
        echo "<script>alert('Booking successful! A confirmation email has been sent.'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Booking failed. Please try again later.'); window.location.href='contact.html';</script>";
    }
} else {
    echo "Invalid request.";
}
?>
