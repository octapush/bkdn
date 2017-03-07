<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Invoice_model');
	}

	public function index()
	{
		//$this->load->view('main');
		echo 'FORBIDDEN';
	}
	//
	public function getemployee(){
		echo $this->Invoice_model->get();
	}

	public function create(){
		echo $this->Invoice_model->post();
	}

	public function update(){
		echo $this->Invoice_model->put();
	}

	public function delete(){
		echo $this->Invoice_model->delete();
	}

}

/* End of file Invoice.php */
/* Location: ./application/controllers/Invoice.php */