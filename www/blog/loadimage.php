<?php
require('../vendor/autoload.php');
use App\Header\HeaderController;

if(isset($_GET['file']) && isset($_GET['format'])){

	$acceptedFormat = array('jpg', 'png', 'gif');

	if(in_array($_GET['format'], $acceptedFormat)){
		// echo 'test réusit';
		$file = '../css/images/'.str_replace('.', '/', htmlentities($_GET['file'])).'.'.$_GET['format'];
		$Header = new HeaderController();
		if(file_exists($file)){
			$Header->Send304NotModifiedFileHeader($file);
		
			header('HTTP/2.1 200 Success');
			header('Content-Type: image/'.$_GET['format']);
			readfile($file);
		}
	}
	
}else{
	header('HTTP/2.1 404 Not Found');
}


?>