<?php

include './config.php';
    $id = $_GET['editid'];
    $Sql = " SELECT * FROM `crud` WHERE id = $id";
    $result = mysqli_query($mysqli,$Sql);
    $row=mysqli_fetch_assoc($result);
    $username=$row['username'];
    $email=$row['email'];
    $mobile=$row['mobile'];
    $password=$row['password'];

if(isset($_POST['update'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];


    $Sql = "UPDATE `crud` SET id = $id , 
    username='$username',
    email='$email',
    mobile='$mobile',
    password='$password' WHERE id = $id";

    $result = mysqli_query($mysqli,$Sql);

    if($result){
        // echo "Data updated succesfully";
        header("location: users.php");
    }else{
        die(mysqli_error($mysqli));
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="bstrap.css">
</head>
<body>

    <div class="container my-5">     
        <form action="" method="post">
            <div class="form-group mb-3">
                <label for="Username" class="form-label">Username</label>
                <input type="text" id="Username" class="form-control" name="username" placeholder="Enter your username" autocomplete="off" value="<?= $username; ?>" >
            </div>  

            <div class="form-group mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" id="Email" class="form-control" name="email" placeholder="Enter your email" autocomplete="off" value="<?= $email; ?>">
            </div>  

            <div class="form-group mb-3">
                <label for="Mobile" class="form-label">Mobile</label>
                <input type="number" id="Mobile" class="form-control" name="mobile" placeholder="Enter your mobile number" autocomplete="off" value="<?= $mobile; ?>">
            </div>  



            <div class="form-group mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="text" id="Password" class="form-control" name="password" placeholder="Enter your password" autocomplete="off"  value="<?= $password; ?>">
            </div>  
            <button type="submit" class="btn btn-primary" name="update">Update</button>
        </form>
    </div>
    <script>
        
    </script>
</body>
</html>