<?php
session_start();
include("../dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta name="keywords" content="predict, barca, barcelona, prediction, news, transfers, rumours, admin">
	<meta name="description" content="Admin page">
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("menu.php"); ?>
	<div id="match-top">
		<h1 id="today-match-2">Admin Page</h1>
		<div id="reg-5">
			<?php
			if(isset($_POST['uploadimage'])){
				$tmpfile = $_FILES['clubimage']['tmp_name'];
				$nameoffile = $_FILES['clubimage']['name'];
				$typeoffile = $_FILES['clubimage']['type'];
				$sizeoffile = $_FILES['clubimage']['size'];
				$permanentfolder = "../images/" . basename($nameoffile);
				$checker = 1;
				if($sizeoffile < 5000000){
					$checker = 0;
				}else{
					echo "<p id='not-checker'>File must be less than 5mb</p>";
				}
				if($checker == 0){
					$uploadtop = move_uploaded_file($tmpfile, $permanentfolder);
				}else{
					echo "<p id='not-checker'>File could not be uploaded</p>";
				}
				if($uploadtop == True){
					echo "<p id='not-checker'>You have successfully upload a new picture</p>";
				}else{
					echo "<p id='not-checker'>File could not be uploaded</p>";
				}
			}
			?>
			<form method="POST" enctype="multipart/form-data">
				Upload Image:<br><input class="form-changer" type="file" name="clubimage" required><br>
				<input class="submit-changer" type="submit" value="Upload" name="uploadimage"><br><br><br>
			</form>
			<?php
			if(isset($_POST['uploadvideo'])){
				$tmpfile = $_FILES['clubvideo']['tmp_name'];
				$nameoffile = $_FILES['clubvideo']['name'];
				$typeoffile = $_FILES['clubvideo']['type'];
				$sizeoffile = $_FILES['clubvideo']['size'];
				$permanentfolder = "../video/" . basename($nameoffile);
				$checker = 1;
				if($sizeoffile < 10000000){
					$checker = 0;
				}else{
					echo "<p id='not-checker'>File must be less than 10mb</p>";
				}
				if($checker == 0){
					$uploadtop = move_uploaded_file($tmpfile, $permanentfolder);
				}else{
					echo "<p id='not-checker'>File could not be uploaded</p>";
				}
				if($uploadtop == True){
					echo "<p id='not-checker'>You have successfully upload a new picture</p>";
				}else{
					echo "<p id='not-checker'>File could not be uploaded</p>";
				}
			}
			?>
			<form method="POST" enctype="multipart/form-data">
				Upload Video:<br><input class="form-changer" type="file" name="clubvideo" required><br>
				<input class="submit-changer" type="submit" value="Upload" name="uploadvideo"><br><br><br>
			</form>
			<?php
				if(isset($_POST['submit-new-pages'])){
					$pageurl = strip_tags(strtolower($_POST['pageurl']));
					$titleofpage = $_POST['titleofpage'];
					$keywordofpage = $_POST['keywordofpage'];
					$descriptionofpage = $_POST['descriptionofpage'];
					$h1title = $_POST['h1title'];
					$image = strip_tags(strtolower($_POST['image']));
					$video = strip_tags(strtolower($_POST['video']));
					$titleofcontent = $_POST['titleofcontent'];
					$content = strip_tags(ucfirst($_POST['content']));
					$newstype = strip_tags(strtolower($_POST['newstype']));
					$pb->PageCreation($pageurl, $titleofpage, $keywordofpage, $descriptionofpage, $h1title, $image, $video, $titleofcontent, $content, $newstype);
				}
			?>
			<h3>Create A New Page News</h3>
			<form method="POST">
				Page Url:<br><input class="form-changer" type="text" name="pageurl" required><br>
				Title of Page:<br><input class="form-changer" type="text" name="titleofpage" required><br>
				Keyword of Page:<br><input class="form-changer" type="text" name="keywordofpage" required><br>
				Description of Page:<br><input class="form-changer" type="text" name="descriptionofpage" required><br>
				h1 Title:<br><input class="form-changer" type="text" name="h1title" required><br>
				Image:<br><input class="form-changer" type="text" name="image" required><br>
				Video:<br><input class="form-changer" type="text" name="video" required><br>
				Title of Content:<br><input class="form-changer" type="text" name="titleofcontent" required><br>	
				Content:<textarea class="field-edit-pro-mes" id="content" name="content" required></textarea><br>
				News Type:<br><select class="form-changer" name="newstype" required>
						<option value="" selected>select news</option>
						<option value="transfer news">Transfer News</option>
						<option value="latest barcelona news">Latest Barcelona News</option>
						<option value="video highlights">Video Highlights</option>
						</select><br>
				<input class="submit-changer" type="submit" name="submit-new-pages" value="Submit">
			</form>
			<script type="text/javascript">
				$(function(){
					var load_pages = 1;
					$("#page-upp").click(function(){
						load_pages = load_pages + 1;
						$("#all-pages-updates").load("../load-more-edit-pages.php", {load_pages_new: load_pages});
					});
				});
			</script>
			<br><br>
			<input id="edit-pa" class="submit-changer" type="button" value="Edit Pages">
			<br><br>
			<div id="all-pages-updates">
				<?php
					$pb->PageCreationEdit();
				?>
			</div>
			<?php
				if(isset($_POST['submit-page-news']) && $_POST['newstype'] == "latest barcelona news"){
					$pb->PageCreationEditLBN($_POST['id'], $_POST['pageurl'], $_POST['titleofpage'], $_POST['keywordofpage'], 
					$_POST['descriptionofpage'], $_POST['h1title'], $_POST['image'], $_POST['titleofcontent'], $_POST['content'], $_POST['newstype']);
				}
				if(isset($_POST['submit-page-news']) && $_POST['newstype'] == "transfer news"){
					$pb->PageCreationEditTN($_POST['id'], $_POST['pageurl'], $_POST['titleofpage'], $_POST['keywordofpage'], 
					$_POST['descriptionofpage'], $_POST['h1title'], $_POST['image'], $_POST['titleofcontent'], $_POST['content'], $_POST['newstype']);
				}
				if(isset($_POST['submit-page-news']) && $_POST['newstype'] == "video highlights"){
					$pb->PageCreationEditVH($_POST['id'], $_POST['pageurl'], $_POST['titleofpage'], $_POST['keywordofpage'], 
					$_POST['descriptionofpage'], $_POST['h1title'], $_POST['image'], $_POST['video'], $_POST['titleofcontent'], $_POST['content'], $_POST['newstype']);
				}
				if(isset($_POST['delete-page-news'])){
					$pb->DeletePageNews($_POST['id'], $_POST['pageurl']);
				}
			?>
			<br><br>
			<table align="center";>
				<tr>
					<td>
						<input id="page-upp" class="read-more" type="button" value="Read More">
					</td>
				</tr>
			</table>
			<h3>Post Barcelona Matches</h3>
			<form method="POST">
				Opponent Club:<br><input class="form-changer" type="text" name="opponentclub" required><br>
				Date:<br><input class="form-changer" type="text" name="date" required><br>
				Time:<br><input class="form-changer" type="text" name="time" required><br>
				Day:<br><input class="form-changer" type="text" name="day" required><br>
				<input class="submit-changer" type="submit" name="submit-b-matches" value="Submit">
			</form>
			<?php
				if(isset($_POST['submit-b-matches'])){
					$opponentclub = strip_tags(strtolower($_POST['opponentclub']));
					$time = strip_tags(strtolower($_POST['time']));
					$day = strip_tags(strtolower($_POST['day']));
					$pb->BarcelonaFutureMatches($opponentclub, $_POST['date'], $time, $day);
				}
			?>
			<h3>Post Barcelona Scores</h3>
			<form method="POST">
				Opponent Club:<br><input class="form-changer" type="text" name="opponentclub" required><br>
				Scores:<br><input class="form-changer" type="text" name="score" placeholder="2-1" required><br>
				<input class="submit-changer" type="submit" name="submit-scores" value="Submit">
			</form><br>
			<?php
				if(isset($_POST['submit-scores'])){
					$opponentclub = $_POST['opponentclub'];
					$score = strip_tags(strtolower($_POST['score']));
					$pb->Scores($opponentclub, $score);
				}
			?>
			<h3>Post Barcelona Squad</h3>
			<form method="POST">
				Player Image:<br><input class="form-changer" type="text" name="playerimage" required><br>
				Player Name:<br><input class="form-changer" type="text" name="playername" required><br>
				Player Bio:<br><textarea class="field-edit-pro-mes" type="text" name="playerbio" required></textarea><br>
				<input class="submit-changer" type="submit" name="submit-squad" value="Submit">
			</form><br>
			<?php
				if(isset($_POST['submit-squad'])){
					$playerimage = $_POST['playerimage'];
					$playername = $_POST['playername'];
					$playerbio = $_POST['playerbio'];
					$pb->Squad($playerimage, $playername, $playerbio);
				}
			?>
			<script type="text/javascript">
				$(function(){
					var load_pages = 1;
					$("#page-player").click(function(){
						load_pages = load_pages + 1;
						$("#all-pages-squad").load("../load-more-barca-squad.php", {load_pages_new: load_pages});
					});
				});
			</script>
			<br><br>
			<input id="edit-squad" class="submit-changer" type="button" value="Edit Squad">
			<br><br>
			<div id="all-pages-squad">
				<?php
					$pb->SquadEditor();
				?>
			</div>
			<?php
				if(isset($_POST['submit-squad-edit'])){
					$id = $_POST['id'];
					$playerimage = $_POST['playerimage'];
					$playername = $_POST['playername'];
					$playerbio = $_POST['playerbio'];
					$pb->ChangeSquadEditor($playerimage, $playername, $playerbio, $id);
				}
				if(isset($_POST['submit-squad-delete'])){
					$id = $_POST['id'];
					$pb->SquadDelete($id);
				}
			?>
			<br><br>
			<table align="center";>
				<tr>
					<td>
						<input id="page-player" class="read-more" type="button" value="Read More">
					</td>
				</tr>
			</table>
			<h2>Predict Matches Section</h2>
			<p>Valid 1 for match with bonus</p>
			<p>Valid 2 for match with no bonus</p>
			<p>Valid 3 for match has ended with bonus</p>
			<p>Valid 4 for match has ended with no bonus</p>
			<p>Valid 5 when match started</p>
			<form method="POST">
				Opponent Club Image:<br><input class="form-changer" type="text" name="opponentclubimage" required><br>
				Opponent Club Name:<br><input class="form-changer" type="text" name="opponentclubname" required><br>
				Date:<br><input class="form-changer" type="text" name="date" required><br>
				Time:<br><input class="form-changer" type="text" name="time" required><br>
				Day:<br><input class="form-changer" type="text" name="day" required><br>
				Valid:<br><input class="form-changer" type="text" name="valid" placeholder="1 or 2" required><br>
				<input class="submit-changer" type="submit" name="submit-today-match" value="Submit">
			</form>
			<?php
				if(isset($_POST['submit-today-match'])){
					$opponentclubimage = $_POST['opponentclubimage'];
					$opponentclubname = $_POST['opponentclubname'];
					$date = $_POST['date'];
					$time = $_POST['time'];
					$day = $_POST['day'];
					$valid = $_POST['valid'];
					$pb->PredictMatchPost($opponentclubimage, $opponentclubname, $date, $time, $day, $valid);
				}
			?>
			<h3>Live Current Scores</h3>
			<form method="POST">
				Barcelona Scores:<br><input class="form-changer" type="text" name="myclubscore" required><br>
				Opponent Scores:<br><input class="form-changer" type="text" name="opponentclubscore" required><br>
				<input class="submit-changer" type="submit" name="submit-now-scores" value="Submit">
			</form>
			<?php
				if(isset($_POST['submit-now-scores'])){
					$myclubscore = $_POST['myclubscore'];
					$opponentclubscore = $_POST['opponentclubscore'];
					$pb->ScoresNow($myclubscore, $opponentclubscore);
				}
			?>
			<h3>Live Score Announcement</h3>
			<form method="POST">
				Match Scores Live:<br><input class="form-changer" type="text" name="who" required><br>
				<input class="submit-changer" type="submit" name="submit-now-live-scores" value="Submit">
			</form>
			<?php
				if(isset($_POST['submit-now-live-scores'])){
					$who = $_POST['who'];
					$pb->ScoresMatchAnnouncement($who);
				}
			?>
			<h3>Execute Command</h3>
			<form method="POST">
			<br><select class="field-edit-pro" name="typeofexec" required>
				<option value="" selected>select your command</option>
				<option value="delete prediction">Delete Prediction</option>
				<option value="match started">Match Started</option>
				<option value="match on going">Match On Going</option>
				<option value="match on going no bonus">Match On Going No Bonus</option>
				<option value="match finishes">Match Finishes</option>
				<option value="match finishes no bonus">Match Finishes No Bonus</option>
				</select><br>
				<input class="submit-changer" type="submit" name="submit-command" value="Submit">
			</form>
			<?php
				if(isset($_POST['submit-command'])){
					$typeofexec = $_POST['typeofexec'];
					$pb->ExecuteCommand($typeofexec);
				}
			?>
			<script type="text/javascript">
				$(function(){
					$("#submit-commentary").click(function(){
						var commentary = $("#commentary-id").val();
						if(commentary == ""){
							
						}else{
							$.post("../insert-commentry.php", {commentary1: commentary});
							$("#com")[0].reset();
						}
					});
				});
			</script>
			<h3>Commentary Insert</h3>
			<form id="com" method="POST">
				Comment:<br><textarea id='commentary-id' class="field-edit-pro-mes" type="text" name="comment"></textarea><br>
				<input id='submit-commentary' class="submit-changer" type="button" value="Submit">
			</form>
			<h3>Predict Barca Updates</h3>
			<form method="POST">
				Updates:<br><textarea class="field-edit-pro-mes" type="text" name="bpupdates"></textarea><br>
				<input class="submit-changer" type="submit" name="submit-b-upd" value="Submit">
			</form>
			<?php
				if(isset($_POST['submit-b-upd'])){
					$pbupdate = $_POST['bpupdates'];
					$pb->UpdateBarcaNew($pbupdate);
				}
			?>
			<br>
			<form method="POST">
				<input class="submit-changer" type="submit" name="truncate-updates" value="Delete All Updates">
			</form>
			<?php
				if(isset($_POST['truncate-updates'])){
					$pb->TruncateAllUpdates();
				}
			?>
			<h3>Insert Winner</h3>
			<form method="POST">
				Transfer Image:<br><input class="form-changer" type="text" name="image" required><br>
				Name:<br><input class="form-changer" type="text" name="name" required><br>
				Email:<br><input class="form-changer" type="email" name="email" required><br>
				Username:<br><input class="form-changer" type="text" name="username" required><br>
				Phone Number:<br><input class="form-changer" type="text" name="phonenumber" required><br>
				Amount:<br><input class="form-changer" type="text" name="amount" placeholder="1,100" required><br>
				Date:<br><input class="form-changer" type="text" name="date" required><br>
				<input class="submit-changer" type="submit" name="submit-new-winner" value="Submit">
			</form>
			<?php
				if(isset($_POST['submit-new-winner'])){
					$image = $_POST['image'];
					$name = $_POST['name'];
					$email = $_POST['email'];
					$username = $_POST['username'];
					$phonenumber = $_POST['phonenumber'];
					$amount = $_POST['amount'];
					$date = $_POST['date'];
					$pb->BarcaWinner($image, $name, $email, $username, $phonenumber, $amount, $date);
				}
			?>
			<br>
			<form method="POST">
				<input class="submit-changer" type="submit" name="randomly-select-winner" value="Randomly Select Winners">
			</form>
			<br>
			<?php
				if(isset($_POST['randomly-select-winner'])){
					$pb->ChooseWinner();
				}
			?>
			<script type="text/javascript">
				$(function(){
					var load_pages = 5;
					$("#check-win").click(function(){
						load_pages = load_pages + 5;
						$("#checking-winners").load("../load-more-wins.php", {load_pages_new: load_pages});
					});
				});
			</script>
			<h3>Check Winner</h3>
			<div id="checking-winners">
				<?php $pb->CheckWinner(); ?>
			</div>
			<br><br>
			<table align="center";>
				<tr>
					<td>
						<input id="check-win" class="read-more" type="button" value="Read More">
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php include("footer.php"); ?>
</body>
</html>