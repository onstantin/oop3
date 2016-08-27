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
	echo $img->load();

	