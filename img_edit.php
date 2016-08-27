<?php

	error_reporting(E_ALL);
	require_once "feedable.interface.php";
	require_once "Note.class.php";
	require_once "ImageJpeg.class.php";
	
	if (isset($_GET['id'])) {
		$id = (int) $_GET['id'];
	}
	else {
		$id = 1;
	}	
	
	$img = new ImageJpeg($id);

	if (isset($_POST['url']) && $_POST['url']!="") {
		$img->url = $_POST['url'];
		$img->save();	
		header("Location: img.php?id=$id");
		die;
	}	
	else if (isset($_FILES['file'])) {
		$img->upload = $_FILES['file']['tmp_name'];
		$img->uploadFile();	
		header("Location: img.php?id=$id");
		die;		
	}
	
	echo $img->load();
?>
<style>
	form, input {
		margin-top: 10px;
		display: block;
	} 
	input {
		width: 300px;
	}
	img {
		max-width: 500px;
	}
</style>

<p>Введите URL новой картинки или загрузите её</p>
<form action="" method="post" enctype="multipart/form-data">
	<input type="text" name="url" placeholder="Введите URL новой картинки">
	<input type="file" name="file">
	<input type="submit" value="Загрузить картинку">
</form>
	