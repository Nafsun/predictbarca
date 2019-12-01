<div id="clear"></div>
<table align="center">
	<tr>
		<td>
			<div id="subscribe">
				<form method="POST">
					<input class="subscribe-field-insert" type="email" name="subscribe" placeholder="Enter your Email here to Subscribe for newsletter" required>
					<input class="subscribe-submit" type="submit" name="subscribe-email" value="Subscribe">
				</form>
				<?php 
					if(isset($_POST['subscribe-email'])){
						$pb->Subscribtion($_POST['subscribe']);
					}
				?>
			</div>
		</td>
	</tr>
</table>
<footer>
		<div id="bap">
			<p>PREDICT BARCA&copy;2019</p>
			<p><a href="about-us.php">About us</a></p>
			<p><a href="privacy-and-policy.php">Privacy and Policy</a></p>
		</div>
		<div id="prt">
			<p><a href="#" target="__blank">Powered by Mustiash Tech Company</a></p>
			<p>RC 1562845</p>
			<p><a href="terms-and-condition.php">Terms and Condition</a></p>
		</div>
		<div id="clear"></div>
		<div id="footer-down">
			<p id="cu"><a href="mailto:contact@predictbarca.com">Contact us</a></p>
			<div id="fu">Follow us 
			<a href="https://www.facebook.com/predictbarca" target="__blank"><img class="social" src="images/facebook.png" alt="facebook"></a> 
			<a href="https://www.twitter.com/predictbarca" target="__blank"><img class="social" src="images/twitter.png" alt="twitter"></a> 
			<a href="https://www.instagram.com/predictbarca" target="__blank"><img class="social" src="images/instagram.png" alt="instagram"></a>
			<a href="https://chat.whatsapp.com/DfnVZITQ3h5DISHAEaAncd" target="__blank"><img class="social" src="images/whatsapp.png" alt="whatsapp"></a>
			</div>
		</div>
	</footer>