<?php
include './config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Interface</title>
    <link rel="stylesheet" href="bstrap.css">
</head>
<body>
<div class="container">
    <form action="index.php" method="post">
        <button class="btn btn-primary my-5"><a href="index.php" class="text-light">Add User</a></button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">SL NO</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Password</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>      
            <tbody>
                <?php        
                    $Sql = "SELECT * FROM `crud` ORDER BY id ASC";
                    $result = mysqli_query($mysqli,$Sql);
                    foreach($result as $key => $row) {
                        // echo "$key<br>";
                        $id = $row['id'];
                        $username = $row['username'];
                        $email = $row['email'];
                        $mobile = $row['mobile'];
                        $password = $row['password'];
                        echo '<tr>
                                <th scope="row">'. ($key + 1) . ' <?php echo $key + 1?></th>
                                    <td>'.$username.'</td>
                                    <td>'.$email.'</td>
                                    <td>'.$mobile.'</td>
                                    <td>'.$password.'</td>
                                    <td>
                                    <button class="btn btn-primary"><a href="edit.php?editid='.$id.'" class="text-light">Edit</a></button>
                                    <button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
                                </td>
                            </tr>';
                    }
                    
                    // Reset the counter if there are no records found
                    if(mysqli_num_rows($result) == 0) {
                        echo '<tr><td colspan="6">No records found</td></tr>';
                    }
                ?>
            </tbody>
        </table>

    </form>
</div>
</body>
</html>