<?php
$conn = mysqli_connect('localhost','root','','regformdata');
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
if(isset($_POST['upload'])){
    $file = $_FILES['image']['name'];
    $query = "INSERT INTO foodtb1(itemname,restname,mrp,saleprice,description,rating,location,image) 
    VALUES('Meat Burger','ABC',199,169,'Meat fits everywhere',4.8,'Kolhapur','$file')";
    $res = mysqli_query($conn,$query);
    if($res){
        move_uploaded_file($_FILES['image']['tmp_name'],"$file");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Img upload</title>
</head>
<body>
    <form class="form1" method="post" enctype="multipart/form-data">
        <input type="file" name = "image">
        <input type="submit" name="upload" value="Upload">
    </form>
</body>
</html>