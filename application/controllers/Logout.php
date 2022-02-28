<?php
if(session_status() === PHP_SESSION_NONE){
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
		header('Location:' . BASE_URL . 'login');
	}
}
