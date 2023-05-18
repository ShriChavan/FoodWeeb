<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location: signin.html');
        exit();
    }
    $name = $_SESSION['username'];
    if(isset($_POST['logout'])){
        session_destroy();
        header('Location: signin.html');
    }
    if(isset($_POST['submit'])){
        $_SESSION['name']=$name;
        header('Location: home.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Location page FoodWeeb</title>
    <link rel="stylesheet" href="css/homestyle.css">
</head>
<body>
    <div class="container">
        <div class="sidebar" id="sidebar">
            <div class="toggle-btn" onclick="show()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <script>
                function show(){
                    document.getElementById('sidebar').classList.toggle('active');
                }
            </script>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="homepage.php">Order now</a></li>
                <li><a href="contactpage.html">Contact us</a></li>
                <li><a href="aboutpage.html">About</a></li>
                <li>
                    <form action="" method="post">
                        <input type="submit" name="profile" value="Profile">
                    </form>
                </li>
                <li>
                    <form action="" method="post">
                        <input type="submit" name="logout" value="Logout">
                    </form>
                </li>
            </ul>
        </div>
        <div class="username">
            <h1><?php echo "Hello ".$name."!" ?></h1>
        </div>
        <div class="logo">
            <img src="logo2.png">
        </div>
    </div>
    <div class="searchb">
        <form action="" class="searchbar" method="post">
            <input type="text" placeholder="Enter your location" name="searchTerm">
            <button type="submit" name="submit"><img src="search.png" alt="searchicon"></button>
        </form>
    </div>
</body>
</html>