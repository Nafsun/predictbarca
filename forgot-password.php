<?php
session_start();
include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours, forgot, password">
	<meta name="description" content="Reset your forgotten password as a barcelona predictor">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">FORGOT PASSWORD</h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg-5">
			<?php
				if(isset($_POST['username']) && isset($_POST['email'])){
					$username = strip_tags(strtolower($_POST['username']));
					$email = strip_tags(strtolower($_POST['email']));
					$pb->CheckUsernameMatchEmail($username, $email);
				}
			?>
			<?php
			if(!isset($_SESSION['username']) && !isset($_SESSION['email']) && !isset($_SESSION['randomnumber'])){
			?>
			<form method="POST">
				Email:<br><input class="form-changer" type="email" name="email" required><br>
				Username:<br><input class="form-changer" type="text" name="username"><br>
				<input class="submit-changer" type="submit" value="Submit"><br><br><br>
			</form>
			<?php
			}
			?>
			<?php
			if(isset($_POST['code'])){
				$pb->CodeChecker($_POST['code']);
			}
			?>
			<?php
				if(isset($_POST['resendcode'])){
					$pb->ResendCode();
				}
			?>
			<?php
				if(isset($_POST['cancelrequest'])){
					session_destroy();
					echo "<script>location.href = 'login.php';</script>";
				}
			?>
			<?php
			if(isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['randomnumber'])){
			?>
				<p>Enter the code sent to your email address down below:</p>
				<form method="POST">
					Code:<br><input class="form-changer" id="code" type="tel" name="code" required><br>
					<input class="submit-changer" type="submit" value="VERIFY">
				</form>
				<br>
				<form method="POST">
					<input class="form-changer" id="resendcode" type="hidden" name="resendcode"><br>
					<input id="submit-changer" type="submit" value="RESEND CODE">
				</form>
				<br>
				<form method="POST">
					<input class="form-changer" id="cancelrequest" type="hidden" name="cancelrequest"><br>
					<input class="submit-changer" type="submit" value="CANCEL">
				</form>
			<?php
			}
			?>
			<?php
				if(isset($_POST['newpassword']) && isset($_POST['repassword'])){
					if($_POST['newpassword'] == $_POST['repassword']){
						$pb->PasswordForgotChange($_POST['newpassword']);
					}else{
						echo "<p id='tmat'>Passwords do not match</p>";
					}
				}
			?>
			<?php
			if(isset($_SESSION['codematch'])){
			?>
				<form method="POST">
					New Password:<br><input class="form-changer" id="newpassword" type="text" name="newpassword" required><br>
					Re-Enter Password:<br><input class="form-changer" id="repassword" type="text" name="repassword" required><br>
					<input class="submit-changer" type="submit" value="VERIFY">
				</form>
			<?php
			}
			?>
		</div>
		<?php include("match-summary.php"); ?>
	</div>
	<?php include("match-down.php"); ?>
	<?php include("footer.php"); ?>
</body>
</html>