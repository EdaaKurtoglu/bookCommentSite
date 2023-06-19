
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

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $quotes = new Quotes();
        $id = $_SESSION['blog_user_id'];
        
        $result = $quotes->create_quote($id, $_POST);
        
        if($result == "")
        {
            header("Location: timeline.php");
            die;
        }else
        {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "<br>The following errors occured:<br><br>";
            echo $result;
           
            echo "</div>";
        }
    
    }
    


?>

<html>
    <head>
    
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>timeline</title>
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <!-- CSS -->
    <link rel="stylesheet" href="style.css" />
  </head>

    
    </head>
    <style type="text/css"> 
        

        #profile_pic{
            width: 150px;
            border-radius: 50%;
            border: solid 2px white;
        }

        #menu_buttons{
            width: 100px;
            display: inline-block;
            margin: 2px;


        }

        #list_img{
            width: 75px;
            float: left;
            margin: 8px;

        }

        #list_bar{
            min-height: 400px;
            margin-top: 20px;
            padding: 8px;
            text-align: center;
            font-size: 20px;
            color:#6633CC ;
        }

        #read_later{
            clear: both;
            font-size: 12px;
            font-weight: bold;
            color: #6633CC;

        }

        textarea{
            width: 100%;
            border: none;
            font-family: tahoma;
            font-size: 14px;
            height: 50px;

        }

        #post_button{
            float: right;
            background-color:#6633CC ;
            border:white ;
            padding: 4px;
            font-size: 14px;
            border-radius: 2px;
            width: 50px;
        }

        #post_bar{
            margin-top: 20px;
            background-color: white;
            padding: 10px;

        }

        #post{
            padding: 4px;
            font-size: 13px;
            display: flex;
            margin-bottom: 20px;
        }

    </style>



    <body style="background-color: linear-gradient(0deg, rgba(150,254,255,1) 0%, rgba(255,255,255,0.23573179271708689) 100%);">
        <!--top bar-->
        <?php
            include("bar.php");
        ?>
    <!--cover area-->
        <div style="width: 800px; margin: auto; min-height: 400px;">
           
<!-- below cover area-->
        <div style="display: flex;">

            <!--read later area-->
            <div style="min-height: 400px; flex: 1;">

                <div id="list_bar" style="margin-left: -100px;margin-top: -200px; position:relative;">
                    <img src='<?php echo $user_data['profile_image'] ?>' id="profile_pic"><br>
                    <a href="profile.php" style="text-decoration: none;">
                        <?php echo $user_data['username'] ?>
                    </a>
                    
                    
                </div>

            </div>

            <!--quotes area-->
                <div style="min-height: 400px;margin-top: -250px; flex:2.5; padding: 20px; padding-right: 0px; position: relative; " >
                    <div style="border: solid thick #aaa;padding: 0px;;">
                        <form method="post">
                            <textarea name="quote" placeholder="What quote do you have in mind?"></textarea>
                            <input class="post_button" type="submit" style="color: white; background-color: black;" value="Post">
                            <br>
                        </form>
                        <br>
                    </div>
                <!-- posts -->    
                <div id="post_bar">

                    <?php

                        $DB = new Database();
                        $user_class = new User();


                        $sql = "select * from quotes order by date desc";
                        $quote = $DB->read($sql);
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