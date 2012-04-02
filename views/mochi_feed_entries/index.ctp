<!-- File /home/ferociousone/dev.ferociousgames.com/app/views/mochi_feed_entries/admin_index.ctp -->

<?php echo $javascript->link('setUrl', array('allowCache' => true, 'inline' => false)); ?> 
<?php echo $javascript->link('dialog', array('allowCache' => true, 'inline' => false)); ?> 
<?php echo $javascript->link('ui.selectmenu', array('allowCache' => true, 'inline' => false)); ?> 
<?php echo $javascript->link('index.ctp', array('allowCache' => true, 'inline' => false)); ?>
   
<?php echo $html->css('dialog');?> 
<?php echo $html->css('paginator');?> 
<?php echo $html->css('ui.selectmenu');?> 
<?php echo $html->css('spinner');?> 
  
<?php $curpage = 1; if( isset($this->params['named']) && isset($this->params['named']['page']) ) $curpage = $this->params['named']['page']; ?>
<?php $limit = 20; if( isset($this->params['named']) && isset($this->params['named']['limit']) ) $limit = $this->params['named']['limit']; ?>
    
	 <div id="boxes"> 
	 		 
		<!-- #customize your modal window here --> 
	 	<div id="submitdlg" class="window">
			<div id="modal_header"></div>
			
			<div id="statusblock">
			</div>
 
		</div>
		
		<div id="gamedlg" class="window">
			<div style="clear:both;"></div>
			<div id="modal_header" style="float:right;margin-top:10px;"><input type="button" class="close" value="Close"/></div>
 			<div id="gamecontent"></div>
		</div>		
	 
		<div id="loading-div" class="window">
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
		
		<!-- Do not remove because youll need it to fill the whole screen --> 
		<div id="dlgmask"></div>
	</div>

	<div id="main">
		<div class="oi1">
			<div id="nav"> 
				<div class="oi2"> 
					<div class="search-box" >
					<form id="searchform" action="/mochi_feed_entries/index/category:<?php echo $category; ?>" method="POST">
						<input type="text" value="" style="width:110px;" name="search" id="search" />
						<input id="search" type="submit" value="Search" />
					</form>
					</div> 

					<div style="border-bottom: 1.5px solid #DBCCB6; margin-bottom:2px;">
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
					 
					<?php  echo $this->element('sidebar', array("categories" => $categories, "category" => $category)); ?>
					
					<div style="margin-top:10px;">
						<div class="side-advert-container">
							<?php echo $this->element('sideadvert'); ?>
						</div>
					</div>
					
				</div> 
			</div>
			<div id="content">
				<div class="top-advert-container">			
					<?php echo $this->element('topadvert'); ?>
				</div>    
			
				<div id="inner-content">
					<div class="oi2">  

						<?php  echo $this->element('pager', array("curpage" => $curpage, "limit" => $limit, "category" => $category)); ?>
						<div class="float-divider"></div>
						
						<div class="addgame"><input type="button" style="margin-top:10px;" value="Add Games" /></div>
  
						<div class="float-divider"></div>
						<div id="content-holder" style="width: 830px; margin: 0px auto;">
							<?php foreach($entries as $rec): ?>  
								<?php  echo $this->element('gamecontainer', array("game" => $rec['MochiFeedEntry'], "mochi_game_id" => $rec['MochiGame']['id'])); ?>
							<?php endforeach; ?>
						</div>

						<div class="float-divider"></div>
						<div class="addgame"><input type="button" style="margin-bottom:10px;" value="Add Games" /></div>

						<div class="float-divider"></div>
						<?php  echo $this->element('pager', array("curpage" => $curpage, "limit" => $limit)); ?>

					</div>
				</div>
			</div>
		</div>
	</div>
		
