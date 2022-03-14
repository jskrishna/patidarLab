<?php
if(session_status() === PHP_SESSION_NONE){
	ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
	session_start();
}
class Logout extends CI_Controller
{
	public function index()
	{
		session_destroy();
		setcookie("USERNAME", '', time()-1000,"/");
		setcookie("PASSWORD", '', time()-1000,"/");
		setcookie("loggedIn", false, time()-1000,"/");
		setcookie("loggedInId", '', time()-1000,"/");
		setcookie("userID", '', time()-1000,"/");
		header('Location:' . BASE_URL . 'login');
	}
}
