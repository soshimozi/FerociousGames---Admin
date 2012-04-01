<?php

class UsersController extends AppController {
    var $name = 'Users';    
    //var $components = array('Auth'); // Not necessary if declared in your app controller
 
	function register() {
		if ($this->data) {
			if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['password_confirm'])) {
				$this->User->create();
				$this->User->save($this->data);
			}
		}  
	}	
	
	function beforeFilter() {
			//$this->Auth->allow('register');
	}
	
	
    /**
     *  The AuthComponent provides the needed functionality
     *  for login, so you can leave this function blank.
     */
    function login() {
		//echo "fuck ckae sucks!";
		//die();
		
		//echo "fuck me fuck me!";
    }

    function logout() {
        $this->redirect($this->Auth->logout());
    }
}

?>