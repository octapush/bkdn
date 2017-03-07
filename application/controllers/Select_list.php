<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Select_list extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
            $this->load->model('Select_model');
    }

	public function index()
	{
		echo 'FORBIDDEN';
	}
	
	public function getcustomer(){
		echo json_encode($this->Select_model->getcustomer());
	}

	public function getdivision(){
		echo json_encode($this->Select_model->getdivision());
	}

	public function getpj(){
		echo json_encode($this->Select_model->getpj());
	}

	public function getno_kontrak(){
		echo json_encode($this->Select_model->getno_kontrak());
	}

	public function getemployeename(){
		echo json_encode($this->Select_model->getemployeename());
	}

	public function getrolename(){
		echo json_encode($this->Select_model->getrolename());
	}
	//getno_kontrak

}
