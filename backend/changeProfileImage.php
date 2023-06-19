
<?php

    session_start();

    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/quotes.php");



    $login = new Login();
    $user_data = $login->check_login($_SESSION['blog_user_id']);

    if ($_SERVER['REQUEST_METHOD'] == "POST") 
    {


        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
        {
            $filename = "uploads/" . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], $filename);
        
            if(file_exists($filename))
            {
                $user_id = $user_data['user_id'];
                $query = "update users set profile_image = '$filename' where user_id = '$user_id ' limit 1 ";
                $DB = new Database();
                $DB->save($query);

                header(("Location: profile.php"));
                die;
            }

        }else 
        {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "<br>The following errors occured:<br><br>";
            echo "Please  add a valid image!";
           
            echo "</div>";
        }
        
    }
?>

<html>
    <head>
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
        <div class="bar">
            <div style="width: 800px;margin:auto;font-size: 30px;"> 
                Phoenix &nbsp &nbsp <input type="text" class="search_box" placeholder="Search for books">
                <img src="img/selfie.jpg "style="width: 50px; float: right;">
                <a href="logout.php">
                <span style="font-size: 11px; float: right; margin: 10px; color:white;">Logout</span>
                </a>
            </div>

        </div>
    <!--cover area-->
        <div style="width: 800px; margin: auto; min-height: 400px;">
           
<!-- below cover area-->
        <div style="display: flex;">

            

            <!--quotes area-->
                <div style="min-height: 400px; flex:2.5; padding: 20px; padding-right: 0px;" >
                    <form method="post" enctype="multipart/form-data">
                        <div style="border: solid thin #aaa;padding: 10px; background-color: white;">
                        
                            <input type="file" name="file"><br> 
                            
                            <input id="post_button" type="submit" value="Change">
                            <br>
                        </div>
                    <form>
                </div>
            
            </div>
            
        </div>
    

    </body>
</html>    