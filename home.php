<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location: signin.html');
        exit();
    }
    $name = $_SESSION['name'];
    $conn = mysqli_connect('localhost','root','','regformdata');
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }

    if(isset($_POST['addtocart'])){

        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = 1;
     
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE itemname = '$product_name'");
     
        if(mysqli_num_rows($select_cart) > 0){
           $message[] = 'product already added to cart';
        }
        else{
           $insert_product = mysqli_query($conn, "INSERT INTO `cart`(itemname, price, quantity, image) VALUES('$product_name', '$product_price', '$product_quantity', '$product_image')");
           echo "<script>alert('Product added to cart succesfully')</script>";
        }
     
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header('Location: signin.html');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>FoodWeeb homepage</title>
</head>
<body>
    <div class="containerbox">
        <div class="logo">
            <img src="logo2.png">
        </div>
        <div class="searchb">
            <form method="GET" class="searchbar">
                <input type="text" name="submit1" placeholder="Search food items">            
                <button type="submit" id="submit1"><img src="search.png" alt="searchicon"></button>
            </form>
        </div>
        <div class="mainp">
            <header><ul>
                <li><a href="contactpage.html">Contact us</a></li>
                <li><a href="aboutpage.html">About</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><form action="" method="post">
                    <input type="submit" name="logout" value="Logout">
                </form></li>
            </ul></header>
        </div>
    </div>
    <div class="location">
        <?php 
            $search = isset($_POST['searTerm']) ? $_POST['searchterm']:'';
            $conn = mysqli_connect('localhost','root','','regformdata');
            $query1 = "SELECT * FROM foodtb1 WHERE location LIKE '%$search%'";
            $result = mysqli_query($conn,$query1);
            $row = mysqli_fetch_assoc($result);
            echo "Hello ".$name."! Your location: ".$row['location'];
        ?>
    </div>
    <main>
        <?php
        if(isset($_GET['submit1'])){
            $conn = mysqli_connect('localhost','root','','regformdata');
            if($conn->connect_error){
                die("Connection failed: ".$conn->connect_error);
            }
            else{
                $searchterm = $_GET['submit1'];
                $query = "SELECT * FROM foodtb1 WHERE itemname like '%$searchterm%'";
                $results = $conn->query($query);
                if($results->num_rows > 0){
                    while($r = $results->fetch_assoc()){
        ?>
                        <div class="card">
                            <div class="image">
                                <img src="<?php echo $r["image"] ?>">
                            </div>
                            <div class="caption">
                                <div class="nmrt">
                                    <b><p class="itemname"><?php echo $r["itemname"] ?></p></b>
                                    <p class="rating"><?php echo $r["rating"] ?> &#9733</p>  
                                </div>     
                                <p class="description"><?php echo $r["description"] ?></p>
                                <p class="price"><del><?php echo $r["mrp"] ?></del> <?php echo $r["saleprice"] ?> Rs.</p>                
                            </div>
                            <div class="addcart">
                                <form action="" method="post">
                                    <input type="hidden" name="product_name" value="<?php echo $r['itemname']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $r['saleprice']; ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $r['image']; ?>">
                                    <button name="addtocart">Add to cart</button>
                                </form>
                            </div>
                        </div>
        <?php
                    }
                } 
                else{
                    echo "<h1>Results not found</h1>";
                }
            }
        }
        ?>
    </main>
</body>
</html>