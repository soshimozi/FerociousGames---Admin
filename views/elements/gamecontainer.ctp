<div class="game_container" >
	<input type="checkbox" name="gametag[]" value="<?php echo $game['game_tag']; ?>" />
	<div class="game_thumb"> 
		<a id="<?php echo $game['game_tag']; ?>" href="javascript:showGame('#<?php echo $game['game_tag']; ?>', '<?php echo $game['game_tag']; ?>');">
		<img src="<?php echo $game['thumbnail_url']; ?>" alt="<?php echo $game['name']; ?>">
		</a>
		<?php if($game['leaderboard_enabled'] || $game['coins_enabled'] || $game['coins_revshare_enabled']): ?>
		<div class="features">
		  <div>
			<?php if($game['leaderboard_enabled']): ?>
			<span class="lb_enabled" title="Leaderboard Enabled"></span>
			<?php endif; ?>
			
			<?php if($game['coins_enabled']): ?>
			<span class="poi_enabled" title="Coins Enabled"></span>
			<?php endif; ?>
		  </div>
		</div>
		 <?php endif; ?>
		<div class="meta">
		  <h3><?php echo $game['name']; ?></h3>
		  <h4>By: <strong><a href="<?php echo $game['author_link']; ?>"><?php echo $game['author']; ?></a></strong></h4>
		  <h4>Category: <?php echo $game['category']; ?></h4>
			<?php if($game['coins_revshare_enabled']): ?>
			<h4 class="poi">Coins Revshare Enabled</h4>
			<?php endif; ?>
		</div>
	</div>
</div>