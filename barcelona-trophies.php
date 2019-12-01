<?php
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Barcelona Trophies</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, trophies">
	<meta name="description" content="See when and the number of trophies like la liga, copa del rey, champions league that barcelona have won in it past years.">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">BARCELONA TROPHIES</h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg">
			<div id="players">
				<img class="news" src="images/laliga.jpg" alt="laliga cup">
				<h3>LALIGA</h3>
				<p>Barcelona have won 25 La liga cup since 1929. They have won the cup in 1944, 1947, 1948, 1948, 1951, 1952, 1958, 1959,
				1973, 1984, 1990, 1991, 1992, 1993, 1997, 1998, 2004, 2005, 2008, 2009, 2010, 2012, 2014, 2015, 2017.</p>
			</div>
			<div id="clear"></div>
			<div id="players">
				<img class="news" src="images/copadelrey.jpg" alt="copa del rey">
				<h3>COPA DEL REY</h3>
				<p>Barcelona have won 30 Copa del rey cup. They have won the cup in 1909, 1911, 1912, 1919, 1921, 1924, 1925, 1927, 1941, 1950,
				1951, 1952, 1956, 1958, 1962, 1967, 1970, 1977, 1980, 1982, 1987, 1989, 1996, 1997, 2008, 2011, 2014, 2015, 2016, 2017.</p>
			</div>
			<div id="clear"></div>
		</div>
		</div>
		<?php include("match-summary.php"); ?>
		<div id="clear"></div>
	</div>
	<?php include("match-down.php"); ?>
	<p id="share-post">Share this page on:
		<a href="https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/barcelona-trophies.php&quote=See when and the number of trophies like la liga, copa, champions league that barcelona have won in it past years." target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a>
		<a href="https://www.twitter.com/intent/tweet?text=See when and the number of trophies like la liga, copa, champions league that barcelona have won in it past years. For more visit https://predictbarca.com/barcelona-trophies.php" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a>
		<a href="whatsapp://send?text=See when and the number of trophies like la liga, copa, champions league that barcelona have won in it past years. For more visit https://predictbarca.com/barcelona-trophies.php" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
	</p>
	<?php include("footer.php"); ?>
</body>
</html>