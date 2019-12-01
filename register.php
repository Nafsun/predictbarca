<?php
session_start();
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register As a Barcelona Predictor</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours, register">
	<meta name="description" content="Register to get a chance of winning free money by predicting Barcelona matches, accessing live commentary and also having a live chat with other barcelona fans">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">REGISTER AS A BARCELONA PREDICTOR</h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg-5">
			<?php
				if(isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword'])){
					$fullname = strip_tags(strtolower($_POST['fullname']));
					$email = strip_tags(strtolower($_POST['email']));
					$username = strip_tags(strtolower($_POST['username']));
					$password = strip_tags(strtolower($_POST['password']));
					$repassword = strip_tags(strtolower($_POST['repassword']));
					if($password === $repassword){
						$pb->Register($fullname, $email, $username, $password);
					}else{
						echo "<p id='not-checker'>Passwords do not Match</p>";
					}
				}
			?>
			<?php
				if(!isset($_SESSION['verify-send']) && !isset($_GET['hash'])){
			?>
			<form method="POST">
				Full Name:<br><input class="form-changer" type="text" name="fullname"><br>
				Email:<br><input class="form-changer" type="email" name="email"><br>
				Username:<br><input class="form-changer" type="text" name="username"><br>
				Password:<br><input class="form-changer" type="password" name="password"><br>
				Re-enter Password:<br><input class="form-changer" type="password" name="repassword"><br><br>
				<input class="submit-changer" type="submit" value="Submit"><br><br><br>
			</form>
			<?php
				}elseif(isset($_SESSION['verify-send']) && !isset($_GET['hash'])){
					unset($_SESSION['verify-send']);
			?>
			<p align='center'>
			A verification link has being sent to your email address, 
			Click on the link to verify your account. If it takes longer than 3 minute to arrive, check your email spam folder. 
			</p>
			<?php
			}elseif(isset($_GET['hash'])){
				$pb->VerifySuccess($_GET['hash']);
			}
			?>
		</div>
		<?php include("match-summary.php"); ?>
	</div>
	<?php include("match-down.php"); ?>
	<p id="share-post">Share this page on: 
		<a href="https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/register.php&quote=Register to get a chance of winning free money by predicting Barcelona matches, accessing live commentary and also having a live chat with other Barcelona fans" target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a>
		<a href="https://www.twitter.com/intent/tweet?text=Register to get a chance of winning free money by predicting Barcelona matches, accessing live commentary and also having a live chat with other Barcelona fans. For more visit https://predictbarca.com/register.php" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a>
		<a href="whatsapp://send?text=Register to get a chance of winning free money by predicting Barcelona matches, accessing live commentary and also having a live chat with other Barcelona fans. For more visit https://predictbarca.com/register.php" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
	</p>
	<?php include("footer.php"); ?>
</body>
</html>