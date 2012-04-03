<!-- File /home/ferociousone/dev.ferociousgames.com/app/views/mochi_feed_entries/admin_index.ctp -->

<?php echo $javascript->link('setUrl', array('allowCache' => true, 'inline' => false)); ?> 
<?php echo $javascript->link('dialog', array('allowCache' => true, 'inline' => false)); ?> 
<?php echo $javascript->link('ui.selectmenu', array('allowCache' => true, 'inline' => false)); ?> 
<?php echo $javascript->link('index.ctp', array('allowCache' => true, 'inline' => false)); ?>
   
<?php echo $html->css('dialog');?> 
<?php echo $html->css('paginator');?> 
<?php echo $html->css('ui.selectmenu');?> 
<?php echo $html->css('spinner');?> 
<?php echo $html->css('game-thumb');?> 
<?php echo $html->css('game-info');?> 

  
<?php $curpage = 1; if( isset($this->params['named']) && isset($this->params['named']['page']) ) $curpage = $this->params['named']['page']; ?>
<?php $limit = 20; if( isset($this->params['named']) && isset($this->params['named']['limit']) ) $limit = $this->params['named']['limit']; ?>
    
	 		 
	<!-- #customize your modal window here --> 
	<div id="submitdlg" style="display:none;">
		<div id="modal_header"></div>
		
		<div id="statusblock">
		safsafsdf
		</div>

	</div>
		   
	<div id="gamedlg" style="display:none;"> 
		<div id="loading-div" style="display:none;">
			<div style="width: 400px; height: 120px; margin: 0px auto;vertical-align: middle;">
				<div id="circleG">
					<div id="circleG_1" class="circleG">
					</div>
					<div id="circleG_2" class="circleG">
					</div>
					<div id="circleG_3" class="circleG">
					</div>
				</div>		
			</div>  
		</div>		
		<div id="gamedlg-contents" style="display:none;">
			<div style="clear:both;"></div>
			<div id="modal_header" style="float:right;margin-top:10px;"><input type="button" class="close" value="Close"/></div>
			<div id="gamecontent"></div>
		</div>
	</div>		

	<div style="width:1100px; padding:15px;">
	
		<div style="margin-top:10px;">
			<div style="overflow:hidden; margin: 0px auto; height:90px; width: 728px;">
				<?php echo $this->element('topadvert'); ?>
			</div>
		</div>	
		
		<div id="bottom-div" style="border-top:.1em solid #DBCCB6; border-bottom:.1em solid #DBCCB6; margin-top:.5em; margin-bottom: .5em; padding:.5em;"> 

			<div id="inner-content" style="width:1000px; margin:0 auto;"> <!-- replaceable content from here -->
			
				<div style="width:950px; margin:0 auto;">
				<?php  echo $this->element('pager', array("curpage" => $curpage, "limit" => $limit, "category" => $category)); ?>
				</div>
				   
				<div class="float-divider"></div>

				<div id="content-holder" style="width: 980px; margin: 0px auto;"> 
				
					<div style="float:right; margin-right:25px;">
						<input id="addgame-button" type="button" value="Add Games" />
					</div>
				
					<div style="float:left; padding-top:5px; margin-left:5px;">
						<form id="searchform" action="/mochi_feed_entries/index/category:<?php echo $category; ?>" method="POST">
							<input type="text" value="" style="width:110px;" name="search" id="search" />
							<input id="search" type="submit" value="Search" />
						</form>
					</div> 

					<div style="float:left; padding-top:5px; margin-left: 15px;">
						<div style="display:inline-block; margin-left: 5px; margin-right:8px;"><h3>Category: </h3></div>
						<div id="categories" style="display:inline-block;" >  
							<select id="category-select" onchange="return changePage(this.value);">
								<option value="premium" <?=($category == "premium") ? ' selected="selected"' : ''?>>Premium Games</option>
								<option value="coins" <?=($category == "coins") ? ' selected="selected"' : ''?>>Coin Games</option>
								<option value="revshare" <?=($category == "revshare") ? ' selected="selected"' : ''?>>Revenue Share Games</option>
								<option value="" <?=($category == "") ? ' selected="selected"' : ''?>>All Games</option>
								<?php foreach($categories as $rec): ?>  
								<option value="<?php echo $rec['Category']['tag']; ?>" <?=($rec['Category']['tag'] == $category) ? ' selected="selected"' : ''?>><?php echo $rec['Category']['display']; ?></option>
								<?php endforeach; ?>
							</select>									
						</div>				
					</div>
   
					<div class="float-divider"></div>
					
					<div style="float:left; padding-top:5px; margin-left: .5em;">  
					<?php if ($session->check('search')): ?>
						<form id="clearfilterform" action="/mochi_feed_entries/clearsearch/" method="POST">
							<span style="font-weight:bold; font-size:smaller; color:#844A19;">
							Filtered By '<?php echo $session->read('search'); ?>'</span>
							<input style="margin: 2px 2px 2px 2px;" type="submit" value="Clear" />
						</form>
					<?php else: ?>
						<span style="font-weight:bold; font-size:smaller; color:#844A19;">
							No Filter
						</span>
					<?php endif; ?>
					</div>
					
					<div class="float-divider"></div>

					<?php foreach($entries as $rec): ?>  
						<?php echo $this->element('gamecontainer', array("game" => $rec['MochiFeedEntry'], "mochi_game_id" => $rec['MochiGame']['id'])); ?>
					<?php endforeach; ?>
						
					<div class="float-divider"></div>
					
				
				</div> <!-- content-holder -->
				
				<div style="width:950px; margin:0 auto;">
				<?php  echo $this->element('pager', array("curpage" => $curpage, "limit" => $limit)); ?>
				</div>
				
			</div> <!-- inner-content -->
			
		</div> <!-- bottom div -->
		
		<div class="float-divider"></div>
		
		<div style="margin-bottom:10px;">
			<div style="overflow:hidden; margin: 0px auto; height:90px; width: 728px;">
				<?php echo $this->element('bottomvert'); ?>
			</div>
		</div>	
		
	</div>  
