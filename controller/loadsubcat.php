<?php

  require_once "../class/user-service.php";
	$functionalarea = $_REQUEST['functionalarea'];
  $userService = new UserService();
  $view_role=$userService->viewRole($functionalarea);
	foreach ($view_role as $role) {
		echo "<option value='$role[role_id]'>$role[role_name]</option>";

}

//$query = mysql_query("SELECT * FROM role WHERE functionalarea_id = '$functionalarea'");
/*while($row = mysqli_fetch_array($run)) {
	echo "<option value='$row[role_id]'>$row[role_name]</option>";
} */



/*
$industryId = $_GET['industryId'];
$view_industry_query="select * from industry where industry_id='$industryId'";
$run=mysqli_query($dbcon,$view_industry_query);

while($row=mysqli_fetch_array($run))
{
  $industry_id=$row['industry_id'];
  $industry_name=$row['industry_name'];
}
*/
?>
