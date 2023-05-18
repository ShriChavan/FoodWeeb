<?php
$name = $_POST['name'];
$age = $_POST['age'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$conpass = $_POST['conpass'];
$gender = $_POST['gender'];

$conn = new mysqli('localhost','root','','regformdata');
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
else{
    $stmt = $conn->prepare("Insert into regdata(name,age,email,phone,password,conpass,gender) values(?,?,?,?,?,?,?)");
    $stmt->bind_param('sisisss',$name,$age,$email,$phone,$password,$conpass,$gender);
    $stmt->execute();
    if(isset($_POST['submit'])){
        header('Location: signin.html');
    }
    $stmt->close();
    $conn->close();
}
?>
