<?php
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Barcelona Matches</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours, matches">
	<meta name="description" content="Get the latest barcelona matches every single day.">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">BARCELONA MATCHES</h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg-2">
			<script type="text/javascript">
				$(function(){
					var load_pages = 10;
					$("#barca-matches-list").click(function(){
						load_pages = load_pages + 10;
						$("#bm").load("load-more-matches.php", {load_pages_new: load_pages});
					});
				});
			</script>
			<div id="bm">
				<?php $pb->DisplayBarcelonaFutureMatches(10); ?>
			</div>
			<table align="center";>
				<tr>
					<td>
						<input id="barca-matches-list" class="read-more" type="button" value="Read More">
					</td>
				</tr>
			</table>
		</div>
		<?php include("match-summary.php"); ?>
		<div id="clear"></div>
	</div>
	<?php include("match-down.php"); ?>
	<p id="share-post">Share this page on: 
		<a href="https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/barcelona-matches.php&quote=Overall barcelona squad with their names, pictures and biographies." target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a>
		<a href="https://www.twitter.com/intent/tweet?text=Overall barcelona squad with their names, pictures and biographies. For more visit https://predictbarca.com/barcelona-matches.php" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a>
		<a href="whatsapp://send?text=Overall barcelona squad with their names, pictures and biographies. For more visit https://predictbarca.com/barcelona-matches.php" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
	</p>
	<?php include("footer.php"); ?>
</body>
</html>