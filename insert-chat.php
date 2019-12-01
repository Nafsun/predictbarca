<?php
	if(isset($_POST['mes1'])){
		include("dbconnect.php");
		$pb->ChatInsert($_POST['mes1']);
	}
?>