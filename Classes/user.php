<?php
class User
{
    public function get_data($id)
    {

        $query = "select * from users where user_id = '$id' limit 1 ";
        $DB = new Database();
        $result = $DB->read($query);
        if($result)
        {

            $row = $result[0];
            return $row;
        }else
        {
            return false;
        }



    }

   public function getUser($id)
   {
        $query = "select * from users where user_id = '$id' limit 1";
        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            return $result[0];
        }else
        {
            return false;
        }
   }

   public function getList($id)
   {
        $query = "select*from readlater as r
        inner join book as b on r.book_id = b.book_id
         where user_id='$id' ";
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


   

}