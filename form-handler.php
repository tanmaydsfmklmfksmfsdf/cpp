<?php
$name=$_POST['name'];
$visitor_email=$_POST['email'];
$subject=$_POST['subject'];
$message=$_POST['Message'];

$conn = new mysqli('localhot','root','','contact us');
if($conn->connect_error){
  die('Connection Failed : '.$conn->connect_error);
}else{
  $stmt = $conn->prepare("insert into message_form(name,visitor_email,subject,message)
  values(?,?,?,?)");
  $stmt->($name,$visitor_email,$subject,$message);
  $stmt->execute();
  echo "Message Successfully Submited...";
  $stmt->close();
  $conn->close();
?>
