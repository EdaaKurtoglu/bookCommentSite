
<?php

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/quotes.php");
include("classes/book.php");

if(isset($_SESSION['blog_user_id']) && is_numeric($_SESSION['blog_user_id']))
{
  $id = $_SESSION['blog_user_id'];
  $login = new Login();
  $result = $login->check_login($id);
  if($result)
  {
    $user = new User();
    $user_data = $user->get_data($id);
    if(!$user_data)
    {
      header("Location: login.php");
      die;
    }


  }else
  {
    header("Location: login.php");
    die;
  }
}else
{
    header("Location: login.php");
    die;
}

$books = new Book();
$book_id = $_GET['book_id'];

 if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $books = new Book();
        $id = $_SESSION['blog_user_id'];
        
        $result = $books->create_comment($id, $_POST, $book_id);
        
        if($result != "")
        {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "<br>The following errors occured:<br><br>";
            echo $result;
           
            echo "</div>";
        }
    
    }
    


$name = $books->getBookName($book_id);
$summary = $books->getSummary($book_id);
$author = $books->getAuthor($book_id);
$page = $books->getPage($book_id);
$language = $books->getLanguage($book_id);
$translator = $books->getTranslator($book_id);
$like = $books->getLike($book_id);
$photo = $books->getPhoto($book_id);
$category = $books->getCategory($book_id);
$comment = $books->getComment($book_id);





?>

<html lang="en">
  
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Page</title>
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <!-- CSS -->
    <link rel="stylesheet" href="style.css" />
    
  </head>

  <style>

    #columns
    {
      background: white;
    }
    #tag_col
    {
      background: #CCCCCC;
      padding: 25px 20px;
      text-align: center;
      max-width: 350px;
      position: absolute;
      margin-top: 10px;
      margin-left: 950px;
      height: 800px;
      width: 600px;
      border: solid thick #000000;
     
    }
    #right_col
    {
      background:#fff9eb;
      position: relative;
      min-height: 400px;
      margin-top: -230px;
      width: 800px;
      border: solid thick #000000;
      
      padding: 8px;
      margin-left: 100px;
      
      
    }

    #pic
    {
      width: 180px;
      height: 220px;
      object-fit: cover;
      display: block;
      box-shadow: 1px 3px 12px rgba(0, 0, 0, 0.18);
      
    }

    #info
    {
      width: 800px;
      margin:auto;
      font-size: 20px; 
      font-family: Arial;
      text-align: left;
      font-weight: bolder;
      

    }
    #name
    {
      font-style: italic;
      font-weight: bolder;
      font-size: 20px;
      text-align: center;
    }
    #summary
    {
      font-style: italic;
      font-size: 15px;
    }

    #post_bar
    {
      text-align: left;
      margin-left: 50px;
    }

    #text
    {
      width:700px;
      margin-left: 50px;
    }
  </style>
  <body>
  <?php
      include("bar.php");
    ?>
  <div class="columns" id="columns">
    <div id="tag_col">
      <img id= "pic" src= "<?php echo implode($photo[0]); ?>">
      <div id="info">
        <br><br>
          Name: <?php echo implode($name[0]); ?> <br><br>
          Author: <?php echo implode($author[0]);?> <br><br>
          Page:  <?php echo implode($page[0]); ?>  <br><br>
          Original Language: <?php echo implode($language[0]); ?> <br><br>
          Translator: <?php echo implode($translator[0]); ?>  <br><br>
          Category: <?php echo implode($category[0]); ?>   <br><br>
          
         
          
          <a href="bookLike.php?type=book&id=<?php echo $book_id;?>">
                <span style="font-size: 20px; margin: 10px; color:red;">Like(<?php echo implode($like[0]); ?> )</span>
          </a>
          <a href=" <?php $books->addList($id,$book_id);?>">
                <span style="font-size: 20px; margin: 10px; color:red;">Add To Your List</span>
          </a>
        
      </div>


    </div>
    <div id="right_col" >
          <div class="name" id="name" ;>
          <br>
          <?php
          echo implode($name[0]);    
          ?>
          <br><br>
          </div>
          
          <div class="summary" id="summary" ;>
          <?php
          echo implode($summary[0]);    
          ?>
          </div>


    </div>
  
      <div class="post" style="min-height: 400px; flex:2.5; padding: 70px; " >
                    <div id="text">
                        <form method="post">
                            <textarea style="width: 100%; margin-left: 0px; margin-top:0px; " name="comment" placeholder="Write a comment!!"></textarea>
                            <input class="post_button" style="color: #fff; background-color: #000000;margin-bottom: 0px;" type="submit" value="Share">
                            <br>
                        </form>    
                    </div>
                <!-- posts -->    
                <div id="post_bar">
                    <?php

                        if($comment)
                        {
                        
                            foreach($comment as $COM_ROW)
                            {
                                $user = new User();
                                $user_info = $user->getUser($COM_ROW['user_id']);
                                include("comments.php");
                            }
                        }
                        
                            
                        
                        


                    ?>


                    
                </div>    



  </div>
    
  </body>
</html>
