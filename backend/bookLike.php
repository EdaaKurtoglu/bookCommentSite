<?php

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/book.php");


echo "<pre>";
print_r($_SERVER);
echo "</pre>";


if (isset($_SERVER['HTTP_REFERER'])) {
    $return_to = $_SERVER['HTTP_REFERER'];
} else {
    $return_to = "book_info.php";
}


if (isset($_GET['type']) && isset($_GET['id'])) {
    
    if(is_numeric($_GET['id']))
    {
        $allowed[] = 'book';
        $allowed[] = 'user';
        $allowed[] = 'comment';
        
        if(in_array($_GET['type'], $allowed))
        {
            $books = new Book();
            $books ->like_book($_GET['id'], $_GET['type'], $_SESSION['blog_user_id']);
            
        }
        
    }
    
}
header("Location: " . $return_to);
die;


