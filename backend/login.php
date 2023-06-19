<?php

    session_start();
    include("classes/connect.php");
    include("classes/login.php");

    
    $e_mail = "";
    $password = ""; 

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $login = new Login();
        $result = $login->evaluate($_POST);
        
        if($result != "")
        {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "<br>The following errors occured:<br><br>";
            echo $result;
           
            echo "</div>";
            
        }
        else
        {
            header("Location: profile.php");
            die;
        }
       
        $e_mail = $_POST['e_mail'];
        $password = $_POST['password'];  
        

    }

   
    
?>

<!DOCTYPE html>
<html>
    <head>

            <title>Login </title>
        
            <script src="https://kit.fontawesome.com/151d3eeddb.js" crossorigin="anonymous"></script>
            <style>


                *{
                    margin: 0;
                    padding: 0;
                    font-family: 'Poppins', sans-serif;
                    box-sizing: border-box;

                }
                #background
                {
                    height: 100vh; 
                    width: 100%;
                    background-position: center;
                    background-size: cover;
                    position:relative;
                    

                }
                #button_field
                {
                    width: 100%;
                    display: flex;
                    justify-content: space-between;
                }
                #signinBtn
                {
                    flex-basis: 48%;
                    margin-left: 100px;
                    background: #3c00a0;
                    color: #fff;
                    height: 40px;
                    border-radius: 20px;
                    border: 0;
                    outline: 0;
                    cursor: pointer;
                    transition: background 1s;
                   
                }
               
                #bar
                {
                    width: 90%;
                    max-width: 450px;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    background: #fff;
                    padding: 50px 30px 70px;
                    text-align: center;
                }
                #title
                {
                    font-size: 40px;
                    margin-bottom: 50px;
                    color: #3c00a0 ;
                    position: relative;
                    
                }
              
                #text
                {
                    height: 40px;
                    width: 300px;
                    border-radius: 4px;
                    border: solid 1px #888;
                }
                
            </style>
    
    </head>
    <body style = "font-family= tahoma";>
        
        
        <div id="bar"> 
            <div id="title">Login</div>    
            <form method="post"; action="login.php">
                    <div class="input-group">
                    
                        <div class="input-field">
                            <i class="fa-solid fa-envelope"></i>
                            <input value="<?php echo $e_mail ?>" name="e_mail"; id="text" type="email" placeholder="e-mail"><br><br>

                        </div>
                        <div class="input-field">
                            <i class="fa-solid fa-lock"></i>
                            <input value="<?php echo $password ?>" name="password"; id="text" type="password" placeholder="Password"><br><br>
                            
                        </div>
                        
                        <p style="font-size: 12px;">For Register <a href="sign.php">Click Here!</a></p><br><br>

                    </div>
                    <div id="button_field">
                        <input type="submit" id="signinBtn" value="Sign in" > </input>
                        
                    </div>
                </form>
            
        </div>
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.backstretch.min.js"></script>
        <script src="js/templatemo-script.js"></script>
        
    </body>
</html>