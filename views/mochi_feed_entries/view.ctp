<!-- File /home/ferociousone/cake/apps/admin/views/mochi_entry/view.ctp -->
<?php
$now = date("m/d/Y h:i:s a");
$to_time=strtotime($now);
$from_time=strtotime($rec['MochiFeedEntry']['updated']);
$hours = (int)(abs($to_time - $from_time) / (60 * 60));

if( $hours > 240 ) {
	$days = (int)($hours / 24);
	$timestring = "$days days ago";
	
} else {
	$timestring = "$hours hours ago"; 
}

?>
  
  
<?php echo $html->css('game-info');?> 

<div id="game_info">
	<div id="key_meta">
		<div class="thumb">
			<a target="_blank" href="<?php echo $rec['MochiFeedEntry']['game_url']; ?>"><img alt="<?php echo $rec['MochiFeedEntry']['name']; ?>" src="<?php echo $rec['MochiFeedEntry']['thumbnail_url']; ?>"></a>
        </div>
		<div style="display:inline-block;">
			<a class="game-link" target="_blank" href="<?php echo $rec['MochiFeedEntry']['game_url']; ?>"><?php echo $rec['MochiFeedEntry']['name']; ?></a>
			<div class="float-divider"></div>
			<div style="font-style:italic;font-size:.75em;">Added <?php echo $timestring; ?></div>
			<div class="float-divider"></div>
			<div style="display:inline-block;text-align:right;width:75px;font-size:.83em;color:#ff0084;font-weight:bold;">Content Rating:</div>
			<div style="display:inline-block;font-weight:bold;"><?php echo $rec['MochiFeedEntry']['rating']; ?></div>
			<div class="float-divider"></div>
			<div style="display:inline-block;text-align:right;width:75px;font-size:.83em;color:#ff0084;font-weight:bold;">Size:</div>
			<div style="display:inline-block;font-weight:bold;"><?php echo $rec['MochiFeedEntry']['resolution']; ?></div>
			<div class="float-divider"></div>
			<div style="display:inline-block;text-align:right;width:75px;font-size:.83em;color:#ff0084;font-weight:bold;">Created by: </div>
			<div style="display:inline-block;"><a class="author-link" target="_blank" href="<?php echo $rec['MochiFeedEntry']['author_link']; ?>"><?php echo $rec['MochiFeedEntry']['author']; ?></a></div>
		</div>
		<div class="float-divider"></div>
		<ul style="float:left; min-width:420px; width:420px; max-width:420px">
			<li><strong>Primary Category:</strong> <?php echo $rec['MochiFeedEntry']['category']; ?></li>
			<li><strong>Secondary Categories:</strong> <?php echo $rec['MochiFeedEntry']['categories']; ?></strong> </li>
			<li><strong>Tags:</strong> <?php echo $rec['MochiFeedEntry']['tags']; ?></li>
		</ul>
		
		<?php if( empty($rec['MochiGame']['id']) ): ?>
		<div>
		<div style="float:left;"><input type="button" value="Add Game" onclick="javascript:addSingleGame('<?php echo $rec['MochiFeedEntry']['game_tag']; ?>');" /></div>
		<div style="float:left; padding-left:8px;" id="gamestatusblock"></div>
		</div>
		<?php endif; ?>
		

	</div>
	<div id="secondary_meta">
		<div id="game_desc">
			<h4>Description:</h4> <?php echo $rec['MochiFeedEntry']['description']; ?></p>
		</div>
		<div id="instructions">
			<div>
				<h4>Instructions:</h4>
				<?php echo $rec['MochiFeedEntry']['instructions']; ?>
			</div>
		</div>
		<div id="game_video">
			<?php if( $rec['MochiFeedEntry']['video_url'] ): ?>
				<h4>Game Video:</h4>
				<iframe width="520" height="315" src="<?php echo str_replace("www.youtube.com/watch?v=", "www.youtube.com/embed/", $rec['MochiFeedEntry']['video_url']); ?>" frameborder="0" allowfullscreen>
				</iframe>		
			<?php endif; ?>
		</div>			
		
	</div><!-- #secondary_meta -->
</div>