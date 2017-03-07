<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {

	public function response($httResponse,$message){
		if($message!=""){
			return json_encode(array('success'=>$httResponse,'message'=>$message));
		}
	}

	public function get(){
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
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
			7 => "placeofbirth",
			8 => "birthday",
			9 => "gender",
			10 => "address",
			11 => "phone"
		);

		$draw = empty($params['draw'])? 0: $params['draw']; //DRAW TABLE REALTIME
        $start = empty($params['start'])? 0 :$params['start'];
        $length = empty($params['length'])?10 :$params['length'];
		$search = empty($params['search']['value'])?NULL:$params['search']['value'];
		$order = $columns[$params['order'][0]['column']]." ".$params['order'][0]['dir'];

		$sql = "SELECT * FROM mst_employee WHERE deleted='0' AND id!='1'";
		$query = $this->db->query($sql);
		$recordsTotal = $query->num_rows();
		$recordsFiltered = $recordsTotal;

		$sql = "SELECT * FROM mst_employee where deleted='0' AND id!='1'";

		if($search!=NULL || $search!=""){
			$sql.= " AND ( name LIKE '%$search%'";
			$sql.= " OR placeofbirth LIKE '%$search%'";
			$sql.= " OR gender LIKE '%$search%'";
			$sql.= " OR address LIKE '%$search%'";
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

		return json_encode($json_data); // send data as json format
	}

	public function post(){
		if (!$this->input->is_ajax_request()) {
            return $this->response('404','No direct script access allowed');
        }

        $patCode = $this->db->query("
        		SELECT 
					CONCAT('EMP',SUBSTRING('00000', 1, 5 - LENGTH(t1.code)), t1.code) AS code
				FROM
				(
						SELECT (CONVERT(REPLACE(MAX(`code`), 'EMP', ''), UNSIGNED INTEGER) + 1) AS code FROM mst_employee
				) AS t1

        	");

        
        $rows = $patCode->row();
        $newCode = $rows->code;

        $code = $newCode;
        $name = $this->input->post('name',true);
        $placeofbirth = $this->input->post('placeofbirth',true);
        $birthday = $this->input->post('birthday',true);
        $gender = $this->input->post('gender',true);
        $address = $this->input->post('address',true);
        $phone = $this->input->post('phone',true);
        $username = $this->input->post('username',true);
        $password = $this->input->post('password',true);

        if(empty($code)){
        	return $this->response('503','Code tidak boleh kosong');
        }else if(empty($name)){
        	return $this->response('503','Nama Employee tidak boleh kosong');
        }else if(empty($placeofbirth)){
        	return $this->response('503','Tempat lahir tidak boleh kosong');
        }else if(empty($birthday)){
        	return $this->response('503','Tanggal lahir tidak boleh kosong');
        }else if(empty($gender)){
        	return $this->response('503','Jenis kelamin tidak boleh kosong');
        }else if(empty($address)){
        	return $this->response('503','ALamat tidak boleh kosong');
        }else if(empty($address)){
        	return $this->response('503','ALamat tidak boleh kosong');
        }else if(empty($username)){
        	return $this->response('503','Username tidak boleh kosong');
        }else if(empty($password)){
        	return $this->response('503','Password tidak boleh kosong');
        }else{

        	$birthday = date('Y-m-d h:i:s', strtotime($birthday));
        	$data = array(
			        'code' => $code,
			        'addby' => $this->session->userdata('code'),
			        'name' => $name,
			        'placeofbirth' => $placeofbirth,
			        'address' => $address,
			        'birthday' => $birthday,
			        'gender' => $gender,
			        'phone' => $phone,
			        'address' => $address,
			        'username' => $username,
			        'password' => md5($password),
			        'deleted' => '0'
			);
        	$this->db->set('adddt','NOW()',FALSE);
			$save = $this->db->insert('mst_employee', $data);
			if($save){
				return $this->response('200','Employee berhasil di tambahkan');
			}else{
				return $this->response('200','Employee gagal di tambahkan');
			}
        }
	}

	public function put(){
		if (!$this->input->is_ajax_request()) {
            return $this->response('404','No direct script access allowed');
        }

        $code = $this->input->post('code',true);
        $name = $this->input->post('name',true);
        $placeofbirth = $this->input->post('placeofbirth',true);
        $birthday = $this->input->post('birthday',true);
        $gender = $this->input->post('gender',true);
        $address = $this->input->post('address',true);
        $phone = $this->input->post('phone',true);
        $username = $this->input->post('username',true);
        $password = $this->input->post('password',true);

        if(empty($code)){
        	return $this->response('503','Code tidak boleh kosong');
        }else if(empty($name)){
        	return $this->response('503','Nama Employee tidak boleh kosong');
        }else if(empty($placeofbirth)){
        	return $this->response('503','Tempat lahir tidak boleh kosong');
        }else if(empty($birthday)){
        	return $this->response('503','Tanggal lahir tidak boleh kosong');
        }else if(empty($gender)){
        	return $this->response('503','Jenis kelamin tidak boleh kosong');
        }else if(empty($address)){
        	return $this->response('503','ALamat tidak boleh kosong');
        }else if(empty($address)){
        	return $this->response('503','ALamat tidak boleh kosong');
        }else if(empty($username)){
        	return $this->response('503','Username tidak boleh kosong');
        }else if(empty($password)){
        	return $this->response('503','Password tidak boleh kosong');
        }else{

        	$birthday = date('Y-m-d h:i:s', strtotime($birthday));
        	$data = array(
			        'code' => $code,
			        'modby' => $this->session->userdata('code'),
			        'name' => $name,
			        'placeofbirth' => $placeofbirth,
			        'address' => $address,
			        'birthday' => $birthday,
			        'gender' => $gender,
			        'phone' => $phone,
			        'address' => $address,
			        'username' => $username,
			        'password' => md5($password),
			        'deleted' => '0'
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	$this->db->where('code', $code);
			$save = $this->db->update('mst_employee', $data);
			if($save){
				return $this->response('200','Employee dengan code '.$code.' berhasil di update');
			}else{
				return $this->response('200','Employee dengan code '.$code.' gagal di update');
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
			        'modby' => $this->session->userdata('code'),
			        'deleted' => '1'
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	$this->db->where('code', $code);
			$save = $this->db->update('mst_employee', $data);
			if($save){
				return $this->response('200','Employee dengan code '.$code.' berhasil di hapus');
			}else{
				return $this->response('202','Employee dengan code '.$code.' gagal di hapus');
			}
        }
	}

	//END CLASS MODEL
}