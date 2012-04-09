<?php
  
class MochiFeedEntriesController extends AppController {
	var $name = 'MochiFeedEntries';

	var $helpers = array('Form', 'Html', 'Javascript', 'Time', 'Session');
	var $uses = array('MochiFeedEntry', 'MochiConfig', 'Category');
	
	function index() {
 
		if(!empty($this->params) ) {
			if( isset($this->params['named']['category']))  {
				$category = $this->params['named']['category'];
			}
			if( isset($this->params['form']) && isset($this->params['form']['search']) )  {
				$search = $this->params['form']['search'];
			}
		} 
		
		if( empty($search) ) {
			if( $this->Session->check("search") ) {
				$search = $this->Session->read("search");
			}
		} else {
			trim($search);
			if( !empty($search) ) {
				$this->Session->write("search", $search);
			}
			
			$search = trim($search);
		}
		
		$conditions = array(); 
		if(!empty($category) ) { 
			if( $category == "premium" ) {
				$conditions = array('MochiFeedEntry.leaderboard_enabled' => '1'); 
				$catname = "Premium";
			} else if($category == "coins" ) {
				$conditions = array('MochiFeedEntry.coins_enabled' =>  '1'); 
				$catname = "Coins";
			} else if($category == "revshare") {
				$conditions =  array("MochiFeedEntry.coins_revshare_enabled" => "1"); 
				$catname = "Revenue Share";
			} else {
				$conditions =  array("lower(MochiFeedEntry.category) LIKE" => "%".low($category)."%"); 
				$catname = $category;
			}
			
		}  else {
			$catname = "All";
			$category = "";
		}
			 
		$filter = "";
		if( !empty($search) ) {
			if( !empty($conditions) ) {
				$conditions = array( 'AND' => array( $conditions, 'OR' => array( 'MochiFeedEntry.name LIKE' => '%'.$search.'%', 'MochiFeedEntry.category LIKE' => '%'.$search.'%', 'MochiFeedEntry.categories LIKE' => '%'.$search.'%', 'MochiFeedEntry.tags LIKE' => '%'.$search.'%')));
			} else {
			
				$conditions = array('OR' => array( 'MochiFeedEntry.name LIKE' => '%'.$search.'%', 'MochiFeedEntry.category LIKE' => '%'.$search.'%', 'MochiFeedEntry.categories LIKE' => '%'.$search.'%', 'MochiFeedEntry.tags LIKE' => '%'.$search.'%'));
			}
			
			$filter = $search;
		}

		$this->paginate = array(
			'fields' => array('MochiFeedEntry.*', 'MochiGame.id'),
			'conditions' => $conditions,
			'order' => array('MochiFeedEntry.metascore' => 'DESC')
		);
		
		$entries = $this->paginate('MochiFeedEntry');
		
		if(isset($this->params['requested'])) {
			return $entries;
		}  
		 
		$this->set('entries', $entries);			
		$this->set('catname', $catname);
		$this->set('category', $category);
		$this->set('filter', $filter);		
		$this->set('categories', $this->Category->find('all'));
	}
	 
	function view($gametag) {
		$rec = $this->MochiFeedEntry->findByGameTag($gametag);
		$this->set(compact('rec'));
	}	
	
	function addgame($gametag) {
		$config_entry = $this->MochiConfig->find('first', array('conditions' => array('MochiConfig.name' => 'auto-post-url')));
		
		if( !empty($config_entry) ) {
			$this->do_post_request($config_entry['MochiConfig']['value'], "game_tag=$gametag");
		}
	}
	
	function clearsearch() {
		$this->Session->write("search", null);
		$this->redirect(array('controller' => 'mochi_feed_entries', 'action' => 'index'));
	}
	
	function do_post_request($url, $data, $optional_headers = null) 
	{ 
		$params = array('http' => array( 
		'method' => 'POST', 
		'content' => $data 
		)); 
		
		if ($optional_headers!== null) { 
			$params['http']['header'] = $optional_headers; 
		} 
		
		$ctx = stream_context_create($params); 
		$fp = @fopen($url, 'rb', false, $ctx); 
		if (!$fp) { 
			throw new Exception("Problem with $url, $php_errormsg"); 
		}
		
		$response = @stream_get_contents($fp); 
		if ($response === false) { 
			throw new Exception("Problem reading data from $url, $php_errormsg"); 
		} 
		
		return $response; 
	}
	
}
?>
