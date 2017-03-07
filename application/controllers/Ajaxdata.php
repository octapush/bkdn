<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxdata extends CI_Controller {

	public function loadCustomer()
	{
		$table = $this->db->query("SELECT mc.code AS id, mc.name AS text FROM mst_customer AS mc WHERE mc.deleted='0'");

		foreach ($query->result_array() as $rows) {
			# code...
			$data[] = $rows;
		}
		echo json_encode($data);
	}

	public function loadNoProyek($id = FALSE)
	{
		$table = $this->db->query("SELECT mc.code AS id, mc.name AS text FROM trx_register_bkdn AS tr WHERE tr.code_customer='$id'");

		foreach ($query->result_array() as $rows) {
			# code...
			$data[] = $rows;
		}
		echo json_encode($data);		
	}

}

/* End of file Ajaxdata.php */
/* Location: ./application/controllers/Ajaxdata.php */