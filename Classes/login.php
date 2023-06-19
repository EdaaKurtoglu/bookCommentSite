<?php

class Login
{
    private $error = "";

    


    public function evaluate($data)
    {

        $e_mail =addslashes($data['e_mail']) ;
         
        $password = addslashes($data['password']);


        $query = "select * from users where e_mail = '$e_mail' limit 1 ";

        
        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            $row = $result[0];
            if($password == $row['password'])
            {
                $log_id = $row['user_id'];
                $query = "insert into log (user_id,actions) 
                values ('$log_id','login')";
                
                $DB->save($query);
                //create a session data
                $_SESSION['blog_user_id'] = $row['user_id'];
            }else
            {
                $this->error .= "wrong password<br>";
            }
        } else {
            $this->error .= "No such email was found<br>";
        }
        return $this->error;

    }

    public function check_login($id)
    {
         if( is_numeric($id))
        {
            $query = "select * from users where user_id= '$id' limit 1 ";
            
        
            
            $DB = new Database();
            $result = $DB->read($query);

            if ($result) 
            {
                $user_data = $result[0];
                
                return $user_data;
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
    }

   
}