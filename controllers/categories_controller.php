<?php 

class CategoriesController extends AppController {

	function all() {
	
		$entries = $this->Category->find('all');
		
		pr($entries);
		
		if(isset($this->params['requested'])) {
			return $entries;
		}
	}
}

?>
