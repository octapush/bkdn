<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
    {
            parent::__construct();
            $id = $this->session->userdata('id');
            if($id=="" || $id==null)
             	redirect(site_url('Authentifikasi'));
    }

    public function debug()
    {
    	$this->load->model('Dashboard_model');

    	$x = $this->Dashboard_model->loadDataCustomer();

    	echo '<pre>';
    	print_r($x);
    }

	public function index()
	{
		$this->Auth->checkingaccess();

		$this->load->model('Dashboard_model');

		$data['loadDataCustomer'] = $this->Dashboard_model->loadDataCustomer();
		$data['loadDataResgitration'] = $this->Dashboard_model->loadDataResgitration();

		$this->load->view('template/header');
		$this->load->view('pages/dashboard', $data);
		$this->load->view('template/footer');
	}

	public function employee()
	{
		$this->Auth->checkingaccess();
		$this->load->view('template/header');
		$this->load->view('pages/employee');
		$this->load->view('template/footer');
	}

	public function customer()
	{
		$this->Auth->checkingaccess();
		$this->load->view('template/header');
		$this->load->view('pages/customer');
		$this->load->view('template/footer');
	}

	public function pj()
	{
		$this->Auth->checkingaccess();
		$this->load->view('template/header');
		$this->load->view('pages/jenis_pj');
		$this->load->view('template/footer');
	}

	public function registerbkdn()
	{
		$this->Auth->checkingaccess();
		$this->load->view('template/header');
		$this->load->view('pages/register');
		$this->load->view('template/footer');
	}

	public function registercom()
	{
		$this->Auth->checkingaccess();
		$this->load->view('template/header');
		$this->load->view('pages/registercom');
		$this->load->view('template/footer');
	}

	public function print_bkdn()
	{
		$this->Auth->checkingaccess();
		$this->load->view('pages/print_bkdn');
	}

	public function role()
	{
		$this->Auth->checkingaccess();
		$this->load->view('template/header');
		$this->load->view('pages/role');
		$this->load->view('template/footer');
	}

	public function user_matrix()
	{
		$this->Auth->checkingaccess();
		$this->load->view('template/header');
		$this->load->view('pages/user_matrix');
		$this->load->view('template/footer');
	}
	
	public function account()
	{
		$this->Auth->checkingaccess();
		$this->load->view('template/header');
		$this->load->view('pages/account');
		$this->load->view('template/footer');
	}

	public function logout()
	{
		$id = $this->session->userdata('id');
		if($id!=null || $id!=null){
			$this->session->sess_destroy();
			redirect(site_url('Authentifikasi'));
		}
	}

	public function emailtmpl()
	{
		$this->Auth->checkingaccess();
		$this->load->view('template/header');
		$this->load->view('pages/emailtmpl');
		$this->load->view('template/footer');
	}

	public function invoice()
	{
		$this->Auth->checkingaccess();
		$this->load->view('template/header');
		$this->load->view('pages/invoice');
		$this->load->view('template/footer');
	}


	//---END
}
