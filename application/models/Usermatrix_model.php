<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermatrix_model extends CI_Model {

	// ROLE USER ADD
	public function getusermatrix(){
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
            return;
        }
        
		if(!$this->input->post('method')){
			return;
		}

		$params = $columns = $totalRecords = $data = array();
		$params= $_POST;
		$columns = array( 
			0 => "me.id",
			1 => "me.code",
			2 => "me.name",
			3 => "mur.id",
			4 => "mur.role_name"
		);

		$draw = empty($params['draw'])? 0: $params['draw']; //DRAW TABLE REALTIME
        $start = empty($params['start'])? 0 :$params['start'];
        $length = empty($params['length'])?10 :$params['length'];
		$search = empty($params['search']['value'])?NULL:$params['search']['value'];
		$order = $columns[$params['order'][0]['column']]." ".$params['order'][0]['dir'];

		$sql = "SELECT me.id, me.`code`,me.`name`,mur.id AS id_role ,mur.role_name
					FROM mst_employee AS me JOIN mst_user_role mur
						ON me.id_role = mur.id
					WHERE me.deleted='0' AND mur.id!='1'";

		$query = $this->db->query($sql);
		$recordsTotal = $query->num_rows();
		$recordsFiltered = $recordsTotal;

		$sql = "SELECT me.id, me.`code`,me.`name`,mur.id AS id_role ,mur.role_name
					FROM mst_employee AS me JOIN mst_user_role mur
						ON me.id_role = mur.id
					WHERE me.deleted='0' AND mur.id!='1'";

		if($search!=NULL || $search!=""){
			$sql.= " AND ( me.name LIKE '%$search%'";
			$sql.= " OR mur.role_name LIKE '%$search%' )";
		}

		$query = $this->db->query($sql);
		$recordsFiltered = $query->num_rows();
		$sql.=" ORDER BY $order LIMIT $start,$length";
		$query = $this->db->query($sql);
		
		foreach ($query->result_array() as $row)
		{	
		        //array_push($rows, );
				$data[]=$row;
		}

		///$data=array();
		$json_data = array(
			"draw"            => intval($draw), 
			"recordsTotal"    => intval($recordsTotal),
			"recordsFiltered" => intval($recordsFiltered), 
			"data"            => $data
			);

		return $json_data;
	}

	//END USER

	public function response($httResponse,$message){
		if (!$this->input->is_ajax_request() && empty($this->session->userdata('id'))) {
            return $this->response('404','No direct script access allowed');
        }

		if($message!=""){
			return json_encode(array('success'=>$httResponse,'message'=>$message));
		}
	}

	public function findbyid(){
		if (!$this->input->is_ajax_request() && empty($this->session->userdata('id'))) {
            return $this->response('404','No direct script access allowed');
        }

		$id = $this->input->post('dataId',true);
		$res = $this->db->query("SELECT * FROM mst_user_role WHERE deleted='0' AND id='$id'");

		$data = array();
		foreach ($res->result_array() as $row)
		{	
		        //array_push($rows, );
				$data[]=$row;
		}
		return json_encode($data);
	}

	public function post(){
		if (!$this->input->is_ajax_request() && empty($this->session->userdata('id'))) {
            return $this->response('404','No direct script access allowed');
        }

        $idEmployee		= $this->input->post('idEmployee',true);
		$idRoleName		= $this->input->post('idRoleName',true);

       	if(empty($idEmployee)){
        	return $this->response('503','Employee tidak boleh kosong');
        }else if(empty($idRoleName)){
        	return $this->response('503','Role Name tidak boleh kosong');
        }else{
        	$data = array(
        		'id_role'=>$idRoleName
			);
        	$this->db->where('id', $idEmployee);
			$save = $this->db->update('mst_employee', $data);
			if($save){
				return $this->response('200','User Matrix berhasil di tambahkan');
			}else{
				return $this->response('200','User Matrix gagal di tambahkan');
			}
        }
	}

	public function put(){
		if (!$this->input->is_ajax_request() && empty($this->session->userdata('id'))) {
            return $this->response('404','No direct script access allowed');
        }

        $idEmployee		= $this->input->post('idEmployee',true);
		$idRoleName		= $this->input->post('idRoleName',true);

       	if(empty($idEmployee)){
        	return $this->response('503','Employee tidak boleh kosong');
        }else if(empty($idRoleName)){
        	return $this->response('503','Role Name tidak boleh kosong');
        }else{
        	$data = array(
        		'id_role'=>$idRoleName
			);
        	$this->db->where('id', $idEmployee);
			$save = $this->db->update('mst_employee', $data);
			if($save){
				return $this->response('200','User Matrix berhasil di ubah');
			}else{
				return $this->response('200','User Matrix gagal di ubah');
			}
        }
	}

	public function delete(){
		if (!$this->input->is_ajax_request() && empty($this->session->userdata('id'))) {
            return $this->response('404','No direct script access allowed');
        }

        $idEmployee		= $this->input->post('id',true);

       	if(empty($idEmployee)){
        	return $this->response('503','ID Employee tidak boleh kosong');
        }else{
        	$data = array(
        		'id_role'=>NULL
			);
        	$this->db->where('id', $idEmployee);
			$save = $this->db->update('mst_employee', $data);
			if($save){
				return $this->response('200','User Matrix berhasil di hapus');
			}else{
				return $this->response('200','User Matrix gagal di hapus');
			}
        }
	}
	//END
}