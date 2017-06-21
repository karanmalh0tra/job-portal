<?php
require_once 'class.mysql.php';
class UserService extends MySql
{
	function UserService()
	{
		$this->MySql();
	}
    function authenticateAdmin($email, $password)
	{
		$authenticated = false;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM admin WHERE admin_email = '".$email."' AND status = 'Active' ";
			$data = $this->ExecuteQuery($query, "select");
				
			if(!isset($data) || count($data)==0)
			{
				$authenticated = false;
			}
			else if($password == $data[0]['password'])
			{
	
				if(!isset($_SESSION))
				{
					session_start();
					$_SESSION['admin_id'] = $data[0]['admin_id'];
					$_SESSION['admin_email'] = $data[0]['admin_email'];
					$_SESSION['admin_name'] = $data[0]['admin_name'];
					$_SESSION['role'] = $data[0]['role'];
					
				}
				$authenticated = true;
			}
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $authenticated;
	}
	function changePassword($adminId,$post)
	{
		$password=0;
		$this->beginTransaction();
		try{
			$oldPassword=$post['OldPassword'];
			$newPassword=$post['newPassword'];
			$sql="select * from admin where admin_id='$adminId'";
			$data=$this->ExecuteQuery($sql,"select");
			if($data[0]['password']==$oldPassword){
				$query="update admin set password='$newPassword' where admin_id='$adminId'";
				$this->ExecuteQuery($query, "update");
				$password=1;
			}
			else{
				$password=0;
			}
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $password;
	}
	function updateProfile($post, $adminId)
	{
		$edit=0;
		$this->beginTransaction();
		try
		{
			$name = $post['name'];
			$mobile = $post['mobile'];
			$email = $post['emailId'];
			
				
			$query = "UPDATE admin SET admin_name = '$name', admin_mobile='$mobile', admin_email='$email' where admin_id='".$adminId."'";
			$this->ExecuteQuery($query, "update");
				
			if(empty($query)){
					
				$edit=0;
			}else{
					
				$edit=1;
			}
				
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
	
		return $edit;
	}
	
	function newUser($post)
	{
		$add=0;
		$this->beginTransaction();
		try {
	
			$userName = $post['userName'];
			$emailId = $post['emailId'];
			$register_on = time();
		    $password = md5(rand(1000000000,9999999999));
					
	     	//$cust_NewPassword=sha1($newPassword);
				
			$query = "INSERT INTO user (fullname, email, password, register_on) VALUES ('".$userName."', '".$emailId."','".$password."', '".$register_on."')";
			$this->ExecuteQuery($query, "insert");
	
			if(empty($query)){
					
				$add=0;
			}else{
					
					$to = $emailId;
					$subject = "Paperclyp - Registration Sucessfull";
				//	$htmlContent = file_get_contents("../images/logo.png");
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					
					$message = '<html><body>';
					
					$message .= '<h4 style="color:#00000;">Hi Dear,</h4>';   
					$message .= '<p style="color:#00000;"><h4>Your Username: '.$emailId.'</h4></p><br>';
					$message .= '<p style="color:#00000;"><h4>Your Password: '.$password.'</h4></p><br>';
					$message .= '<p style="color:#00000;"><h4>Click on bellow link to Access Your Account.</h4></p><br>';	
					$message .= "http://10dumbs.com/paperclyp/user-register.php?hash=".$password."&email=".$to;
					$message .= '<table><tr><td><h4 style="color:#00000;"><br><b>Thanks & Regards,<br>
									 www.paperclyp.com</b></h4></td><td><a href="http://10dumbs.com/paperclyp/"><img src="http://10dumbs.com/paperclyp/images/logo-final.png" style="width:200px;" alt=""/></a></td></tr></table>'; 
									 
					$message .= '</body></html>';
				//	$headers = "From:noreply@10dumbs.com";
					$headers .= 'From: Paper Clyp <noreply@paperclyp.com>';
					mail($to,$subject,$message,$headers);
					if(mail){
						$add=1;
					}else{
						$add=-1;
					}
					
			}
	
			$this->commitTransaction();
	
		} catch (Exception $e) {
	
			$this->rollbackTransaction();
		}
	
		return $add;
	}
	
	
	
}	

?>