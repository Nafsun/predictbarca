<?php
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Predict Barca</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours">
	<meta name="description" content="Predict Barca is an online platform that provide you with latest barcelona news, transfers, scores, matches and video highlights. It allows people to also have access to live commentary and live chat with other barcelona fans on every match.">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<?php
		if(isset($_GET['hash'])){
			$pb->VerifySub($_GET['hash']);
		}
	?>
	<?php include("match-top.php"); ?>
	<div id="match-middle">
		<p id="predict">Predict Barca is an online platform that provide you with latest barcelona news, transfers, scores, matches and video highlights.</p>
		<img class="barca-image-center" src="images/barcelona kit.jpg" alt="barcelona kit">
		<p id="choose">Every News we provide tends to be accurate and we do not provide our users with any fake rumours or news.</p>
	</div>
	<?php include("match-down.php"); ?>
	<p id="share-post">Share this page on: 
		<a href="https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com&quote=Predict Barca is an online platform that provide you with latest barcelona news, transfers, scores, matches and video highlights. It allows people to also have access to live commentary and live chat with other barcelona fans on every match." target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a>
		<a href="https://www.twitter.com/intent/tweet?text=Predict Barca is an online platform that provide you with latest barcelona news, transfers, scores, matches and video highlights. It allows people to also have access to live commentary and live chat with other barcelona fans on every match. For more visit https://predictbarca.com" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a>
		<a href="whatsapp://send?text=Predict Barca is an online platform that provide you with latest barcelona news, transfers, scores, matches and video highlights. It allows people to also have access to live commentary and live chat with other barcelona fans on every match. For more visit https://predictbarca.com" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
	</p>
	<?php include("footer.php"); ?>
</body>
</html>