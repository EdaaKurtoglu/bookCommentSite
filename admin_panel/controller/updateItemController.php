<?php
    include_once "../config/dbconnect.php";
session_start();
$id = $_SESSION['blog_user_id'];

    $book_id=$_POST['book_id'];
    $book_name= $_POST['book_name'];
    $book_author= $_POST['book_author'];
    $pages= $_POST['pages'];
    $category= $_POST['category'];
    $translator=$_POST['translator'];
    $language= $_POST['language'];
    $summary= $_POST['summary'];
    
    if( isset($_FILES['newImage']) ){
        
        $location="./a_uploads/";
        $img = $_FILES['newImage']['name'];
        $tmp = $_FILES['newImage']['tmp_name'];
        $dir = './a_uploads/';
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif','webp');
        $image =rand(1000,1000000).".".$ext;
        $final_image=$location. $image;
        if (in_array($ext, $valid_extensions)) {
            $path = UPLOAD_PATH . $image;
            move_uploaded_file($tmp, $dir.$image);
        }
    }else{
        $final_image=$_POST['existingImage'];
    }
        $updateItem = mysqli_query($conn,"UPDATE book SET 
        book_name='$book_name', 
        book_author='$book_author', 
        pages='$pages',
        category_id='$category',
        book_lang='$language',
        translator= '$translator',
        summary='$summary',
        photo='$final_image' 
        WHERE book_id= $book_id");


        $added ='updated into Books';
        $addLog = mysqli_query($conn,"INSERT INTO log
        (user_id,actions) 
        VALUES ('$id','$added $book_name')");

    if($updateItem)
    {
        echo "true";
    }
   else
    {
         echo mysqli_error($conn);
    }
?>