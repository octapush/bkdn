<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentifikasi extends CI_Controller {

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

	public function login(){
		$this->Auth->login();
	}
}
