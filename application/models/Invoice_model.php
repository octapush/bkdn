<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model {

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
			2 => "adddt",
			3 => "addby",
			4 => "moddt",
			5 => "modby",
			6 => "code",
			7 => "name",
			8 => "no_kontrak",
			9 => "no_invoice",
			10 => "no_faktur",
			11 => "tgl",
			12 => "penerima"
		);

		$draw = empty($params['draw'])? 0: $params['draw']; //DRAW TABLE REALTIME
        $start = empty($params['start'])? 0 :$params['start'];
        $length = empty($params['length'])?10 :$params['length'];
		$search = empty($params['search']['value'])?NULL:$params['search']['value'];
		$order = $columns[$params['order'][0]['column']]." ".$params['order'][0]['dir'];

		// $sql = "SELECT * FROM trx_invoice WHERE deleted='0'";
		$sql = "
			SELECT 
				A.id,
				A.adddt,
				A.addby,
				A.moddt,
				A.modby,
				B.name,
				B.code,
				(SELECT no_kontrak FROM trx_register_bkdn WHERE id = A.no_kontrak) AS no_kontrak,
				A.no_invoice,
				A.no_faktur,
				A.tgl,
				A.penerima
			FROM trx_invoice A 
			LEFT JOIN mst_customer B ON A.code_customer	= B.code
			WHERE A.deleted = '0'
		";
		$query = $this->db->query($sql);
		$recordsTotal = $query->num_rows();
		$recordsFiltered = $recordsTotal;

		// $sql = "SELECT * FROM trx_invoice where deleted='0'";
		$sql = "
			SELECT 
				A.id,
				A.adddt,
				A.addby,
				A.moddt,
				A.modby,
				B.name,
				B.code,
				(SELECT no_kontrak FROM trx_register_bkdn WHERE id = A.no_kontrak) AS no_kontrak,
				A.no_invoice,
				A.no_faktur,
				A.tgl,
				A.penerima
			FROM trx_invoice A 
			LEFT JOIN mst_customer B ON A.code_customer	= B.code
			WHERE A.deleted = '0'
		";

		if($search!=NULL || $search!=""){
			$sql.= " AND ( A.id LIKE '%$search%'";
			$sql.= " OR B.name LIKE '%$search%'";
			$sql.= " OR A.no_kontrak LIKE '%$search%'";
			$sql.= " OR A.no_invoice LIKE '%$search%'";
			$sql.= " OR A.no_faktur LIKE '%$search%'";
			$sql.= " OR A.penerima LIKE '%$search%' )";
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

        // $patCode = $this->db->query("
        // 	SELECT 
	       //    (CASE WHEN CONCAT('ETL',SUBSTRING('00000', 1, 5 - LENGTH(t1.code)), t1.code) IS NULL THEN 'ETL0001' END) AS code
	       //  FROM
	       //  (
	       //      SELECT (CONVERT(REPLACE(MAX(code), 'ETL', ''), UNSIGNED INTEGER) + 1) AS code FROM trx_invoice
	       //  ) AS t1

        // ");

        
        // $rows = $patCode->row();
        // $newCode = $rows->code;

		// $code          = $newCode;
		$code_customer = $this->input->post('code_customer',true);
		$no_kontrak    = $this->input->post('no_kontrak',true);
		$no_invoice    = $this->input->post('no_invoice',true);
		$no_faktur     = $this->input->post('no_faktur',true);
		$tgl           = $this->input->post('tgl',true);
		$penerima      = $this->input->post('penerima',true);

        if(empty($code_customer)){
        	return $this->response('503','Code Customer tidak boleh kosong');
        }else if(empty($no_kontrak)){
        	return $this->response('503','no kontrak tidak boleh kosong');
        }else if(empty($no_invoice)){
        	return $this->response('503','no invoice tidak boleh kosong');
        }else if(empty($no_faktur)){
        	return $this->response('503','no faktur tidak boleh kosong');
        }else if(empty($tgl)){
        	return $this->response('503','tanggal tidak boleh kosong');
        }else if(empty($penerima)){
        	return $this->response('503','penerima tidak boleh kosong');
        }else{
        	$tgl = date('Y-m-d h:i:s', strtotime($tgl));
        	$data = array(
			        // 'code' => $code,
			        'addby' => $this->session->userdata('code'),
			        'code_customer' => $code_customer,
					'no_kontrak' => $no_kontrak,
					'no_invoice' => $no_invoice,   
					'no_faktur' => $no_faktur,  
					'tgl' => $tgl,
					'penerima' => $penerima,
			        'deleted' => '0'
			);
        	$this->db->set('adddt','NOW()',FALSE);
			$save = $this->db->insert('trx_invoice', $data);
			if($save){
				return $this->response('200','Data Invoice berhasil di tambahkan');
			}else{
				return $this->response('200','Data Invoice gagal di tambahkan');
			}
        }
	}

	public function put(){
		if (!$this->input->is_ajax_request()) {
            return $this->response('404','No direct script access allowed');
        }

        // $code = $this->input->post('code',true);
		$code_customer = $this->input->post('code_customer',true);
		$no_kontrak    = $this->input->post('no_kontrak',true);
		$no_invoice    = $this->input->post('no_invoice',true);
		$no_faktur     = $this->input->post('no_faktur',true);
		$tgl           = $this->input->post('tgl',true);
		$penerima      = $this->input->post('penerima',true);

        if(empty($code_customer)){
        	return $this->response('503','Code Customer tidak boleh kosong');
        }else if(empty($no_kontrak)){
        	return $this->response('503','no kontrak tidak boleh kosong');
        }else if(empty($no_invoice)){
        	return $this->response('503','no invoice tidak boleh kosong');
        }else if(empty($no_faktur)){
        	return $this->response('503','no faktur tidak boleh kosong');
        }else if(empty($tgl)){
        	return $this->response('503','tanggal tidak boleh kosong');
        }else if(empty($penerima)){
        	return $this->response('503','penerima tidak boleh kosong');
        }else{
        	$tgl = date('Y-m-d h:i:s', strtotime($tgl));
        	$data = array(
			        // 'code' => $code,
			        'modby' => $this->session->userdata('code'),
			        'code_customer' => $code_customer,
					'no_kontrak' => $no_kontrak,
					'no_invoice' => $no_invoice,  
					'no_faktur' => $no_faktur,  
					'tgl' => $tgl,   
					'penerima' => $penerima,
			        'deleted' => '0'
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	// $this->db->where('code', $code);
			$save = $this->db->update('trx_invoice', $data);
			if($save){
				return $this->response('200','Data Invoice dengan code '.$no_invoice.' berhasil di update');
			}else{
				return $this->response('200','Data Invoice dengan code '.$code.' gagal di update');
			}
        }
	}

	public function delete(){
		if (!$this->input->is_ajax_request()) {
            return $this->response('404','No direct script access allowed');
        }

        $id = $this->input->post('id',true);
        if(empty($id)){
        	return $this->response('503','id tidak boleh kosong');
        }else{
        	$data = array(
			        'modby' => $this->session->userdata('id'),
			        'deleted' => '1'
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	$this->db->where('id', $id);
			$save = $this->db->update('trx_invoice', $data);
			if($save){
				return $this->response('200','Data Invoice dengan id '.$id.' berhasil di hapus');
			}else{
				return $this->response('202','Data Invoice dengan id '.$id.' gagal di hapus');
			}
        }
	}

	//END CLASS MODEL

}

/* End of file Invoice_model.php */
/* Location: ./application/models/Invoice_model.php */