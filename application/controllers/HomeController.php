<?php

class HomeController extends CI_Controller{

	public function index()
	{
		$data['login'] = TRUE;
		$data['title'] = "login";  	 	
		$data['sub_title'] = "Login Page";

		// $data['error_message'] = '<strong>Warning !</strong> An error has occurred.';
		// $data['map'] = $this->HomeModel->getAllCustomers(); 
		$this->load->view('home',$data);
	}
	public function getAllCustomers(){  								// get all customer for map
		$data = $this->HomeModel->getAllCustomers(); 
		echo json_encode($data);
	}
	public function createCustomer(){   								 //create customer 
		$data = array(
			'customer_name'=> $this->input->post('ct_name'),
			'monthly_charges'=> $this->input->post('ct_monthly'),
			'sms_charges'=> $this->input->post('ct_sms'),
			'server_charges'=> $this->input->post('ct_server'),
			'date' => date("Y-m-d")
		);
//Upload file...............................
		$result = $this->do_upload('ct_image');
		if($result != false){
			$data['customer_pic'] = $result;
		}

		if ($result = $this->HomeModel->createCustomer($data)) {
			redirect('HomeController');
		}
		else{
			echo 'sorry your project is not created.';
		}
	}
	public function do_upload($filename)
	{
		$config['upload_path']          = 'uploads';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload($filename))
		{
			$error = array('error' => $this->upload->display_errors());
			return false ;
		}
		else
		{
			$data = $this->upload->data();
			return $data['file_name'] ;
		}
	}
	public function getAllCustomersDatatables($from,$to){ 						//get all customers for datatables plugin 
		$list = $this->HomeModel->getAllCustomersDatatables($from,$to); 
		$data = array();

		$no = 0;
		foreach ($list as $project) {
			$no++;
			$row = array();

			$row[]= $project['customer_name']; 
			$row[]= $project['monthly_charges'];
			$row[]= $project['sms_charges'];
			$row[]= $project['server_charges'];
			// $row[]=$project['first_name'].' '.$project['last_name'];

			// $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Enroll" id="enroll" onclick="enroll('."'".$project['p_id']."'".')">Request for Documentation </a> ';
			$data[] = $row;
		}

		$output = array(
			"data" => $data,
		);
		echo json_encode($output);
	} 
}
?>