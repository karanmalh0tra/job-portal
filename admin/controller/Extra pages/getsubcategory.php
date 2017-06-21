<?php

require_once '../class/admin-service.php';
$adminService = new AdminService();
$parent_cat = $_GET['parent_cat'];
$subCategory = $adminService->viewSubCategoryBymainCategoryId($parent_cat);

foreach($subCategory as $subCategoryList)
{
	
	echo "<option value='$subCategoryList[subcategory_id]'>$subCategoryList[subcategory_name]</option>";
}
?>