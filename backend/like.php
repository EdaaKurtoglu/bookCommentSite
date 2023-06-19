<?php

session_start();
include("classes/quotes.php");
include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");


echo "<pre>";
print_r($_SERVER);
echo "</pre>";

if (isset($_SERVER['HTTP_REFERER'])) {
    $return_to = $_SERVER['HTTP_REFERER'];
} else {
    $return_to = "profile.php";
}

if (isset($_GET['type']) && isset($_GET['id'])) {
    
    if(is_numeric($_GET['id']))
    {
        $allowed[] = 'quote';
        $allowed[] = 'user';
        $allowed[] = 'comment';
        
        if(in_array($_GET['type'], $allowed))
        {
            $quotes = new Quotes();
            
            $quotes->like_quote($_GET['id'], $_GET['type'], $_SESSION['blog_user_id']);
        }
        
    }
    
}
header("Location: " . $return_to);
die;


