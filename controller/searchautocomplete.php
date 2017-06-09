<?php
require_once "../class/user-service.php";
$userService = new UserService();
$namesearch=$userService->searchUser($_GET['userName']);
//$output = '<ul class="list-unstyled">';
$json = array();
foreach($namesearch as $user){
   $json[]=array(
  'value'=> $user["user_name"],
  'label'=> $user["user_name"]." - ".$user["user_id"]
);
  //  $output .= '<li>'.$user["user_name"].'</li>';
}
//$output .= '</ul>';
//echo $output;
echo json_encode($json);

 ?>
