<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
            //$this->load->model('Customer_model');
    }

	public function index()
	{
		echo 'FORBIDDEN';
	}
	
	public function getcustomer(){
		echo json_encode($this->Customer_model->get());
	}

	public function create(){
		echo $this->Customer_model->post();
	}

	public function update(){
		echo $this->Customer_model->put();
	}

	public function delete(){
		echo $this->Customer_model->delete();
	}

}
