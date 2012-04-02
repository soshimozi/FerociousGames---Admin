<h3 class="sidebar_header">Game Category</h3>		
<div id="categories" >  
	<select id="category-select" onchange="return changePage(this.value);">
		<option value="premium" <?=($category == "premium") ? ' selected="selected"' : ''?>>Premium Games</option>
		<option value="coins" <?=($category == "coins") ? ' selected="selected"' : ''?>>Coin Games</option>
		<option value="revshare" <?=($category == "revshare") ? ' selected="selected"' : ''?>>Revenue Share Games</option>
		<option value="" <?=($category == "") ? ' selected="selected"' : ''?>>All Games</option>
		<?php foreach($categories as $rec): ?>  
		<option value="<?php echo $rec['Category']['tag']; ?>" <?=($rec['Category']['tag'] == $category) ? ' selected="selected"' : ''?>><?php echo $rec['Category']['display']; ?></option>
		<?php endforeach; ?>
	</select>									
	</fieldset>
</div>				
