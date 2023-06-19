<?php

session_start();
$id = $_SESSION['blog_user_id'];
    include_once "../config/dbconnect.php";
    
    $c_id=$_POST['record'];
    $category = mysqli_query($conn, "SELECT category_name FROM category where category_id='$c_id'");
    
    $query="DELETE FROM category where category_id='$c_id'";
    
   

    $data=mysqli_query($conn,$query);

    if($data){
        echo"Category Item Deleted";
    }
    else{
        echo"Not able to delete";
    }

    $delete ='deleted from Categories';

    $addLog = mysqli_query($conn,"INSERT INTO log
    (user_id,actions) 
    VALUES ('$id','$delete $category')");

    
?>