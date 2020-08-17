<?php
	$controller = '';
	$action = '';

	if(isset($_GET['controller'])) {
		$controller = $_GET['controller'];
		if(isset($_GET['action'])) {
			$action = $_GET['action'];
		}
	}

	$controller_path = 'controllers/' . ucfirst($controller) . 'Controller.php';
	if(!file_exists($controller_path)) {
		die("Controller " . $controller_path . " not exist.");
	}
	require_once $controller_path;

	$class = ucfirst($controller) . 'Controller';
	if(!class_exists($class)) {
		die("Class $class not exist in $controller_path");
	}
	$object = new $class;
	if(!method_exists($object, $action)) {
		die("Method " . $action . " not exist in class $class.");
	}
	$object->$action();
?>