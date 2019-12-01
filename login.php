<?php
session_start();
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login As a Barcelona Predictor</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours">
	<meta name="description" content="Access your barcelona prediction account by login with your username and password">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">LOGIN AS A BARCELONA PREDICTOR</h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg-5">
			<?php
			if(isset($_POST['username']) && isset($_POST['password'])){
				$username = strip_tags(strtolower($_POST['username']));
				$password = strip_tags(strtolower($_POST['password']));
				$pb->Login($username, $password);
			}
			?>
			<?php
				if(isset($_SESSION['ac'])){
					echo "<p id='not-checker'>Your account has being activated, enter your username and password to update your profile and update your bank account details.</p>";
					session_destroy();
				}
			?>
			<form method="POST">
				Username:<br><input class="form-changer" type="text" name="username"><br>
				Password:<br><input class="form-changer" type="password" name="password"><br>
				<p><a id='fp' href="forgot-password.php">forgot password</a></p>
				<input class="submit-changer" type="submit" value="Submit"><br><br><br>
			</form>
		</div>
		<?php include("match-summary.php"); ?>
	</div>
	<?php include("match-down.php"); ?>
	<p id="share-post">Share this page on: 
		<a href="https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/login.php&quote=Access your barcelona prediction account by login with your username and password." target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a>
		<a href="https://www.twitter.com/intent/tweet?text=Access your barcelona prediction account by login with your username and password. For more visit https://predictbarca.com/login.php" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a>
		<a href="whatsapp://send?text=Access your barcelona prediction account by login with your username and password. For more visit https://predictbarca.com/login.php" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
	</p>
	<?php include("footer.php"); ?>
</body>
</html>