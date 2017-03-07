<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Model{

	public function checkingaccess()
	{
		$uri = $this->uri->segment(2);
		$pages = $this->session->userdata((String)$uri);
		if($pages=="0"){
			redirect(site_url('pages'));
		}
	}

	public function login(){
		$username = $this->input->post('username',true);
		$password = $this->input->post('password',true);

		if(empty($username)||$username==""){
			$this->session->set_flashdata('msg', 'Username tidak boleh kosong');
			redirect(site_url('Authentifikasi'));
		}else if(empty($password)||$password==""){
			$this->session->set_flashdata('msg', 'Password tidak boleh kosong');
			redirect(site_url('Authentifikasi'));
		}else{
			$res = $this->db->query("
									SELECT me.*,
										   mur.id AS idrole, 
										   mur.role_name AS role_name, 
										   mur.employee AS employee, 
										   mur.pj AS pj, 
										   mur.customer AS customer, 
										   mur.registerbkdn AS registerbkdn, 
										   mur.registercom AS registercom, 
										   mur.print_bkdn AS print_bkdn,
										   mur.print_bkdn AS invoice,
										   mur.print_bkdn AS role
										FROM mst_employee AS me 
												JOIN mst_user_role AS mur 
												ON me.id_role = mur.id 
										WHERE me.username='".$username."' AND me.password='".md5($password)."'
									");
			$data = array();
			if($res->num_rows()==1){
				foreach ($res->result_array() as $rows) {
					# code...
					$data['id'] 			= $rows['id'];
					$data['code'] 			= $rows['code'];
					$data['name'] 			= $rows['name'];
					$data['id_role'] 		= $rows['id_role'];
					$data['username'] 		= $rows['username'];

					$data['idrole'] 		= $rows['idrole'];
					$data['role_name'] 		= $rows['role_name'];
					$data['employee'] 		= $rows['employee'];
					$data['pj'] 			= $rows['pj'];
					$data['customer'] 		= $rows['customer'];
					$data['registerbkdn'] 	= $rows['registerbkdn'];
					$data['registercom'] 	= $rows['registercom'];
					$data['print_bkdn'] 	= $rows['print_bkdn'];
				}
				$this->session->set_userdata($data);
				redirect(site_url('pages'));
			}else{
				$this->session->set_flashdata('msg', 'Username dan password cek kembali!');
				redirect(site_url('Authentifikasi'));
			}
		}
	}
}