<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Do something (like save to DB, send mail, etc.)
    echo "Message received successfully!";
} else {
    // Block other request methods
    http_response_code(405);
    echo "405 Method Not Allowed";
}
?>
