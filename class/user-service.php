<?php
require_once 'class.mysql.php';
class UserService extends MySql
{
	function UserService()
	{
		$this->MySql();
	}


	function authenticateUser($email, $password)
	{
		$authenticated = false;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM users WHERE user_email = '".$email."' ";
			$data = $this->ExecuteQuery($query, "select");

			if(!isset($data) || count($data)==0)
			{
				$authenticated = false;
			}
			else if(sha1($password) == $data[0]['user_password'])
			{

				if(!isset($_SESSION))
				{
					session_start();
					$_SESSION['user_id'] = $data[0]['user_id'];
					$_SESSION['user_email'] = $data[0]['user_email'];
					$_SESSION['user_name'] = $data[0]['user_name'];

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
	//view User Profile
	function viewUser($userId)
	{
		$view;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM users WHERE user_id='".$userId."'";
			$data = $this->ExecuteQuery($query, "select");
			$view = $data[0];
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $view;
	}

	function searchUser($userName)
	{
		$view;
		$this->beginTransaction();
		try
		{
			$query="SELECT * FROM users WHERE user_name LIKE '%$userName%'";
			$view = $this->ExecuteQuery($query, "select");
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $view;
	}


	//view Projects
	function viewProject($userId)
	{
		$projects;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM projects WHERE user_id='".$userId."'";
			$data = $this->ExecuteQuery($query, "select");
			$projects = $data;
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $projects;
	}

	function addProject($post,$userId)
	{
		$data;
		$this->beginTransaction();
		try {
			$project_client = $post['project_client'];
			$project_title = $post['project_title'];
			$project_location = $post['project_location'];
			$project_role_description = $post['project_role_description'];
			$project_details = $post['project_details'];
			$project_skills_used = $post["project_skills_used"];
			$query = "INSERT INTO projects (project_client, project_title, project_location, project_role_description, project_details, project_skills_used)
			VALUES
			('".$project_client."','".$project_title."','".$project_location."', '".$project_role_description."', '".$project_details."', '".$project_skills_used."')";

			$data = $this->ExecuteQuery($query,"insert");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();

		}
		return $data;
	}


	function viewIndustry()
	{
		$this->beginTransaction();
		try {
			$query = "SELECT * FROM industry";
			$data = $this->ExecuteQuery($query,"select");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function viewFunctionalArea()
	{
		$this->beginTransaction();
		try {
			$query = "SELECT * FROM functionalarea";
			$data = $this->ExecuteQuery($query,"select");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function viewRole($functionalId)
	{
		$data;
		$this->beginTransaction();
		try {

			$query="SELECT * FROM role WHERE functionalarea_id = '".$functionalId."'";
			$data = $this->ExecuteQuery($query,"select");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function viewRoleByFunctionalAreaId($functionalAreaId)
	{
		$data;
		$this->beginTransaction();
		try {
			$query="select * from role where functionalarea_id= '".$functionalAreaId."'";
			$data = $this->ExecuteQuery($query,"select");
			$this->commitTransaction();
		} catch(Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function updateUser($post,$userId)
	{
		$data;
		$this->beginTransaction();
		try {
			$oldimage = $post['oldimage'];
			$newimage=$_FILES['newimage'];
			$imagePath=$oldimage;
			if(!empty($newimage['tmp_name']))
			{
				$imagePath=$this->upLoadImage($newimage);
			}
			$oldresumefile=$post['oldresumefile'];
			$newresumefile=$_FILES['newresumefile'];
			$resumePath=$oldresumefile;
			if(!empty($newresumefile['tmp_name']))
			{
				$resumePath=$this->upLoadResume($newresumefile);
			}
			$user_name = $post['name'];
			$date_of_birth =  $post['date_of_birth'];
			$resume_headline =  mysql_real_escape_string($post['resume_headline']);
			$user_experience = $post['experience'];
			$user_mobile = $post['mobile'];
			$user_gender = $post['gender'];
			$user_location = mysql_real_escape_string($post['location']);
			$industry_id = $post['industry'];
			$functionalarea_id = $post['functionalarea'];
			$user_key_skills = mysql_real_escape_string($post['user_key_skills']);
			//$role_id= $post['role'];
			//role_id='$role_id'
			$address = mysql_real_escape_string($post['address']);
			$hometown = mysql_real_escape_string($post['hometown']);
			$pincode = $post['pincode'];
			$marital_status = $post['maritalStatus'];
			$query="update users set user_name='$user_name', date_of_birth='$date_of_birth', user_experience='$user_experience', resume_headline='$resume_headline', user_mobile='$user_mobile', user_gender='$user_gender',
			user_location='$user_location', industry_id='$industry_id', functionalarea_id='$functionalarea_id',
			address='$address', hometown='$hometown', pincode='$pincode', marital_status='$marital_status', imagepath='$imagePath', resumepath='$resumePath', user_key_skills='$user_key_skills'
			where user_id='".$userId."'";
			$data = $this->ExecuteQuery($query,"update");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function updateEducation($post,$userId)
	{
		$data;
		$this->beginTransaction();
		try {
			$graduation_id = $post['graduation'];
			$specialization_id = $post['specialization'];
			$university_name = $post['university'];
			$university_year = $post['graduationyear'];
			$grading_system - $post['gradingsystem'];
			$universty_marks = $post['universitymarks'];
			$x_board = $post['xboard'];
			$x_year = $post['xyear'];
			$x_marks = $post['xmarks'];
			$xii_board = $post['xiiboard'];
			$xii_year = $post['xiiyear'];
			$xii_marks = $post['xiimarks'];
			$query = "SELECT * from education where user_id='".$userId."'";
			$data=$this->ExecuteQuery($query,"select");
			if(empty($data)){
				$query="INSERT INTO education (graduation_id, specialization_id, university_name, university_year, grading_system, universty_marks, x_board, x_year, x_marks, xii_board, xii_year, xii_marks, user_id)
				VALUES
				('".$graduation_id."','".$specialization_id."','".$university_name."', '".$university_year."', '".$grading_system."', '".$universty_marks."','".$x_board."', '".$x_year."', '".$x_marks."', '".$xii_board."', '".$xii_year."', '".$xii_marks."', '".$userId."')";
				$data = $this->ExecuteQuery($query,"insert");
			}
			else {
				$query="update education set graduation_id='$graduation_id', specialization_id='$specialization_id', university_name='$university_name',
				university_year='$university_year', grading_system='$grading_system', universty_marks='$universty_marks',
				x_board='$x_board', x_year='$x_year', x_marks='$x_marks', xii_board='$xii_board', xii_year='$xii_year', xii_marks='$xii_marks'
				where user_id='".$userId."'";
				$data = $this->ExecuteQuery($query,"update");
			}
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function viewEducation($userId)
	{
		$view;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM education WHERE user_id='".$userId."'";
			$data = $this->ExecuteQuery($query, "select");
			if(!empty($data)){
				$view = $data[0];
				$this->commitTransaction();
				return $view;
			}
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
	}

	function updateEmployerDesignation($post,$userId)
	{
		$data;
		$this->beginTransaction();
		try {
			$employer_name = $post['employer_name'];
			$start_date = $post['startdate'];
			$end_date = $post['enddate'];
			$user_designation = $post['user_designation'];
			$job_profile = $post['job_profile'];
			$query = "SELECT * from users_employers where user_id='".$userId."'";
			$data=$this->ExecuteQuery($query,"select");
			if(empty($data)){
				$query="INSERT INTO users_employers (employer_name, start_date, end_date, user_designation, job_profile, user_id)
				VALUES
				('".$employer_name."','".$start_date."', '".$end_date."', '".$user_designation."', '".$job_profile."', '".$userId."')";
				$data = $this->ExecuteQuery($query,"insert");
			}
			else {
				$query="update users_employers set employer_name='$employer_name', start_date='$start_date', end_date='$end_date', user_designation='$user_designation',
				job_profile='$job_profile'
				where user_id='".$userId."'";
				$data = $this->ExecuteQuery($query,"update");
			}
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function viewEmployerDesignation($userId)
	{
		$view;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM users_employers WHERE user_id='".$userId."'";
			$data = $this->ExecuteQuery($query, "select");
			if(!empty($data)){
				$view = $data[0];
				$this->commitTransaction();
				return $view;
			}


		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}

	}

	function upLoadImage($image)
	{

		$result=array();
		$file_name=$image['name'];
		$file_size=$image['size'];
		$file_tmp=$image['tmp_name'];
		$file_type=$image['type'];
		$file_ext=strtolower(end(explode('.',$file_name)));
		move_uploaded_file($file_tmp,"../images/userprofileimages/".$file_name);
		return ("images/userprofileimages/".$file_name);

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
			move_uploaded_file($file_tmp,"../images/userprofileimages/".$file_name);
			return ("images/userprofileimages/".$file_name);
		}
		else
		{
			return false;
		}

	}

	function upLoadResume($resumefile)
	{

		$result=array();
		$file_name=$resumefile['name'];
		$file_size=$resumefile['size'];
		$file_tmp=$resumefile['tmp_name'];
		$file_type=$resumefile['type'];
		$file_ext=strtolower(end(explode('.',$file_name)));
		move_uploaded_file($file_tmp,"../resumes/".$file_name);
		return ("resumes/".$file_name);

		$extensions=array("doc","docx","pdf");

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
			move_uploaded_file($file_tmp,"../resumes/".$file_name);
			return ("resumes/".$file_name);
		}
		else
		{
			return false;
		}

	}

	function updateSummary($post,$userId)
	{
		$update_summary;
		$this->beginTransaction();
		try
		{
			$profile_summary=mysql_real_escape_string($post['profile_summary']);
			$query = "update users set profile_summary='$profile_summary' WHERE user_id='".$userId."'";
			$update_summary = $this->ExecuteQuery($query, "select");
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $update_summary;
	}

	/* function uploadPhoto($file)
	{
	$data;
	$this->beginTransaction();
	try {
	$query = "INSERT INTO file (path) VALUES ('" . mysqli_real_escape_string($path) . "')";
	$data = $this->ExecuteQuery($query,"insert");
	$this->commitTransaction();
} catch(Exception $e) {
$this->rollbackTransaction();
}
} */
function changePassword($post,$userId)
{
	$password=0;
	$this->beginTransaction();
	try{
		$oldPassword=sha1($post['oldPassword']);
		$newPassword=sha1($post['newPassword']);
		$sql="select * from users where user_id='$userId'";
		$data=$this->ExecuteQuery($sql,"select");
		if($data[0]['user_password']==$oldPassword){
			$query="update users set user_password='$newPassword' where user_id='$userId'";
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
//SIGNUP.PHP used
function newUser($post)
{
	$add=0;
	$this->beginTransaction();
	try {

		$user_name = $post['name'];
		$user_email = $post['email'];
		$user_password = sha1($post['pass']);
		$user_gender = $post['gender'];
		$user_location = $post['location'];
		$user_mobile = $post['mobile'];
		$query = "INSERT INTO users (user_name, user_email, user_password, user_gender, user_location, user_mobile, join_date) VALUES ('".$user_name."','".$user_email."','".$user_password."', '".$user_gender."', '".$user_location."', '".$user_mobile."', NOW())";
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
//End of use of SIGNUP.PHP

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
/*function upLoadImage($image)
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

} */
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
