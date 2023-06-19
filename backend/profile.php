
<?php

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/quotes.php");


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


//posting start here
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $quotes = new Quotes();
    $id = $_SESSION['blog_user_id'];
    
    $result = $quotes->create_quote($id, $_POST);
    
    if($result == "")
    {
        header("Location: profile.php");
        die;
    }else
    {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
        echo "<br>The following errors occured:<br><br>";
        echo $result;
       
        echo "</div>";
    }

}

//collect quotes
$quotes = new Quotes();
$id = $_SESSION['blog_user_id'];
$quote = $quotes->getQuote($id);



?>




<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Page</title>
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php
      include("bar.php");
      
    ?>
    
    <div class="header__wrapper">
      <header style="margin-left: 70px;margin-top: -305px; z-index:-1; position:relative; width: 100%;"></header>
      <div class="cols__container">
        <div class="left__col">
          <div class="img__container">
            <span style="font-size: 12px;">
                <?php
                  $image = "";
                  if(file_exists($user_data['profile_image']))
                  {
                    $image = $user_data['profile_image'];
                  }

                ?>

               <img src="<?php echo $image ?>"><br/>
                <a style="text-decoration: none; color:red;"href="changeProfileImage.php">Change Image</a>
            </span>
          </div>
          <h2><div style="font-size: 20px;"><?php echo $user_data['username'] ?> </div></h2>
         
          <p><div style="font-size: 20px;"><?php echo $user_data['e_mail'] ?> </div></p>

        </div>
        <div class="right__col">
          <nav >
            <ul style="background: white;">
              <li><a href="">quotes</a></li>
              <li><a href="readLater.php">
                <span>Read Later</span>
              </a></li>
              
            </ul>
           
          </nav>

          <div style="min-height: 400px; flex:2.5; padding: 20px; padding-right: 0px;" >
                    <div style="border: solid thin #aaa;padding: 10px; background-color: white;">
                        <form method="post">
                            <textarea name="quote" placeholder="What quote do you have in mind?"></textarea>
                            <input class="post_button" type="submit" value="Post">
                            <br>
                        </form>    
                    </div>
                <!-- posts -->    
                <div id="post_bar">
                    <?php

                        if($quote)
                        {
                        
                            foreach($quote as $ROW)
                            {
                                $user = new User();
                                $user_info = $user->getUser($ROW['user_id']);
                                include("quotes.php");
                            }
                        }
                        
                            
                        
                        


                    ?>


                    
                </div>    
            </div>
      </div>
    </div>
    
  </body>
</html>
