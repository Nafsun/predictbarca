<?php
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>About us</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours, about, us">
	<meta name="description" content="We are a company with the sole aim of providing all the latest Barcelona news, transfers, highlights etc to Barcelona fans. We also aim to bring together all Barcelona fans by allowing them to have a live chat on every Barcelona match including watching live commentary and predicting what they think Barcelona will score on each and every match.">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">ABOUT US</h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg-5">
			<div id="receiver-3">
				We are a company with the sole aim of providing all the latest Barcelona news, transfers, highlights etc to Barcelona fans. We also aim to bring together all Barcelona fans by allowing them to have a live chat on every Barcelona match including watching live commentary and predicting what they think Barcelona will score on each and every match.
			</div>
		</div>
		<?php include("match-summary.php"); ?>
		<div id="clear"></div>
	</div>
	<?php include("match-down.php"); ?>
	<p id="share-post">Share this page on: 
		<a href="https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/about-us.php&quote=We are a company with the sole aim of providing all the latest Barcelona news, transfers, highlights etc to Barcelona fans. We also aim to bring together all Barcelona fans by allowing them to have a live chat on every Barcelona match including watching live commentary and predicting what they think Barcelona will score on each and every match." target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a>
		<a href="https://www.twitter.com/intent/tweet?text=We are a company with the sole aim of providing all the latest Barcelona news, transfers, highlights etc to Barcelona fans. We also aim to bring together all Barcelona fans by allowing them to have a live chat on every Barcelona match including watching live commentary and predicting what they think Barcelona will score on each and every match. For more visit https://predictbarca.com/about-us.php" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a>
		<a href="whatsapp://send?text=We are a company with the sole aim of providing all the latest Barcelona news, transfers, highlights etc to Barcelona fans. We also aim to bring together all Barcelona fans by allowing them to have a live chat on every Barcelona match including watching live commentary and predicting what they think Barcelona will score on each and every match. For more visit https://predictbarca.com/about-us.php" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
	</p>
	<?php include("footer.php"); ?>
</body>
</html>