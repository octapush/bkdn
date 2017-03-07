<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_matrix extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
            //
    }

	public function index()
	{
		echo 'FORBIDDEN';
	}
	
	public function getusermatrix(){
		echo json_encode($this->Usermatrix_model->getusermatrix());
	}

	public function getbyid(){
		echo $this->Usermatrix_model->findbyid();
	}

	public function create(){
		echo $this->Usermatrix_model->post();
	}

	public function update(){
		echo $this->Usermatrix_model->put();
	}

	public function delete(){
		echo $this->Usermatrix_model->delete();
	}

}