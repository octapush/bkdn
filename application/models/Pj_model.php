<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pj_model extends CI_Model {

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

		$sql = "SELECT * FROM mst_pj WHERE deleted='0'";
		$query = $this->db->query($sql);
		$recordsTotal = $query->num_rows();
		$recordsFiltered = $recordsTotal;

		$sql = "SELECT * FROM mst_pj where deleted='0'";

		if($search!=NULL || $search!=""){
			$sql.= " AND ( code LIKE '%$search%'";
			$sql.= " OR name LIKE '%$search%')";
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
				(CASE WHEN LENGTH(t1.NO_CODE) > 1 THEN CONCAT('P0',t1.NO_CODE + 1) ELSE CONCAT('P00',t1.NO_CODE + 1) END) AS newCode
				FROM(
					SELECT 
					CONVERT(RIGHT(code,3),UNSIGNED INTEGER) AS NO_CODE
					FROM mst_pj ORDER BY id DESC LIMIT 1

				) AS t1
        	");
        $newCode="";

        if($patCode->num_rows()>0){
        	$rows = $patCode->row();
        	$newCode = $rows->newCode;
        }else{
        	$newCode = "P001";
        }

        $name = $this->input->post('name',true);
        $address = $this->input->post('address',true);
        $npwp = $this->input->post('npwp',true);
        $phone = $this->input->post('phone',true);

        if(empty($name)){
        	return $this->response('503','Nama Jenis Perjanjian tidak boleh kosong');
        }else{
        	$data = array(
			        'addby' => 'SYSTEM',
			        'code'=>$newCode,
			        'name' => $name,
			        'deleted' => '0'
			);
        	$this->db->set('adddt','NOW()',FALSE);
			$save = $this->db->insert('mst_pj', $data);
			if($save){
				return $this->response('200','Jenis Perjanjian berhasil di tambahkan');
			}else{
				return $this->response('200','Jenis Perjanjian gagal di tambahkan');
			}
        }
	}

	public function put(){
		if (!$this->input->is_ajax_request()) {
            return $this->response('404','No direct script access allowed');
        }

        $id = $this->input->post('id',true);
        $name = $this->input->post('name',true);

        if(empty($id)){
        	return $this->response('503','Id tidak boleh kosong');
        }else if(empty($name)){
        	return $this->response('503','Nama Jenis Perjanjian tidak boleh kosong');
        }else{
        	$data = array(
			        'modby' => 'SYSTEM',
			        'name' => $name,
			        'deleted' => '0'
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	$this->db->where('id', $id);
			$save = $this->db->update('mst_pj', $data);
			if($save){
				return $this->response('200','Customer dengan id '.$id.' berhasil di update');
			}else{
				return $this->response('200','Customer dengan id '.$id.' gagal di update');
			}
        }
	}

	public function delete(){
		if (!$this->input->is_ajax_request()) {
            return $this->response('404','No direct script access allowed');
        }

        $id = $this->input->post('id',true);
        if(empty($id)){
        	return $this->response('503','Id tidak boleh kosong');
        }else{
        	$data = array(
			        'modby' => 'SYSTEM',
			        'deleted' => '1'
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	$this->db->where('id', $id);
			$save = $this->db->update('mst_pj', $data);
			if($save){
				return $this->response('200','Customer dengan id '.$id.' berhasil di hapus');
			}else{
				return $this->response('202','Customer dengan id '.$id.' gagal di hapus');
			}
        }
	}
}