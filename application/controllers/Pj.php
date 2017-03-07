<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pj extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
            $this->load->model('Pj_model');
    }

	public function index()
	{
		echo 'FORBIDDEN';
	}
	
	public function getpj(){
		echo json_encode($this->Pj_model->get());
	}

	public function create(){
		echo $this->Pj_model->post();
	}

	public function update(){
		echo $this->Pj_model->put();
	}

	public function delete(){
		echo $this->Pj_model->delete();
	}

}
