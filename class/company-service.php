<?php
require_once 'class.mysql.php';
class CompanyService extends MySql
{
	function CompanyService()
	{
		$this->MySql();
	}

  function newCompany($post)
	{
		$add=0;
		$this->beginTransaction();
		try {

			$company_name = $post['companyname'];
      $company_email = $post['companyemail'];
      $company_password = sha1($post['companypass']);
			$company_address = $post['companyaddress'];
			$company_location = $post['companylocation'];
			$company_contact = $post['companycontact'];
      $company_contact_person = $post['companycontactperson'];

			$query = "INSERT INTO companies (company_name, company_email, company_password, company_address, company_location, company_contact, company_contact_person)
      VALUES ('".$company_name."','".$company_email."','".$company_password."', '".$company_address."', '".$company_location."', '".$company_contact."', '".$company_contact_person."')";
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

	function authenticateCompany($email, $password)
	{
		$authenticated = false;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM companies WHERE company_email = '".$email."' ";
			$data = $this->ExecuteQuery($query, "select");

			if(!isset($data) || count($data)==0)
			{
				$authenticated = false;
			}
			else if(sha1($password) == $data[0]['company_password'])
			{

				if(!isset($_SESSION))
				{
					session_start();
					$_SESSION['company_id'] = $data[0]['company_id'];
					$_SESSION['company_email'] = $data[0]['company_email'];
					$_SESSION['company_name'] = $data[0]['company_name'];

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

	function viewCompany($companyId)
	{
		$view;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM companies WHERE company_id='".$companyId."'";
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

	function updateCompany($post,$companyId)
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
			$company_name = $post['company_name'];
			$company_address =  mysql_real_escape_string($post['company_address']);
			$company_contact = $post['company_contact'];
			$company_contact_person = $post['company_contact_person'];
			$company_about = mysql_real_escape_string($post['company_about']);
			$query="update companies set company_name='$company_name', company_address='$company_address', company_contact='$company_contact', company_contact_person='$company_contact_person', company_about='$company_about'
			where company_id='".$companyId."'";
			$data = $this->ExecuteQuery($query,"update");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function upLoadImage($image)
	{

		$result=array();
		$file_name=$image['name'];
		$file_size=$image['size'];
		$file_tmp=$image['tmp_name'];
		$file_type=$image['type'];
		$file_ext=strtolower(end(explode('.',$file_name)));
		move_uploaded_file($file_tmp,"../images/companyprofileimages/".$file_name);
		return ("images/companyprofileimages/".$file_name);

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
			move_uploaded_file($file_tmp,"../images/companyprofileimages/".$file_name);
			return ("images/companyprofileimages/".$file_name);
		}
		else
		{
			return false;
		}

	}

  function addJob($post,$companyId)
	{
		$data;
		$this->beginTransaction();
		try {
			$job_title = $post['jobtitle'];
			$job_description = $post['jobdescription'];
			$job_work_experience = $post['jobexperience'];
			$job_skills = $post['jobskills'];
			$job_salary = $post['jobsalary'];
			$job_location = $post["joblocation"];
      $industry_id = $post["jobindustry"];
      $functionalarea_id = $post["jobfunctionalarea"];
			$query = "INSERT INTO jobs (job_title, job_description, job_work_experience, job_skills, job_salary, job_location, industry_id, functionalarea_id, company_id )
			 VALUES
			 ('".$job_title."','".$job_description."','".$job_work_experience."', '".$job_skills."', '".$job_salary."', '".$job_location."', '".$industry_id."', '".$functionalarea_id."', '".$companyId."')";

			$data = $this->ExecuteQuery($query,"insert");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

  function viewJob()
	{
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM jobs";
			$data = $this->ExecuteQuery($query, "select");
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $data;
	}

	function viewJobFromCompany($companyId)
	{
		$this->beginTransaction();
		try {
			$query = "SELECT * from jobs WHERE company_id='".$companyId."' AND job_status='active' ORDER BY timestamp DESC LIMIT 3";
			$data = $this->ExecuteQuery($query,"select");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

  function getJobDetail($jobId)
	{
    $view;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM jobs where job_id='".$jobId."'";
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

	function updateJobDetails($post,$jobId)
	{
		$data;
		$this->beginTransaction();
			$job_title = $post['job_title'];
			$job_description =  mysql_real_escape_string($post['job_description']);
			$job_work_experience = $post['job_work_experience'];
			$job_skills =  mysql_real_escape_string($post['job_skills']);
			$job_salary = $post['job_salary'];
			$job_location = mysql_real_escape_string($post['job_location']);
			$industry_id = $post['jobindustry'];
      $functionalarea_id = $post['jobfunctionalarea'];
			$query="update jobs set job_title='$job_title', job_description='$job_description', job_work_experience='$job_work_experience', job_skills='$job_skills',
			job_salary='$job_salary', job_location='$job_location', industry_id='$industry_id', functionalarea_id='$functionalarea_id'
			where job_id='".$jobId."'";
			$data = $this->ExecuteQuery($query,"update");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}
 	//TODO: work on updating Job Status.
	function updateJobStatus($post,$jobId)
	{
		$data;
		$this->beginTransaction();
			$job_title = $post['job_title'];
			$query="update jobs set functionalarea_id='$functionalarea_id'
			where job_id='".$jobId."'";
			$data = $this->ExecuteQuery($query,"update");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function viewCompanyById($companyId)
	{
		$view;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM companies WHERE company_id='".$companyId."'";
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

	function changePassword($post,$companyId)
	{
		$password=0;
		$this->beginTransaction();
		try{
			$oldPassword=sha1($post['oldPassword']);
			$newPassword=sha1($post['newPassword']);
			$sql="select * from companies where company_id='$companyId'";
			$data=$this->ExecuteQuery($sql,"select");
			if($data[0]['user_password']==$oldPassword){
				$query="update companies set user_password='$newPassword' where company_id='$companyId'";
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


}
?>
