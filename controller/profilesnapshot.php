<?php
require_once "../class/user-service.php";
$userService = new UserService();
$update_user=$userService->updateUser($_POST,$_GET['userId']);
header("location:../dashboard.php");

?>

<?php /*
if(isset($_POST['submit']))
{
  $user_name=$_POST['name'];
  $user_email=$_POST['email'];
  //$user_pass=$_POST['pass'];
  $user_mobile=$_POST['mobile'];
  $user_location=$_POST['location'];



    $update_user="update users set user_name='$user_name', user_email='$user_email', user_pass='$user_pass', user_mobile='$user_mobile', user_location='$user_location' where user_email='$emailId'";
   if(mysqli_query($dbcon,$update_user))
   {
      echo"<script>window.open('welcome.php','_self')</script>";
   }

} */
?>
