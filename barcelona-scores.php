<?php
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Barcelona Scores</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours, scores">
	<meta name="description" content="Latest barcelona matches score lines">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">BARCELONA SCORES</h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg-2">
			<script type="text/javascript">
				$(function(){
					var load_pages = 10;
					$("#barca-scores-list").click(function(){
						load_pages = load_pages + 10;
						$("#bs").load("load-more-scores.php", {load_pages_new: load_pages});
					});
				});
			</script>
			<div id="bs">
				<?php $pb->DisplayAllScores(); ?>
			</div>
			<table align="center";>
				<tr>
					<td>
						<input id="barca-scores-list" class="read-more" type="button" value="Read More">
					</td>
				</tr>
			</table>
		</div>
		<?php include("match-summary.php"); ?>
		<div id="clear"></div>
	</div>
	<?php include("match-down.php"); ?>
	<p id="share-post">Share this page on: 
		<a href="https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/barcelona-scores.php&quote=Latest barcelona matches score lines." target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a>
		<a href="https://www.twitter.com/intent/tweet?text=Latest barcelona matches score lines. For more visit https://predictbarca.com/barcelona-scores.php" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a>
		<a href="whatsapp://send?text=Latest barcelona matches score lines. For more visit https://predictbarca.com/barcelona-scores.php" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
	</p>
	<?php include("footer.php"); ?>
</body>
</html>