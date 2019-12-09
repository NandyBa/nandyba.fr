<?php
require('../vendor/autoload.php');
use App\Header\HeaderController;

if(isset($_GET['file']) && isset($_GET['format'])){

	$acceptedFormat = array('css','js');

	if(in_array($_GET['format'], $acceptedFormat)){
		$file = '../'.$_GET['format'].'/'.$_GET['file'].'.'.$_GET['format'];
		$Header = new HeaderController();
		if(file_exists($file)){
			$Header->Send304NotModifiedFileHeader($file);
		
			header('HTTP/2.1 200 Success');
			header('Content-Type: text/'.$_GET['format']);
			readfile($file);
			exit();
		}else{
			// Dans le cas contraire
			header('HTTP/2.1 404 Not Found');
		}
	}else{
		// Dans le cas contraire
		header('HTTP/2.1 404 Not Found');
	}
	
}else{
	// Dans le cas contraire
	header('HTTP/2.1 404 Not Found');
}



?>