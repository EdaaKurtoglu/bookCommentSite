<?php


    session_start();
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/quotes.php");

    $login = new Login();
    $user_data = $login->check_login($_SESSION['blog_user_id']);
   

        $sql = "select * from book order by likes desc limit 10";
        $DB = new Database();
        $result = $DB->read($sql);
    

?>
<!DOCTYPE html>
    <html>
    <head>
        <title></title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <!-- Font Awesome -->
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        />
        <!-- CSS -->
        <link rel="stylesheet" href="style.css" />
    </head>    

        <body style="font-family: tahoma; background-color: #d0d8e4;">
        <br>
        <?php
            include("bar.php");
        ?>

        <div style="width: 800px;margin: auto; min-height: 400px">
            <div style="display: flex;">
                <div style="min-height: 400px; flex: 2.5; padding: 20px; padding-right: 0px; margin-top: -270px;">
                    <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
                        <div class="title" style="font-size: 40x; font-weight: bold; text-align: center;"> MOST LIKED 10 BOOKS</div><br><br>
                        <?php
                           
                            if(is_array(($result)))
                            {         
                                foreach($result as $BOOK_ROW)
                                {
                                    
                                    
                                    include("user.php");
                                    echo "Likes:";
                                    echo $BOOK_ROW['likes'];
                                }
                            }else
                            {
                                 echo "No result were found!";
                            }


                        ?>
                    </div>

                </div>

            </div>
        </div>
            
        </body>


    </html>
