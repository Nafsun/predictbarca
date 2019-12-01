<div id="match-top">
		<div id="transfer-news-div">
			<p id="tnd">Transfer News</p>
			<?php $pb->DisplayNewsSummary("transfer news"); ?>
			<p id="tnd">Latest Barca News</p>
			<?php $pb->DisplayNewsSummary("latest barcelona news"); ?>
		</div>
		<?php $pb->DisplayBarcaMatchLogo(); ?>
		<div id="barca-match-div">
			<p id="bmd">Barcelona Matches</p>
			<?php $pb->DisplayBarcelonaFutureMatches(5); ?>
			<p id="bmd">Predict B. Updates</p>
			<?php $pb->DisplayPUpdates(); ?>
		</div>
		<?php $pb->DisplayOpponentMatchLogo(); ?>
	</div>
	<div id="clear"></div>