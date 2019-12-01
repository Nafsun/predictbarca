<?php
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Predictions</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours">
	<meta name="description" content="All the predictions made by barcelona fans about their matches">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">PREDICTIONS</h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg-2">
			<script type="text/javascript">
				$(function(){
					var load_pages = 10;
					$("#barca-predict").click(function(){
						load_pages = load_pages + 10;
						$("#bp").load("load-more-predictions.php", {load_pages_new: load_pages});
					});
				});
			</script>
			<div id="bp">
				<?php $pb->DisplayPredictions(); ?>
			</div>
			<table align="center";>
				<tr>
					<td>
						<input id="barca-predict" class="read-more" type="button" value="Read More">
					</td>
				</tr>
			</table>
		</div>
		<?php include("match-summary.php"); ?>
		<div id="clear"></div>
	</div>
	<?php include("match-down.php"); ?>
	<p id="share-post">Share this page on: 
		<a href="https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/predictions.php&quote=All the predictions made by barcelona fans about their matches." target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a>
		<a href="https://www.twitter.com/intent/tweet?text=All the predictions made by barcelona fans about their matches. For more visit https://predictbarca.com/predictions.php" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a>
		<a href="whatsapp://send?text=All the predictions made by barcelona fans about their matches. For more visit https://predictbarca.com/predictions.php" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
	</p>
	<?php include("footer.php"); ?>
</body>
</html>