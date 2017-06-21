<?php
session_start();

if(!$_SESSION['user_email'])
{
  header("Location: login.php");
}
else {
  $userId = $_SESSION['user_id'];
  require_once "class/user-service.php";
  $userService = new UserService();
  $funcarea = $userService->viewGraduation();
}

?>

<?php include "header.php";?>

<form name="addroleform" action="controller/addrole.php" method="post">
  Graduation: <select name="functionalarea_id" id="">
    <?php foreach($funcarea as $fa)
    {
      ?>
      <<option value="<?php echo $fa['graduation_id']; ?>"><?php echo $fa['graduation_name']; ?></option>
    <?php } ?>
  </select>
  Add role:<input type="text" name="role_name" required/><br/>
  <button type="submit">Add</button>

</form>

<?php include "footer.php";?>
