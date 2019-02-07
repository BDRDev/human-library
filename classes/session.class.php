<?php


class Session {

	protected $sessionId;

	//This is going to be used for looping through all of the sessions
	protected $session_name = array("userId", "user_role");
	
	//I want to have functions for destroying all sessions, and getting a list of all sessions,
	//check to see if a session exists, 

	//checks to see if the session has been started, if not start the session
	public function __construct(){
		if(!isset($_SESSION)){
			$this->init_session();
		}
	}

	//starts a session
	public function init_session(){
		session_start();
	}

	public function create_session($session_name, $session_value){
		$_SESSION[$session_name] = $session_value;
	}

	public function get_session($session_name){
		//runs if a session value is returned
		if(isset($_SESSION[$session_name])){

			return $_SESSION[$session_name];

		} else {
			//runs if null

			return "Sorry, " . $session_name . " is not currently set";

		}
	}

	public function get_all_sessions(){

	}

	public function remove_session($session_name){
		if(isset($_SESSION[$session_name])){

			unset($_SESSION[$session_name]);

		} else {
			//runs if null

			return "Sorry, " . $session_name . " is not currently set";

		}

	}

	public function test_function(){
		return "hooked up to the Session Class";
	}
}