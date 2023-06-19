<?php
session_start();
$id = $_SESSION['blog_user_id'];
    include_once "../config/dbconnect.php";
    
    $book_id=$_POST['record'];
    
    $sql = "SELECT book_name FROM book where book_id='$book_id'";
    $book = mysqli_query($conn, $sql);
    $query="DELETE FROM book where book_id='$book_id'";

    $data=mysqli_query($conn,$query);

    if($data){
        echo "Product Item Deleted";
    }
    else{
        echo"Not able to delete";
    }

    $deleted ='deleted from Books';

    $addLog = mysqli_query($conn,"INSERT INTO log
        (user_id,actions) 
        VALUES ('$id','$deleted $book')");
?>