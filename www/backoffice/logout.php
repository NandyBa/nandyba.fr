<?php
session_start();
if(isset($_POST['user']) and isset($_POST['password'])):
	unset($_SESSION['user']);
	unset($_SESSION['role']);
endif;


?>