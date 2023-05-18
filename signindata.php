<?php 
session_start();
$email = $_POST['email'];
$conpass = $_POST['conpass'];

$conn = new mysqli('localhost','root','','regformdata');
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
else{
    $stmt = $conn->prepare("select * from regdata where email = ?");
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if($stmt_result->num_rows>0){
        $data = $stmt_result->fetch_assoc();
        $username = $data['name'];
        $age = $data['age'];
        $phone = $data['phone'];
        $gender = $data['gender'];
        if($data['conpass']===$conpass){
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['age'] = $age;
            $_SESSION['phone'] = $phone;
            $_SESSION['gender'] = $gender;
            header('Location: homepage.php');
        }
        else{
            echo "<h2>Invalid email or password</h2>";
        }
    }
    else{
        echo "<h2>Invalid email or password</h2>";
    }
}
?>