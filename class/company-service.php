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
			$company_country = $post['companycountry'];
      $company_state = $post['companystate'];
      $company_city = $post['companycity'];
			$company_contact = $post['companycontact'];
      $company_contact_person = $post['companycontactperson'];

			$query = "INSERT INTO companies (company_name, company_email, company_password, company_address, company_country, company_state, company_city, company_contact, company_contact_person)
      VALUES ('".$company_name."','".$company_email."','".$company_password."', '".$company_address."', '".$company_country."', '".$company_state."', '".$company_city."', '".$company_contact."', '".$company_contact_person."')";
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


}
?>
