<?php

 $host="127.0.0.2";
 $user="root";

 $port = 3307;
 $password = "";
 $socket = "";
 $dbname="book_site";

$conn = mysqli_connect($host,$user,$password,$dbname,$port,$socket);

if(!$conn) {
    die("Connection Failed:".mysqli_connect_error());
}

?>