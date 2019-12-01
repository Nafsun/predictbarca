<?php
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Barcelona Video Highlights</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours, video, highlights">
	<meta name="description" content="Get the latest barcelona matches video highlights, training highlights, best of barcelona players etc">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">BARCELONA VIDEO HIGHLIGHTS</h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg-5">
			<script type="text/javascript">
				$(function(){
					var load_pages = 3;
					$("#latest-video-upload").click(function(){
						load_pages = load_pages + 3;
						$("#bvh").load("load-more-video-highlights.php", {load_pages_new: load_pages});
					});
				});
			</script>
			<div id="bvh">
				<?php  
					$pb->DisplayVideoNews();
				?>
			</div>
			<br>
			<table align="center";>
				<tr>
					<td>
						<input id="latest-video-upload" class="read-more" type="button" value="Read More">
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
		<a href="https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/barcelona-video-highlights.php&quote=Get the latest barcelona matches video highlights, training highlights, best of barcelona players etc." target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a>
		<a href="https://www.twitter.com/intent/tweet?text=Get the latest barcelona matches video highlights, training highlights, best of barcelona players etc. For more visit https://predictbarca.com/barcelona-video-highlights.php" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a>
		<a href="whatsapp://send?text=Get the latest barcelona matches video highlights, training highlights, best of barcelona players etc. For more visit https://predictbarca.com/barcelona-video-highlights.php" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
	</p>
	<?php include("footer.php"); ?>
</body>
</html>