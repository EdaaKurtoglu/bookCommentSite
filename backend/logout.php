<?php

session_start();
include("classes/connect.php");
$DB = new Database;
if (isset($_SESSION['blog_user_id']))
{
    $log_id = $_SESSION['blog_user_id'];
    $query = "insert into log (user_id,actions) 
                values ('$log_id','logout')";
                
                $DB->save($query);
    $_SESSION['blog_user_id'] = null;
     
    unset($_SESSION['blog_user_id']);
}
header("Location: ./index.php");
die;