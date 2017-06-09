<?php
require_once 'class.mysql.php';
class CompanyService extends MySql
{
	function AdminService()
	{
		$this->MySql();
	}

  function addGraduation($post)
	{
		$data;
		$this->beginTransaction();
		try {
			$graduation_name = $post['graduation_name'];
			 $query = "INSERT INTO graduation (graduation_name)
			 VALUES
			 ('".$graduation_name."')";

			$data = $this->ExecuteQuery($query,"insert");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

  function editGraduation($post,$graduationId)
	{
		$data;
		$this->beginTransaction();
		try {
			$graduation_name = $post['graduation_name'];
			 $query = "UPDATE graduation set graduation_name='$graduation_name' where graduation_id='".$graduationId"'";
			$data = $this->ExecuteQuery($query,"update");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

  function deleteGraduation($post, $graduationId)
	{
		$data;
		$this->beginTransaction();
		try {
		  $query = "delete from graduation where graduation_id='".$graduationId"'";
			$data = $this->ExecuteQuery($query,"delete");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

  function viewGraduation()
	{
		$this->beginTransaction();
		try {
			$query = "SELECT * FROM graduation";
			$data = $this->ExecuteQuery($query,"select");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

  function addSpecialization($post)
	{
		$data;
		$this->beginTransaction();
		try {
			$graduation_name = $post['graduation_name'];
			 $query = "INSERT INTO graduation (graduation_name)
			 VALUES
			 ('".$graduation_name."')";

			$data = $this->ExecuteQuery($query,"insert");
			$this->commitTransaction();
		} catch (Exception $e) {
			$this->rollbackTransaction();
		}
		return $data;
	}

}
