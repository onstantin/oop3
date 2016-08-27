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
	}
}

spl_autoload_register('class_autoload');
spl_autoload_register('core_autoload');

$data = Note::loadDataFile();

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

foreach($data as $feed_item_info)
{
    $class_name = $feed_item_info[0];
    $feed_object = new $class_name($feed_item_info[1]);
    /* @var $feed_object feedable */
    echo "<div>".$feed_object->feed_item()."</div>";
}
?>

</body>	
</html>