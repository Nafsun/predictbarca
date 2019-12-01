<?php
	if(isset($_POST['commentary1'])){
		include("dbconnect.php");
		$pb->CommentaryInsert($_POST['commentary1']);
	}
?>