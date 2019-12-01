<?php
session_start();
include("dbconnect.php");
?>
<?php
if(!isset($_SESSION['username'])){
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Account</title>
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">WELCOME BACK <?php echo strtoupper($_SESSION['username']); ?></h1>
		<?php include("transfer-summary.php"); ?>
		<div id="reg-3">
			<div id="account-down">
				<div id="menu-account">
					<p id="hom"><a>HOME</a></p>
					<p id="pre"><a>PREDICT</a></p>
					<p id="tro"><a>TROPHIES</a></p>
					<p id="edp"><a>EDIT PROFILE</a></p>
					<p id="livechat"><a>LIVE CHAT</a></p>
					<p id="livecom"><a>COMMENTRY</a></p>
				</div>
				<div id="clear"></div>
				<script type="text/javascript">
					$(function(){
						setInterval(function(){
							$("#home-display2").load("display-match-predict.php");
						}, 10000);
						setInterval(function(){
							$("#predict-display2").load("display-predict-aspect.php");
						}, 60000);
					});
				</script>
				<div id="home-display">
					<?php $pb->DisplayOnlyMatchLogo(); ?>
					<div id="home-display2">
					<?php $pb->DisplayPredictMatch(); ?>
					<br>
					</div>
				</div>
				<div id="predict-display">
					<div id="predict-display2">
						<?php $pb->DisplayPredictionAspect(); ?>
					</div>
				</div>
				<?php
					if(isset($_POST['scores'])){
						$pb->PredictScoresHere($_POST['scores']);
					}
				?>
				<div id="trophies-display">
					<?php $pb->WonNaira(); ?>
				</div>
				<div id="edit-profile-display">
					<div id="edit-p-show">
						<?php $pb->ShowRegister(); ?>
						<input id='edit-change-click' class="edit-p-edit" type="button" value="Edit Profile">
						<br>
						<br>
						<div id="show-on-click-edit-profile">
							<?php $pb->UpdateRegister(); ?>
						</div>
						<?php
							if(isset($_POST['submission-editor'])){
								$fullname = $_POST['fullname'];
								$email = $_POST['email']; 
								$phonenumber = $_POST['phonenumber']; 
								$gender = $_POST['gender']; 
								$age = $_POST['age']; 
								$hobby = $_POST['hobby']; 
								$country = $_POST['country']; 
								$state = $_POST['state']; 
								$localgovt = $_POST['localgovt']; 
								$bankaccountname = $_POST['bankaccountname']; 
								$bankaccountno = $_POST['bankaccountno']; 
								$bankname = $_POST['bankname'];
								$pb->UpdatedRegister($fullname, $email, $phonenumber, $gender, $age, $hobby, $country, $state, $localgovt, $bankaccountname, $bankaccountno, $bankname);
							}
						?>
						<input id='password-change-click' class="edit-p-edit" type="button" value="Change Password">
						<br>
						<br>
						<div id="show-on-click-change-password">
							<form method="POST">
								Old Password:<br><input class="field-edit-pro" type="text" name="oldpassword" required><br>
								New Password:<br><input class="field-edit-pro" type="text" name="newpassword" required><br>
								Re-enter Password:<br><input class="field-edit-pro" type="text" name="repassword" required><br>
								<input class="predict-match-submit" type="submit" name="submit-pass" value="Submit">
							</form>
							<?php 
								if(isset($_POST['submit-pass'])){
									$oldpassword = $_POST['oldpassword'];
									$newpassword = $_POST['newpassword'];
									$repassword = $_POST['repassword'];
									if($newpassword == $repassword){
										$pb->ChangePassword($oldpassword, $newpassword);
									}else{
										echo "<p id='not-checker'>New Passwords do not Match</p>";
										echo "<script>alert('New Passwords do not Match');</script>";
									}
								}
							?>
						</div>
						<form method="POST">
							<input id='password-change-click' class="edit-p-edit" type="submit" name="submit-logout" value="Logout">
						</form>
						<?php 
							if(isset($_POST['submit-logout'])){
								session_destroy();
								echo "<script>location.href = 'login.php';</script>";
							}
						?>
					</div>
					<br>
				</div>
				<script type="text/javascript">
					$(function(){
						$("#mes-insertion-click").click(function(){
							var mes = $("#mes-insertion").val();
							if(mes == ""){
								
							}else{
								$.post("insert-chat.php", {mes1: mes});
								$("#c")[0].reset();
							}
						});
					});
				</script>
				<script type="text/javascript">
					$(function(){
						setInterval(function(){
							$("#commentry-display2").load("load-instant-commentary.php");
						}, 5000);
					});
				</script>
				<div id="livechat-display">
					<iframe id="framechat" src="chat.php" frameborder="0" scrolling="auto"></iframe>
					<form id="c" method="POST">
						<textarea id='mes-insertion' class="field-edit-pro-mes" placeholder="message" required></textarea><br>
						<input id='mes-insertion-click' class="predict-match-submit" type="button" value="Send">
					</form>
					<br>
				</div>
				<div id="commentry-display">
					<div id="commentry-display2">
						<?php $pb->CommentaryForMatchHere(); ?>
					</div>
				</div>
			</div>
		</div>
		</div>
		<?php include("match-summary.php"); ?>
		<div id="clear"></div>
	</div>
	<?php include("match-down.php"); ?>
	<?php include("footer.php"); ?>
</body>
</html>