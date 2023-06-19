<?php
    session_start();
    include_once "../config/dbconnect.php";
    $id = $_SESSION['blog_user_id'];
    
    if(isset($_POST['upload']))
    {
       
        $book_name = $_POST['book_name'];
        $book_author = $_POST['book_author'];
        $pages = $_POST['pages'];
        $translator = $_POST['translator'];
        $language = $_POST['language'];
       
        $summary = $_POST['summary'];
        $category = $_POST['category'];

        $name = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
    
        $location="../a_uploads/";
        $image=$location.$name;

        $target_dir="../a_uploads/";
        $finalImage=$target_dir.$name;

        move_uploaded_file($temp,$finalImage);

         $insert = mysqli_query($conn,"INSERT INTO book
         (book_name,book_author,pages,translator,book_lang,summary,category_id,photo) 
         VALUES ('$book_name','$book_author','$pages','$translator','$language','$summary','$category','$image')");
            $added ='added into Books';
         $addLog = mysqli_query($conn,"INSERT INTO log
         (user_id,actions) 
         VALUES ('$id','$added $book_name')");
 
         if(!$insert)
         {
             echo mysqli_error($conn);
         }
         else
         {
             echo "Records added successfully.";
         }
         if(!$addLog)
         {
             echo mysqli_error($conn);
         }
         else
         {
             echo "Records added successfully.";
         }
     
    }
        
?>