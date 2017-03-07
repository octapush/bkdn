<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
    }

	public function index()
	{
		$id = $this->session->userdata('id');
            if($id!="" || $id!=null)
             	redirect(site_url('pages'));
             else
				$this->load->view('login');
	}

	public function update(){
		echo $this->Account_model->put();
	}
}
