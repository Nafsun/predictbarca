<?php
session_start();
require 'PHPMailer/PHPMailerAutoload.php';
?>
<?php
class PDOConnection{
	private $hostdb = "mysql:host=localhost;dbname=predictbarca_database";
	private $username = "root";
	private $password = "12345678";
	
	public function dbconnection(){
		try{
			$connection = new PDO($this->hostdb, $this->username, $this->password);
			return $connection;
		}catch (PDOException $e){
			echo "Connection Error:" . $e->getMessage() . "";
		}
	}
}

class PredictBarca extends PDOConnection{
	public function Register($fullname, $email, $username, $password){
		$checkforusername = $this->dbconnection()->query("SELECT username FROM loginpredictor");
		if($checkforusername->fetchColumn() === $username){
			echo "<p id='not-checker'>There is already someone with that username, use another username</p>";
		}else{
			date_default_timezone_set("Africa/Lagos");
			$dateofreg = date('d/m/y', time());
			$hash = md5(rand(10, 100));
			if(!empty($_SERVER["HTTP_CLIENT_IP"])){
				//check for ip from share internet
				$ip = $_SERVER["HTTP_CLIENT_IP"];
			}elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
				// Check for the Proxy User
				$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			}else{
				$ip = $_SERVER["REMOTE_ADDR"];
			}
			$check_s = $this->dbconnection()->query("SELECT username FROM registerpredictor WHERE username = {$this->dbconnection()->quote($username)}");
			if($check_s->fetchColumn() === $username){
				echo "<script>alert('Someone have already registered with this username, choose another username');</script>";
				echo "<p id='not-checker'>Someone have already registered with this username, choose another username</p>";
			}else{
				$register = $this->dbconnection()->prepare("INSERT INTO registerpredictor (fullname, email, username, hash, dateofreg, ip) VALUES (?, ?, ?, ?, ?, ?)");
				$register->execute([$fullname, $email, $username, $hash, $dateofreg, $ip]);
				$verify = $this->dbconnection()->prepare("INSERT INTO loginpredictor (username, password) VALUES (?, ?)");
				$verify->execute([$username, $password]);
				$s = $this->dbconnection()->prepare("INSERT INTO newsletter(email, hash) VALUES(?, ?)");
				$s->execute([$email, $hash]);
				$_SESSION['verify-send'] = "email verification";
				$this->SendEmailVerification($email, $hash);
			}
		}
	}
	public function Login($username, $password){
		$login = $this->dbconnection()->prepare("SELECT password FROM loginpredictor WHERE username = ?");
		$login->execute([$username]);
		if($login->fetchColumn() === $password){
			$check_acti = $this->dbconnection()->query("SELECT activation FROM registerpredictor WHERE username = {$this->dbconnection()->quote($username)}");
			if($check_acti->fetchColumn() == 1){
				$_SESSION['username'] = $username;
				echo "<script>location.href = 'account.php';</script>";
			}else{
				echo "<p id='not-checker'>You have not activated your account, check your email to verify</p>";
			}
		}else{
			echo "<p id='not-checker'>Username or Password incorrect</p>";
		}
	}
	public function PageCreation($pageurl, $titleofpage, $keywordofpage, $descriptionofpage, $h1title, $image, $video, $titleofcontent, $content, $newstype){
		date_default_timezone_set("Africa/Lagos");
		$date = date('d/m/y', time());
		$time = date('h:i:s a', time());
		$day = date('D', time());
		if($newstype == "latest barcelona news"){
			$pc = $this->dbconnection()->prepare("INSERT INTO barcelonapages(pageurl, titleofpage, keywordofpage, descriptionofpage, h1title, 
			image, titleofcontent, content, date, time, day, newstype) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$pc->execute([$pageurl, $titleofpage, $keywordofpage, $descriptionofpage, $h1title, $image, $titleofcontent, $content, $date, $time, $day, $newstype]);
			$file = "../news/{$pageurl}.php";
			$open = fopen($file, "w+");
			fwrite($open, "<?php include('../dbconnect.php'); ?>
							<!DOCTYPE html>
							<html>
							<head>
								<title>{$titleofpage}</title>
								<meta name='keywords' content='{$keywordofpage}'>
								<meta name='description' content='{$descriptionofpage}'>
								<?php include('head.php'); ?>
								<meta property='og:image' content='https://predictbarca.com/images/{$image}'>
<meta property='og:image:width' content='1200'>
<meta property='og:image:height' content='630'>
							</head>
							<body>
								<?php include('menu.php'); ?>
								<div id='match-top'>
									<h1 id='today-match-2'>{$h1title}</h1>
									<?php include('transfer-summary.php'); ?>
									<div id='reg-5'>
										<div id='lbn'>
											<img class='news' src='../images/{$image}' alt='{$titleofpage}'>
											<div id='receiver-2'>
												<h2>{$titleofcontent}</h2>
												{$content}. <span>Posted on {$date} at {$time}</span>
											</div>
										</div>
										<br>
										<br>
									</div>
									<?php include('match-summary.php'); ?>
									<div id='clear'></div>
								</div>
								<?php include('match-down.php'); ?>
								<p id='share-post'>Share this page on: 
									<a href='https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/news/{$pageurl}.php&quote={$descriptionofpage}' target='__blank'><img class='social' src='../images/facebook.png' alt='facebook'></a>
									<a href='https://www.twitter.com/intent/tweet?text={$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php' target='__blank'><img class='social' src='../images/twitter.png' alt='twitter'></a>
									<a href='whatsapp://send?text={$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php' target='__blank'><img class='social' src='../images/whatsapp.png' alt='whatsapp'></a>
								</p>
								<?php include('footer.php'); ?>
							</body>
							</html>");
			fclose($open);
			$news = $this->dbconnection()->query("SELECT email FROM newsletter WHERE verify = 1");
			while($row = $news->fetch()){
				$mail = new PHPMailer;
				$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
				$mail->addAddress($row['email']);
				$mail->isHTML(true);
				$mail->Subject  = 'Latest Barcelona News';
				$mail->Body     = "<div align='center'><h1>{$titleofcontent}</h1><h4>{$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php</h4></div>";
				if(!$mail->send()) {
					echo '<p id="tmat">Message was not sent.</p>';
					echo 'Mailer error: ' . $mail->ErrorInfo;
				}else{
					passthru;
				}
			}
			echo "<p id='not-checker'>Latest Barcelona News Page has being created</p>";
		}
		if($newstype == "transfer news"){
			$pc = $this->dbconnection()->prepare("INSERT INTO barcelonapages(pageurl, titleofpage, keywordofpage, descriptionofpage, h1title, 
			image, titleofcontent, content, date, time, day, newstype) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$pc->execute([$pageurl, $titleofpage, $keywordofpage, $descriptionofpage, $h1title, $image, $titleofcontent, $content, $date, $time, $day, $newstype]);
			$file = "../news/{$pageurl}.php";
			$open = fopen($file, "w+");
			fwrite($open, "<?php include('../dbconnect.php'); ?>
							<!DOCTYPE html>
							<html>
							<head>
								<title>{$titleofpage}</title>
								<meta name='keywords' content='{$keywordofpage}'>
								<meta name='description' content='{$descriptionofpage}'>
								<?php include('head.php'); ?>
								<meta property='og:image' content='https://predictbarca.com/images/{$image}'>
<meta property='og:image:width' content='1200'>
<meta property='og:image:height' content='630'>
							</head>
							<body>
								<?php include('menu.php'); ?>
								<div id='match-top'>
									<h1 id='today-match-2'>{$h1title}</h1>
									<?php include('transfer-summary.php'); ?>
									<div id='reg'>
										<div id='tn'>
											<div id='players2'>
												<img class='news' src='../images/{$image}' alt='{$titleofpage}'>
												<h3>{$titleofcontent}</h3>
												<p>{$content}. <span>Posted on {$date} at {$time}</span></p>
											</div>
											<div id='clear'></div>
										</div>
										<br><br>
									</div>
									<?php include('match-summary.php'); ?>
									<div id='clear'></div>
								</div>
								<?php include('match-down.php'); ?>
								<p id='share-post'>Share this page on: 
									<a href='https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/news/{$pageurl}.php&quote={$descriptionofpage}' target='__blank'><img class='social' src='../images/facebook.png' alt='facebook'></a>
									<a href='https://www.twitter.com/intent/tweet?text={$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php' target='__blank'><img class='social' src='../images/twitter.png' alt='twitter'></a>
									<a href='whatsapp://send?text={$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php' target='__blank'><img class='social' src='../images/whatsapp.png' alt='whatsapp'></a>
								</p>
								<?php include('footer.php'); ?>
							</body>
							</html>");
			fclose($open);
			$news = $this->dbconnection()->query("SELECT email FROM newsletter WHERE verify = 1");
			while($row = $news->fetch()){
				$mail = new PHPMailer;
				$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
				$mail->addAddress($row['email']);
				$mail->isHTML(true);
				$mail->Subject  = 'Transfer News';
				$mail->Body     = "<div align='center'><h1>{$titleofcontent}</h1><h4>{$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php</h4></div>";
				if(!$mail->send()) {
					echo '<p id="tmat">Message was not sent.</p>';
					echo 'Mailer error: ' . $mail->ErrorInfo;
				}else{
					passthru;
				}
			}
			echo "<p id='not-checker'>Transfer Page has being created</p>";
		}
		if($newstype == "video highlights"){
			$pc = $this->dbconnection()->prepare("INSERT INTO barcelonapages(pageurl, titleofpage, keywordofpage, descriptionofpage, h1title, 
			image, video, titleofcontent, content, date, time, day, newstype) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$pc->execute([$pageurl, $titleofpage, $keywordofpage, $descriptionofpage, $h1title, $image, $video, $titleofcontent, $content, $date, $time, $day, $newstype]);
			$file = "../news/{$pageurl}.php";
			$open = fopen($file, "w+");
			fwrite($open, "<?php include('../dbconnect.php'); ?>
							<!DOCTYPE html>
							<html>
							<head>
								<title>{$titleofpage}</title>
								<meta name='keywords' content='{$keywordofpage}'>
								<meta name='description' content='{$descriptionofpage}'>
								<?php include('head.php'); ?>
								<meta property='og:image' content='https://predictbarca.com/images/{$image}'>
<meta property='og:image:width' content='1200'>
<meta property='og:image:height' content='630'>
							</head>
							<body>
								<?php include('menu.php'); ?>
								<div id='match-top'>
									<h1 id='today-match-2'>{$h1title}</h1>
									<?php include('transfer-summary.php'); ?>
									<div id='reg-5'>
										<div id='bvh'>
											<video src'../video/{$video}' class='news-video' controls></video>
											<div id='clear'></div>
											<div id='receiver-3'>
												<h2>{$titleofcontent}</h2>
												{$content}. <span>Posted on {$date} at {$time}</span>
											</div>
										</div>
										<br><br>
									</div>
									<?php include('match-summary.php'); ?>
									<div id='clear'></div>
								</div>
								<?php include('match-down.php'); ?>
								<p id='share-post'>Share this page on: 
									<a href='https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/news/{$pageurl}.php&quote={$descriptionofpage}' target='__blank'><img class='social' src='../images/facebook.png' alt='facebook'></a>
									<a href='https://www.twitter.com/intent/tweet?text={$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php' target='__blank'><img class='social' src='../images/twitter.png' alt='twitter'></a>
									<a href='whatsapp://send?text={$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php' target='__blank'><img class='social' src='../images/whatsapp.png' alt='whatsapp'></a>
								</p>
								<?php include('footer.php'); ?>
							</body>
							</html>");
			fclose($open);
			$news = $this->dbconnection()->query("SELECT email FROM newsletter WHERE verify = 1");
			while($row = $news->fetch()){
				$mail = new PHPMailer;
				$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
				$mail->addAddress($row['email']);
				$mail->isHTML(true);
				$mail->Subject  = 'Video Highlights';
				$mail->Body     = "<div align='center'><h1>{$titleofcontent}</h1><h4>{$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php</h4></div>";
				if(!$mail->send()) {
					echo '<p id="tmat">Message was not sent.</p>';
					echo 'Mailer error: ' . $mail->ErrorInfo;
				}else{
					passthru;
				}
			}
			echo "<p id='not-checker'>Video Page has being created</p>";
		}
	}
	public function PageCreationEdit(){
		$page_edit = $this->dbconnection()->query("SELECT * FROM barcelonapages ORDER BY id DESC LIMIT 1");
		while($row = $page_edit->fetch()){
			echo "<form method='POST'>
			<input class='form-changer' type='hidden' name='id' value='{$row['id']}'>
			Page Url:<br><input class='form-changer' type='text' name='pageurl' value='{$row['pageurl']}' required><br>
			Title of Page:<br><input class='form-changer' type='text' name='titleofpage' value='{$row['titleofpage']}' required><br>
			Keyword of Page:<br><input class='form-changer' type='text' name='keywordofpage' value='{$row['keywordofpage']}' required><br>
			Description of Page:<br><input class='form-changer' type='text' name='descriptionofpage' value='{$row['descriptionofpage']}' required><br>
			h1 Title:<br><input class='form-changer' type='text' name='h1title' value='{$row['h1title']}' required><br>
			Image:<br><input class='form-changer' type='text' name='image' value='{$row['image']}' required><br>
			Video:<br><input class='form-changer' type='text' name='video' value='{$row['video']}' required><br>
			Title of Content:<br><input class='form-changer' type='text' name='titleofcontent' value='{$row['titleofcontent']}' required><br>	
			Content:<textarea class='field-edit-pro-mes' id='content' name='content' required>{$row['content']}</textarea><br>
			News Type:<br><select class='form-changer' name='newstype' required>
					<option value='' selected>select news</option>
					<option value='transfer news'>Transfer News</option>
					<option value='latest barcelona news'>Latest Barcelona News</option>
					<option value='video highlights'>Video Highlights</option>
					</select><br>
			<input class='submit-changer' type='submit' name='submit-page-news' value='Update'>
		</form><br>";
			echo "<form method='POST'><input class='form-changer' type='hidden' name='id' value='{$row['id']}'>
				<input class='form-changer' type='hidden' name='pageurl' value='{$row['pageurl']}'>
			<input class='submit-changer' type='submit' name='delete-page-news' value='Delete'></form>";
		}
	}
	public function LoadMorePages($load_more){
		$page_edit = $this->dbconnection()->query("SELECT * FROM barcelonapages ORDER BY id DESC LIMIT {$load_more}");
		while($row = $page_edit->fetch()){
			echo "<br><form method='POST'>
			<input class='form-changer' type='hidden' name='id' value='{$row['id']}'>
			Page Url:<br><input class='form-changer' type='text' name='pageurl' value='{$row['pageurl']}' required><br>
			Title of Page:<br><input class='form-changer' type='text' name='titleofpage' value='{$row['titleofpage']}' required><br>
			Keyword of Page:<br><input class='form-changer' type='text' name='keywordofpage' value='{$row['keywordofpage']}' required><br>
			Description of Page:<br><input class='form-changer' type='text' name='descriptionofpage' value='{$row['descriptionofpage']}' required><br>
			h1 Title:<br><input class='form-changer' type='text' name='h1title' value='{$row['h1title']}' required><br>
			Image:<br><input class='form-changer' type='text' name='image' value='{$row['image']}' required><br>
			Video:<br><input class='form-changer' type='text' name='video' value='{$row['video']}' required><br>
			Title of Content:<br><input class='form-changer' type='text' name='titleofcontent' value='{$row['titleofcontent']}' required><br>	
			Content:<textarea class='field-edit-pro-mes' id='content' name='content' required>{$row['content']}</textarea><br>
			News Type:<br><select class='form-changer' name='newstype' required>
					<option value='' selected>select news</option>
					<option value='transfer news'>Transfer News</option>
					<option value='latest barcelona news'>Latest Barcelona News</option>
					<option value='video highlights'>Video Highlights</option>
					</select><br>
			<input class='submit-changer' type='submit' name='submit-page-news' value='Update'>
		</form><br>";
		echo "<form method='POST'><input class='form-changer' type='hidden' name='id' value='{$row['id']}'>
				<input class='form-changer' type='hidden' name='pageurl' value='{$row['pageurl']}'>
			<input class='submit-changer' type='submit' name='delete-page-news' value='Delete'></form>";
		}
	}
	public function PageCreationEditLBN($id, $pageurl, $titleofpage, $keywordofpage, $descriptionofpage, $h1title, $image, $titleofcontent, $content, $newstype){
		date_default_timezone_set("Africa/Lagos");
		$date = date('d/m/y', time());
		$time = date('h:i:s a', time());
		$day = date('D', time());
		$lbn = $this->dbconnection()->prepare("UPDATE barcelonapages SET pageurl = ?, titleofpage = ?, keywordofpage = ?, descriptionofpage = ?, 
		h1title = ?, image = ?, titleofcontent = ?, content = ?, date = ?, time = ?, day = ?, newstype = ? WHERE id = {$this->dbconnection()->quote($id)}");
		$lbn->execute([$pageurl, $titleofpage, $keywordofpage, $descriptionofpage, $h1title, $image, $titleofcontent, $content, $date, $time, $day, $newstype]);
		$file = "../news/{$pageurl}.php";
		$open = fopen($file, "w+");
		fwrite($open, "<?php include('../dbconnect.php'); ?>
						<!DOCTYPE html>
						<html>
						<head>
							<title>{$titleofpage}</title>
							<meta name='keywords' content='{$keywordofpage}'>
							<meta name='description' content='{$descriptionofpage}'>
							<?php include('head.php'); ?>
							<meta property='og:image' content='https://predictbarca.com/images/{$image}'>
<meta property='og:image:width' content='1200'>
<meta property='og:image:height' content='630'>
						</head>
						<body>
							<?php include('menu.php'); ?>
							<div id='match-top'>
								<h1 id='today-match-2'>{$h1title}</h1>
								<?php include('transfer-summary.php'); ?>
								<div id='reg-5'>
									<div id='lbn'>
										<img class='news' src='../images/{$image}' alt='{$titleofpage}'>
										<div id='receiver-2'>
											<h2>{$titleofcontent}</h2>
											{$content}. <span>Updated on {$date} at {$time}</span>
										</div>
									</div>
									<br>
									<br>
								</div>
								<?php include('match-summary.php'); ?>
								<div id='clear'></div>
							</div>
							<?php include('match-down.php'); ?>
							<p id='share-post'>Share this page on: 
								<a href='https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/news/{$pageurl}.php&quote={$descriptionofpage}' target='__blank'><img class='social' src='../images/facebook.png' alt='facebook'></a>
								<a href='https://www.twitter.com/intent/tweet?text={$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php' target='__blank'><img class='social' src='../images/twitter.png' alt='twitter'></a>
								<a href='whatsapp://send?text={$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php' target='__blank'><img class='social' src='../images/whatsapp.png' alt='whatsapp'></a>
							</p>
						<?php include('footer.php'); ?>
						</body>
						</html>");
		fclose($open);
		echo "<p id='not-checker'>Latest Barcelona News Page has being updated</p>";
	}
	public function PageCreationEditTN($id, $pageurl, $titleofpage, $keywordofpage, $descriptionofpage, $h1title, $image, $titleofcontent, $content, $newstype){
		date_default_timezone_set("Africa/Lagos");
		$date = date('d/m/y', time());
		$time = date('h:i:s a', time());
		$day = date('D', time());
		$lbn = $this->dbconnection()->prepare("UPDATE barcelonapages SET pageurl = ?, titleofpage = ?, keywordofpage = ?, descriptionofpage = ?, 
		h1title = ?, image = ?, titleofcontent = ?, content = ?, date = ?, time = ?, day = ?, newstype = ? WHERE id = {$this->dbconnection()->quote($id)}");
		$lbn->execute([$pageurl, $titleofpage, $keywordofpage, $descriptionofpage, $h1title, $image, $titleofcontent, $content, $date, $time, $day, $newstype]);
		$file = "../news/{$pageurl}.php";
		$open = fopen($file, "w+");
		fwrite($open, "<?php include('../dbconnect.php'); ?>
						<!DOCTYPE html>
							<html>
							<head>
								<title>{$titleofpage}</title>
								<meta name='keywords' content='{$keywordofpage}'>
								<meta name='description' content='{$descriptionofpage}'>
								<?php include('head.php'); ?>
								<meta property='og:image' content='https://predictbarca.com/images/{$image}'>
<meta property='og:image:width' content='1200'>
<meta property='og:image:height' content='630'>
							</head>
							<body>
								<?php include('menu.php'); ?>
								<div id='match-top'>
									<h1 id='today-match-2'>{$h1title}</h1>
									<?php include('transfer-summary.php'); ?>
									<div id='reg'>
										<div id='tn'>
											<div id='players2'>
												<img class='news' src='../images/{$image}' alt='{$titleofpage}'>
												<h3>{$titleofcontent}</h3>
												<p>{$content}. <span>Updated on {$date} at {$time}</span></p>
											</div>
											<div id='clear'></div>
										</div>
										<br><br>
									</div>
									<?php include('match-summary.php'); ?>
									<div id='clear'></div>
								</div>
								<?php include('match-down.php'); ?>
								<p id='share-post'>Share this page on: 
									<a href='https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/news/{$pageurl}.php&quote={$descriptionofpage}' target='__blank'><img class='social' src='../images/facebook.png' alt='facebook'></a>
									<a href='https://www.twitter.com/intent/tweet?text={$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php' target='__blank'><img class='social' src='../images/twitter.png' alt='twitter'></a>
									<a href='whatsapp://send?text={$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php' target='__blank'><img class='social' src='../images/whatsapp.png' alt='whatsapp'></a>
								</p>
								<?php include('footer.php'); ?>
							</body>
							</html>");
		fclose($open);
		echo "<p id='not-checker'>Transfer News Page has being updated</p>";
	}
	public function PageCreationEditVH($id, $pageurl, $titleofpage, $keywordofpage, $descriptionofpage, $h1title, $image, $video, $titleofcontent, $content, $newstype){
		date_default_timezone_set("Africa/Lagos");
		$date = date('d/m/y', time());
		$time = date('h:i:s a', time());
		$day = date('D', time());
		$lbn = $this->dbconnection()->prepare("UPDATE barcelonapages SET pageurl = ?, titleofpage = ?, keywordofpage = ?, descriptionofpage = ?, 
		h1title = ?, image = ?, video = ?, titleofcontent = ?, content = ?, date = ?, time = ?, day = ?, newstype = ? WHERE id = {$this->dbconnection()->quote($id)}");
		$lbn->execute([$pageurl, $titleofpage, $keywordofpage, $descriptionofpage, $h1title, $image, $video, $titleofcontent, $content, $date, $time, $day, $newstype]);
		$file = "../news/{$pageurl}.php";
		$open = fopen($file, "w+");
		fwrite($open, "<?php include('../dbconnect.php'); ?>
						<!DOCTYPE html>
							<html>
							<head>
								<title>{$titleofpage}</title>
								<meta name='keywords' content='{$keywordofpage}'>
								<meta name='description' content='{$descriptionofpage}'>
								<?php include('head.php'); ?>
								<meta property='og:image' content='https://predictbarca.com/images/{$image}'>
<meta property='og:image:width' content='1200'>
<meta property='og:image:height' content='630'>
							</head>
							<body>
								<?php include('menu.php'); ?>
								<div id='match-top'>
									<h1 id='today-match-2'>{$h1title}</h1>
									<?php include('transfer-summary.php'); ?>
									<div id='reg-5'>
										<div id='bvh'>
											<video src='../video/{$video}' class='news-video' controls></video>
											<div id='clear'></div>
											<div id='receiver-3'>
												<h2>{$titleofcontent}</h2>
												{$content}. <span>Updated on {$date} at {$time}</span>
											</div>
										</div>
										<br><br>
									</div>
									<?php include('match-summary.php'); ?>
									<div id='clear'></div>
								</div>
								<?php include('match-down.php'); ?>
								<p id='share-post'>Share this page on: 
									<a href='https://www.facebook.com/sharer/sharer.php?u=https://predictbarca.com/news/{$pageurl}.php&quote={$descriptionofpage}' target='__blank'><img class='social' src='../images/facebook.png' alt='facebook'></a>
									<a href='https://www.twitter.com/intent/tweet?text={$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php' target='__blank'><img class='social' src='../images/twitter.png' alt='twitter'></a>
									<a href='whatsapp://send?text={$descriptionofpage} For more visit https://predictbarca.com/news/{$pageurl}.php' target='__blank'><img class='social' src='../images/whatsapp.png' alt='whatsapp'></a>
								</p>
								<?php include('footer.php'); ?>
							</body>
							</html>");
		fclose($open);
		echo "<p id='not-checker'>Video Highlight Page has being updated</p>";
	}
	public function DeletePageNews($id, $pageurl){
		unlink("../news/{$pageurl}.php");
		$this->dbconnection()->query("DELETE FROM barcelonapages WHERE id = {$this->dbconnection()->quote($id)}");
		echo "<p id='not-checker'>Content has being deleted</p>";
	}
	public function DisplayNewsSummary($n){
		$news_n = $this->dbconnection()->query("SELECT * FROM barcelonapages WHERE newstype = {$this->dbconnection()->quote($n)} ORDER BY id DESC LIMIT 5");
		while($row = $news_n->fetch()){
			echo "<p><img src='images/{$row['image']}' id='sumimg'><a class='linkgo' href='news/{$row['pageurl']}.php'>{$row['titleofcontent']}</a></p><br><div id='clear'></div>";
		}
	}
	public function DisplayNewsSummary3($n){
		$news_n = $this->dbconnection()->query("SELECT * FROM barcelonapages WHERE newstype = {$this->dbconnection()->quote($n)} ORDER BY id DESC LIMIT 5");
		while($row = $news_n->fetch()){
			echo "<p><img src='../images/{$row['image']}' id='sumimg'><a class='linkgo' href='{$row['pageurl']}.php'>{$row['titleofcontent']}</a></p><br><div id='clear'></div>";
		}
	}
	public function DisplayNewsSummary2($n){
		$news_n = $this->dbconnection()->query("SELECT * FROM barcelonapages WHERE newstype = {$this->dbconnection()->quote($n)} ORDER BY id DESC LIMIT 5");
		while($row = $news_n->fetch()){
			echo "<p><img src='../images/{$row['image']}' id='sumimg'><a class='linkgo' href='{$row['pageurl']}.php'>{$row['titleofcontent']}</a></p><br><div id='clear'></div>";
		}
	}
	public function DisplayAllNews(){
		$dan = $this->dbconnection()->query("SELECT * FROM barcelonapages ORDER BY id DESC LIMIT 10");
		while($row = $dan->fetch()){
			echo "<p><img src='images/{$row['image']}' id='sumimg1'><a class='linkgo' id='barca-n' href='news/{$row['pageurl']}.php'>{$row['titleofcontent']}</a></p><br><div id='clear'></div>";
		}
	}
	public function DisplayAllNewsMore($load){
		$dan = $this->dbconnection()->query("SELECT * FROM barcelonapages ORDER BY id DESC LIMIT {$load}");
		while($row = $dan->fetch()){
			echo "<p><img src='images/{$row['image']}' id='sumimg1'><a class='linkgo' id='barca-n' href='news/{$row['pageurl']}.php'>{$row['titleofcontent']}</a></p><br><div id='clear'></div>";
		}
	}
	public function Scores($opponentclub, $score){
		date_default_timezone_set("Africa/Lagos");
		$date = date('d/m/y', time());
		$time = date('h:i:s a', time());
		$day = date('D', time());
		$s = $this->dbconnection()->prepare("INSERT INTO barcelonascores(opponentclub, scores, date, time, day) VALUES (?, ?, ?, ?, ?)");
		$s->execute([$opponentclub, $score, $date, $time, $day]);
		$scores = $this->dbconnection()->query("SELECT email FROM newsletter WHERE verify = 1");
		while($row = $scores->fetch()){
			$mail = new PHPMailer;
			$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
			$mail->addAddress($row['email']);
			$mail->isHTML(true);
			$mail->Subject  = 'Barcelona Scores';
			$mail->Body     = "<div align='center'><h1>Barcelona vs " . ucwords($opponentclub) . "</h1><h4>The match has ended {$score}. For more visit https://predictbarca.com/barcelona-scores.php</h4></div>";
			if(!$mail->send()) {
				echo '<p id="tmat">Message was not sent.</p>';
				echo 'Mailer error: ' . $mail->ErrorInfo;
			}else{
				passthru;
			}
		}
		echo "<p id='not-checker'>Scores Uploaded</p>";
	}
	public function DisplayAllScores(){
		$das = $this->dbconnection()->query("SELECT * FROM barcelonascores ORDER BY id DESC LIMIT 10");
		while($row = $das->fetch()){
			echo "<p>". ucfirst($row['club']) . " vs " . $row['opponentclub'] . " scores: <span id='scores-here'>" . $row['scores'] . "</span> on " . ucfirst($row['date']) . "</p>";
		}
	}
	public function DisplayAllScoresMore($load){
		$das = $this->dbconnection()->query("SELECT * FROM barcelonascores ORDER BY id DESC LIMIT {$load}");
		while($row = $das->fetch()){
			echo "<p>". ucfirst($row['club']) . " vs " . $row['opponentclub'] . " scores: <span id='scores-here'>" . $row['scores'] . "</span> on " . ucfirst($row['date']) . "</p>";
		}
	}
	public function DisplayPredictions(){
		$dp = $this->dbconnection()->query("SELECT * FROM allpredict ORDER BY id DESC LIMIT 10");
		while($row = $dp->fetch()){
			echo "<p>" . ucwords($row['name']) . " predict that the " . ucfirst($row['myclub']) . " vs {$row['opponentclub']} match on {$row['date']} will end : <span id='scores-here'>{$row['scores']}</span></p>";
		}
	}
	public function DisplayPredictionsMore($load){
		$dp = $this->dbconnection()->query("SELECT * FROM allpredict ORDER BY id DESC LIMIT {$load}");
		while($row = $dp->fetch()){
			echo "<p>" . ucwords($row['name']) . " predict that the " . ucfirst($row['myclub']) . " vs {$row['opponentclub']} match on {$row['date']} will end : <span id='scores-here'>{$row['scores']}</span></p>";
		}
	}
	public function DisplayLatestBarcelonaNews(){
		$lbn = 'latest barcelona news';
		$dlbn = $this->dbconnection()->query("SELECT * FROM barcelonapages WHERE newstype = {$this->dbconnection()->quote($lbn)} ORDER BY id DESC LIMIT 5");
		while($row = $dlbn->fetch()){
			echo "<img class='news' src='images/{$row['image']}' alt='news image'>
				<div id='receiver-2'>
					<h2>{$row['titleofcontent']}</h2>
					{$row['content']}. <span>Updated on {$row['date']} at {$row['time']}</span>
				</div><br><br><div id='clear'></div>";
		}
	}
	public function DisplayLatestBarcelonaNewsMore($load){
		$lbn = 'latest barcelona news';
		$dlbn = $this->dbconnection()->query("SELECT * FROM barcelonapages WHERE newstype = {$this->dbconnection()->quote($lbn)} ORDER BY id DESC LIMIT {$load}");
		while($row = $dlbn->fetch()){
			echo "<img class='news' src='images/{$row['image']}' alt='news image'>
				<div id='receiver-2'>
					<h2>{$row['titleofcontent']}</h2>
					{$row['content']}. <span>Updated on {$row['date']} at {$row['time']}</span>
				</div><br><br><div id='clear'></div>";
		}
	}
	public function DisplayTransferNews(){
		$tn = 'transfer news';
		$dtn = $this->dbconnection()->query("SELECT * FROM barcelonapages WHERE newstype = {$this->dbconnection()->quote($tn)} ORDER BY id DESC LIMIT 5");
		while($row = $dtn->fetch()){
			echo "<div id='players2'>
					<img class='news' src='images/{$row['image']}' alt='news image'>
					<h3>{$row['titleofcontent']}</h3>
					<p>{$row['content']}. <span>Updated on {$row['date']} at {$row['time']}</span></p>
				</div>
				<div id='clear'></div>";
		}
	}
	public function DisplayTransferNewsMore($load){
		$tn = 'transfer news';
		$dtn = $this->dbconnection()->query("SELECT * FROM barcelonapages WHERE newstype = {$this->dbconnection()->quote($tn)} ORDER BY id DESC LIMIT {$load}");
		while($row = $dtn->fetch()){
			echo "<div id='players2'>
					<img class='news' src='images/{$row['image']}' alt='news image'>
					<h3>{$row['titleofcontent']}</h3>
					<p>{$row['content']}. <span>Updated on {$row['date']} at {$row['time']}</span></p>
				</div>
				<div id='clear'></div>";
		}
	}
	public function Squad($playerimage, $playername, $playerbio){
		$sd = $this->dbconnection()->prepare("INSERT INTO barcelonasquad (image, playername, playerbio) VALUES (?, ?, ?)");
		$sd->execute([$playerimage, $playername, $playerbio]);
		echo "<p id='not-checker'>Players Info Inserted</p>";
	}
	public function DisplaySquad(){
		$ds = $this->dbconnection()->query("SELECT * FROM barcelonasquad ORDER BY id DESC LIMIT 10");
		while($row = $ds->fetch()){
			echo "<div id='players'>
					<img class='news' src='images/{$row['image']}' alt='news image'>
					<h3>{$row['playername']}</h3>
					<p>{$row['playerbio']}</p>
				</div>
				<div id='clear'></div>";
		}
	}
	public function DisplaySquadMore($load){
		$ds = $this->dbconnection()->query("SELECT * FROM barcelonasquad ORDER BY id DESC LIMIT {$load}");
		while($row = $ds->fetch()){
			echo "<div id='players'>
					<img class='news' src='images/{$row['image']}' alt='news image'>
					<h3>{$row['playername']}</h3>
					<p>{$row['playerbio']}</p>
				</div>
				<div id='clear'></div>";
		}
	}
	public function SquadEditor(){
		$se = $this->dbconnection()->query("SELECT * FROM barcelonasquad ORDER BY id DESC LIMIT 1");
		while($row = $se->fetch()){
			echo "<form method='POST'>
				<input class='form-changer' type='hidden' name='id' value='{$row['id']}' required><br>
				Player Image:<br><input class='form-changer' type='text' name='playerimage' value='{$row['image']}' required><br>
				Player Name:<br><input class='form-changer' type='text' name='playername' value='{$row['playername']}' required><br>
				Player Bio:<br><textarea class='field-edit-pro-mes' type='text' name='playerbio' required>{$row['playerbio']}</textarea><br>
				<input class='submit-changer' type='submit' name='submit-squad-edit' value='Update'>
				</form><br>
				<form method='POST'>
				<input class='form-changer' type='hidden' name='id' value='{$row['id']}' required><br>
				<input class='submit-changer' type='submit' name='submit-squad-delete' value='Delete'>
				</form>";
		}
	}
	public function ChangeSquadEditor($playerimage, $playername, $playerbio, $id){
		$cse = $this->dbconnection()->prepare("UPDATE barcelonasquad SET image = ?, playername = ?, playerbio = ? WHERE id = {$this->dbconnection()->quote($id)}");
		$cse->execute([$playerimage, $playername, $playerbio]);
		echo "<p id='not-checker'>Player Squad Updated</p>";
	}
	public function SquadDelete($id){
		$this->dbconnection()->query("DELETE FROM barcelonasquad WHERE id = {$this->dbconnection()->quote($id)}");
		echo "<p id='not-checker'>Player Squad is deleted</p>";
	}
	public function SquadEditorMore($load){
		$se = $this->dbconnection()->query("SELECT * FROM barcelonasquad ORDER BY id DESC LIMIT {$load}");
		while($row = $se->fetch()){
			echo "<form method='POST'>
				<input class='form-changer' type='hidden' name='id' value='{$row['id']}' required><br>
				Player Image:<br><input class='form-changer' type='text' name='playerimage' value='{$row['image']}' required><br>
				Player Name:<br><input class='form-changer' type='text' name='playername' value='{$row['playername']}' required><br>
				Player Bio:<br><textarea class='field-edit-pro-mes' type='text' name='playerbio' required>{$row['playerbio']}</textarea><br>
				<input class='submit-changer' type='submit' name='submit-squad-edit' value='Submit'>
				</form><br><form method='POST'>
				<input class='form-changer' type='hidden' name='id' value='{$row['id']}' required><br>
				<input class='submit-changer' type='submit' name='submit-squad-delete' value='Delete'>
				</form>";
		}
	}
	public function DisplayVideoNews(){
		$vh = 'video highlights';
		$dvh = $this->dbconnection()->query("SELECT * FROM barcelonapages WHERE newstype = {$this->dbconnection()->quote($vh)} ORDER BY id DESC LIMIT 3");
		while($row = $dvh->fetch()){
			echo "<video src='video/{$row['video']}' class='news-video' controls></video>
				<div id='clear'></div>
				<div id='receiver-3'>
					<h2>{$row['titleofcontent']}</h2>
					{$row['content']}. <span>Posted on {$row['date']} at {$row['time']}</span>
				</div>";
		}
	}
	public function DisplayVideoNewsMore($load){
		$vh = 'video highlights';
		$dvh = $this->dbconnection()->query("SELECT * FROM barcelonapages WHERE newstype = {$this->dbconnection()->quote($vh)} ORDER BY id DESC LIMIT {$load}");
		while($row = $dvh->fetch()){
			echo "<video src='video/{$row['video']}' class='news-video' controls></video>
				<div id='clear'></div>
				<div id='receiver-3'>
					<h2>{$row['titleofcontent']}</h2>
					{$row['content']}. <span>Posted on {$row['date']} at {$row['time']}</span>
				</div>";
		}
	}
	public function BarcelonaFutureMatches($opponentclub, $date, $time, $day){
		$bfm = $this->dbconnection()->prepare("INSERT INTO barcelonamatches(opponentclub, date, time, day) VALUES (?, ?, ?, ?)");
		$bfm->execute([$opponentclub, $date, $time, $day]);
		$barca_m = $this->dbconnection()->query("SELECT email FROM newsletter WHERE verify = 1");
		while($row = $barca_m->fetch()){
			$mail = new PHPMailer;
			$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
			$mail->addAddress($row['email']);
			$mail->isHTML(true);
			$mail->Subject  = 'Barcelona Match';
			$mail->Body     = "<div align='center'><h1>Barcelona Vs {$opponentclub}</h1><h4>The match will began on {$date} at {$time} on {$day}. For more visit https://predictbarca.com/barcelona-matches.php</h4></div>";
			if(!$mail->send()) {
				echo '<p id="tmat">Message was not sent.</p>';
				echo 'Mailer error: ' . $mail->ErrorInfo;
			}else{
				passthru;
			}
		}
		echo "<p id='not-checker'>Match Inserted</p>";
	}
	public function DisplayBarcelonaFutureMatches($no){
		$dbfm = $this->dbconnection()->query("SELECT * FROM barcelonamatches ORDER BY id DESC LIMIT {$no}");
		while($row = $dbfm->fetch()){
			echo "<p>". ucfirst($row['club']) . " vs " . ucwords($row['opponentclub']) . " match - " . ucfirst($row['date']) . " at " . $row['time'] . " on " . ucfirst($row['day']). "</p>";
		}
	}
	public function DisplayBarcelonaFutureMatchesMore($load_more){
		$dbfm = $this->dbconnection()->query("SELECT * FROM barcelonamatches ORDER BY id DESC LIMIT {$load_more}");
		while($row = $dbfm->fetch()){
			echo "<p>". ucfirst($row['club']) . " vs " . ucwords($row['opponentclub']) . " match - " . ucfirst($row['date']) . " at " . $row['time'] . " on " . ucfirst($row['day']). "</p>";
		}
	}
	public function PredictMatchPost($opponentclubimage, $opponentclubname, $date, $time, $day, $valid){
		$pmp = $this->dbconnection()->prepare("INSERT INTO todaysmatch(opponentclubimage, opponentclubname, date, time, day, valid) VALUES (?, ?, ?, ?, ?, ?)");
		$pmp->execute([$opponentclubimage, $opponentclubname, $date, $time, $day, $valid]);
		$p_m = $this->dbconnection()->query("SELECT email FROM newsletter WHERE verify = 1");
		while($row = $p_m->fetch()){
			$mail = new PHPMailer;
			$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
			$mail->addAddress($row['email']);
			$mail->isHTML(true);
			$mail->Subject  = 'Available Barcelona Match Prediction';
			$mail->Body     = "<div align='center'><h1>Barcelona Vs {$opponentclubname}</h1><h4>Get a chance to win 1,100 naira to predict the end score of Barcelona Vs {$opponentclubname} match - {$date} at {$time} on {$day}. To predict the match, login to your account - https://predictbarca.com/login.php</h4></div>";
			if(!$mail->send()) {
				echo '<p id="tmat">Message was not sent.</p>';
				echo 'Mailer error: ' . $mail->ErrorInfo;
			}else{
				passthru;
			}
		}
		echo "<p id='not-checker'>Match Prediction Inserted</p>";
	}
	public function DisplayScoresLines(){
		$scorelines = $this->dbconnection()->query("SELECT clubname, opponentclubname, myclubscore, opponentclubscore FROM todaysmatch");
		while($rows = $scorelines->fetch()){
			echo "<p id='tmat'>" . ucfirst($rows['clubname']) . " vs {$rows['opponentclubname']}</p>";
			echo "<p id='tmat'>Live Scores: {$rows['myclubscore']} - {$rows['opponentclubscore']}</p>";
			$scorewho = $this->dbconnection()->query("SELECT who FROM whoscores ORDER BY id DESC");
			while($rowswho = $scorewho->fetch()){
				echo "<p id='tmat'>{$rowswho['who']}</p>";
			}
		}
	}
	public function ScoresNow($myclubscore, $opponentclubscore){
		$sn = $this->dbconnection()->prepare("UPDATE todaysmatch SET myclubscore = ?, opponentclubscore = ?");
		$sn->execute([$myclubscore, $opponentclubscore]);
		$s_n = $this->dbconnection()->query("SELECT email FROM newsletter WHERE verify = 1");
		while($row = $s_n->fetch()){
			$mail = new PHPMailer;
			$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
			$mail->addAddress($row['email']);
			$mail->isHTML(true);
			$mail->Subject  = 'Barcelona Match Scores';
			$mail->Body     = "<div align='center'><h1>Barcelona</h1><h4>Todays Live Match - Barcelona have currently scored {$myclubscore} while the opponent scores {$opponentclubscore}. The match is currently on going, to participate in a live chat with other Barcelona fans and watch live commentary, visit - https://predictbarca.com/ and login to your account.</h4></div>";
			if(!$mail->send()) {
				echo '<p id="tmat">Message was not sent.</p>';
				echo 'Mailer error: ' . $mail->ErrorInfo;
			}else{
				passthru;
			}
		}
		echo "<p id='not-checker'>Today Score Updated</p>";
	}
	public function DisplayOnlyMatchLogo(){
		$doml = $this->dbconnection()->query("SELECT * FROM todaysmatch");
		while($row = $doml->fetch()){
			echo "<br><table align='center';>
						<tr>
							<td>
								<img class='barca-image' src='images/{$row['clubimage']}' alt='barcelona image'> 
								<img class='opponent-image' src='images/{$row['opponentclubimage']}' alt='opponent image'>
							</td>
						</tr>
					</table>";
		}
	}
	public function DisplayBarcaMatchLogo(){
		$doml = $this->dbconnection()->query("SELECT * FROM todaysmatch");
		while($row = $doml->fetch()){
			echo "<img class='barca-image-1' src='images/{$row['clubimage']}' alt='barcelona logo'>";
		}
	}
	public function DisplayOpponentMatchLogo(){
		$doml = $this->dbconnection()->query("SELECT * FROM todaysmatch");
		while($row = $doml->fetch()){
			echo "<img class='barca-image-2' src='images/{$row['opponentclubimage']}' alt='opponent logo'>";
		}
	}
	public function DisplayTodaysMatchHomepage(){
		$check = $this->dbconnection()->query("SELECT * FROM todaysmatch");
		if($check->rowCount() == 0){
			echo "<p class='compressup' id='today-match'>No Barcelona Match is Available at this time</p>";
		}else{
			$tm = $this->dbconnection()->query("SELECT * FROM todaysmatch");
			while($row = $tm->fetch()){
				echo "<p id='today-match'>Todays Match - {$row['date']} at {$row['time']}</p>";
			}
		}
	}
	public function DisplayPredictMatch(){
		$check = $this->dbconnection()->query("SELECT * FROM todaysmatch");
		if($check->rowCount() == 0){
			echo "<p id='tmat'>No Barcelona Match is Available at this time</p>";
		}else{
			$check_valid = $this->dbconnection()->query("SELECT valid FROM todaysmatch WHERE valid = 1");
			if($check_valid->fetchColumn() == 1){
				$dpm = $this->dbconnection()->query("SELECT * FROM todaysmatch");
				while($row = $dpm->fetch()){
					echo "<p id='tmat'>Todays Match - {$row['date']} at {$row['time']}</p>
							<div id='clear'></div>
							<p id='tmat'>Get 1,100 naira Bonus by Predicting this match</p>";
				}
				$this->DisplayScoresLines();
			}
			$check_valid2 = $this->dbconnection()->query("SELECT valid FROM todaysmatch WHERE valid = 2");
			if($check_valid2->fetchColumn() == 2){
				$dpm2 = $this->dbconnection()->query("SELECT * FROM todaysmatch");
				while($row = $dpm2->fetch()){
					echo "<p id='tmat'>Todays Match - {$row['date']} at {$row['time']}</p>
							<div id='clear'></div>
							<p id='tmat'>No 1,100 naira Bonus for this Match</p>";
				}
				$this->DisplayScoresLines();
			}
			$check_valid3 = $this->dbconnection()->query("SELECT valid FROM todaysmatch WHERE valid = 3");
			if($check_valid3->fetchColumn() == 3){
				$check_match_scores = $this->dbconnection()->query("SELECT clubname, opponentclubname, myclubscore, opponentclubscore FROM todaysmatch");
				while($row_match = $check_match_scores->fetch()){
					echo "<p id='tmat'>Todays Match has Ended {$row_match['clubname']} scores {$row_match['myclubscore']} and {$row_match['opponentclubname']} scores {$row_match['opponentclubscore']}, if you won the 1,100 naira, you will receive an email from us and your 1,100 naira into your bank account in less than 24 hours</p><br>";
				}
			}
			$check_valid4 = $this->dbconnection()->query("SELECT valid FROM todaysmatch WHERE valid = 4");
			if($check_valid4->fetchColumn() == 4){
				$check_match_scores = $this->dbconnection()->query("SELECT clubname, opponentclubname, myclubscore, opponentclubscore FROM todaysmatch");
				while($row_match = $check_match_scores->fetch()){
					echo "<p id='tmat'>Todays Match has Ended {$row_match['clubname']} scores {$row_match['myclubscore']} and {$row_match['opponentclubname']} scores {$row_match['opponentclubscore']}. There is no 1,100 naira bonus in todays match.</p><br>";
				}
			}
		}
	}
	public function DisplayPredictMatch2(){
		$check = $this->dbconnection()->query("SELECT * FROM todaysmatch");
		if($check->rowCount() == 0){
			$this->DisplayTodaysMatchHomepage();
		}else{
			$check_valid = $this->dbconnection()->query("SELECT valid FROM todaysmatch WHERE valid = 1");
			if($check_valid->fetchColumn() == 1){
				$dpm = $this->dbconnection()->query("SELECT * FROM todaysmatch");
				while($row = $dpm->fetch()){
					$this->DisplayTodaysMatchHomepage();
					echo "<p id='tmat'>Get 1,100 naira Bonus by Predicting this match</p>";
				}
				$this->DisplayScoresLines();
			}
			$check_valid2 = $this->dbconnection()->query("SELECT valid FROM todaysmatch WHERE valid = 2");
			if($check_valid2->fetchColumn() == 2){
				$dpm2 = $this->dbconnection()->query("SELECT * FROM todaysmatch");
				while($row = $dpm2->fetch()){
					$this->DisplayTodaysMatchHomepage();
					echo "<p id='tmat'>No 1,100 naira Bonus for this Match</p>";
				}
				$this->DisplayScoresLines();
			}
			$check_valid3 = $this->dbconnection()->query("SELECT valid FROM todaysmatch WHERE valid = 3");
			if($check_valid3->fetchColumn() == 3){
				$check_match_scores = $this->dbconnection()->query("SELECT clubname, opponentclubname, myclubscore, opponentclubscore FROM todaysmatch");
				while($row_match = $check_match_scores->fetch()){
					echo "<p class='compress' id='tmat'>Todays Match has Ended {$row_match['clubname']} scores {$row_match['myclubscore']} and {$row_match['opponentclubname']} scores {$row_match['opponentclubscore']}, if you won the 1,100 naira, you will receive an email from us and your 1,100 naira into your bank account in less than 24 hours</p>";
				}
			}
			$check_valid4 = $this->dbconnection()->query("SELECT valid FROM todaysmatch WHERE valid = 4");
			if($check_valid4->fetchColumn() == 4){
				$check_match_scores = $this->dbconnection()->query("SELECT clubname, opponentclubname, myclubscore, opponentclubscore FROM todaysmatch");
				while($row_match = $check_match_scores->fetch()){
					echo "<p class='compress' id='tmat'>Todays Match has Ended {$row_match['clubname']} scores {$row_match['myclubscore']} and {$row_match['opponentclubname']} scores {$row_match['opponentclubscore']}. There is no 1,100 naira bonus in todays match.</p>";
				}
			}
		}
	}
	public function DisplayPredictionAspect(){
		$check = $this->dbconnection()->query("SELECT * FROM todaysmatch");
		if($check->rowCount() == 0){
			echo "<p id='tmat'>No Barcelona Match is Available for Prediction</p><br>";
		}
		$check_valid3 = $this->dbconnection()->query("SELECT valid FROM todaysmatch WHERE valid = 3");
		$check_valid4 = $this->dbconnection()->query("SELECT valid FROM todaysmatch WHERE valid = 4");
		if($check_valid3->fetchColumn() == 3){
			$check_match_scores = $this->dbconnection()->query("SELECT clubname, opponentclubname, myclubscore, opponentclubscore FROM todaysmatch");
			while($row_match = $check_match_scores->fetch()){
				echo "<p id='tmat'>Todays Match has Ended {$row_match['clubname']} scores {$row_match['myclubscore']} and {$row_match['opponentclubname']} scores {$row_match['opponentclubscore']}, if you won the 1,100 naira, you will receive an email from us and your 1,100 naira into your bank account in less than 24 hours</p><br>";
			}
		}elseif($check_valid4->fetchColumn() == 4){
			$check_match_scores = $this->dbconnection()->query("SELECT clubname, opponentclubname, myclubscore, opponentclubscore FROM todaysmatch");
			while($row_match = $check_match_scores->fetch()){
				echo "<p id='tmat'>Todays Match has Ended {$row_match['clubname']} scores {$row_match['myclubscore']} and {$row_match['opponentclubname']} scores {$row_match['opponentclubscore']}. There is no 1,100 naira bonus in todays match.</p><br>";
			}
		}else{
			$check_if_exist = $this->dbconnection()->query("SELECT username FROM predict WHERE username = {$this->dbconnection()->quote($_SESSION['username'])}");
			if($check_if_exist->fetchColumn() == $_SESSION['username']){
				$check_club_scores = $this->dbconnection()->query("SELECT valid FROM todaysmatch WHERE valid = 5");
				if($check_club_scores->fetchColumn() == 5){
					echo "<p id='tmat'>The match has began</p><br>";
				}else{
					echo "<p id='tmat'>You have already predict this match</p><br>";
				}
			}else{
				$check_club_scores = $this->dbconnection()->query("SELECT valid FROM todaysmatch WHERE valid = 5");
				if($check_club_scores->fetchColumn() == 5){
					echo "<p id='tmat'>The match has began</p><br>";
				}else{
					$check_started_start = $this->dbconnection()->query("SELECT started FROM todaysmatch WHERE started = 1");
					if($check_started_start->fetchColumn() == 1){
						echo "<p id='tmat'>Prediction is over, the Match has began</p><br>";
					}else{
						$check_valid = $this->dbconnection()->query("SELECT valid FROM todaysmatch WHERE valid = 1");
						$check_started = $this->dbconnection()->query("SELECT started FROM todaysmatch WHERE started = 0");
						if($check_valid->fetchColumn() == 1 && $check_started->fetchColumn() == 0){
							$get_match = $this->dbconnection()->query("SELECT clubname, opponentclubname FROM todaysmatch");
							while($row = $get_match->fetch()){
								echo "<p id='predict-match-show'>what is the end result of " . strtolower($row['clubname']) . " vs " . strtolower($row['opponentclubname']) . "?</p>
									<form method='POST'>
										<input class='field-match-result-insert' type='text' name='scores' placeholder='2-1' required>
										<input class='predict-match-submit' type='submit' value='Submit'>
									</form><p id='tmat'>If you think " . strtolower($row['clubname']) . " will score 2 and " . strtolower($row['opponentclubname']) . " will
									score 1, Enter 2 - 1 in the text field above. Otherwise, put what you think will be the end result.</p><br>";
							}
						}
						$check_valid2 = $this->dbconnection()->query("SELECT valid FROM todaysmatch WHERE valid = 2");
						$check_started2 = $this->dbconnection()->query("SELECT started FROM todaysmatch WHERE started = 0");
						if($check_valid2->fetchColumn() == 2 && $check_started2->fetchColumn() == 0){
							$get_match = $this->dbconnection()->query("SELECT clubname, opponentclubname FROM todaysmatch");
							while($row = $get_match->fetch()){
								echo "<p id='predict-match-show'>what is the end result of " . strtolower($row['clubname']) . " vs " . strtolower($row['opponentclubname']) . "?</p>
									<form method='POST'>
										<input class='field-match-result-insert' type='text' name='scores' placeholder='2-1' required>
										<input class='predict-match-submit' type='submit' value='Submit'>
									</form><p id='tmat'>If you think " . strtolower($row['clubname']) . " will score 2 and " . strtolower($row['opponentclubname']) . " will
									score 1, Enter 2 - 1 in the text field above. Otherwise, put what you think will be the end result.</p><p id='tmat'>No 1,100 naira Bonus for this Match</p><br>";
							}
						}
					}
				}
			}
		}
	}
	public function PredictScoresHere($score){
		$date = date('d/m/y', time());
		$time = date('h:i:s a', time());
		$day = date('D', time());
		$get_reg = $this->dbconnection()->query("SELECT fullname, email, username, ip FROM registerpredictor WHERE username = {$this->dbconnection()->quote($_SESSION['username'])}");
		while($row = $get_reg->fetch()){
			$get_match = $this->dbconnection()->query("SELECT clubname, opponentclubname FROM todaysmatch");
			while($row2 = $get_match->fetch()){
				$p = $this->dbconnection()->prepare("INSERT INTO predict (name, myclub, opponentclub, email, username, scores, date, time, day, ip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$p->execute([$row['fullname'], $row2['clubname'], $row2['opponentclubname'], $row['email'], $_SESSION['username'], $score, $date, $time, $day, $row['ip']]);
				$p2 = $this->dbconnection()->prepare("INSERT INTO allpredict (name, myclub, opponentclub, email, username, scores, date, time, day, ip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$p2->execute([$row['fullname'], $row2['clubname'], $row2['opponentclubname'], $row['email'], $_SESSION['username'], $score, $date, $time, $day, $row['ip']]);
				$mail = new PHPMailer;
				$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
				$mail->addAddress($row['email']);
				$mail->isHTML(true);
				$mail->Subject  = 'Prediction';
				$mail->Body     = "<div align='center'><h2>Current Prediction</h2><h4>Thank you for predicting this Barcelona match. We will get back to you after you won the award.</h4></div>";
				if(!$mail->send()){
					echo '<p id="tmat">Message was not sent.</p>';
					echo 'Mailer error: ' . $mail->ErrorInfo;
				}else{
					passthru;
				}
				echo "<script>location.href = 'account.php';</script>";
			}
		}
	}
	public function ScoresMatchAnnouncement($who){
		$sma = $this->dbconnection()->prepare("INSERT INTO whoscores(who) VALUES (?)");
		$sma->execute([$who]);
		$s_m_a = $this->dbconnection()->query("SELECT email FROM newsletter WHERE verify = 1");
		while($row = $s_m_a->fetch()){
			$mail = new PHPMailer;
			$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
			$mail->addAddress($row['email']);
			$mail->isHTML(true);
			$mail->Subject  = 'Barcelona Who Scores';
			$mail->Body     = "<div align='center'><h1>Who Scores</h1><h4>Todays Live Match - {$who}. The match is currently on going, to participate in a live chat with other Barcelona fans and watch live commentary, visit - https://predictbarca.com/ and login to your account.</h4></div>";
			if(!$mail->send()) {
				echo '<p id="tmat">Message was not sent.</p>';
				echo 'Mailer error: ' . $mail->ErrorInfo;
			}else{
				passthru;
			}
		}
		echo "<p id='not-checker'>Match Live has being Announced</p>";
	}
	public function ExecuteCommand($typeofexec){
		if($typeofexec == "delete prediction"){
			$this->dbconnection()->query("TRUNCATE predict");
			$this->dbconnection()->query("TRUNCATE whoscores");
			$this->dbconnection()->query("TRUNCATE livechat");
			$this->dbconnection()->query("TRUNCATE commentary");
			$this->dbconnection()->query("TRUNCATE todaysmatch");
		}
		if($typeofexec == "match started"){
			$this->dbconnection()->query("UPDATE todaysmatch SET started = 1");
			$t = $this->dbconnection()->query("SELECT email FROM newsletter WHERE verify = 1");
			while($row = $t->fetch()){
				$mail = new PHPMailer;
				$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
				$mail->addAddress($row['email']);
				$mail->isHTML(true);
				$mail->Subject  = 'Barcelona Match has Began';
				$mail->Body     = "<div align='center'><h1>Barcelona Match has Began</h1><h4>Todays Live Match - The match has began, to participate in a live chat with other Barcelona fans and watch live commentary, visit - https://predictbarca.com/ and login to your account.</h4></div>";
				if(!$mail->send()) {
					echo '<p id="tmat">Message was not sent.</p>';
					echo 'Mailer error: ' . $mail->ErrorInfo;
				}else{
					passthru;
				}
			}
			echo "<p id='not-checker'>Match Started</p>";
		}
		if($typeofexec == "match on going"){
			$this->dbconnection()->query("UPDATE todaysmatch SET valid = 1");
			echo "<p id='not-checker'>Match On Going</p>";
		}
		if($typeofexec == "match on going no bonus"){
			$this->dbconnection()->query("UPDATE todaysmatch SET valid = 2");
			echo "<p id='not-checker'>Match On Going No Bonus</p>";
		}
		if($typeofexec == "match finishes"){
			$this->dbconnection()->query("UPDATE todaysmatch SET valid = 3");
			$mf = $this->dbconnection()->query("SELECT email FROM newsletter WHERE verify = 1");
			while($row = $mf->fetch()){
				$mail = new PHPMailer;
				$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
				$mail->addAddress($row['email']);
				$mail->isHTML(true);
				$mail->Subject  = 'Barcelona Match has Ended';
				$mail->Body     = "<div align='center'><h1>Barcelona Match has Ended</h1><h4>Todays Live Match have just ended, the person won the 1,100 naira will be contacted via his email and he will receive his money within 24 hours.</h4></div>";
				if(!$mail->send()) {
					echo '<p id="tmat">Message was not sent.</p>';
					echo 'Mailer error: ' . $mail->ErrorInfo;
				}else{
					passthru;
				}
			}
			echo "<p id='not-checker'>Todays Match is finished</p>";
		}
		if($typeofexec == "match finishes no bonus"){
			$this->dbconnection()->query("UPDATE todaysmatch SET valid = 4");
			$mfo = $this->dbconnection()->query("SELECT email FROM newsletter WHERE verify = 1");
			while($row = $mfo->fetch()){
				$mail = new PHPMailer;
				$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
				$mail->addAddress($row['email']);
				$mail->isHTML(true);
				$mail->Subject  = 'Barcelona Match has Ended';
				$mail->Body     = "<div align='center'><h1>Barcelona Match has Ended</h1><h4>Todays Live Match have just ended, do not forget that their is no bonus (1,100 naira) for this match.</h4></div>";
				if(!$mail->send()) {
					echo '<p id="tmat">Message was not sent.</p>';
					echo 'Mailer error: ' . $mail->ErrorInfo;
				}else{
					passthru;
				}
			}
			echo "<p id='not-checker'>Todays Match is finished</p>";
		}
	}
	public function WonNaira(){
		$won = $this->dbconnection()->query("SELECT woncount FROM registerpredictor WHERE username = {$this->dbconnection()->quote($_SESSION['username'])}");
		while($row = $won->fetch()){
			echo "<p id='trophy-show'>You have {$row['woncount']} trophy (1,100 naira).</p><br>";
		}
	}
	public function ShowRegister(){
		$sr = $this->dbconnection()->query("SELECT * FROM registerpredictor WHERE username = {$this->dbconnection()->quote($_SESSION['username'])}");
		while($row = $sr->fetch()){
			echo "<p>Full Name: " . ucwords($row['fullname']) . "</p>
						<p>Email: {$row['email']}</p>
						<p>Phone Number: {$row['phonenumber']}</p>
						<p>Gender: {$row['gender']}</p>
						<p>Age: {$row['age']}</p>
						<p>Hobby: {$row['hobby']}</p>
						<p>Country: {$row['country']}</p>
						<p>State: {$row['state']}</p>
						<p>Local Government: {$row['localgovt']}</p>
						<p>Bank Account Name: {$row['bankaccountname']}</p>
						<p>Bank Account No: {$row['bankaccountno']}</p>
						<p>Bank Name: {$row['bankname']}</p>";
		}
	}
	public function UpdateRegister(){
		$sr = $this->dbconnection()->query("SELECT * FROM registerpredictor WHERE username = {$this->dbconnection()->quote($_SESSION['username'])}");
		while($row = $sr->fetch()){
			echo "<form method='POST'>
								Full Name:<br><input class='field-edit-pro' type='text' name='fullname' value='{$row['fullname']}' required><br>
								Email:<br><input class='field-edit-pro' type='email' name='email' value='{$row['email']}' required><br>
								Phone Number:<br><input class='field-edit-pro' type='tel' name='phonenumber' value='{$row['phonenumber']}' required><br>
								Gender:<br><select class='field-edit-pro' name='gender' required>
											<option value='' selected>select your gender</option>
											<option value='Male'>Male</option>
											<option value='Female'>Female</option>
											</select><br>
								Age:<br><input class='field-edit-pro' type='text' name='age' value='{$row['age']}' required><br>
								Hobby:<br><input class='field-edit-pro' type='text' name='hobby' value='{$row['hobby']}' required><br>
								Country:<br><input class='field-edit-pro' type='text' name='country' value='{$row['country']}' required><br>
								State:<br><input class='field-edit-pro' type='text' name='state' value='{$row['state']}' required><br>	
								Local Government:<br><input class='field-edit-pro' type='text' name='localgovt' value='{$row['localgovt']}' required><br>
								Bank Account Name:<br><input class='field-edit-pro' type='text' name='bankaccountname' value='{$row['bankaccountname']}' required><br>
								Bank Account No:<br><input class='field-edit-pro' type='text' name='bankaccountno' value='{$row['bankaccountno']}' required><br>
								Bank Name:<br><input class='field-edit-pro' type='text' name='bankname' value='{$row['bankname']}' required><br>
								<input class='predict-match-submit' type='submit' name='submission-editor' value='Submit'>
							</form>";
		}
	}
	public function UpdatedRegister($fullname, $email, $phonenumber, $gender, $age, $hobby, $country, $state, $localgovt, $bankaccountname, $bankaccountno, $bankname){
		$udr = $this->dbconnection()->prepare("UPDATE registerpredictor SET fullname = ?, email = ?, phonenumber = ?, gender = ?, age = ?,
		hobby = ?, country = ?, state = ?, localgovt = ?, bankaccountname = ?, bankaccountno = ?, bankname = ?	WHERE username = {$this->dbconnection()->quote($_SESSION['username'])}");
		$udr->execute([$fullname, $email, $phonenumber, $gender, $age, $hobby, $country, $state, $localgovt, $bankaccountname, $bankaccountno, $bankname]);
		echo "<script>location.href = 'account.php';</script>";
	}
	public function ChangePassword($oldpassword, $newpassword){
		$cp = $this->dbconnection()->query("SELECT password FROM loginpredictor WHERE username = {$this->dbconnection()->quote($_SESSION['username'])}");
		if($cp->fetchColumn() === $oldpassword){
			$pc = $this->dbconnection()->prepare("UPDATE loginpredictor SET password = ? WHERE username = {$this->dbconnection()->quote($_SESSION['username'])}");
			$pc->execute([$newpassword]);
			session_destroy();
			echo "<script>location.href = 'login.php';</script>";
		}else{
			echo "<p id='not-checker'>Wrong Old Password</p>";
			echo "<script>alert('Wrong Old Password');</script>";
		}
	}
	public function CommentaryForMatchHere(){
		$check = $this->dbconnection()->query("SELECT * FROM todaysmatch");
		if($check->rowCount() == 0){
			echo "<p id='tmat'>No Barcelona Match is Available for Commentary</p><br>";
		}else{
			$c = $this->dbconnection()->query("SELECT * FROM commentary ORDER BY id DESC LIMIT 30");
			$t = $this->dbconnection()->query("SELECT * FROM todaysmatch");
			while($rowt = $t->fetch()){
				echo "<p id='tmat'>" . ucfirst($rowt['clubname']) . " Vs {$rowt['opponentclubname']} Live Commentary</p>";
			}
			while($rowc = $c->fetch()){
				echo "<p id='message-chat'>{$rowc['comment']}</p>";
			}
			echo "<br>";
		}
	}
	public function CommentaryInsert($comment){
		$date = date('d/m/y', time());
		$time = date('h:i:s a', time());
		$day = date('D', time());
		$get_com = $this->dbconnection()->query("SELECT clubname, opponentclubname FROM todaysmatch");
		while($row = $get_com->fetch()){
			$ci = $this->dbconnection()->prepare("INSERT INTO commentary (myclub, opponentclub, comment, date, time, day) VALUES (?, ?, ?, ?, ?, ?)");
			$ci->execute([$row['clubname'], $row['opponentclubname'], $comment, $date, $time, $day]);
			$ci2 = $this->dbconnection()->prepare("INSERT INTO allcommentary (myclub, opponentclub, comment, date, time, day) VALUES (?, ?, ?, ?, ?, ?)");
			$ci2->execute([$row['clubname'], $row['opponentclubname'], $comment, $date, $time, $day]);
		}
	}
	public function DisplayPUpdates(){
		$dpu = $this->dbconnection()->query("SELECT content FROM predictbarcaupdates ORDER BY id DESC LIMIT 3");
		while($row = $dpu->fetch()){
			echo "<p>{$row['content']}</p>";
		}
	}
	public function UpdateBarcaNew($con){
		$ubn = $this->dbconnection()->prepare("INSERT INTO predictbarcaupdates (content) VALUES (?)");
		$ubn->execute([$con]);
		$u_b_n = $this->dbconnection()->query("SELECT email FROM newsletter WHERE verify = 1");
		while($row = $u_b_n->fetch()){
			$mail = new PHPMailer;
			$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
			$mail->addAddress($row['email']);
			$mail->isHTML(true);
			$mail->Subject  = 'Predict Barca Updates';
			$mail->Body     = "<div align='center'><h1>Updates</h1><h4>{$con}. For more visit https://predictbarca.com</h4></div>";
			if(!$mail->send()) {
				echo '<p id="tmat">Message was not sent.</p>';
				echo 'Mailer error: ' . $mail->ErrorInfo;
			}else{
				passthru;
			}
		}
		echo "<p id='not-checker'>Barca Predict News Updated</p>";
	}
	public function TruncateAllUpdates(){
		$this->dbconnection()->query("TRUNCATE predictbarcaupdates");
		echo "<p id='not-checker'>Deleted All Updates</p>";
	}
	public function DisplayChat(){
		$check = $this->dbconnection()->query("SELECT * FROM todaysmatch");
		if($check->rowCount() == 0){
			echo "<p id='tmat' style='color:white;'>No Barcelona Match is Available for Live Chat</p><br>";
		}else{
			$c = $this->dbconnection()->query("SELECT * FROM livechat ORDER BY id DESC LIMIT 30");
			$t = $this->dbconnection()->query("SELECT * FROM todaysmatch");
			while($rowt = $t->fetch()){
				echo "<p id='tmat' style='color:white;'>" . ucfirst($rowt['clubname']) . " Vs {$rowt['opponentclubname']} Live Chat</p>";
			}
			while($rowc = $c->fetch()){
				echo "<p id='message-chat'>{$rowc['message']}</p>";
			}
		}
	}
	public function ChatInsert($chat){
		$check = $this->dbconnection()->query("SELECT * FROM todaysmatch");
		if($check->rowCount() == 0){
			echo "<p id='tmat' style='color:white;'>You cannot sent a live message since their is no Barcelona match available</p><br>";
		}else{
			$date = date('d/m/y', time());
			$time = date('h:i:s a', time());
			$day = date('D', time());
			if(!empty($_SERVER["HTTP_CLIENT_IP"])){
				//check for ip from share internet
				$ip = $_SERVER["HTTP_CLIENT_IP"];
			}elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
				// Check for the Proxy User
				$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			}else{
				$ip = $_SERVER["REMOTE_ADDR"];
			}
			$get_info = $this->dbconnection()->query("SELECT fullname, email, username FROM registerpredictor WHERE username = {$this->dbconnection()->quote($_SESSION['username'])}");
			while($row = $get_info->fetch()){
				$get_today = $this->dbconnection()->query("SELECT clubname, opponentclubname FROM todaysmatch");
				while($row2 = $get_today->fetch()){
					$lc = $this->dbconnection()->prepare("INSERT INTO livechat (name, myclub, opponentclub, email, username, message, date, time, day, ip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					$lc->execute([$row['fullname'], $row2['clubname'], $row2['opponentclubname'], $row['email'], $_SESSION['username'], $chat, $date, $time, $day, $ip]);
					$lc2 = $this->dbconnection()->prepare("INSERT INTO alllivechat (name, myclub, opponentclub, email, username, message, date, time, day, ip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					$lc2->execute([$row['fullname'], $row2['clubname'], $row2['opponentclubname'], $row['email'], $_SESSION['username'], $chat, $date, $time, $day, $ip]);
				}
			}
		}
	}
	public function BarcaWinner($image, $name, $email, $username, $phonenumber, $amount, $date){
		$get_m = $this->dbconnection()->query("SELECT clubname, opponentclubname FROM todaysmatch");
		while($row = $get_m->fetch()){
			$bw = $this->dbconnection()->prepare("INSERT INTO won (image, name, email, username, phonenumber, amount, myclub, opponentclub, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$bw->execute([$image, $name, $email, $username, $phonenumber, $amount, $row['clubname'], $row['opponentclubname'], $date]);
			$this->dbconnection()->query("UPDATE registerpredictor SET woncount = woncount + 1 WHERE username = {$this->dbconnection()->quote($username)}");
			$w = $this->dbconnection()->query("SELECT email FROM registerpredictor WHERE username = {$this->dbconnection()->quote($username)}");
			while($row2 = $w->fetch()){
				$mail = new PHPMailer;
				$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
				$mail->addAddress($row2['email']);
				$mail->isHTML(true);
				$mail->Subject  = 'Won Price';
				$mail->Body     = "<div align='center'><h1>Award</h1><h4>You have won the 1,100 naira, you will receive your payment within 24 hours. Login to your profile to see your award - https://predictbarca.com/login.php</h4></div>";
				if(!$mail->send()) {
					echo '<p id="tmat">Message was not sent.</p>';
					echo 'Mailer error: ' . $mail->ErrorInfo;
				}else{
					passthru;
				}
			}
			echo "<p id='not-checker'>Winner is inserted</p>";
		}
	}
	public function DisplayWinner(){
		$dw = $this->dbconnection()->query("SELECT * FROM won");
		while($row = $dw->fetch()){
			echo "<img class='won-alert' src='images/{$row['image']}' alt='winners alert'>
			<div id='receiver'>
				<p>Name: {$row['name']}</p>
				<p>Phone Number: {$row['phonenumber']}</p>
				<p>Amount Recieved: {$row['amount']}</p>
				<p>Match: " .  ucfirst($row['myclub']) . " vs {$row['opponentclub']}</p>
				<p>Date: {$row['date']}</p>
			</div>
			<div id='clear'></div>";
		}
	}
	public function ChooseWinner(){
		$check = $this->dbconnection()->query("SELECT * FROM predict LIMIT 5");
		while($row_check = $check->fetch()){
			echo "{$row_check['name']}, {$row_check['myclub']}, {$row_check['opponentclub']}, {$row_check['email']}, {$row_check['username']}, {$row_check['scores']}";
			$cw = $this->dbconnection()->query("SELECT * FROM registerpredictor WHERE username = {$this->dbconnection()->quote($row_check['username'])} ORDER BY RAND()");
			while($row = $cw->fetch()){
				echo "<p>{$row['fullname']}, {$row['email']}, {$row['username']}, {$row['phonenumber']}, {$row['gender']}, {$row['age']}, 
				{$row['hobby']}, {$row['country']}, {$row['state']}, {$row['localgovt']}, {$row['bankaccountname']}, {$row['bankaccountno']}, {$row['bankname']}</p>";
			}
		}
	}
	public function CheckWinner(){
		$check = $this->dbconnection()->query("SELECT * FROM predict LIMIT 5");
		while($row_check = $check->fetch()){
			echo "{$row_check['name']}, {$row_check['myclub']}, {$row_check['opponentclub']}, {$row_check['email']}, {$row_check['username']}, {$row_check['scores']}";
		}
	}
	public function CheckWinnerMore($load){
		$check = $this->dbconnection()->query("SELECT * FROM predict LIMIT {$load}");
		while($row_check = $check->fetch()){
			echo "{$row_check['name']}, {$row_check['myclub']}, {$row_check['opponentclub']}, {$row_check['email']}, {$row_check['username']}, {$row_check['scores']}";
		}
	}
	public function Subscribtion($email){
		$hash = md5(rand(10, 100));
		$check_s = $this->dbconnection()->query("SELECT email FROM newsletter WHERE email = {$this->dbconnection()->quote($email)}");
		if($check_s->fetchColumn() === $email){
			echo "<script>alert('You have already subscribe');</script>";
		}else{
			$s = $this->dbconnection()->prepare("INSERT INTO newsletter(email, hash) VALUES(?, ?)");
			$s->execute([$email, $hash]);
			$mail = new PHPMailer;
			$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
			$mail->addAddress($email);
			$mail->isHTML(true);
			$mail->Subject  = 'Newsletter';
			$mail->Body     = "<div align='center'><h1>Subscribe</h1><h4>Click the link to subscribe and be receiving new updates about Predict Barca - https://predictbarca.com/?hash={$hash}</h4></div>";
			if(!$mail->send()) {
				echo '<p id="tmat">Message was not sent.</p>';
				echo 'Mailer error: ' . $mail->ErrorInfo;
			}else{
				passthru;
			}
			echo "<script>alert('Check your email to confirm your subscription request');</script>";
		}
	}
	public function VerifySub($check_hash){
		$c_hash = $this->dbconnection()->query("SELECT hash FROM newsletter WHERE hash = {$this->dbconnection()->quote($check_hash)}");
		if($c_hash->fetchColumn() === $check_hash){
			$c_activate = $this->dbconnection()->query("SELECT verify FROM newsletter WHERE hash = {$this->dbconnection()->quote($check_hash)}");
			if($c_activate->fetchColumn() == 1){
				echo "<p id='tmat'>You have already verify your subscription</p>";
			}else{
				$this->dbconnection()->query("UPDATE newsletter SET verify = verify + 1 WHERE hash = {$this->dbconnection()->quote($check_hash)}");
				echo "<script>alert('you have subscribe to Predict Barca newsletter');</script>";
			}
		}else{
			echo "<script>alert('Hash not found');</script>";
		}
	}
	public function VerifySuccess($check_hash){
		$c_hash = $this->dbconnection()->query("SELECT hash FROM registerpredictor WHERE hash = {$this->dbconnection()->quote($check_hash)}");
		if($c_hash->fetchColumn() === $check_hash){
			$c_activate = $this->dbconnection()->query("SELECT activation FROM registerpredictor WHERE hash = {$this->dbconnection()->quote($check_hash)}");
			if($c_activate->fetchColumn() == 1){
				echo "<p id='tmat'>You have already activated your account</p>";
			}else{
				$this->dbconnection()->query("UPDATE registerpredictor SET activation = 1 WHERE hash = {$this->dbconnection()->quote($check_hash)}");
				$check_email = $this->dbconnection()->query("SELECT email FROM registerpredictor WHERE hash = {$this->dbconnection()->quote($check_hash)}");
				while($row = $check_email->fetch()){
					$this->dbconnection()->query("UPDATE newsletter SET verify = verify + 1 WHERE email = {$this->dbconnection()->quote($row['email'])}");
				}
				$_SESSION['ac'] = "activated account";
				echo "<script>location.href = 'login.php';</script>";
			}
		}else{
			echo "<p id='tmat'>Hash key not Found</p>";
		}
	}
	public function SendEmailVerification($e, $hash){
		$mail = new PHPMailer;
		$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
		$mail->addAddress($e);
		$mail->isHTML(true);
		$mail->Subject  = 'Account Verification';
		$mail->Body     = "<div align='center'><h2>Verification Link</h2><h4>Click the link here to activate your account - <br> https://predictbarca.com/register.php?hash={$hash}</h4></div>";
		if(!$mail->send()){
			echo '<p id="tmat">Message was not sent.</p>';
			echo 'Mailer error: ' . $mail->ErrorInfo;
		}else{
			passthru;
		}
	}
	public function CheckUsernameMatchEmail($username, $email){
		$checkume = $this->dbconnection()->prepare("SELECT username FROM registerpredictor WHERE email = ?");
		$checkume->execute([$email]);
		if($checkume->fetchColumn() === $username){
			$_SESSION['username'] = $username;
			$_SESSION['email'] = $email;
			$mail = new PHPMailer;
			$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
			$mail->addAddress($_SESSION['email']);
			$mail->isHTML(true);
			$randomvalue = rand(1000, 5000);
			$mail->Subject  = 'Forgot Password';
			$mail->Body     = "<div align='center'><h1>Forgot Password</h1><h4>Copy the numbers down below to confirm<br> your new password</h4><h2>{$randomvalue}</h2></div>";
			$_SESSION['randomnumber'] = $randomvalue;
			if(!$mail->send()) {
			  echo '<p id="tmat">Message was not sent.</p>';
			  echo 'Mailer error: ' . $mail->ErrorInfo;
			}else{
				passthru;
			}
		}else{
			echo "<p id='tmat'>Username do not match the email you entered</p>";
		}
	}
	public function ResendCode(){
		$mail = new PHPMailer;
		$mail->setFrom('no-reply@predictbarca.com', 'Predict Barca');
		$mail->addAddress($_SESSION['email']);
		$mail->isHTML(true);
		$randomvalue = rand(1000, 5000);
		$mail->Subject  = 'Forgot Password';
		$mail->Body     = "<div align='center'><h1>Forgot Password</h1><h4>Copy the numbers down below to confirm<br> your new password</h4><h2>{$randomvalue}</h2></div>";
		$_SESSION['randomnumber'] = $randomvalue;
		if(!$mail->send()) {
		  echo '<p id="tmat">Message was not sent.</p>';
		  echo 'Mailer error: ' . $mail->ErrorInfo;
		}else{
			passthru;
		}
	}
	public function CodeChecker($code){
		if($_SESSION['randomnumber'] == $code){
			$_SESSION['codematch'] = "codematch";
			unset($_SESSION['randomnumber']);
		}else{
			echo "<p id='tmat'>Invalid code</p>";
		}
	}
	public function PasswordForgotChange($pass){
		$psc = $this->dbconnection()->prepare("UPDATE loginpredictor SET password = ? WHERE username = {$this->dbconnection()->quote($_SESSION['username'])}");
		$psc->execute([$pass]);
		session_destroy();
		echo "<script>location.href = 'login.php';</script>";
	}
}
$pb = new PredictBarca();
?>