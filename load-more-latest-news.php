<?php
$load_pages_new = $_POST['load_pages_new'];
if(isset($load_pages_new)){
	include("dbconnect.php");
	$pb->DisplayLatestBarcelonaNewsMore($load_pages_new);
}
?>