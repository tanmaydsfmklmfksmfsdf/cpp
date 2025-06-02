<?php
// Load PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer or manual PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact us";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$pickup = $conn->real_escape_string($_POST['pickup']);
$drop = $conn->real_escape_string($_POST['drop']);
$dateTime = $conn->real_escape_string($_POST['dateTime']);
$message = $conn->real_escape_string($_POST['message']);

// Insert into database
$sql = "INSERT INTO `contact-form` (`name`, `email`, `pickup`, `drop`, `dateTime`, `message`)
        VALUES ('$name', '$email', '$pickup', '$drop', '$dateTime', '$message')";

if ($conn->query($sql) === TRUE) {
    // Email sending logic
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'n2pgaming321@gmail.com';        // ⬅️ Your Gmail
        $mail->Password   = 'bqry krzu ubto pzdi';     // ⬅️ App password from Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
       $mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true,
    ],
];
        // Recipients
        $mail->setFrom('yourgmail@gmail.com', 'Dream Drive');
        $mail->addAddress($email, $name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Booking Confirmation - Dream Drive';
        $mail->Body    = "
            <h3>Hello $name,</h3>
            <p>Your booking was successful!</p>
            <p><strong>Pickup:</strong> $pickup<br>
            <strong>Drop:</strong> $drop<br>
            <strong>Date & Time:</strong> $dateTime</p>
            <p>Thank you for choosing Dream Drive.</p>
        ";

        $mail->send();
        echo "Booking successful! A confirmation email has been sent to $email.";
    } catch (Exception $e) {
        echo "Booking successful, but email could not be sent. Error: {$mail->ErrorInfo}";
    }

} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
