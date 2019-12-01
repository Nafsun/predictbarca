<script type="text/javascript">
    $(document).ready(function() {
     $('#loading').hide();
	});
	window.onbeforeunload = function () { $('#loading').show(); } 
</script>
<div id="loading">
  <img id="loading-image" src="../images/loading.gif" alt="Loading..." />
</div>
<div id="barca-top">
		<img id="barca-image" src="../images/predict barca.png" alt="barcelona logo">
		<h1>PREDICT BARCA</h1>
		<div id="clear"></div>
		<div id="menu-lap">
			<a class="space-in-nav" href="../">HOME</a>
			<a class="space-in-nav" href="../register.php">REGISTER</a>
			<a class="space-in-nav" href="../login.php">LOGIN</a>
			<a class="space-in-nav" href="../won.php">WON</a>
			<a class="space-in-nav" href="../barcelona-news.php">NEWS</a>
			<a class="space-in-nav" href="../predictions.php">PREDICTIONS</a>
			<?php if(isset($_SESSION['username'])){echo "<a class='space-in-nav' href='../account.php'>ACCOUNT</a>";} ?>
			<a id='brcl' class="space-in-nav">BARCELONA</a>
		</div>
		<div id="menu-lap-2">
			<p><a class="space-in-nav" href="../">HOME</a>
			<a class="space-in-nav" href="../register.php">REGISTER</a>
			<a class="space-in-nav" href="../login.php">LOGIN</a>
			<a class="space-in-nav" href="../won.php">WON</a>
			<a class="space-in-nav" href="../barcelona-news.php">NEWS</a>
			<a class="space-in-nav" href="../transfer-news.php">TRANSFER</a>
			<a class="space-in-nav" href="../predictions.php">PREDICTIONS</a>
			<a class="space-in-nav" href="../barcelona-matches.php">MATCHES</a>
			<a class="space-in-nav" href="../barcelona-scores.php">SCORES</a>
			<a class="space-in-nav" href="../barcelona-video-highlights.php">VIDEO</a>
			<a class="space-in-nav" href="../barcelona-squad.php">SQUAD</a>
			<a class="space-in-nav" href="../history-of-barcelona.php">HISTORY</a>
			<a class="space-in-nav" href="../barcelona-trophies.php">TROPHIES</a></p>
		</div>
		<div id="menu-phone">
			<p><a class="space-in-nav" href="../">HOME</a></p>
			<p><a class="space-in-nav" href="../register.php">REGISTER</a></p>
			<p><a class="space-in-nav" href="../login.php">LOGIN</a></p>
			<p><a class="space-in-nav" href="../won.php">WON</a></p>
			<p><a class="space-in-nav" href="../barcelona-news.php">NEWS</a></p>
			<p><a class="space-in-nav" href="../predictions.php">PREDICTIONS</a></p>
			<?php if(isset($_SESSION['username'])){echo "<a class='space-in-nav' href='../account.php'>ACCOUNT</a>";} ?>
			<p><a id='brcl2' class="space-in-nav">BARCELONA</a></p>
		</div>
		<div id="barcelona-appear">
			<p><a href="../transfer-news.php">Transfer News</a></p>
			<p><a href="../barcelona-matches.php">Barcelona Matches</a></p>
			<p><a href="../latest-barcelona-news.php">Latest Barcelona News</a></p>
			<p><a href="../barcelona-video-highlights.php">Barcelona Video Highlights</a></p>
			<p><a href="../barcelona-scores.php">Barcelona Scores</a></p>
			<p><a href="../barcelona-squad.php">Barcelona Squad</a></p>
			<p><a href="../history-of-barcelona.php">History of Barcelona</a></p>
			<p><a href="../barcelona-trophies.php">Barcelona Trophies</a></p>
		</div>
		<div id="barcelona-appear-2">
			<p><a href="../transfer-news.php">Transfer News</a></p>
			<p><a href="../barcelona-matches.php">Barcelona Matches</a></p>
			<p><a href="../latest-barcelona-news.php">Latest Barcelona News</a></p>
			<p><a href="../barcelona-video-highlights.php">Barcelona Video Highlights</a></p>
			<p><a href="../barcelona-scores.php">Barcelona Scores</a></p>
			<p><a href="../barcelona-squad.php">Barcelona Squad</a></p>
			<p><a href="../history-of-barcelona.php">History of Barcelona</a></p>
			<p><a href="../barcelona-trophies.php">Barcelona Trophies</a></p>
		</div>
	</div>
	<div id="clear"></div>