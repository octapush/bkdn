<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

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
			1 => "code",
			2 => "adddt",
			3 => "addby",
			4 => "moddt",
			5 => "modby",
			6 => "name",
			7 => "name",
			8 => "address",
			9 => "npwp",
			10 => "phone"
		);

		$draw = empty($params['draw'])? 0: $params['draw']; //DRAW TABLE REALTIME
        $start = empty($params['start'])? 0 :$params['start'];
        $length = empty($params['length'])?10 :$params['length'];
		$search = empty($params['search']['value'])?NULL:$params['search']['value'];
		$order = $columns[$params['order'][0]['column']]." ".$params['order'][0]['dir'];

		$sql = "SELECT * FROM mst_customer WHERE deleted='0'";
		$query = $this->db->query($sql);
		$recordsTotal = $query->num_rows();
		$recordsFiltered = $recordsTotal;

		$sql = "SELECT * FROM mst_customer where deleted='0'";

		if($search!=NULL || $search!=""){
			$sql.= " AND ( code LIKE '%$search%'";
			$sql.= " OR name LIKE '%$search%'";
			$sql.= " OR address LIKE '%$search%'";
			$sql.= " OR npwp LIKE '%$search%'";
			$sql.= " OR phone LIKE '%$search%' )";
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
		if($message!=""){
			return json_encode(array('success'=>$httResponse,'message'=>$message));
		}
	}

	public function post(){
		if (!$this->input->is_ajax_request()) {
            return $this->response('404','No direct script access allowed');
        }

        $patCode = $this->db->query("
        		SELECT 
					CONCAT('CUS',SUBSTRING('000', 1, 3 - LENGTH(t1.code)), t1.code) AS code
				FROM
				(
						SELECT (CONVERT(REPLACE(MAX(`code`), 'CUS', ''), UNSIGNED INTEGER) + 1) AS code FROM mst_customer
				) AS t1
        	");
        
        $rows = $patCode->row();
        $newCode = $rows->code;

        $code = $newCode;
        $name = $this->input->post('name',true);
        $address = $this->input->post('address',true);
        $npwp = $this->input->post('npwp',true);
        $phone = $this->input->post('phone',true);

        if(empty($code)){
        	return $this->response('503','Code tidak boleh kosong');
        }else if(empty($name)){
        	return $this->response('503','Nama Customer tidak boleh kosong');
        }else{
        	$data = array(
			        'code' => $code,
			        'addby' => 'SYSTEM',
			        'name' => $name,
			        'address' => $address,
			        'npwp' => $npwp,
			        'phone' => $phone,
			        'deleted' => '0'
			);
        	$this->db->set('adddt','NOW()',FALSE);
			$save = $this->db->insert('mst_customer', $data);
			if($save){
				return $this->response('200','Customer berhasil di tambahkan');
			}else{
				return $this->response('200','Customer gagal di tambahkan');
			}
        }
	}

	public function put(){
		if (!$this->input->is_ajax_request()) {
            return $this->response('404','No direct script access allowed');
        }

        $code = $this->input->post('code',true);
        $name = $this->input->post('name',true);
        $address = $this->input->post('address',true);
        $npwp = $this->input->post('npwp',true);
        $phone = $this->input->post('phone',true);

        if(empty($code)){
        	return $this->response('503','Code tidak boleh kosong');
        }else if(empty($name)){
        	return $this->response('503','Nama Customer tidak boleh kosong');
        }else{
        	$data = array(
			        'modby' => 'SYSTEM',
			        'name' => $name,
			        'address' => $address,
			        'npwp' => $npwp,
			        'phone' => $phone,
			        'deleted' => '0'
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	$this->db->where('code', $code);
			$save = $this->db->update('mst_customer', $data);
			if($save){
				return $this->response('200','Customer dengan code '.$code.' berhasil di update');
			}else{
				return $this->response('200','Customer dengan code '.$code.' gagal di update');
			}
        }
	}

	public function delete(){
		if (!$this->input->is_ajax_request()) {
            return $this->response('404','No direct script access allowed');
        }

        $code = $this->input->post('code',true);
        if(empty($code)){
        	return $this->response('503','Code tidak boleh kosong');
        }else{
        	$data = array(
			        'modby' => 'SYSTEM',
			        'deleted' => '1'
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	$this->db->where('code', $code);
			$save = $this->db->update('mst_customer', $data);
			if($save){
				return $this->response('200','Customer dengan code '.$code.' berhasil di hapus');
			}else{
				return $this->response('202','Customer dengan code '.$code.' gagal di hapus');
			}
        }
	}
}