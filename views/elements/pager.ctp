<!-- padding: 2px 6px; border-color: #999; font-weight: bold; font-size: 13px; vertical-align: top; background: #fff; color: #FF0084; -->


<div class="PagesFlickr">
	<div class="Paginator">
		<span class="AtStart"><?php echo $paginator->prev('< prev', null, null); ?></span>
		<?php 
		   // the maximum number of pages to display in the range of numbers
			$pageIndex = $curpage;
			$maxPages = 9; 
			$totalPages = $paginator->counter(array('format' => '%pages%')); 

			// set defaults 
			$currentPage = $pageIndex+1; 
			$startPage = 1; 
			$endPage = $totalPages; 
			
			// adjust startPage if the currentPage is more than maxPages
		?>

			<?php if ($currentPage >= $maxPages): ?>
			<?php $startPage = $pageIndex; ?>
				<a onclick="javascript:changePage('<?php echo $category; ?>',1, '<?php echo $limit; ?>');" href="#">1</a>		
				<span class="break">...</span>            
			<?php endif; ?>


			<?php
				// adjust endPage if the page count is more than maxPages
				if ($totalPages > $maxPages) 
					$endPage = $startPage + $maxPages; 
					
				// display the range of page number links (upto maxPages)
				if( (min($endPage, $totalPages) - $startPage) < 9 ) {
					$startPage = max(1, min($endPage, $totalPages) - 9);
				}
				
			?>
			<?php for ($i = $startPage; ($i <= $endPage && $i<= $totalPages); $i++): ?>
				<?php if ($i == $curpage) { ?>
					<span class="this-page"><?php echo $i ?></span>
				<?php } else { ?>
					<a onclick="javascript:changePage('<?php echo $category; ?>',<?php echo $i; ?>, '<?php echo $limit; ?>');" href="#"><?php echo $i; ?></a>		
				<?php } ?>
			<?php endfor; ?>

			<?php if (($endPage < $totalPages) && ($endPage != $totalPages)): ?>
			
				<span class="break">...</span>            
				<a onclick="javascript:changePage('<?php echo $category; ?>',<?php echo $totalPages; ?>, '<?php echo $limit; ?>');" href="#"><?php echo $totalPages; ?></a>
				
			<?php endif; ?> 
			 
		<span class="Next"><?php echo $paginator->next('next >', null, null);?></span>

		<!-- Items per page: -->  
		<div class="items-per-page" >
			<select id="sel-limit" onchange="changeLimit('mochi_feed_entries', this.value)">
			  <option value="10"<?=($limit == '10') ? ' selected="selected"' : ''?>> 10 Items Per Page</option>
			  <option value="20"<?=($limit == '20') ? ' selected="selected"' : ''?>> 20 Items Per Page</option>
			  <option value="50"<?=($limit == '50') ? ' selected="selected"' : ''?>> 50 Items Per Page</option>
			  <option value="100"<?=($limit == '100') ? ' selected="selected"' : ''?>>100 Items Per Page</option> 
			</select>									
		</div>
		<div style="color:#999; font-size:smaller;font-style:italic;">
		<?php
			echo $this->Paginator->counter(array(
				'format' => '(%count% games)')); 
		?>	
		</div>
		
	</div>  
</div>
