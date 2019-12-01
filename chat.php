<?php include("head.php"); include("dbconnect.php"); ?>
<script type="text/javascript">
$(function(){
	setInterval(function(){
		$("#livechat-display2").load("load-instant-livechat.php");
	}, 4000);
});
</script>
<div id="livechat-display2">
	<?php $pb->DisplayChat(); ?>
</div>