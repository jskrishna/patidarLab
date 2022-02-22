<?php
if(session_status() === PHP_SESSION_NONE){
	session_start();
}
class Logout extends CI_Controller
{
	public function index()
	{
		session_destroy();
		header('Location:' . BASE_URL . 'login');
	}
}
