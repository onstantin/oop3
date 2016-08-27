<?php
error_reporting(E_ALL);
require_once "feedable.interface.php";

function class_autoload($class_name) {
	$file_name = "classes/".mb_strtolower($class_name,"utf-8").".class.php";
	if (file_exists($file_name)) {
		require_once($file_name);
	}
}

function core_autoload($class_name) {
	$class_name = str_replace("_", ".", $class_name);
	$file_name = "core/".mb_strtolower($class_name,"utf-8").".php";
	if (file_exists($file_name)) {
		require_once($file_name);
	} else {
		header("HTTP/1.0 404 Not Found");
		die("Такой категории не существует");	
	}	
}

spl_autoload_register('class_autoload');
spl_autoload_register('core_autoload');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Список новостей, публикаций и картинок</title>
	<meta charset="utf-8">
	<link type="text/css" href="style.css" rel="stylesheet" charset="utf-8"> 
</head>
<body>	

<?php
if (isset($_GET['category'])) {
	$class = ucfirst($_GET['category'])."_Core";
	$core = new $class;
} else {
	header("Location: index.php?category=news&action=all");
}	

if (isset($_GET['id'])) {
	$id = (int)$_GET['id'];
} else {
	$id = 1;
}

if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = "all";
}

echo $core->$action($id);

?>

</body>	
</html>