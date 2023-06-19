<?php

class Signup
{
    private $error = "";

    public function evaluate($data)
    {
        foreach($data as $key => $value)
        {
            if(empty($value))
            {
                $this->error = $this->error . $key . "is empty!<br>";
            }
            if($key == "e_mail")
            {
                if (!preg_match("/([\w\-]+\@[\w\-]+[\w\-]+)/", $value))
                    {
                    $this->error = $this->error . "invalid email adress!<br>";
                    }
            }
            if($key == "username")
            {
                if (is_numeric($value))
                {
                    $this->error = $this->error . "username cant be a number!<br>";
                }
                if(strstr($value, " "))
                {
                    $this->error = $this->error . "username cant have spaces!<br>";
                }

            }
            
        }

        if($this->error == "")
        {
            $this->create_user($data);
            //no error
        }else
        {
            return $this->error;
           
        }

    }

    public function create_user($data)
    {

        $e_mail = $data['e_mail'];
        $username = ucfirst($data['username']);
        $password = $data['password'];
        $user_id = $this->create_user_id();
        $url = strtolower($username);
        $query = "insert into users (user_id,e_mail,username,password,url) 
        values ('$user_id','$e_mail','$username','$password', '$url')";
        $DB = new Database();
        $DB->save($query);
        $query = "insert into log (user_id,action) 
        values ('$user_id','register')";
        $DB = new Database();
        $DB->save($query);

    }

    private function create_user_id()
    {
        $length = rand(4, 19);
        $number = "";
        for($i=0; $i < $length ; $i++)
        {
            $new_rand = rand(0,9);
            $number = $number . $new_rand;
        }

        return $number;
    }
}