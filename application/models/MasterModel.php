<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelMaster extends CI_Model {

public function dataTabelFormatModel($columns=array(),$spname,$orderDefault=NULL){
		$params = $columns = $totalRecords = $data = array();

		$params = $_REQUEST;
		
		//DEFAULT PARAM DATATABLE JQUERY
		$draw 	= empty($params['draw'])?0: $params['draw']; 
		$start 	= empty($params['start'])?1:$params['start']; 
		$length = empty($params['length'])?10:$params['length'];
		
		//ORDERING COLUMN
		if(empty($order)){
			$order = NULL;
		}else{
			$order	= empty($columns[$params['order'][0]['column']])? $orderDefault : $columns[$params['order'][0]['column']]." ".empty($params['order'][0]['dir'])? NULL : $params['order'][0]['dir'];
		}
		
		$search 	= empty($params['search']['value'])? NULL : $params['search']['value'];

		$modeList 	= 1;
		$user_id 	= empty($params['user_id'])? NULL : $params['user_id'];
		

		//MODELLIST 1 FOR GET DATA AND WITH CUSTOM FILTER DATA

		$sp = "CALL ".$spname."(
								'".$start."',
								'".$length."',
								'".$order."',
								'".$search."',
								'".$modeList."',
								'".$user_id."'
							)";

		$sp2 = "CALL ".$spname."(
								'".NULL."',
								'".NULL."',
								'".NULL."',
								'".$search."',
								'".intval('2')."',
								'".$user_id."'
							)";

		//echo $sp;
		//echo $sp2." => ". $this->getrecordsTotal($sp2);

		$res = $this->db->query($sp);
		//mysqli_next_result($this->db->conn_id);
		$data=array();

		foreach ($res->result_array() as $row) {
			# code...
			$data[] = $rows;
		}

		//FORMATING DATA JSON FOR DATATABLE JQUERY, DON'T CHANGE
		$json_data = array(
			"draw"            => intval($draw),   
			"recordsTotal"    => $this->getrecordsTotal($sp2),
			"recordsFiltered" => $this->getrecordsFiltered($sp2),
			"data"            => $data
			);

		return $json_data;
		 
	}


	public function dataTabelFormatModelBillRajal($columns=array(),$spname,$orderDefault=NULL){
		$params = $columns = $totalRecords = $data = array();

		$params = $_REQUEST;
		
		//DEFAULT PARAM DATATABLE JQUERY
		$draw 		= empty($params['draw'])?0: $params['draw']; 
		$start 		= empty($params['start'])?1:$params['start']; 
		$length 	= empty($params['length'])?10:$params['length'];

		$startDate 	= empty($params['startDate'])?NULL:$params['startDate'];
		$endDate 	= empty($params['endDate'])?NULL:$params['endDate'];
		$nama 		= empty($params['nama'])?NULL:$params['nama'];
		$nomr 		= empty($params['nomr'])?NULL:$params['nomr'];
		$kdPoly 	= empty($params['kdPoly'])?NULL:$params['kdPoly'];
		$kdBayar 	= empty($params['kdBayar'])?NULL:$params['kdBayar'];
		
		//ORDERING COLUMN
		if(empty($order)){
			$order = NULL;
		}else{
			$order	= empty($columns[$params['order'][0]['column']])? $orderDefault : $columns[$params['order'][0]['column']]." ".empty($params['order'][0]['dir'])? NULL : $params['order'][0]['dir'];
		}
		
		$search 	= empty($params['search']['value'])? NULL : $params['search']['value'];

		$modeList 	= 1;
		$user_id 	= empty($params['user_id'])? NULL : $params['user_id'];
		
		//DINAMYC QUERY;

		/*$conditions = "";
		if($startDate!=NULL && $endDate!=NULL){
			$conditions = "AND tp.TGLREG BETWEEN $startDate AND $endDate";
		}elseif($startDate!=NULL && $endDate!=NULL && $nama!=NULL && $kdPoly!=NULL && $kdBayar!=NULL){
			$conditions = " AND (
							tp.TGLREG BETWEEN '$startDate' AND '$endDate')
		                    AND
		                    (mp.NAMA LIKE CONCAT('%',IFNULL('$nama',NULL),'%'))
		                    AND
		                    (mpy.kode = IFNULL('$kdPoly',''))
		                    AND
		                    (mcb.KODE = IFNULL('$kdBayar',''))
		                    AND
		                    (mp.NOMR = IFNULL('$nomr',''))
		                   )";
		}elseif ($search!=NULL) {
			# code...
			$conditions = " AND (mp.NAMA LIKE CONCAT('%',IFNULL('$search',''),'%')) OR (mp.TEMPAT LIKE CONCAT('%',IFNULL('$search',''),'%'))";
		}

		//MODELLIST 1 FOR GET DATA AND WITH CUSTOM FILTER DATA
		$sql = "
				SELECT
					*
				FROM
		        (
					SELECT 
						tp.NOMR,
		                tp.IDXDAFTAR, 
		                mp.NAMA AS NAMA,
		                mp.ALAMAT,
		                mp.TGLLAHIR,
		                mp.JENISKELAMIN,
		                mp.UMUR,
		                mpy.nama AS NAMA_POLY,
		                mpy.kode AS KDPOLY,
		                mcb.NAMA AS CARABAYAR, 
		                (
							CASE (SELECT COUNT(*) AS tagihan FROM t_bayarrajal WHERE NOMR = tp.NOMR AND IDXDAFTAR = tp.IDXDAFTAR) WHEN 0 THEN 'Lunas' ELSE '' END
		                ) AS STATUSTAGIHAN
					FROM 
						t_pendaftaran AS tp
					JOIN m_pasien AS mp
						ON tp.NOMR = mp.NOMR 
					JOIN m_poly AS mpy
						ON mpy.kode = tp.KDPOLY 
					JOIN m_carabayar AS mcb
						ON mcb.KODE = tp.KDCARABAYAR 
					WHERE 1=1 $conditions
						
		        ) AS t1
		        LIMIT $start, $length
			";
			
		$recordsTotal = "
							SELECT COUNT(*) AS recordsTotal
							FROM 
								t_pendaftaran AS tp
							JOIN m_pasien AS mp
								ON tp.NOMR = mp.NOMR 
							JOIN m_poly AS mpy
								ON mpy.kode = tp.KDPOLY 
							JOIN m_carabayar AS mcb
								ON mcb.KODE = tp.KDCARABAYAR 
							WHERE 1=1
						";

		$recordsFiltered = "
							SELECT
								COUNT(*) AS recordsFiltered
							FROM
					        (
								SELECT 
									tp.NOMR,
					                tp.IDXDAFTAR, 
					                mp.NAMA AS NAMA,
					                mp.ALAMAT,
					                mp.TGLLAHIR,
					                mp.JENISKELAMIN,
					                mp.UMUR,
					                mpy.nama AS NAMA_POLY,
					                mpy.kode AS KDPOLY,
					                mcb.NAMA AS CARABAYAR, 
					                (
										CASE (SELECT COUNT(*) AS tagihan FROM t_bayarrajal WHERE NOMR = tp.NOMR AND IDXDAFTAR = tp.IDXDAFTAR) WHEN 0 THEN 'Lunas' ELSE '' END
					                ) AS STATUSTAGIHAN
								FROM 
									t_pendaftaran AS tp
								JOIN m_pasien AS mp
									ON tp.NOMR = mp.NOMR 
								JOIN m_poly AS mpy
									ON mpy.kode = tp.KDPOLY 
								JOIN m_carabayar AS mcb
									ON mcb.KODE = tp.KDCARABAYAR 
								WHERE 1=1 $conditions
									
					        ) AS t1
					        LIMIT $start, $length
							";
		*/

		$sp = "CALL ".$spname."(
								'".$start."',
								'".$length."',
								'".$order."',
								'".$search."',
								'".$modeList."',
								'".$startDate."',
								'".$endDate."',
								'".$nama."',
								'".$nomr."',
								'".$kdPoly."',
								'".$kdBayar."',
								'".$user_id."'
							)";

		$sp2 = "CALL ".$spname."(
								'".NULL."',
								'".NULL."',
								'".NULL."',
								'".$search."',
								'".intval('2')."',
								'".$startDate."',
								'".$endDate."',
								'".$nama."',
								'".$nomr."',
								'".$kdPoly."',
								'".$kdBayar."',
								'".$user_id."'
							)";

		//echo $sp;
		//echo $sp2." => ". $this->getrecordsTotal($sp2);

		$res = $this->db->query($sp);
		mysqli_next_result($this->db->conn_id);

		//FORMATING DATA JSON FOR DATATABLE JQUERY, DON'T CHANGE
		$json_data = array(
			"draw"            => intval($draw),   
			"recordsTotal"    => $this->getrecordsTotal($sp2),
			"recordsFiltered" => $this->getrecordsFiltered($sp2),
			"data"            => $res->result_array()
			);

		return $json_data;
		 
	}

	public function getrecordsTotal($sp){
		$query = $this->db->query($sp);
		mysqli_next_result($this->db->conn_id);
		$row=0;
		if ($query->num_rows() > 0)
		{
		        $row = $query->row()
		        			 ->recordsTotal;

		}
			else
		{
			$row = 0;
		}
		return $row;
	}

	public function getrecordsFiltered($sp){
		$query = $this->db->query($sp);
		mysqli_next_result($this->db->conn_id);
		$row=0;
		if ($query->num_rows() > 0)
		{
		        $row = $query->row()
		        			 ->recordsFiltered;

		}
			else
		{
			$row = 0;
		}
		return $row;
	}

}