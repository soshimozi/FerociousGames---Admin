<!-- File /home/ferociousone/dev.ferociousgames.com/app/views/mochi_feed_entries/admin_index.ctp -->

<?php echo $javascript->link('setUrl', array('allowCache' => true, 'inline' => false)); ?> 
<?php echo $javascript->link('dialog', array('allowCache' => true, 'inline' => false)); ?> 
<?php //echo $javascript->link('page', array('allowCache' => true, 'inline' => false)); ?> 

<?php echo $html->css('dialog');?> 

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
 
			<div id="gamecontent">
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
					<form action="/mochi_feed_entries/index/category:<?php echo $category; ?>" method="POST">
						<input type="text" value="" style="width:90px;" name="search" id="search" />
						<input type="submit" value="Search" />
					</form>
					<div style="padding-top:5px;">
					<h3>Showing <?php echo $catname; ?> Games</h2>
					</div>
					</div> 

					<div style="border-bottom: 1.5px solid #DBCCB6; margin-bottom:2px;">
					<?php if ($session->check('search')): ?>
						<form action="/mochi_feed_entries/clearsearch/" method="POST">
						<span style="font-weight:bold; font-size:smaller; color:#844A19;">
							Filtered By '<?php echo $session->read('search'); ?>'
							<input style="margin: 2px 2px 2px 2px;" type="submit" value="Clear" /></span>
						</form>
					<?php else: ?>
						<span style="font-weight:bold; font-size:smaller; color:#844A19;">
							No Filter
						</span>
					<?php endif; ?>
					</div>
					 
					<?php  echo $this->element('sidebar'); ?>
				</div> 
			</div>
			<div id="content">
				<div class="oi2"> 
				

					<div class="float-divider"></div>
				<?php echo $this->element('topadvert'); ?>
					<div class="float-divider"></div>

					<?php  echo $this->element('pager', array("curpage" => $curpage, "limit" => $limit)); ?>

					<div class="float-divider"></div>
					
					<div style="float: left; vertical-align: bottom;">
					<input type="button" id="addGame" style="margin:10px;" value="Add Games" />
					</div>

					<div class="float-divider"></div>

					<?php foreach($entries as $rec): ?>  
						<?php  echo $this->element('gamecontainer', array("game" => $rec['MochiFeedEntry'])); ?>
					<?php endforeach; ?>

					<div class="float-divider"></div>

					<div style="display: inline-block; vertical-align:bottom;">
					<input type="button" id="addGame" style="margin:10px;" value="Add Games" />
					</div>

					<div class="float-divider"></div>

					<?php  echo $this->element('pager', array("curpage" => $curpage, "limit" => $limit)); ?>
					
					
				</div>
			</div>
		</div>
	</div>
		
