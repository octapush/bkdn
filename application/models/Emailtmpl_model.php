<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailtmpl_model extends CI_Model {

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
			7 => "bodymsg"
		);

		$draw = empty($params['draw'])? 0: $params['draw']; //DRAW TABLE REALTIME
        $start = empty($params['start'])? 0 :$params['start'];
        $length = empty($params['length'])?10 :$params['length'];
		$search = empty($params['search']['value'])?NULL:$params['search']['value'];
		$order = $columns[$params['order'][0]['column']]." ".$params['order'][0]['dir'];

		$sql = "SELECT * FROM mst_emailtmpl WHERE deleted='0'";
		$query = $this->db->query($sql);
		$recordsTotal = $query->num_rows();
		$recordsFiltered = $recordsTotal;

		$sql = "SELECT * FROM mst_emailtmpl where deleted='0'";

		if($search!=NULL || $search!=""){
			$sql.= " AND ( name LIKE '%$search%'";
			$sql.= " OR bodymsg LIKE '%$search%' )";
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
	          (CASE WHEN CONCAT('ETL',SUBSTRING('00000', 1, 5 - LENGTH(t1.code)), t1.code) IS NULL THEN 'ETL0001' END) AS code
	        FROM
	        (
	            SELECT (CONVERT(REPLACE(MAX(code), 'ETL', ''), UNSIGNED INTEGER) + 1) AS code FROM mst_emailtmpl
	        ) AS t1

        ");

        
        $rows = $patCode->row();
        $newCode = $rows->code;

        $code = $newCode;
        $name = $this->input->post('name',true);
        $bodymsg = $this->input->post('bodymsg',true);

        if(empty($code)){
        	return $this->response('503','Code tidak boleh kosong');
        }else if(empty($name)){
        	return $this->response('503','Judul Email tidak boleh kosong');
        }else if(empty($bodymsg)){
        	return $this->response('503','Isi Email tidak boleh kosong');
        }else{

        	$data = array(
			        'code' => $code,
			        'addby' => $this->session->userdata('code'),
			        'name' => $name,
			        'bodymsg' => $bodymsg,
			        'deleted' => '0'
			);
        	$this->db->set('adddt','NOW()',FALSE);
			$save = $this->db->insert('mst_emailtmpl', $data);
			if($save){
				return $this->response('200','Template Email berhasil di tambahkan');
			}else{
				return $this->response('200','Template Email gagal di tambahkan');
			}
        }
	}

	public function put(){
		if (!$this->input->is_ajax_request()) {
            return $this->response('404','No direct script access allowed');
        }

        $code = $this->input->post('code',true);
        $name = $this->input->post('name',true);
        $bodymsg = $this->input->post('bodymsg',true);

        if(empty($code)){
        	return $this->response('503','Code tidak boleh kosong');
        }else if(empty($name)){
        	return $this->response('503','Judul Email tidak boleh kosong');
        }else if(empty($bodymsg)){
        	return $this->response('503','Isi Email tidak boleh kosong');
        }else{

        	$data = array(
			        'code' => $code,
			        'modby' => $this->session->userdata('code'),
			        'name' => $name,
			        'bodymsg' => $bodymsg,
			        'deleted' => '0'
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	$this->db->where('code', $code);
			$save = $this->db->update('mst_emailtmpl', $data);
			if($save){
				return $this->response('200','Template Email dengan code '.$code.' berhasil di update');
			}else{
				return $this->response('200','Template Email dengan code '.$code.' gagal di update');
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
			$save = $this->db->update('mst_emailtmpl', $data);
			if($save){
				return $this->response('200','Template Email dengan code '.$code.' berhasil di hapus');
			}else{
				return $this->response('202','Template Email dengan code '.$code.' gagal di hapus');
			}
        }
	}

	//END CLASS MODEL

}

/* End of file Emailtmpl_model.php */
/* Location: ./application/models/Emailtmpl_model.php */