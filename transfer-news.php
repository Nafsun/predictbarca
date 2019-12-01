<?php
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Transfer News</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours">
	<meta name="description" content="Latest barcelona transfer news and rumours">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">TRANSFER NEWS</h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg">
			<script type="text/javascript">
				$(function(){
					var load_pages = 5;
					$("#latest-t-news-here").click(function(){
						load_pages = load_pages + 5;
						$("#tn").load("load-more-transfer-news.php", {load_pages_new: load_pages});
					});
				});
			</script>
			<div id="tn">
				<?php
				$pb->DisplayTransferNews();
				?>
			</div>
			<table align="center";>
				<tr>
					<td>
						<input id="latest-t-news-here" class="read-more" type="button" value="Read More">
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
		<a href="https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/transfer-news.php&quote=Latest barcelona transfer news and rumours." target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a>
		<a href="https://www.twitter.com/intent/tweet?text=Latest barcelona transfer news and rumours. For more visit https://predictbarca.com/transfer-news.php" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a>
		<a href="whatsapp://send?text=Latest barcelona transfer news and rumours. For more visit https://predictbarca.com/transfer-news.php" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
	</p>
	<?php include("footer.php"); ?>
</body>
</html>