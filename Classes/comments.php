<?php

    Class Comment
    {
        private $error="";
        public function create_comment($id,$data)
    {
        if(!empty($data['comment']))
        {
            $comment = addslashes($data['comment']);
            $comment_id = $this->create_comment_id();
            $query = "insert into comments (user_id,comment_id,book_id,comment) values ('$id','$comment_id','0' '$comment')";

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
        $query = "select comment from book where book_id=  $book_id " ;

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