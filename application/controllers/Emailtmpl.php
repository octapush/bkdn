<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailtmpl extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Emailtmpl_model');
	}

	public function index()
	{
		//$this->load->view('main');
		echo 'FORBIDDEN';
	}
	//
	public function getemployee(){
		echo $this->Emailtmpl_model->get();
	}

	public function create(){
		echo $this->Emailtmpl_model->post();
	}

	public function update(){
		echo $this->Emailtmpl_model->put();
	}

	public function delete(){
		echo $this->Emailtmpl_model->delete();
	}

}

/* End of file Emailtmpl.php */
/* Location: ./application/controllers/Emailtmpl.php */