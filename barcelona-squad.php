<?php
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Barcelona Squad</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours, squad">
	<meta name="description" content="Overall barcelona squad with their names, pictures and biographies">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">BARCELONA SQUAD</h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg">
			<script type="text/javascript">
				$(function(){
					var load_pages = 10;
					$("#barca-sqaud-here").click(function(){
						load_pages = load_pages + 10;
						$("#bs").load("load-more-squad.php", {load_pages_new: load_pages});
					});
				});
			</script>
			<div id="bs">
				<?php $pb->DisplaySquad(); ?>
			</div>
			<br>
			<table align="center";>
				<tr>
					<td>
						<input id="barca-sqaud-here" class="read-more" type="button" value="Read More">
					</td>
				</tr>
			</table>
			<br><br>
		</div>
	</div>
		<?php include("match-summary.php"); ?>
		<div id="clear"></div>
	</div>
	<?php include("match-down.php"); ?>
	<p id="share-post">Share this page on: 
		<a href="https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/barcelona-squad.php&quote=Overall barcelona squad with their names, pictures and biographies" target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a>
		<a href="https://www.twitter.com/intent/tweet?text=Overall barcelona squad with their names, pictures and biographies. For more visit https://predictbarca.com/barcelona-squad.php" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a>
		<a href="whatsapp://send?text=Overall barcelona squad with their names, pictures and biographies. For more visit https://predictbarca.com/barcelona-squad.php" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
	</p>
	<?php include("footer.php"); ?>
</body>
</html>