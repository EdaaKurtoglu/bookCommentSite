<?php

class Book
{
    private $error = "";
    
    public function getBookName($id)
    {
        $query = "select book_name from book where book_id=  $id " ;

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

    public function getSummary($id)
    {
        $query = "select summary from book where book_id=  $id " ;

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

    public function getAuthor($id)
    {
        $query = "select book_author from book where book_id=  $id " ;

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
    public function getPage($id)
    {
        $query = "select pages from book where book_id=  $id " ;

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
    public function getLanguage($id)
    {
        $query = "select book_lang from book where book_id=  $id " ;

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
    public function getTranslator($id)
    {
        $query = "select translator from book where book_id=  $id " ;

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
    public function getCategory($id)
    {
        $query = "select category_name  from category,book where category.category_id= book.category_id and book_id= '$id' " ;

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
    public function getLike($id)
    {
        $query = "select likes from book where book_id=  $id " ;

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

    public function like_book($id, $type, $blog_user_id)
    {

        
        if ($type == 'book') {

            $DB = new Database();
            //increment the book table
            $sql = "update book set likes = likes + 1 where book_id = '$id' limit 1";
            $DB->save($sql);

            //save likes details
            
            $sql = "select likes from likes where type='book' && contentid ='$id' limit 1";
            $result = $DB->read($sql);

            $sql = "insert into log (user_id,actions) values ('$blog_user_id', 'likes book $id')";
            $DB->save($sql);
            if(is_array($result))
            {

                $likes = json_decode($result[0]['like'],true);

                $user_ids = array_column($likes, "user_id");

                if(!in_array($blog_user_id, $user_ids))
                {
                    $arr["user_id"] = $blog_user_id;
                    $arr["date"] = date("Y-m-d H:i:s");

                    $likes[] = $arr;
                    $likes_string = json_encode($likes);
                    
                    $sql = "update likes set likes = '$likes_string' where type = 'book' && contentid = '$id' limit 1";
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
    public function getPhoto($id)
    {
        $query = "select photo from book where book_id=  $id " ;

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

    public function addList($id,$book_id)
    {
        $query = "insert into readlater (user_id,book_id) values ('$id','$book_id');";

        $DB = new Database();
        $DB->save($query);

        
    }
    
    public function create_comment($id,$data,$book_id)
    {
        if(!empty($data['comment']))
        {
            $comment = addslashes($data['comment']);
            $comment_id = $this->create_comment_id();
            $query = "insert into comments ( comment_id, user_id, book_id, comment) values ('$comment_id','$id','$book_id','$comment')";

            $DB = new Database();
             $DB->save($query);
            
        }else
        {
            $this->error = "Please type a quote!<br>";
        }
        return $this->error;
    }
    public function getComment($book_id)
    {
        $query = "select * from comments where book_id=  '$book_id' " ;

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
    private function create_comment_id()
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