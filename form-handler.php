<?php
// Database credentials
$servername = "localhost";
$username = "root";       // default XAMPP user
$password = "";           // default is empty
$dbname = "dream_drive";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form values
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Prepare SQL query
$sql = "INSERT INTO contact_form (name, email, subject, message) 
        VALUES ('$name', '$email', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Thank you! Your message has been received.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>

