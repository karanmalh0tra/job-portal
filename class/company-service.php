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
			$company_location = $post['location'];
			$company_address =  mysql_real_escape_string($post['company_address']);
			$company_contact = $post['company_contact'];
			$company_contact_person = $post['company_contact_person'];
			$company_about = mysql_real_escape_string($post['company_about']);
			$query="update companies set company_location='$company_location', company_name='$company_name', company_address='$company_address', company_contact='$company_contact', company_contact_person='$company_contact_person', company_about='$company_about', imagepath='$imagePath'
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
			$query = "SELECT * FROM jobs WHERE job_archive='N' ";
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
			$query = "SELECT * from jobs WHERE company_id='".$companyId."' AND job_status='active' AND job_archive='N' ORDER BY timestamp DESC LIMIT 3";
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
			$query = "SELECT * FROM jobs where job_id='".$jobId."' and job_archive='N'";
			$view = $this->ExecuteQuery($query, "select");
			//$view = $data[0];
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $view[0];
	}

	function updateJobDetails($post,$jobId)
	{
		$data;
		$this->beginTransaction();
		try {
			$functionalarea_id = $post['jobfunctionalarea'];
			$job_title = $post['jobtitle'];
			$job_description = $post['jobdescription'];
			$job_work_experience = $post['jobexperience'];
			$job_skills = $post['jobskills'];
			$job_salary = $post['jobsalary'];
			$job_location = $post["joblocation"];
			$industry_id = $post["jobindustry"];
			$functionalarea_id = $post["jobfunctionalarea"];
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
	function updateJobStatus($jobId)
	{
		$status;
		$this->beginTransaction();
		try {
			$job=$this->getJobDetail($jobId);
			if($job['job_status']=="active")
			{

				$query="update jobs set job_status='inactive' where job_id='$jobId'";
				$this->ExecuteQuery($query, "update");
				$status="inactive";
			}
			else {

				$query="update jobs set job_status='active' where job_id='$jobId'";
				$this->ExecuteQuery($query, "update");
				$status="active";
			}
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $status;
	}

	function deleteJob($jobId)
	{
		$data;
		$this->beginTransaction();
		try {
			$query="update jobs set job_archive='Y' where job_id='$jobId'";
			$data=$this->ExecuteQuery($query,"update");
			$this->commitTransaction();
		}
		catch(Exception $e) {
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
	//TODO: edit applyforjob for companyid everywhere
	function applyForJob($userId,$jobId)
	{
		$data;
		$this->beginTransaction();
		try
		{
			$query = "INSERT INTO applied_jobs (user_id, job_id, applied_date)
			VALUES
			('".$userId."','".$jobId."', NOW() )";
			$data = $this->ExecuteQuery($query, "insert");
			if(!empty($data))
			{
				$getcompanyId = $this->getJobDetail($jobId);


				$query = "INSERT INTO company_notification (user_id, job_id, company_id)
				VALUES
				('".$userId."','".$jobId."', '".$getcompanyId['company_id']."' )";
				$data = $this->ExecuteQuery($query, "insert");
			}
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $data;
	}

	function viewCompanyNotification($companyId)
	{
		$view;
		$this->beginTransaction();
		try
		{
			$query = "SELECT count(*) as count FROM company_notification WHERE company_id='".$companyId."' AND status='unread'";
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

	function updateCompanyNotifications($jobId)
	{
		$data;
		$this->beginTransaction();
		try {
			$query="update company_notification set status='read' where job_id='$jobId'";
			$data=$this->ExecuteQuery($query,"update");
			$this->commitTransaction();
		}
		catch(Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function appliedJobs($userId, $jobId)
	{
		$data;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM applied_jobs WHERE user_id='".$userId."' AND job_id='".$jobId."'";
			$data = $this->ExecuteQuery($query, "select");
			if(!empty($data))
			{
				$data= $data[0];
			}
			else {
				$data=0;
			}
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $data;
	}

	function viewApplications($jobId)
	{
		$data;
		$this->beginTransaction();
		try {
			$query = "SELECT * FROM applied_jobs WHERE job_id='".$jobId."' AND status='process'";
			$data = $this->ExecuteQuery($query, "select");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function applicantShortlist($userId,$jobId)
	{
		$data;
		$this->beginTransaction();
		try {
			$query="update applied_jobs set status='shortlisted' where user_id='$userId' and job_id='$jobId'";
			$data=$this->ExecuteQuery($query,"update");
			$this->commitTransaction();
		}
		catch(Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function applicantAccept($userId,$jobId)
	{
		$data;
		$this->beginTransaction();
		try {
			$query="update applied_jobs set status='accepted' where user_id='$userId' and job_id='$jobId'";
			$data=$this->ExecuteQuery($query,"update");
			$this->commitTransaction();
		}
		catch(Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function applicantReject($userId,$jobId)
	{
		$data;
		$this->beginTransaction();
		try {
			$query="update applied_jobs set status='rejected' where user_id='$userId' and job_id='$jobId'";
			$data=$this->ExecuteQuery($query,"update");
			$this->commitTransaction();
		}
		catch(Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function viewShortlistedApplications($jobId)
	{
		$data;
		$this->beginTransaction();
		try {
			$query = "SELECT * FROM applied_jobs WHERE job_id='".$jobId."' AND status='shortlisted'";
			$data = $this->ExecuteQuery($query, "select");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function removeApplicantFromShortlist($userId, $jobId)
	{
		$data;
		$this->beginTransaction();
		try {
			$query="update applied_jobs set status='process' where user_id='$userId' and job_id='$jobId'";
			$data=$this->ExecuteQuery($query,"update");
			$this->commitTransaction();
		}
		catch(Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function savedJobs($userId, $jobId)
	{
		$data;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * FROM saved_jobs WHERE user_id='".$userId."' AND job_id='".$jobId."'";
			$data = $this->ExecuteQuery($query, "select");
			if(!empty($data))
			{
				$data= $data[0];
			}
			else {
				$data=0;
			}
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $data;
	}

	function viewSavedJobs($userId)
	{
		$data;
		$this->beginTransaction();
		try {
			$query = "SELECT * FROM saved_jobs WHERE user_id='".$userId."' AND status='saved'";
			$data = $this->ExecuteQuery($query, "select");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function addSavedJob($userId, $jobId)
	{
		$data;
		$this->beginTransaction();
		try
		{
			$query = "SELECT * from saved_jobs where user_id='".$userId."' and job_id='".$jobId."' ";
			$data=$this->ExecuteQuery($query,"select");
			if(empty($data)){
				$query = "INSERT INTO saved_jobs (user_id, job_id, status)
				VALUES
				('".$userId."','".$jobId."', 'saved' )";
				$data = $this->ExecuteQuery($query, "insert");
			}
			else {
				$query = "UPDATE saved_jobs set status='saved'
				where user_id='".$userId."' and job_id='".$jobId."'";
				$data = $this->ExecuteQuery($query, "update");
			}
			$this->commitTransaction();
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $data;
	}

	function removeSavedJob($userId, $jobId)
	{
		$data;
		$this->beginTransaction();
		try {
			$query="update saved_jobs set status='unsaved' where user_id='$userId' and job_id='$jobId'";
			$data=$this->ExecuteQuery($query,"update");
			$this->commitTransaction();
		}
		catch(Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function searchEmployees($skills,$location)
	{
		$data;
		$this->beginTransaction();
		try {
			$query = "select * from users where user_location LIKE '%$location%' and";
			$skills2 = mysql_real_escape_string($skills);
			$skills1 = explode(' ', $skills2);
			$keyCount = 0;
			foreach ($skills1 as $skill) {
				if ($keyCount > 0){
					$query .= " and";
				}
				$query .= " user_key_skills LIKE '%$skill%'";
				++$keyCount;
			}
			$data=$this->ExecuteQuery($query,"select");
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function viewSearchedJobs($keywords, $location, $industryId)
	{
		$data;
		$this->beginTransaction();
		try {
			if(!empty($industryId))
			{
			  $query = "select * from jobs where job_location LIKE '%$location%' and industry_id like '$industryId' and ";
			}
			else {
				$query = "select * from jobs where job_location LIKE '%$location%' and ";
			}
			$skills2 = mysql_real_escape_string($keywords);
			$skills1 = explode(' ', $skills2);
			$keyCount = 0;
			foreach ($skills1 as $skill) {
				if ($keyCount > 0){
					$query .= " and";
				}
				$query .= " job_skills LIKE '%$skill%'";
				++$keyCount;
			}
			$data=$this->ExecuteQuery($query,"select");
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function viewEightJobs()
	{
		$data;
		$this->beginTransaction();
		try {
			$query="SELECT *, Count(*) AS occurances
    					FROM jobs
    					GROUP BY industry_id
    					ORDER BY occurances DESC
    					LIMIT 8";
			$data=$this->ExecuteQuery($query,"select");
			$this->commitTransaction();
		}
		catch(Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

	function searchCompany($location, $serviceId)
	{
		$data;
		$this->beginTransaction();
		try{
			$locationSql = "";

			if(!empty($location))
			{
				$locationSql = " and city like '%".$location."%'";
			}
			$sql = "select * from company where service_category like '%".$serviceId.",%'". $locationSql ." order by company_id asc";
			$data = $this->ExecuteQuery($sql, "select");
			//return $data;
		}
		catch(Exception $e)
		{
			$this->rollbackTransaction();
		}
		return $data;
	}

}
?>
