<?php
session_start();
if(!isset($_SESSION['adminid'])){
    header('Location: adminlogin.html');
    exit();
}
$conn = mysqli_connect('localhost','root','','regformdata');
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
if(isset($_POST['upload'])){
    $file = $_FILES['image']['name'];
    $itemname = $_POST['itemname'];
    $restname = $_POST['restname'];
    $mrp = $_POST['mrp'];
    $saleprice = $_POST['saleprice'];
    $description = $_POST['description'];
    $rating = $_POST['rating'];
    $location = $_POST['location'];

    $query = "INSERT INTO foodtb1(itemname,restname,mrp,saleprice,description,rating,location,image) 
    VALUES('$itemname','$restname','$mrp','$saleprice','$description','$rating','$location','$file')";
    $res = mysqli_query($conn,$query);

    if($res){
        move_uploaded_file($_FILES['image']['tmp_name'],"$file");
        header('location:adminpage.php');
        echo "<script>alert('Product updated succesfully')</script>";
    }
    else{
        header('location:adminpage.php');
        echo "<script>alert('Product could not be updated')</script>";
    }
}
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `foodtb1` WHERE id = $delete_id ") or die('query failed');
    if($delete_query){
       header('location:adminpage.php');
       $message[] = 'product has been deleted';
    }else{
       header('location:adminpage.php');
       $message[] = 'product could not be deleted';
    };
};
if(isset($_POST['logout'])){
    session_destroy();
    header('Location: adminlogin.html');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="css/adminpagestyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="logo">
        <img src="logo2.png">
    </div>
    <div class="main">
        <header><ul>
            <li class="active"><a href="contactmgmt.php">Contact requests</a></li>
            <li><a href="order.php">Orders</a></li>
            <li><form action="" method="post">
                    <input type="submit" name="logout" value="Logout">
            </form></li>
        </ul></header>
    </div>
    <div class="main2">
        <div class="container">
            <form class="form1" method="post" enctype="multipart/form-data">
                <h1>Add items</h1>
                <div class="content">
                    <div class="input-box">
                        <input type="text" name = 'itemname' placeholder="Enter item name">
                    </div>
                    <div class="input-box">
                        <input type="text" name = 'restname' placeholder="Enter restaurant name">
                    </div>
                    <div class="input-box">
                        <input type="number" name = 'mrp' placeholder="Enter mrp">
                    </div>
                    <div class="input-box">
                        <input type="number" name = 'saleprice' placeholder="Enter saleprice">
                    </div>
                    <div class="input-box">
                        <input type="text" name = 'description' placeholder="Enter item description">
                    </div>
                    <div class="input-box">
                        <input type="number" step="0.01" name = 'rating' placeholder="Enter rating">
                    </div>
                    <div class="input-box">
                        <input type="text" name = 'location' placeholder="Enter location">
                    </div>
                    <div class="buttons">
                        <input type="file" name = "image">
                    </div>
                </div>
                <div class="submitb">
                    <input type="submit" name="upload" value="Submit">
                </div>
            </form>
        </div>
    </div>

    <div class="container2">
    <section class="display-product-table">
        <table>
        <thead>
            <th>Product image</th>
            <th>Product name</th>
            <th>Product price</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
            
                $select_products = mysqli_query($conn, "SELECT * FROM `foodtb1`");
                if(mysqli_num_rows($select_products) > 0){
                while($row = mysqli_fetch_assoc($select_products)){
            ?>
            <tr>
                <td><img src="<?php echo $row['image']; ?>" height="80" width="130px" alt="img"></td>
                <td><?php echo $row['itemname']; ?></td>
                <td>Rs.<?php echo $row['mrp']; ?>/-</td>
                <td>
                <a href="adminpage.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are your sure you want to delete this?');"> <i class="fas fa-trash"></i> Delete </a>
                </td>
            </tr>
            <?php
                };    
                }else{
                    echo "<div class='empty'>No product added</div>";
                };
            ?>
        </tbody>
        </table>
    </section>
    </div>

</body>
</html>