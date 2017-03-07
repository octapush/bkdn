<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {

	public function get(){
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
			0 => "id",
			1 => "addby",
			2 => "adddt",
			3 => "role_name",
			4 => "employee",
			5 => "customer",
			6 => "pj",
			7 => "registerbkdn",
			8 => "registercom",
			9 => "print_bkdn",
			10 => "invoice",
			11 => "role"
		);

		$draw = empty($params['draw'])? 0: $params['draw']; //DRAW TABLE REALTIME
        $start = empty($params['start'])? 0 :$params['start'];
        $length = empty($params['length'])?10 :$params['length'];
		$search = empty($params['search']['value'])?NULL:$params['search']['value'];
		$order = $columns[$params['order'][0]['column']]." ".$params['order'][0]['dir'];

		$sql = "SELECT * FROM mst_user_role WHERE deleted='0' AND id!='1'";
		$query = $this->db->query($sql);
		$recordsTotal = $query->num_rows();
		$recordsFiltered = $recordsTotal;

		$sql = "SELECT * FROM mst_user_role where deleted='0' AND id!='1'";

		if($search!=NULL || $search!=""){
			$sql.= " AND ( addby LIKE '%$search%'";
			$sql.= " OR role_name LIKE '%$search%' )";
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

        $role_name		= $this->input->post('role_name',true);
		$employee		= $this->input->post('employee',true);
		$customer 		= $this->input->post('customer',true);
		$pj 			= $this->input->post('pj',true);
		$registerbkdn 	= $this->input->post('registerbkdn',true);
		$registercom	= $this->input->post('registercom',true);
		$print_bkdn 	= $this->input->post('print_bkdn',true);
		$invoice	  	= $this->input->post('invoice',true);
		$role 			= $this->input->post('role',true);
		$user_matrix 	= $this->input->post('user_matrix',true);

        $patCode = $this->db->query("SELECT role_name FROM mst_user_role WHERE role_name='$role_name'");
        
        $rows = $patCode->num_rows();
       	
       	if($rows>0){
       		return $this->response('503','Role Name dengan '.$role_name.' sudah di gunakan, silahkan gunakan yang lain!');
       	}else if(empty($role_name)){
        	return $this->response('503','Role Name tidak boleh kosong');
        }else{
        	$data = array(
        		'addby'=>$this->session->userdata('code'), //CODE EMPLOYEE SESSION
				'role_name'=>$role_name,
				'employee'=>$employee,
				'customer'=>$customer,
				'pj'=>$pj,
				'registerbkdn'=>$registerbkdn,
				'registercom'=>$registercom,
				'print_bkdn'=>$print_bkdn,
				'invoice'=>$invoice,
				'role'=>$role,
				'user_matrix'=>$user_matrix,
				'deleted'=>'0'
			);
        	$this->db->set('adddt','NOW()',FALSE);
			$save = $this->db->insert('mst_user_role', $data);
			if($save){
				return $this->response('200','Role Name berhasil di tambahkan');
			}else{
				return $this->response('200','Role Name gagal di tambahkan');
			}
        }
	}

	public function put(){
		if (!$this->input->is_ajax_request() && empty($this->session->userdata('id'))) {
            return $this->response('404','No direct script access allowed');
        }

        $id 			= $this->input->post('id',true);
        $role_name		= $this->input->post('role_name');
		$employee		= $this->input->post('employee');
		$customer 		= $this->input->post('customer');
		$pj 			= $this->input->post('pj');
		$registerbkdn 	= $this->input->post('registerbkdn');
		$registercom	= $this->input->post('registercom');
		$print_bkdn 	= $this->input->post('print_bkdn');
		$invoice	  	= $this->input->post('invoice');
		$role 			= $this->input->post('role');
		$user_matrix 	= $this->input->post('user_matrix');

		if(empty($id)){
        	return $this->response('503','Id tidak boleh kosong');
        }else if(empty($role_name)){
        	return $this->response('503','Role Name tidak boleh kosong');
        }else{
        	$data = array(
			        'modby'=>$this->session->userdata('code'), //CODE EMPLOYEE SESSION
			        'role_name'=>$role_name,
					'employee'=>$employee,
					'customer'=>$customer,
					'pj'=>$pj,
					'registerbkdn'=>$registerbkdn,
					'registercom'=>$registercom,
					'print_bkdn'=>$print_bkdn,
					'invoice'=>$invoice,
					'role'=>$role,
					'user_matrix'=>$user_matrix,
					'deleted'=>'0'
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	$this->db->where('id', $id);
			$save = $this->db->update('mst_user_role', $data);
			if($save){
				return $this->response('200','Role Name dengan code '.$id.' berhasil di update');
			}else{
				return $this->response('200','Role Name dengan code '.$id.' gagal di update');
			}
        }
	}

	public function delete(){
		if (!$this->input->is_ajax_request()) {
            return $this->response('404','No direct script access allowed');
        }

        $id = $this->input->post('id',true);

        if(empty($id)){
        	return $this->response('503','Code tidak boleh kosong');
        }else{
        	$data = array(
			        'modby' => $this->session->userdata('code'),
			        'deleted' => '1'
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	$this->db->where('id', $id);
			$save = $this->db->update('mst_user_role', $data);
			if($save){
				return $this->response('200','Role Name dengan code '.$id.' berhasil di hapus');
			}else{
				return $this->response('202','Role Name dengan code '.$id.' gagal di hapus');
			}
        }
	}
	//END
}