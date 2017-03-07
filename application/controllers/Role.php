<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
            //
    }

	public function index()
	{
		echo 'FORBIDDEN';
	}
	
	public function getrole(){
		echo json_encode($this->Role_model->get());
	}

	public function getbyid(){
		echo $this->Role_model->findbyid();
	}

	public function create(){
		echo $this->Role_model->post();
	}

	public function update(){
		echo $this->Role_model->put();
	}

	public function delete(){
		echo $this->Role_model->delete();
	}

}