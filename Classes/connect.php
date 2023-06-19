<?php

class Database
{
    

//$con->close();

	private $host="127.0.0.2";
	private $user="root";

    private $port = 3307;
	private $password = "";
    private  $socket = "";
	private $dbname="book_site";

	function connect()
	{
		$connection = new mysqli($this->host, $this->user, $this->password, $this->dbname, $this->port, $this->socket)
        or die ('Could not connect to the database server' . mysqli_connect_error());
		return $connection;
	}


	function read($query)
	{

		$conn = $this->connect();

		$result = mysqli_query($conn,$query);
		if(!$result)
		{
			return false;
		}
		else
		{
			$data = false;
			while($row = mysqli_fetch_assoc($result) )
			{
				$data[] = $row;
			}
			return $data;
		}

	}

	function save($query)
	{
		$conn = $this->connect();
		$result = mysqli_query($conn,$query);
		if(!$result)
		{
			return false;
		}
		else
		{
			return true;
		}

	}


}




