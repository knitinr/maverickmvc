<?php
class App {
	public $uri_segments;
	public $controller_name;
	public $action_name;
	public $parameters;
	
	public function __construct() {
		if ($_GET['url']!='index.php') {
			$this->uri_segments = explode('/', $_GET['url']);
		} else {
			$this->uri_segments = array();
		}
		
		if (count($this->uri_segments) > 0) {
			$this->controller_name = $this->uri_segments[0];
			if (count($this->uri_segments) > 1 && $this->uri_segments[1]) {
				$this->action_name = $this->uri_segments[1];
				if (count($this->uri_segments) > 2) {
					$this->parameters = $this->uri_segments;
					
					array_shift($this->parameters);
					array_shift($this->parameters);
				} else {
					$this->parameters = array();
				}
			} else {
				$this->action_name = 'index';
				$this->parameters = array();
			}
		} else {
			$this->controller_name = 'welcome';
			$this->action_name = 'index';
			$this->parameters = array();
		}
	}
	
	public function load() {
		App::output($this->controller_name, $this->action_name, $this->parameters);
	}
	
	public static function output($controller_name = NULL, $action_name = NULL, $parameters = array()) {
		global $config;
		$candidate_controller_filename = 'controller/'.$config['controller_prefix'].$controller_name.$config['controller_suffix'].'.php';
		$controller_obj = NULL;
		if (file_exists($candidate_controller_filename)) {
			include_once('inc/class.controller.php');
			include($candidate_controller_filename);
			if (class_exists($controller_name)) {
				$controller_obj = new $controller_name;
				
				if (method_exists($controller_obj, $config['action_prefix'].$action_name.$config['action_suffix'])) {
					call_user_func_array(array($controller_obj, $action_name), $parameters);
					//$controller_obj->{$this->action_name}($this->parameters);
				}
			}
		}
	}
}
?>