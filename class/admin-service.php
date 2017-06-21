<?php
require_once 'class.mysql.php';
class AdminService extends MySql
{
	function AdminService()
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
	function changeStatus($adminId)
	{
		$edit;
		$this->beginTransaction();
		try
		{
			$admin= $this->getAdminById($adminId);
			if($admin['status'] =='Active'){
				$sql = "update admin set status='In-Active' where admin_id='$adminId'";
				$this->ExecuteQuery($sql, "update");
				$edit="In-Active";
			}else if($admin['status'] =='In-Active'){
			
			$sql = "update admin set status='Active' where admin_id='$adminId'";
			$this->ExecuteQuery($sql, "update");
			$edit="Active";
			}
		$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $edit;
	}
	function addAdmin($post)
	{
		$add=0;
		$this->beginTransaction();
		try {
	
			$name = $post['name'];
			$mobile = $post['mobile'];
			$email = $post['emailId'];
			$password = $post['password'];
			$role = $post['role'];
				
			$query = "INSERT INTO admin (admin_name, admin_mobile, admin_email, password,role) VALUES ('".$name."', '".$mobile."','".$email."', '".$password."', '".$role."')";
			$this->ExecuteQuery($query, "insert");
	
			if(empty($query)){
					
				$add=0;
			}else{
					
				$add=1;
			}
	
			$this->commitTransaction();
	
		} catch (Exception $e) {
	
			$this->rollbackTransaction();
		}
	
		return $add;
	}
	function viewAdmin()
	{
		$data;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM admin where archive='n'";
			$data = $this->ExecuteQuery($query, "select");
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $data;
	
	
	}
	function getAdminById($adminId)
	{
		$admin;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM admin WHERE admin_id='".$adminId."' and archive='n'";
			$data = $this->ExecuteQuery($query, "select");
			$admin = $data[0];
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $admin;
	}
	function updateAdmin($post, $adminId)
	{
		$edit=0;
		$this->beginTransaction();
		try
		{
			$name = $post['name'];
			$mobile = $post['mobile'];
			$email = $post['emailId'];
			$password = $post['password'];
			$role = $post['role'];
			
			//INSERT INTO admin (admin_name, admin_mobile, admin_email, password,role)	
			$query = "UPDATE admin SET admin_name = '$name', admin_mobile='$mobile', admin_email='$email', password='$password', role='$role' where admin_id='".$adminId."'";
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
	function deleteAdmin($adminId)
	{
		$delete =0;
		$this->beginTransaction();
		try
		{
			$query = "UPDATE admin set archive = 'y' WHERE admin_id='".$adminId."'";
			$data = $this->ExecuteQuery($query, "update");
			if(!empty($data)){
				$delete = 1;
			}
			
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $delete;
	}
	function addCategory($post)
	{
		$add=0;
		$this->beginTransaction();
		try {
	
			$categoryName = $post['categoryName'];
			
			$query = "INSERT INTO category (category_name) VALUES ('".$categoryName."')";
			$this->ExecuteQuery($query, "insert");
	
			if(empty($query)){
					
				$add=0;
			}else{
					
				$add=1;
			}
	
			$this->commitTransaction();
	
		} catch (Exception $e) {
	
			$this->rollbackTransaction();
		}
	
		return $add;
	}
	function viewCategory()
    {
      	$data;
      	$this->beginTransaction();
      	try{
      		$query="select * from category where archive='n'";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data;
      	 
    }
	function viewCategoryById($categoryId)
    {
      	$data;
      	$this->beginTransaction();
      	try{
      		$query="select * from category where category_id='$categoryId' and archive='n'";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data[0];
    }
	function changeCategoryStatus($categoryId)
	{
		$edit;
		$this->beginTransaction();
		try
		{
			$category= $this->viewCategoryById($categoryId);
			if($category['status'] =='Active'){
				$sql = "update category set status='In-Active' where category_id='$categoryId'";
				$this->ExecuteQuery($sql, "update");
				$edit="In-Active";
			}else if($category['status'] =='In-Active'){
			
			$sql = "update category set status='Active' where category_id='$categoryId'";
			$this->ExecuteQuery($sql, "update");
			$edit="Active";
			}
		$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $edit;
	}
	function updateCategory($post, $categoryId)
	{
		$edit=0;
		$this->beginTransaction();
		try
		{
			
			$categoryName = $post['categoryName'];	
			$query = "UPDATE category SET category_name = '$categoryName' where category_id='".$categoryId."'";
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
	function deleteCategory($categoryId)
	{
		$delete =0;
		$this->beginTransaction();
		try
		{
			$query = "UPDATE category set archive = 'y' WHERE category_id='".$categoryId."'";
			$data = $this->ExecuteQuery($query, "update");
			if(!empty($data)){
				$delete = 1;
			}
			
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $delete;
	}
	function addSubCategory($post)
	{
		$add=0;
		$this->beginTransaction();
		try {
	
			$subCategoryName = $post['subCategoryName'];
			$categoryId = $post['categoryId'];
				
			$query = "INSERT INTO  sub_category (sub_category_name,category_id) VALUES ('".$subCategoryName."','".$categoryId."')";
			$this->ExecuteQuery($query, "insert");

			if(empty($query)){
					
				$add=0;
			}else{
					
				$add=1;
			}
	
			$this->commitTransaction();
	
		} catch (Exception $e) {
	
			$this->rollbackTransaction();
		}
	
		return $add;
	}
	function viewSubCategory()
    {
      	$data;
      	$this->beginTransaction();
      	try{
      		$query="select * from sub_category where archive='n'";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data;
      	 
    }
	function viewSubCategoryById($subcategoryId)
    {
      	$data;
      	$this->beginTransaction();
      	try{
      		$query="select * from sub_category where sub_category_id='$subcategoryId'";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data[0];
    }
	function changeSubCategoryStatus($subcategoryId)
	{
		$edit;
		$this->beginTransaction();
		try
		{
			$subcategory= $this->viewSubCategoryById($subcategoryId);
			if($subcategory['status'] =='Active'){
				$sql = "update sub_category set status='In-Active' where sub_category_id='$subcategoryId'";
				$this->ExecuteQuery($sql, "update");
				$edit="In-Active";
			}else if($subcategory['status'] =='In-Active'){
			
			$sql = "update sub_category set status='Active' where sub_category_id='$subcategoryId'";
			$this->ExecuteQuery($sql, "update");
			$edit="Active";
			}
		$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $edit;
	}
	function deleteSubCategory($subcategoryId)
	{
		$delete =0;
		$this->beginTransaction();
		try
		{
			$query = "UPDATE sub_category set archive = 'y' WHERE sub_category_id='".$subcategoryId."'";
			$data = $this->ExecuteQuery($query, "update");
			if(!empty($data)){
				$delete = 1;
			}
			
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $delete;
	}
	function updateSubCategory($post, $subcategoryId)
	{
		$edit=0;
		$this->beginTransaction();
		try
		{
			
			$subCategoryName = $post['subCategoryName'];
			$categoryId = $post['categoryId'];
			
			$query = "UPDATE sub_category SET sub_category_name = '$subCategoryName', category_id = '$categoryId' where sub_category_id='".$subcategoryId."'";
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
	
}	

?>