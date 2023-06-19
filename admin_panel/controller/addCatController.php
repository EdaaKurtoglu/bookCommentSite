<?php
session_start();
$id = $_SESSION['blog_user_id'];
    include_once "../config/dbconnect.php";
    
    if(isset($_POST['upload']))
    {
       
        $catname = $_POST['c_name'];
       
         $insert = mysqli_query($conn,"INSERT INTO category (category_name)  VALUES ('$catname')");
         $added ='added into Categories';
         $addLog = mysqli_query($conn,"INSERT INTO log
         (user_id,actions) 
         VALUES ('$id','$added $catname')");
         if(!$insert)
         {
             echo mysqli_error($conn);
             header("Location: ../index.php?category=error");
         }
         else
         {
             echo "Records added successfully.";
             header("Location: ../index.php?category=success");
         }
     
    }
        
?>