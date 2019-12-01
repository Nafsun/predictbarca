<?php
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Latest Barcelona News</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours">
	<meta name="description" content="Get all the latest barcelona news including transfers, talks, wins etc">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">LATEST BARCELONA NEWS</h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg-5">
			<script type="text/javascript">
				$(function(){
					var load_pages = 5;
					$("#latest-b-news-here").click(function(){
						load_pages = load_pages + 5;
						$("#lbn").load("load-more-latest-news.php", {load_pages_new: load_pages});
					});
				});
			</script>
			<div id="lbn">
				<?php
					$pb->DisplayLatestBarcelonaNews();
				?>
			</div>
			<br>
			<table align="center";>
				<tr>
					<td>
						<input id="latest-b-news-here" class="read-more" type="button" value="Read More">
					</td>
				</tr>
			</table>
			<br><br>
		</div>
		<?php include("match-summary.php"); ?>
		<div id="clear"></div>
	</div>
	<?php include("match-down.php"); ?>
	<p id="share-post">Share this page on: 
		<a href="https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/latest-barcelona-news.php&quote=Get all the latest barcelona news including transfers, talks, wins etc." target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a>
		<a href="https://www.twitter.com/intent/tweet?text=Get all the latest barcelona news including transfers, talks, wins etc. For more visit https://predictbarca.com/latest-barcelona-news.php" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a>
		<a href="whatsapp://send?text=Get all the latest barcelona news including transfers, talks, wins etc. For more visit https://predictbarca.com/latest-barcelona-news.php" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
	</p>
	<?php include("footer.php"); ?>
</body>
</html>