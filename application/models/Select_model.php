<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Select_model extends CI_Model {

	public function getcustomer(){
		if (!$this->input->is_ajax_request() && empty($this->session->userdata('code'))) {
            exit('No direct script access allowed');
            return;
        }

		$data=array();
		$query = $this->db->query("SELECT msc.code AS id,CONCAT(msc.name,' [ ',msc.address,' ]') AS text FROM mst_customer AS msc WHERE deleted='0'");
		foreach ($query->result_array() as $rows) {
			# code...
			$data[] = $rows;
		}
		return $data;
	}

	public function getdivision(){
		if (!$this->input->is_ajax_request() && empty($this->session->userdata('code'))) {
            exit('No direct script access allowed');
            return;
        }

		$data=array();
		$query = $this->db->query("SELECT md.code AS id,CONCAT(md.code,' , ',md.project_name) AS text FROM mst_division AS md WHERE deleted='0'");
		foreach ($query->result_array() as $rows) {
			# code...
			$data[] = $rows;
		}
		return $data;
	}

	public function getpj(){
		if (!$this->input->is_ajax_request() && empty($this->session->userdata('code'))) {
            exit('No direct script access allowed');
            return;
        }

		$data=array();
		$query = $this->db->query("SELECT mp.code AS id,mp.name AS text FROM mst_pj AS mp WHERE deleted='0'");
		foreach ($query->result_array() as $rows) {
			# code...
			$data[] = $rows;
		}
		return $data;
	}
	public function getno_kontrak(){
		
		if (!$this->input->is_ajax_request() && empty($this->session->userdata('code'))) {
            exit('No direct script access allowed');
            return;
        }
		if(!empty($this->input->post('nPiece',true))){
			$data=array();
			$query = $this->db->query("SELECT tb.no_kontrak AS id,tb.no_kontrak AS text FROM trx_register_bkdn AS tb WHERE tb.deleted='0' AND tb.no_kontrak LIKE '%".$this->input->post('nPiece',true)."%' LIMIT 10");
			foreach ($query->result_array() as $rows) {
				# code...
				$data[] = $rows;
			}
			//return $data;
			return $data;
		}
	}

	public function getemployeename(){
		
		if (!$this->input->is_ajax_request() && empty($this->session->userdata('code'))) {
            exit('No direct script access allowed');
            return;
        }
		if(!empty($this->input->post('nPiece',true))){
			$data=array();
			$query = $this->db->query("
				SELECT me.id AS id,me.name AS text FROM mst_employee AS me 
					WHERE me.id!='1' 
						AND (me.id_role IS NULL OR me.id_role='') 
						AND me.deleted='0' 
						AND me.name 
					LIKE '%".$this->input->post('nPiece',true)."%' LIMIT 10");

			foreach ($query->result_array() as $rows) {
				# code...
				$data[] = $rows;
			}
			//return $data;
			return $data;
		}
	}

	public function getrolename(){
		
		if (!$this->input->is_ajax_request() && empty($this->session->userdata('code'))) {
            exit('No direct script access allowed');
            return;
        }
		if(!empty($this->input->post('nPiece',true))){
			$data=array();
			$query = $this->db->query("SELECT mus.id AS id,mus.role_name AS text FROM mst_user_role AS mus WHERE mus.deleted='0' AND mus.id!=1 AND mus.role_name LIKE '%".$this->input->post('nPiece',true)."%' LIMIT 10");
			foreach ($query->result_array() as $rows) {
				# code...
				$data[] = $rows;
			}
			//return $data;
			return $data;
		}
	}
	
}