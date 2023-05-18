<?php
$name = $_POST['name'];
$email = $_POST['email'];
$feedback = $_POST['Message'];

$conn = new mysqli('localhost','root','','regformdata');
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
else{
    $stmt = $conn->prepare("Insert into contactreqs(name,email,feedback) values(?,?,?)");
    $stmt->bind_param('sss',$name,$email,$feedback);
    $stmt->execute();
    if(isset($_POST['submit'])){
        echo "<script>alert('Feedback submitted successfully')</script>";
        header('Location:contactpage.html');
    }
    $stmt->close();
    $conn->close();
}
?>
