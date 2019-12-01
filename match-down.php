<div id="clear"></div><br><br>
	<div id="transfer-news-div-2">
		<p id="tnd">Transfer News</p>
		<?php $pb->DisplayNewsSummary("transfer news"); ?><br>
		<p id="tnd">Latest Barca News</p>
		<?php $pb->DisplayNewsSummary("latest barcelona news"); ?>
	</div>
	<div id="barca-match-div-2">
		<p id="bmd">Barcelona Matches</p>
		<?php $pb->DisplayBarcelonaFutureMatches(5); ?>
		<p id="bmd">Predict Barca Updates</p>
		<?php $pb->DisplayPUpdates(); ?>
	</div>
	<br>
	<br>