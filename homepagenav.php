<?php 
$conn = new mysqli('localhost','root','','regformdata');
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
if($_POST['search']==""){
    echo "<h1>No results found</h1>";
}
else{
    $search = trim($_POST["search"]);
    $query = $db->prepare("SELECT location from foodtb1 where location like '%$search%'");
    $query -> execute(array());
    $control = $query->fetchAll(PDO::FETCH_OBJ);
    $count = $query->rowCount();
    if($count>0){
        header("Location: home.php");
    }
    else{
        echo "<h1>No results found</h1>";
    }
}
?>