<?php
session_start();
require_once('../vendor/autoload.php');
use App\DataBase\UserController;
use App\Header\HeaderController;

$Header = new HeaderController();
$Header->forceHTTPS();


$User = new UserController();
if ( !isset( $_SESSION['user'] ) and !isset( $_SESSION['role'] ) ){ 
	if ( isset( $_POST['user'] ) and isset( $_POST['password'] ) ){
		if ( $User->login( $_POST['user'], $_POST['password'] ) == true ){
			$_SESSION['user'] = $_POST['user'];
			$_SESSION['role'] = 'redacteur';
			$Header->redirectToSamePage();
		}
	}


	?>
	<h1>Veuillez vous connectez</h1>
	<form method="post">
		<input type="text" name="user" placeholder="user">
		<input type="password" name="password" placeholder="password">
		<input type="submit" name="">
	</form>
	<?php
	die();
}

?>