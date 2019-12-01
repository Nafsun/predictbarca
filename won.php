<?php
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Won</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours, won">
	<meta name="description" content="All the people who have won free money on predict barca">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">PEOPLE WHO WON N1,100</h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg-5">
			<?php $pb->DisplayWinner(); ?>
		</div>
		<?php include("match-summary.php"); ?>
	</div>
	<?php include("match-down.php"); ?>
	<p id="share-post">Share this page on: 
		<a href="https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/won.php&quote=All the people who have won free money on predict barca." target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a>
		<a href="https://www.twitter.com/intent/tweet?text=All the people who have won free money on predict barca. For more visit https://predictbarca.com/won.php" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a>
		<a href="whatsapp://send?text=All the people who have won free money on predict barca. For more visit https://predictbarca.com/won.php" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
	</p>
	<?php include("footer.php"); ?>
</body>
</html>