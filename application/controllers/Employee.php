<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function index()
	{
		//$this->load->view('main');
		echo 'FORBIDDEN';
	}
	//
	public function getemployee(){
		echo $this->Employee_model->get();
	}

	public function create(){
		echo $this->Employee_model->post();
	}

	public function update(){
		echo $this->Employee_model->put();
	}

	public function delete(){
		echo $this->Employee_model->delete();
	}

}
