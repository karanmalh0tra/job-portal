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
			$query = "SELECT admin_id, admin_name, admin_email, password,role, status FROM admin WHERE admin_email = '".$email."' AND status = 'Active' ";
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
			$oldPassword=$post['oldPassword'];
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
			$sName = $post['sname'];
			$mobile = $post['mobile'];
			$email = $post['email'];
			
				
			$query = "UPDATE admin SET admin_name = '$sName', admin_mobile='$mobile', admin_email='$email' where admin_id='".$adminId."'";
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
	function changeStatus($status, $adminId)
      {
      	$action;
      	$this->beginTransaction();
      	try{
      		$verifiedTime=time();
      
      		$query="update admin set status='$status' where admin_id='$adminId'";
      		$data=$this->ExecuteQuery($query,"update");
      		if(empty($data))
      		{
      			$action=0;
      		}
      		else{
      			$action=1;
      		}
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $action;
      
      }
	function addSubadmin($post)
	{
		$add=0;
		$this->beginTransaction();
		try {
	
			$sName = $post['sname'];
			$mobile = $post['mobile'];
			$email = $post['email'];
			$password = $post['password'];
			$role = $post['role'];
				
			$query = "INSERT INTO admin (admin_name, admin_mobile, admin_email, password,role) VALUES ('".$sName."', '".$mobile."','".$email."', '".$password."', '".$role."')";
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
	function viewSubadmin()
	{
		$data;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM admin";
			$data = $this->ExecuteQuery($query, "select");
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $data;
	
	
	}
	function getSubadmindetail($subadminId)
	{
		$subadmin;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM admin WHERE admin_id='".$subadminId."'";
			$data = $this->ExecuteQuery($query, "select");
			$subadmin = $data[0];
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $subadmin;
	}
	function updateSubadmin($post, $subadminId)
	{
		$edit=0;
		$this->beginTransaction();
		try
		{
			$sName = $post['sname'];
			$mobile = $post['mobile'];
			$email = $post['email'];
			$password = $post['password'];
			$role = $post['role'];
			$status = $post['status'];
			
				
			$query = "UPDATE admin SET admin_name = '$sName', admin_mobile='$mobile', admin_email='$email', password='$password', role='$role', status='$status' where admin_id='".$subadminId."'";
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
	 function addBanner($post)
      {
      	$add;
      	$this->beginTransaction();
      	try{
      		$bannerName=$post['bannerName'];
      		$image=$_FILES['image'];
			
      		$imagePath=$this->upLoadImage($image);
      		$query="insert into banner(banner_name,banner_image)
      				values('$bannerName','$imagePath')";
      		$data=$this->ExecuteQuery($query,"insert");
      		if(empty($data))
      		{
      			$add=0;
      		}
      		else{
      			$add=1;
      		}
      		$this->commitTransaction();
      		
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $add;
      }
	  function upLoadImage($image)
      {
      
      	$result=array();
      	$file_name=$image['name'];
      	$file_size=$image['size'];
      	$file_tmp=$image['tmp_name'];
      	$file_type=$image['type'];
      	$file_ext=strtolower(end(explode('.',$file_name)));
      	move_uploaded_file($file_tmp,"../images/".$file_name);
      	return ("images/".$file_name);
      
      	$extensions=array("jpeg","jpg","png");
      
      	if(in_array($file_ext, $extensions)== false)
      	{
      		$errors[]="extension not allowed, please choose JPEG or PNG file";
      		 
      	}
      	if($file_size > 2097152)
      	{
      		$errors[]='File size must be excately 2 MB';
      	}
      
      	if(empty($errors)==true)
      	{
      		move_uploaded_file($file_tmp,"../images/".$file_name);
      		return ("images/".$file_name);
      	}
      	else
      	{
      		return false;
      	}
      
      }
	   function viewBanner()
      {
      	$data;
      	$this->beginTransaction();
      	try{
      		$query="select * from banner";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data;
      	 
      }
	  function viewBannerById($bannerId)
      {
      	$data;
      	$this->beginTransaction();
      	try{
      		$query="select * from banner where banner_id='$bannerId'";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data[0];
      }
	   function editBanner($post,$bannerId)
      {
      	$edit;
      	$this->beginTransaction();
      	try{
      		$currentImage=$post['oldImage'];
      		$newImage=$_FILES['newImage'];
      		$title=$post['bannerName'];
      		
      		$imagePath = $currentImage;
      		
      		if(!empty($newImage['tmp_name']))
      		{
      			$imagePath=$this->upLoadImage($newImage);
      		}
      		$query="update banner set banner_name='$title',banner_image='$imagePath' where banner_id='$bannerId'";
      		$data=$this->ExecuteQuery($query,"update");
      		if(empty($data))
      		{
      			$edit=0;
      		}
      		else{
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
      		$query="select * from category";
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
      		$query="select * from category where category_id='$categoryId'";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data[0];
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
	function addSubCategory($post)
	{
		$add=0;
		$this->beginTransaction();
		try {
	
			$subCategoryName = $post['subCategoryName'];
			$categoryId = $post['categoryId'];
				
			$query = "INSERT INTO subcategory (	subcategory_name,category_id) VALUES ('".$subCategoryName."','".$categoryId."')";
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
	function viewSubCategory($start_from,$limit)
    {
      	$data;
      	$this->beginTransaction();
      	try{
      		//$query="select * from subcategory ORDER BY category_id";
			$query="SELECT * FROM subcategory ORDER BY category_id ASC LIMIT $start_from, $limit";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data;
      	 
    }
	function countSubCategoryRecord()
    {
      	$data;
      	$this->beginTransaction();
      	try{
      		$query="SELECT COUNT(subcategory_id) as cnt FROM subcategory";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data[0];
      	 
    }
	
	function viewSubCategoryById($subcategoryId)
    {
      	$data;
      	$this->beginTransaction();
      	try{
      		$query="select * from subcategory where subcategory_id='$subcategoryId'";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data[0];
    }
	function viewSubCategoryBymainCategoryId($categoryId)
    {
      	$data;
      	$this->beginTransaction();
      	try{
      		$query="select * from subcategory where category_id='$categoryId'";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data;
    }
	function updateSubCategory($post,$subcategoryId)
	{
		$edit=0;
		$this->beginTransaction();
		try
		{
			
			$subCategoryName = $post['subCategoryName'];
			$categoryId = $post['categoryId'];
			
				
			$query = "UPDATE subcategory SET subcategory_name = '$subCategoryName', category_id = '$categoryId' where subcategory_id='".$subcategoryId."'";
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
	function addPortfolio($post)
    {
      	$add;
      	$this->beginTransaction();
      	try{
      		$portfolioTitle=$post['portfolioTitle'];
			$keywordsTag=$post['keywordsTag'];
			$url=$post['url'];
			$description=$post['description'];
			$categoryId=$post['categoryId'];
			$sub_cat=$post['sub_cat'];
			$pdate=$post['pdate'];
		//	$tdate = $post['tdate'];
		//	$date = str_replace('/', '-', $tdate); 
            $formatedtdate = date('Y-m-d', strtotime($pdate));
			$workDescription=$post['workDescription'];
			$clientName=$post['clientName'];
			$clientTestimonial=$post['clientTestimonial'];
			$companyName=$post['companyName'];
			$companyDescription=$post['companyDescription'];
      	//	$image=$_FILES['image'];
			
      	//	$imagePath=$this->upLoadImage($image);
      		$query="insert into portfolio(portfolio_title,keyword_tags,category_id,subcategory_id, url, description, portfolio_date, work_description,client_name,client_testimonial,company_name,company_description)
      				values('$portfolioTitle','$keywordsTag','$categoryId','$sub_cat','$url','$description','$formatedtdate','$workDescription','$clientName','$clientTestimonial','$companyName','$companyDescription')";
      		$data=$this->ExecuteQuery($query,"insert");
      		if(empty($data))
      		{
      			$add=0;
      		}
      		else{
      			$add=1;
      		}
			$porfolioId=mysql_insert_id();
			foreach($_FILES['image']['tmp_name'] as $key => $tmp_name )
			{
				$file_name = $key.$_FILES['image']['name'][$key];
				$file_size =$_FILES['image']['size'][$key];
				$file_tmp =$_FILES['image']['tmp_name'][$key];
				$file_type=$_FILES['image']['type'][$key];
				$file_ext=strtolower(end(explode('.',$file_name)));
				move_uploaded_file($file_tmp,"../images/".$file_name);
				$image1=("images/".$file_name);
					
				$query1="INSERT INTO porfolio_images(image_path,porfolio_id) VALUES('$image1','$porfolioId')";
				$this->ExecuteQuery($query1,"insert");
					
			}
		/*	for($i=0;$i<count($_FILES["image"]["name"]);$i++)
					{			
						$file_name = $i.$_FILES['image']['name'][$i];
						$file_size =$_FILES['image']['size'][$i];
						$file_tmp =$_FILES['image']['tmp_name'][$i];
						$file_type=$_FILES['image']['type'][$i];
						$file_ext=strtolower(end(explode('.',$file_name)));
						move_uploaded_file($file_tmp,"../images/".$file_name);
						$galleryPath=("images/".$file_name);
							
						$query2="insert into porfolio_images(image_path,porfolio_id) values('$galleryPath', '$porfolioId')";
						$this->ExecuteQuery($query2,"insert");
							
					} */
      		$this->commitTransaction();
      		
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $add;
    }
	function viewPortfolio()
    {
      	$data;
      	$this->beginTransaction();
      	try{
      		$query="select * from portfolio";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data;
      	 
    }
	
	function viewPortfolioById($portfolioId)
    {
      	$data;
      	$this->beginTransaction();
      	try{
      		$query="select * from portfolio where portfolio_id='$portfolioId'";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data[0];
    }
	function editPortfolio($post,$portfolioId)
    {
      	$edit;
      	$this->beginTransaction();
      	try{
			
      		$portfolioTitle=$post['portfolioTitle'];
			$keywordsTag=$post['keywordsTag'];
			$url=$post['url'];
			$description=$post['description'];
			$categoryId=$post['categoryId'];
			
			
			if(!empty($post['sub_cat'])){
				$sub_cat=$post['sub_cat'];
				
			}else{
				$sub_cat=0;
			}
			$pdate=$post['pdate'];
		//	$tdate = $post['tdate'];
		//	$date = str_replace('/', '-', $tdate); 
            $formatedtdate = date('Y-m-d', strtotime($pdate));
			$workDescription=$post['workDescription'];
			$clientName=$post['clientName'];
			$clientTestimonial=$post['clientTestimonial'];
			$companyName=$post['companyName'];
			$companyDescription=$post['companyDescription'];
			
		//	$pdate=time();
			
      	/*	$currentImage=$post['oldImage'];
			$newImage=$_FILES['newImage'];
      		$imagePath = $currentImage;
      		
      		if(!empty($newImage['tmp_name']))
      		{
      			$imagePath=$this->upLoadImage($newImage);
      		}      */
      		$query="update portfolio set portfolio_title='$portfolioTitle' , keyword_tags='$keywordsTag',category_id='$categoryId',subcategory_id='$sub_cat',url='$url',description='$description',portfolio_date='$formatedtdate',	work_description='$workDescription',client_name='$clientName',	client_testimonial='$clientTestimonial',company_name='$companyName',company_description='$companyDescription' where portfolio_id='$portfolioId'";
      		$data=$this->ExecuteQuery($query,"update");
      		if(empty($data))
      		{
      			$edit=0;
      		}
      		else{
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
	function viewPortfolioImageByPortfolioId($porfolioId)
    {
      	$data;
      	$this->beginTransaction();
      	try{
      		$query="select * from porfolio_images where porfolio_id='$porfolioId'";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data;
    }
	function viewRandomImageByPortfolioId($porfolioId)
    {
      	$data;
      	$this->beginTransaction();
      	try{
      		$query="select * from porfolio_images where porfolio_id='$porfolioId' LIMIT 1";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data;
    }
	function viewPortfolioImageById($imageId)
    {
      	$data;
      	$this->beginTransaction();
      	try{
      		$query="select * from porfolio_images where image_id='$imageId'";
      		$data=$this->ExecuteQuery($query,"select");
      		$this->commitTransaction();
      	}
      	catch(Exception $e)
      	{
      		$this->rollbackTransaction();
      	}
      	return $data[0];
    }
	function updatePortfolioImage($post,$imageId)
	{
		$edit;
		$this->beginTransaction();
		try
		{
			    $oldImage=$post['oldImage'];
	 			$newImage=$_FILES['newImage'];
	 			$imagePathe=$oldImage;
	 			if(!empty($newImage['tmp_name']))
	 			{
	 				$imagePathe=$this->upLoadImage($newImage);
	 			}
	
			$sql = "update porfolio_images set image_path='$imagePathe' where image_id='$imageId'";
	
			$data=$this->ExecuteQuery($sql, "update");
			
      			$edit=1;
      		
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