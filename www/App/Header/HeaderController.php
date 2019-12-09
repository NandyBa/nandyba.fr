<?php
namespace App\Header;


class HeaderController{
	public function forceHTTPS(){
		if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
		    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		    $this->MovePermanently($redirect);
		}
		$this->redirectToNonWww(); // To redirect to non www.
	}

	public function Send304NotModifiedFileHeader($file){
		$last_modified_time = filemtime($file);
		$etag = 'W/"'.md5($last_modified_time).'"';


		header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $last_modified_time) . " GMT");
		header("Etag: $etag");

		if(
			(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) === $last_modified_time) || 
			(isset($_SERVER['HTTP_IF_NONE_MATH']) && $etag === trim($_SERVER['HTTP_IF_NONE_MATH']))){
			header('HTTP/2.1 304 Not Modified');
			exit();
		}
	}


	public function SendMaintenanceHeader(){
		header('HTTP/2.1 503 Service Unavailable');
	}

	public function redirectToNonWww(){
		if (substr($_SERVER['HTTP_HOST'], 0, 4) === 'www.') {
	    	$redirect = 'https://' . substr($_SERVER['HTTP_HOST'], 4).$_SERVER['REQUEST_URI'];
	    	$this->MovePermanently($redirect);
		}
	}

	public function Send404(){
		header('HTTP/2.1 404 Not found');
	}

	public function redirectToSamePage(){
		header('Location: https://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	}

	public function MovePermanently($redirect)
	{
		header('HTTP/2.1 301 Moved Permanently');
	    header('Location: '.$redirect);
	    exit();
	}

	public function SimpleRedirect($url){
		header('Location: '.$url);
		exit();
	}
	
}

?>