<div class="browse_numpart">
	<div class="browse_nummd">
		<!-- Items per page: -->
		<div style="clear:both; font:bold 12px Arial; text-align:center; padding-top:3px;">
			Items Per Page: 
			<select onchange="changeLimit('mochi_feed_entries', this.value)">
			  <option value="10"<?=($limit == '10') ? ' selected="selected"' : ''?>>10</option>
			  <option value="20"<?=($limit == '20') ? ' selected="selected"' : ''?>>20</option>
			  <option value="50"<?=($limit == '50') ? ' selected="selected"' : ''?>>50</option>
			  <option value="100"<?=($limit == '100') ? ' selected="selected"' : ''?>>100</option> 
			</select>									
		</div>
		<div style="clear:both; font:bold 12px Arial; text-align:center; padding-top:3px;">
			Showing page <span style="color:#556B2F;"><?php echo $curpage; ?></span> of <span style="color:#556B2F;"><?php echo $paginator->counter(array('format' => '%pages%')); ?></span> 
		</div>					
		<div style="padding-top:4px; text-align: center;">
			<div style="display:inline-block; width:100px; text-align:center;">
				<?php echo $paginator->first('<<'); ?>&nbsp;&nbsp;&nbsp;<?php echo $paginator->prev('PREV', null, null); ?>
			</div>
			<div style="display:inline-block; width:100px; text-align:center;">
				<!-- Page: -->
				<select onchange="setURL('page', this.value)">
				<?php for ($i = 1; $i <= $paginator->counter(array('format' => '%pages%')); $i++): ?>
				  <option value="<?=$i?>"<?=($curpage == $i) ? ' selected="selected"' : ''?>><?=$i?></option>
				<?php endfor ?>
				</select>
			</div>
			<div style="display:inline-block; width:100px; text-align:center;">
				<?php echo $paginator->next('NEXT', null, null); ?>&nbsp;&nbsp;&nbsp;<?php echo $paginator->last('>>'); ?>
			</div>
		</div>
	</div>
</div>	