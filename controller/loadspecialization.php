<?php

  require_once "../class/user-service.php";
	$graduation = $_REQUEST['graduation'];
  $userService = new UserService();
  $view_specialization=$userService->viewSpecialization($graduation);
	foreach ($view_specialization as $specialization) {
		echo "<option value='$specialization[specialization_id]'>$specialization[specialization_name]</option>";

}
