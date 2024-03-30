<?php

include './config.php';


if(isset($_GET['deleteid'])){
    $deleteid = $_GET['deleteid'];
    

    $Sql= "DELETE FROM `crud` WHERE id = $deleteid";
    $result=mysqli_query($mysqli,$Sql);

    if($result){
        echo "deleted successfully";
        header("location: users.php");
    }else{
        die(mysqli_error($mysqli));
    }

    header("location: users.php");
}



?>