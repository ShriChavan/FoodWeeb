<?php
    $conn = mysqli_connect('localhost','root','','regformdata');
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="css/orderstyle.css">
</head>
<body>
    <h1>Orders</h1>
    <div class="container">
        <table>
            <thead>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Payment Method</th>
                <th>Address</th>
                <th>Pin-code</th>
                <th>Products</th>
                <th>Total price</th>
            </thead>
            <tbody>
                <?php
                    $query = mysqli_query($conn, "SELECT * FROM order1");
                    if(mysqli_num_rows($query)>0){
                        while($fetchOrder = mysqli_fetch_assoc($query)){
                    
                ?>

                <tr>
                    <td>
                        <?php echo $fetchOrder['name'] ?>
                    </td>
                    <td>
                        <?php echo $fetchOrder['number'] ?>
                    </td>
                    <td>
                        <?php echo $fetchOrder['email'] ?>
                    </td>
                    <td>
                        <?php echo $fetchOrder['method'] ?>
                    </td>
                    <td>
                        <?php echo $fetchOrder['flat'].",".$fetchOrder['street'].",".$fetchOrder['city'].",".$fetchOrder['state'] ?>
                    </td>
                    <td>
                        <?php echo $fetchOrder['pin_code'] ?>
                    </td>
                    <td>
                        <?php echo $fetchOrder['total_products'] ?>
                    </td>
                    <td>
                        <?php echo $fetchOrder['total_price'] ?>
                    </td>
                </tr>

                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="cleardb">
        <form method="post">
            <input type="submit" name="submit" value="Dispatch Orders">
        </form>
    </div>
</body>
</html>