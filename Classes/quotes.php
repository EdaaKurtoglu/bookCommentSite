<?php

class Quotes
{
    private $error = "";
    public function create_quote($id,$data)
    {
        if(!empty($data['quote']))
        {
            $quote = addslashes($data['quote']);
            $quote_id = $this->create_quote_id();
            $query = "insert into quotes (user_id,quote_id,quote) values ('$id','$quote_id', '$quote')";

            $DB = new Database();
            $DB->save($query);
            
        }else
        {
            $this->error = "Please type a quote!<br>";
        }
        return $this->error;
    }


    public function getQuote($id)
    {
        $query = "select * from  quotes where user_id= '$id' order by date desc limit 10" ;

        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            return $result;
        }else
        {
            return false;
        }
    }
    public function like_quote($id, $type, $blog_user_id)
    {
        if ($type == 'quote') {

            $DB = new Database();
            //increment the quote table
            $sql = "update quotes set likes = likes + 1 where quote_id = '$id' limit 1";
            $DB->save($sql);

            //save likes details
            
            $sql = "select likes from likes where type='quote' && contentid ='$id' limit 1";
            $result = $DB->read($sql);

            $sql = "insert into log (user_id,actions) values ('$blog_user_id', 'likes quote $id')";
            $DB->save($sql);

            if(is_array($result))
            {

                $likes = json_decode($result[0]['likes'],true);

                $user_ids = array_column($likes, "user_id");

                if(!in_array($blog_user_id, $user_ids))
                {
                    $arr["user_id"] = $blog_user_id;
                    $arr["date"] = date("Y-m-d H:i:s");

                    $likes[] = $arr;
                    $likes_string = json_encode($likes);
                    
                    $sql = "update likes set likes = '$likes_string' where type = 'quote' && contentid = '$id' limit 1";
                    $result = $DB->save($sql);
                }
                
           

            }else
            {
                $arr["user_id"] = $blog_user_id;
                $arr["date"] = date("Y-m-d H:i:s");

                $arr2[] = $arr;

                $likes = json_encode($arr2);

                $sql = "insert into likes (type,contentid,likes) values ('$type','$id','$likes') ";
                $result = $DB->save($sql);
            }

        }
    }
    private function create_quote_id()
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