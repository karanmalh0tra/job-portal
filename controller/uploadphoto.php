<?php
require_once "../class/user-service.php";

$userService = new UserService();
$upload_file=$userService->uploadPhoto($_FILES);
$path = "/uploads/" . basename($name);
if (move_uploaded_file($file['tmp_name'], $path)) {
    // Move succeed.
} else {
    // Move failed. Possible duplicate?
}
?>
