<?php

class MySql
{
	var $conn;
	function MySql()
	{
		
		//server database
		$host="localhost"; // Host name 
		$username="root"; // Mysql username 
		$password=""; // Mysql password 
		$db_name="rejoinher"; // Database name 
		//localhost
		/*$host="localhost";
		$username="root";
		$password="";
		$db_name="mcacareer";*/
		if(!$this->conn)
		{
			$this->conn=mysql_connect("$host", "$username", "$password")or die("cannot connect to server"); 
			mysql_select_db("$db_name")or die("cannot select DB");
			return true;
		}
	}
	function ExecuteQuery($Query, $Qrytype){
		if(!empty($Query) && !empty($Qrytype))
		{
			switch(strtolower($Qrytype)){
				case "select":
					$Result = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
					if($Result)
					{	
						$ResultSet = array();
						
						while($ResultSet1 = mysql_fetch_array($Result))
							$ResultSet[] =$ResultSet1;
						mysql_free_result($Result);
						return $ResultSet;
						
						
					}
					else return false;
					break;
				case "update":
					$Result = mysql_query($Query) or die("Error in Updation Query <br> ".$Query."<br>". mysql_error());
					if($Result)
					{
						$AffectedNums = mysql_affected_rows();
						return $AffectedNums;
					}
					else return false;
					break;
				case "insert":
					$Result = mysql_query($Query) or die("Error in Insertion Query <br> ".$Query."<br>". mysql_error());
					if($Result)
					{
						$LastInsertedRow = mysql_insert_id();
						return $LastInsertedRow;
					}
					else return false;
					break;
				case "delete":
					$Result = mysql_query($Query) or die("Error in Deletion Query <br> ".$Query."<br>". mysql_error());
					if($Result)
						return true;
					else
						return false;
					break;
				case "selectassoc":
					$Result = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
					if($Result)
					{	
						$ResultSet = array();
						
						while($ResultSet1 = mysql_fetch_assoc($Result))
							$ResultSet[] =$ResultSet1;
						mysql_free_result($Result);
						return $ResultSet;
						
						
					}
					else return false;
					break;
				case "selectrow":
					$Result = mysql_query($Query) or die("Error in Selection Query <br> ".$Query."<br>". mysql_error());
					if($Result)
					{	
						$ResultSet = array();
						
						while($ResultSet1 = mysql_fetch_row($Result))
							$ResultSet[] =$ResultSet1;
						mysql_free_result($Result);
						return $ResultSet;
						
						
					}
					else return false;
					break;

				case "norows":
					$Result = mysql_query($Query) or die("Error in num rows Query <br> ".$Query."<br>". mysql_error());
					if($Result)  {	
					   
					   $ResultSet = mysql_num_rows($Result);
					   return $ResultSet;
					}
					else return false;
					
					break;
					
			}
		}
	}
	function beginTransaction(){
		mysql_query("BEGIN");
	}
	
	function commitTransaction(){
		mysql_query("COMMIT");
	}
	
	function rollbackTransaction(){
		mysql_query("ROLLBACK");
	}
	
	function uuid()
	{
		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}
}


?>