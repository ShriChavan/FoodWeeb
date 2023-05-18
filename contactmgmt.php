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
    <title>Contact Requests</title>
    <link rel="stylesheet" href="css/contactmgmtstyle.css">
</head>
<body>
    <h1>Contact Requests</h1>
    <div class="container">
        <table>
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Feedback</th>
            </thead>
            <tbody>
                <?php
                    $query = mysqli_query($conn, "SELECT * FROM contactreqs");
                    if(mysqli_num_rows($query)>0){
                        while($fetchOrder = mysqli_fetch_assoc($query)){
                    
                ?>

                <tr>
                    <td>
                        <?php echo $fetchOrder['name'] ?>
                    </td>
                    <td>
                        <?php echo $fetchOrder['email'] ?>
                    </td>
                    <td>
                        <?php echo $fetchOrder['feedback'] ?>
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
            <input type="submit" name="submit" value="Mark as read">
        </form>
    </div>
</body>
</html>