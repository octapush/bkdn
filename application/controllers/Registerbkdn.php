<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registerbkdn extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
            $this->load->model('Registerbkdn_model');
    }

	public function index()
	{
		echo 'FORBIDDEN';
	}
	
	public function getregisterbkdn(){
		echo json_encode($this->Registerbkdn_model->get());
	}

	public function create(){
		echo $this->Registerbkdn_model->post();
	}

	public function update(){
		echo $this->Registerbkdn_model->put();
	}

	public function delete(){
		echo $this->Registerbkdn_model->delete();
	}

	public function uploadfile(){
		echo $this->Registerbkdn_model->upload();
	}

	public function uploadwithdata(){
		echo $this->Registerbkdn_model->uploadwithdata();
	}
	
	public function createdetail(){
		echo $this->Registerbkdn_model->createdetail();
	}

	public function create_cus(){
		echo $this->Registerbkdn_model->create_cus();
	}

	public function detailregister(){
		
		echo $this->Registerbkdn_model->detailregister();
	}

	public function print_bkdn(){
		echo $this->Registerbkdn_model->print_bkdn();
	}

	public function update_detail(){
		echo $this->Registerbkdn_model->update_detail();
	}

	public function open_doc(){
		echo $this->Registerbkdn_model->open_doc();
	}
}
