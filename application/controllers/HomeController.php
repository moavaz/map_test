<?php

class HomeController extends CI_Controller{

	public function index()
	{
		
		$data['login'] = TRUE;

		$data['title'] = "login";  	 	
		$data['sub_title'] = "Login Page";

		// $data['error_message'] = '<strong>Warning !</strong> An error has occurred.';
		
		$this->load->view('home',$data);
	}
}
?>