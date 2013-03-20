<?php
class Controller {
	function loadModel($model_name) {
		global $config;
		$candidate_model_filename = 'model/'.$config['model_prefix'].$model_name.$config['model_suffix'].'.php';
		$model_class_name = $config['model_prefix'].$model_name.$config['model_suffix'];
		if (file_exists($candidate_model_filename)) {
			include($candidate_model_filename);
			if (class_exists($model_class_name)) {
				$this->$model_name = new $model_class_name();
			}
		}
	}
	
	function loadView($view_name, $data = NULL) {
		if ($data) extract($data);
		$candidate_model_filename = 'view/'.$view_name.'.php';
		if (file_exists($candidate_model_filename)) {
			include($candidate_model_filename);
		}
	}
}