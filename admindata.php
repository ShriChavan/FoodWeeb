<?php 
session_start();
$adminid = $_POST['adminid'];
$pass = $_POST['password'];

$conn = new mysqli('localhost','root','','regformdata');
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
else{
    $stmt = $conn->prepare("select * from adminlogin where adminid = ?");
    $stmt->bind_param('s',$adminid);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if($stmt_result->num_rows>0){
        $data = $stmt_result->fetch_assoc();
        if($data['password']===$pass){
            $_SESSION['adminid']=$adminid;
            $_SESSION['password']=$pass;
            header('Location: adminpage.php');
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