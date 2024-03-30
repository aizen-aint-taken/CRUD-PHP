<?php
include "./config.php";

if (isset($_POST["submit"])) {
    // escape user inputs 
    $username = mysqli_real_escape_string($mysqli, $_POST["username"]);
    $email = mysqli_real_escape_string($mysqli, $_POST["email"]);
    $mobile = mysqli_real_escape_string($mysqli, $_POST["mobile"]);
    $password = mysqli_real_escape_string($mysqli, $_POST["password"]);

    if (
        empty($username) ||
        empty($email) ||
        empty($mobile) ||
        empty($password)
    ) {
        echo "All fields are required!";
    } else {
        // Check if the email already exists
        $check_query = "SELECT * FROM `crud` WHERE email='$email'";
        $check_result = mysqli_query($mysqli, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            echo "Email already exists";
        } else {
            // Check if the username already exists
            $check_query = "SELECT * FROM `crud` WHERE username='$username'";
            $check_result = mysqli_query($mysqli, $check_query);
            $email = filter_var($check_query,FILTER_VALIDATE_EMAIL);
            echo $email;

            if (mysqli_num_rows($check_result) > 0) {
                echo "Username already exists";
            } else {
                // Check if the mobile number already exists
                $check_query = "SELECT * FROM `crud` WHERE mobile='$mobile'";
                $check_result = mysqli_query($mysqli, $check_query);
              if(!filter_input_array($email,  FILTER_SANITIZE_EMAIL)){
                echo "email is not valid";
              }else{
                echo "valid email, you're accepted";
              }
                if (mysqli_num_rows($check_result) > 0) {
                    echo "Mobile already exists";
                } else {

                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    // Insert into database
                    $insert_query = "INSERT INTO `crud` (username, email, mobile, password) 
                                     VALUES ('$username', '$email', '$mobile', '$password')";
                    $insert_result = mysqli_query($mysqli, $insert_query);

                    if ($insert_result) {
                        header("location: users.php");
                        exit();
                    } else {
                        echo "Error: " . mysqli_error($mysqli);
                    }
                }
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD UI</title>
    <link rel="stylesheet" href="bstrap.css">
</head>
<body>

    <div class="container my-5">     
        <form action="index.php" method="post">
            <div class="form-group mb-3">
                <label for="Username" class="form-label">Username</label>
                <input type="text" id="Username" class="form-control" name="username" placeholder="Enter your username" autocomplete="off" >
            </div>  

            <div class="form-group mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" id="Email" class="form-control" name="email" placeholder="Enter your email" autocomplete="off">
            </div>  

            <div class="form-group mb-3">
                <label for="Mobile" class="form-label">Mobile</label>
                <input type="number" id="Mobile" class="form-control" name="mobile" placeholder="Enter your mobile number" autocomplete="off">
            </div>  



            <div class="form-group mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password"  id="Password" class="form-control" name="password" placeholder="Enter your password" autocomplete="off">
                <input type="checkbox" onclick="seePassword()">Show Password
            </div>  
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <script>
        function seePassword(){
            let password = document.getElementById("Password");
                 if (password.type === "password") {
                        password.type = "text";
                 } else {
                    password.type = "password";
                 }
        }
    </script>
</body>
</html>