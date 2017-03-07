<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registerbkdn_model extends CI_Model {

	public function __construct()
    {
            parent::__construct();
            $this->load->helper(array('form', 'url'));
    }

	public function get(){
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
            return;
        }
        
		// if(!$this->input->post('method')){
		// 	return;
		// }

		$params = $columns = $totalRecords = $data = array();
		$params= $_POST;
		$columns = array( 
			0=> "trb.id",
			1=> "trb.no_kontrak",
			2=> "trb.addby",
			3=> "trb.adddt",
			4=> "trb.modby",
			5=> "trb.moddt",
			6=> "mc.name", // AS customer_name
			7=> "mc.address", // AS customer_address
			8=> "mp.name", //AS jenis_perijinan
			9=> "trb.id_jenis_surat",
			10=> "trb.tgl_pj",
			11=> "trb.amount_kontrak",
			12=> "trb.begindate",
			13=> "trb.enddate",
			14=> "trb.id_division",
			15=> "trb.id_customer",
			16=> "trb.id_pj",
			17=> "trb.ppn",
			18=> "trb.pph",
			19=> "trb.total_amount",
			20=> "trb.file_name",
			21=> "trb.is_close",
			22=> "trb.close_2",
			23=> "md.code", //AS code_division
			24=> "md.project_name" //AS project_name
			
		);


		$draw = empty($params['draw'])? 0: $params['draw']; //DRAW TABLE REALTIME
        $start = empty($params['start'])? 0 :$params['start'];
        $length = empty($params['length'])?10 :$params['length'];
		$search = empty($params['search']['value'])?NULL:$params['search']['value'];

		$order = $columns[$params['order'][0]['column']]." ".$params['order'][0]['dir'];
		$is_close = empty($params['is_close'])? 0: $params['is_close']; 
		$sql = "SELECT 
					trb.*,trb.is_close AS close_2,md.code AS code_division, md.project_name,mp.name AS jenis_perijinan, mc.name AS customer_name,mc.address AS customer_address 
				FROM trx_register_bkdn AS trb 
					JOIN mst_division AS md ON trb.code_division = md.code 
					JOIN mst_pj AS mp ON trb.code_pj = mp.code
					JOIN mst_customer  AS mc ON trb.code_customer = mc.code
				WHERE trb.deleted='0' AND trb.is_close='$is_close'";

		$query = $this->db->query($sql);
		$recordsTotal = $query->num_rows();
		$recordsFiltered = $recordsTotal;

		$sql = "SELECT 
					trb.*,trb.is_close AS close_2,md.code AS code_division, md.project_name,mp.name AS jenis_perijinan, mc.name AS customer_name,mc.address AS customer_address 
				FROM trx_register_bkdn AS trb 
					JOIN mst_division AS md ON trb.code_division = md.code 
					JOIN mst_pj AS mp ON trb.code_pj = mp.code
					JOIN mst_customer  AS mc ON trb.code_customer = mc.code
				WHERE trb.deleted='0' AND trb.is_close='$is_close'";

		if($search!=NULL || $search!=""){
			$sql.= " AND (trb.no_kontrak='$search'";
			$sql.= " OR mc.name LIKE '%$search%' )";
		}

		$query = $this->db->query($sql);
		$recordsFiltered = $query->num_rows();
		$sql.=" ORDER BY $order LIMIT $start,$length";
		$query = $this->db->query($sql);

		//force_download('/path/to/photo.jpg', NULL);
		$newArray = array();

		foreach ($query->result_array() as $row)
		{	
				$fileName = $row['file_name'];
				$action = array
				(
					"action"=>"<button style='display:none' title=\"View Detail Data\" type=\"button\" data-tag=\"view\" class=\"easyui-linkbutton l-btn\">View</button><button type=\"button\" title=\"Edit Data Selection\" data-tag=\"edit\" class=\"easyui-linkbutton l-btn\">Edit</button>&nbsp;&nbsp;<button type=\"button\" title=\"Delete Data Selection\" data-tag=\"delete\" class=\"easyui-linkbutton l-btn\">Delete</button>",
					'file'=>"<a href='../../uploads/$fileName' class=\"l-btn-a easyui-linkbutton\">Download</a>"
				);
				$newArray = array_merge($action,$row);
				
				$data[]=$newArray;
		}


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
		if (!$this->input->is_ajax_request() && $this->session->userdata('code')!="") {
            return $this->response('404','No direct script access allowed');
        }

        $no_kontrak = $this->input->post('no_kontrak',true);
        $id_division = $this->input->post('id_division',true);
        $id_customer = $this->input->post('id_customer',true);
        $id_pj = $this->input->post('id_pj',true);
        $tgl_pj = $this->input->post('tgl_pj',true);
        $id_jenis_surat = $this->input->post('id_jenis_surat',true);
        $amount_kontrak = $this->input->post('amount_kontrak',true);
        $begindate = $this->input->post('begindate',true);
        $enddate = $this->input->post('enddate',true);

        $tgl_pj = date('Y-m-d h:i:s', strtotime($tgl_pj));
        $begindate = date('Y-m-d h:i:s', strtotime($begindate));
        $enddate = date('Y-m-d h:i:s', strtotime($enddate));

        if(empty($no_kontrak)){
        	return $this->response('503','No Kontrak tidak boleh kosong');
        }else if(empty($id_division)){
        	return $this->response('503','Nama Divisi tidak boleh kosong');
        }else if(empty($id_customer)){
        	return $this->response('503','Nama Perusahaan tidak boleh kosong');
        }else if(empty($id_pj)){
        	return $this->response('503','Tanggal Perjanjian tidak boleh kosong');
        }else if(empty($amount_kontrak)){
        	return $this->response('503','Nilai Kontrak tidak boleh kosong');
        }else if(empty($id_jenis_surat)){
        	return $this->response('503','Jenis surat tidak boleh kosong');
        }else if(empty($begindate)){
        	return $this->response('503','Tanggal Awal Pelaksanaan tidak boleh kosong');
        }else if(empty($enddate)){
        	return $this->response('503','Tanggal Akhir Pelaksanaan tidak boleh kosong');
        }else{

        	$ppn = 10;
        	$pph = 0;
        	if($id_jenis_surat==1){
        		$pph = 2;
        	}if($id_jenis_surat==2){
        		$pph = 1.5;
        	}if($id_jenis_surat==3){
        		$pph= 3;
        	}
	        
	        $total_ppn = 0;
	        $total_pph = 0;
	        $total_amount = 0;

        	$total_ppn = ((intval($amount_kontrak)) * ($ppn/100));
        	$total_pph = ((intval($amount_kontrak)) * ($pph/100));

        	$total_amount = (intval($amount_kontrak) + intval($total_ppn) + intval($total_pph));

        	$data = array(
			        'no_kontrak' => $no_kontrak,
			        'addby' => 'SYSTEM',
			        'id_division' => $id_division,
			        'id_customer' => $id_customer,
			        'id_pj' => $id_pj,
			        'tgl_pj' => $tgl_pj,
			        'id_jenis_surat' => $id_jenis_surat,
			        'amount_kontrak' => $amount_kontrak,
			        'begindate' => $begindate,
			        'enddate' => $enddate,
			        'ppn' => $ppn,
			        'pph' => $pph,
			        'total_amount' => $total_amount,
			        'deleted' => '0'
			);
        	$this->db->set('adddt','NOW()',FALSE);
			$save = $this->db->insert('trx_register_bkdn', $data);
			if($save){
				return $this->response('200','Register calon perusahaan di tambahkan');
			}else{
				return $this->response('200','Register calon perusahaan di tambahkan');
			}
        }
	}

	public function put(){
		if (!$this->input->is_ajax_request() && $this->session->userdata('code')!="") {
            return $this->response('404','No direct script access allowed');
        }

        $no_kontrak 	= $this->input->post('no_kontrak',true);
        $id 			= $this->input->post('id',true);
        $code_division 	= $this->input->post('code_division',true);
        $code_customer 	= $this->input->post('code_customer',true);
        $code_pj 		= $this->input->post('code_pj',true);
        $tgl_pj 		= $this->input->post('tgl_pj',true);
        $amount_kontrak = $this->input->post('amount_kontrak',true);
        $begindate 		= $this->input->post('begindate',true);
        $enddate 		= $this->input->post('enddate',true);

        if(empty($id)){
        	return $this->response('503','Id tidak boleh kosong');
        }else if(empty($code_division)){
        	return $this->response('503','Divisi tidak boleh kosong');
        }else if(empty($code_customer)){
        	return $this->response('503','Customer tidak boleh kosong');
        }else if(empty($code_pj)){
        	return $this->response('503','Jenis Perjanjian tidak boleh kosong');
        }else if(empty($amount_kontrak) || intval($amount_kontrak)<1){
        	return $this->response('503','Nilai Amount Kontrak tidak boleh kosong');
        }else if(empty($begindate)){
        	return $this->response('503','Tanggal Awal tidak boleh kosong');
        }else if(empty($enddate)){
        	return $this->response('503','Tanggal Akhir tidak boleh kosong');
        }else{

        	$tgl_pj = date('Y-m-d h:i:s', strtotime($tgl_pj));
	        $begindate = date('Y-m-d h:i:s', strtotime($begindate));
	        $enddate = date('Y-m-d h:i:s', strtotime($enddate));

        	$data = array(
			        'modby' => $this->session->userdata('code'),
			        'code_division' => $code_division,
			        'code_customer' => $code_customer,
			        'code_pj' => $code_pj,
			        'tgl_pj' => $tgl_pj,
			        'amount_kontrak' => $amount_kontrak,
			        'begindate' => $begindate,
			        'enddate' => $enddate,
			        'deleted' => '0'
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	$this->db->where('id', $id);
			$save = $this->db->update('trx_register_bkdn', $data);
			if($save){
				return $this->response('200','Register dengan no_kontrak '.$no_kontrak.' berhasil di update');
			}else{
				return $this->response('200','Register dengan no_kontrak '.$no_kontrak.' gagal di update');
			}
        }
	}

	public function update_detail(){
		if (!$this->input->is_ajax_request() && $this->session->userdata('code')!="") {
            return $this->response('404','No direct script access allowed');
        }

        $id = $this->input->post('id_detail',true);
        $qty = $this->input->post('qty',true);
        $deskripsi = $this->input->post('deskripsi',true);
        $spesifikasi = $this->input->post('spesifikasi',true);
        $price_item = $this->input->post('price_item',true);

        if(empty($id)){
        	return $this->response('503','Id tidak boleh kosong');
        }else if(empty($qty) || $qty=="0"){
        	return $this->response('503','Qty tidak boleh Nol/kosong');
        }else if(empty($deskripsi)){
        	return $this->response('503','deskripsi tidak boleh kosong');
        }else if(empty($spesifikasi)){
        	return $this->response('503','spesifikasi tidak boleh kosong');
        }else if(empty($price_item) || intval($price_item)<1){
        	return $this->response('503','Price item tidak boleh kosong');
        }else{
        	$price_total = intval($qty)*floatval($price_item);

        	$data = array(
			        'modby' => $this->session->userdata('code'),
			        'qty' => $qty,
			        'deskripsi' => $deskripsi,
			        'spesifikasi_standart' => $spesifikasi,
			        'price_per_item' => $price_item,
			        'total_price' => $price_total,
			        'deleted' => '0'
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	$this->db->where('id', $id);
			$save = $this->db->update('trx_register_bkdn_detail', $data);
			if($save){
				return $this->response('200','Register bkdn dengan id '.$id.' '.$price_item.' '.$price_total.'berhasil di update');
			}else{
				return $this->response('200','Register bkdn dengan id '.$id.' gagal di update');
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
			        'modby' => $this->session->userdata('code'),
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

	public function uploadwithdata(){
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
            return;
        }

		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'doc|docx|pdf|xls|xlsx'; //'gif|jpg|png|txt|doc|pdf|xls';
        // $config['max_size']             = 100;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $config['overwrite']=FALSE;
        $config['encrypt_name']=TRUE;
        $config['remove_spaces']=TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('file_doc'))
        {
                $error = $this->upload->display_errors();
                return json_encode(array("SUCCESS"=>"FALSE","MSG"=>$error));
        }
        else
        {
                $data = $this->upload->data();
                return json_encode(array("SUCCESS"=>"TRUE","file_name"=>$data['file_name']));
        }
	}

	public function removedata(){
		$file_name = $this->input->post('file_name',true);
		$path = "../../uploads/"+$file_name;
		if($file_name!=null || $file_name!=""){
			if(is_file($path)){
				unlink("../../uploads/"+$file_name);
			}
		}
		
	}

	public function createdetail(){
		if (!$this->input->is_ajax_request()) {
            return $this->response('404','No direct script access allowed');
        }

		$dg = $this->input->post('datadetail',true);
		$file_name = $this->input->post('file_name',true);
		$dh = $this->input->post('dataheader',true);

		$data=array();
		$dataHeader=array();

		foreach ($dh as $rowsHeader) {
			$dataHeader['no_kontrak']=$rowsHeader['kontrak_no'];
			$dataHeader['addby']="SYSTEM";
			$dataHeader['code_division']="EPC";
			$dataHeader['code_customer']=$rowsHeader['code_customer'];
			$dataHeader['code_pj']=$rowsHeader['code_pj'];
			$dataHeader['tgl_pj']=$rowsHeader['tgl_awal'];
			$dataHeader['amount_kontrak']=$rowsHeader['nilai_kontrak'];
			$dataHeader['begindate']=$rowsHeader['tgl_awal'];
			$dataHeader['enddate']=$rowsHeader['tgl_akhir'];
			$dataHeader['lingkup_pekerjaan']=$rowsHeader['lingkup_pekerjaan'];
			$dataHeader['dasar_pelaksanaan_pekerjaan']=$rowsHeader['dasar_pelaksanaan_pekerjaan'];
			$dataHeader['cara_pembayaran']=$rowsHeader['cara_pembayaran'];
			$dataHeader['pelaksanaan_pekerjaan']=$rowsHeader['pelaksanaan_pekerjaan'];
			$dataHeader['asuransi_dan_jaminan']=$rowsHeader['asuransi_dan_jaminan'];
			$dataHeader['lain_lain']=$rowsHeader['lain_lain'];
			$dataHeader['file_name']=$file_name;
			$dataHeader['deleted']="0";
		}

		$no_kontrak = $dataHeader['no_kontrak'];
		$code_pj = $dataHeader['code_pj'];
		$code_customer = $dataHeader['code_customer'];

		$qNo = $this->db->query("SELECT no_kontrak AS jumlah  FROM trx_register_bkdn WHERE no_kontrak='$no_kontrak'");

		$qPJ = $this->db->query("SELECT code AS jumlah FROM mst_pj WHERE code='$code_pj'");

		$qCus = $this->db->query("SELECT code AS jumlah FROM mst_customer WHERE code='$code_customer'");

		$jumlah = $qNo->num_rows();
		$jumlahPj = $qPJ->num_rows();
		$jumlahCus = $qCus->num_rows();

		if($jumlah>0){
			$this->cekfile($file_name);
			return $this->response('503',"No Kontrak $no_kontrak sudah ada!");
		}

		if($jumlahPj==0){
			$this->cekfile($file_name);
			return $this->response('503',"Code Perijinan $code_pj tidak ditemukan, silahkan gunakan data yang ada!");
		}

		if($jumlahCus==0){
			$this->cekfile($file_name);
			return $this->response('503',"Code Customer $code_customer tidak ditemukan, silahkan gunakan data yang ada!");
		}

		if(empty($dataHeader['no_kontrak'])){
			$this->cekfile($file_name);
			return $this->response('503','No Kontrak tidak boleh kosong');
        }else if(empty($dataHeader['code_customer']) || $dataHeader['code_customer']=="0"){
        	$this->cekfile($file_name);
        	return $this->response('503','Customer Name tidak boleh kosong');
        }else if(empty($dataHeader['code_pj']) || $dataHeader['code_pj']=="0"){
        	$this->cekfile($file_name);
        	return $this->response('503','Surat Perjanjian tidak boleh kosong');
        }else if(empty($dataHeader['amount_kontrak'])){
        	$this->cekfile($file_name);
        	return $this->response('503','Nilai Kontrak tidak boleh kosong');
        }else if(empty($dataHeader['begindate'])){
        	$this->cekfile($file_name);
        	return $this->response('503','Tanggal awal pelaksanaan kerja tidak boleh kosong');
        }else if(empty($dataHeader['enddate'])){
        	$this->cekfile($file_name);
        	return $this->response('503','Tanggal akhir pelaksanaan kerja tidak boleh kosong');
        }else if(empty($dataHeader['lingkup_pekerjaan'])){
        	$this->cekfile($file_name);
        	return $this->response('503','Lingkup pekerjaan tidak boleh kosong' );
        }else if(empty($dataHeader['dasar_pelaksanaan_pekerjaan'])){
        	$this->cekfile($file_name);
        	return $this->response('503','Dasar pelaksanaan kerja tidak boleh kosong');
        }else if(empty($dataHeader['cara_pembayaran'])){
        	$this->cekfile($file_name);
        	return $this->response('503','Cara Pembayaran tidak boleh kosong');
        }else if(empty($dataHeader['pelaksanaan_pekerjaan'])){
        	$this->cekfile($file_name);
        	return $this->response('503','Pelaksanaan pekerjaan tidak boleh kosong');
        }else if(empty($dataHeader['pelaksanaan_pekerjaan'])){
        	$this->cekfile($file_name);
        	return $this->response('503','Pelaksanaan pekerjaan tidak boleh kosong');
        }else if(empty($dataHeader['asuransi_dan_jaminan'])){
        	$this->cekfile($file_name);
        	return $this->response('503','Asuransi dan jaminan tidak boleh kosong');
        }else if(empty($dataHeader['lain_lain'])){
        	$this->cekfile($file_name);
        	return $this->response('503','Lain-lain nya tidak boleh kosong');
        }else{

	        $dataHeader['tgl_pj'] = date('Y-m-d h:i:s', strtotime($dataHeader['tgl_pj']));
	        $dataHeader['begindate'] = date('Y-m-d h:i:s', strtotime($dataHeader['begindate']));
	        $dataHeader['enddate'] = date('Y-m-d h:i:s', strtotime($dataHeader['enddate']));

        	$ppn = 10;
        	$pph = 0;
        	if($dataHeader['code_pj']==1){
        		$pph = 2;
        	}else if($dataHeader['code_pj']==2){
        		$pph = 1.5;
        	}else if($dataHeader['code_pj']==3){
        		$pph= 3;
        	}

        	$total_ppn = 0;
	        $total_pph = 0;
	        $total_amount = 0;

        	$total_ppn = ((intval($dataHeader['amount_kontrak'])) * ($ppn/100));
        	$total_pph = ((intval($dataHeader['amount_kontrak'])) * ($pph/100));

        	$total_amount = (intval($dataHeader['amount_kontrak']) + intval($total_ppn) + intval($total_pph));
        	
			$this->db->trans_begin();

			$this->db->set('adddt','NOW()',FALSE);
			$this->db->set('ppn',$ppn,FALSE);
			$this->db->set('pph',$pph,FALSE);
        	$this->db->set('total_amount',$total_amount,FALSE);
			$this->db->insert('trx_register_bkdn', $dataHeader);

			foreach ($dg as $rows) {
				# code...
				$data['no_kontrak'] = $dataHeader['no_kontrak'];
				$data['addby'] = "SYSTEM";
				$data['qty'] 		= $rows['qty'];
				$data['deskripsi'] 	= $rows['deskripsi'];
				$data['spesifikasi_standart'] = $rows['spesifikasi_standart'];
				$data['price_per_item'] = intval($rows['price_per_item']);
				$data['total_price'] = intval($rows['total_price']);
				$data['deleted'] = "0";
				//$data[]=$rows;
				$this->db->set('adddt','NOW()',FALSE);
				$this->db->insert('trx_register_bkdn_detail', $data);
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				$this->cekfile($file_name);
				return $this->response('FALSE','TRANSAKSI GAGAL');
			}else{
				$this->db->trans_commit();
				return $this->response('TRUE','TRANSAKSI SUKSES');
			}
        }
	}

	public function create_cus(){
		if (!$this->input->is_ajax_request()) {
            return $this->response('404','No direct script access allowed');
        }

        $code = $this->input->post('code',true);
        $name = $this->input->post('name',true);
        $address = $this->input->post('address',true);
        $npwp = $this->input->post('npwp',true);
        $phone = $this->input->post('phone',true);

        $qCek = $this->db->query("SELECT code FROM mst_customer WHERE deleted='0' AND code='$code'");
        
        if($qCek->num_rows()>0){
        	return $this->response('503','Duplicate code, silahkan gunakan Code yang lain!');
        }

        if(empty($code)){
        	return $this->response('503','Code tidak boleh kosong');
        }else if(empty($name)){
        	return $this->response('503','Nama Customer tidak boleh kosong');
        }else{
        	$data = array(
			        'code' => $code,
			        'addby' => $this->session->userdata('code'),
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

	public function cekfile($file_name){
		if($file_name!=null || $file_name!="")
		{
			unlink("./uploads/".$file_name);
		}
	}

	public function detailregister(){
		$no_kontrak = $this->input->post('data',true);
		$result = $this->db->query("SELECT * FROM trx_register_bkdn_detail WHERE deleted='0' AND no_kontrak='$no_kontrak'");
		$data = array();
		foreach ($result->result_array() as $rows) {
			# code...
			$data[] = $rows;
		}
		return json_encode($data);
	}

	public function print_bkdn(){
		$findNo  = $this->input->post('findNo',true);
		$result = $this->db->query("
				SELECT trb.*,md.code AS code_division, md.project_name,mp.name AS jenis_perijinan, mc.name AS customer_name,mc.address AS customer_address 
				FROM trx_register_bkdn AS trb 
					JOIN mst_division AS md ON trb.code_division = md.code 
					JOIN mst_pj AS mp ON trb.code_pj = mp.code
					JOIN mst_customer  AS mc ON trb.code_customer = mc.code
				WHERE trb.deleted='0' AND no_kontrak='$findNo'
				");

		$resultDetail = $this->db->query("SELECT * FROM trx_register_bkdn_detail WHERE deleted='0' AND no_kontrak='$findNo'
				");


		if($result->num_rows()<1){
			return json_encode(array("header"=>"FALSE","MSG"=>"Data dengan nomor kontrak $findNo tidak ditemukan!"));
		}

		$dataHeader = array();
		$dataDetail = array();

		foreach ($result->result_array() as $rows) {
			# code...
			$dataHeader[] = $rows;
		}
		foreach ($resultDetail->result_array() as $rows) {
			# code...
			$dataDetail[] = $rows;
		}
		return json_encode(array("header"=>$dataHeader,"detail"=>$dataDetail));
	}


	public function open_doc(){
		if (!$this->input->is_ajax_request()) {
            return $this->response('404','No direct script access allowed');
        }

        $id = $this->input->post('id',true);
        if(empty($id)){
        	return $this->response('503','Id tidak boleh kosong');
        }else{
        	$data = array(
			        'modby' => $this->session->userdata('code'),
			        'is_close' => '0'
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	$this->db->where('id', $id);
			$save = $this->db->update('trx_register_bkdn', $data);
			
			if($save){
				return $this->response('200','Register BKDN dengan no_kontrak '.$id.' berhasil di hapus');
			}else{
				return $this->response('202','Register BKDN dengan no_ontrak '.$id.' gagal di hapus');
			}
        }
	}

	//END CLASS

}