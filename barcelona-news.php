<?php
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Barcelona News</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours">
	<meta name="description" content="All barcelona latest news, transfer, talks, highlights, training ground and rumours">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">BARCELONA NEWS</h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg-2">
			<script type="text/javascript">
				$(function(){
					var load_pages = 10;
					$("#more-news-loader").click(function(){
						load_pages = load_pages + 10;
						$("#bn").load("load-more-news.php", {load_pages_new: load_pages});
					});
				});
			</script>
			<div id="bn">
				<?php
					$pb->DisplayAllNews();
				?>
			</div>
			<br>
			<br>
			<table align="center";>
				<tr>
					<td>
						<input id="more-news-loader" class="read-more" type="button" value="Read More">
					</td>
				</tr>
			</table>
		</div>
		<?php include("match-summary.php"); ?>
		<div id="clear"></div>
	</div>
	<?php include("match-down.php"); ?>
	<p id="share-post">Share this page on: 
		<a href="https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/barcelona-news.php&quote=All barcelona latest news, transfer, talks, highlights, training ground and rumours." target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a>
		<a href="https://www.twitter.com/intent/tweet?text=All barcelona latest news, transfer, talks, highlights, training ground and rumours. For more visit https://predictbarca.com/barcelona-news.php" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a>
		<a href="whatsapp://send?text=All barcelona latest news, transfer, talks, highlights, training ground and rumours. For more visit https://predictbarca.com/barcelona-news.php" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
	</p>
	<?php include("footer.php"); ?>
</body>
</html>