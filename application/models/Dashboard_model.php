<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function loadDataCustomer()
	{
		$sql = "
		select
			*
		from 
		(
			(select count(`id`) as active from mst_customer where deleted = '0') as a,
			(select count(`id`) as noactive from mst_customer where deleted = '1') as b 
		)
		";

		$r = $this->db->query($sql)->row();

		return $r;
	}

	public function loadDataResgitration()
	{
		$sql = "
		select
			*
		from 
		(
			(select count(`id`) as done from trx_register_bkdn where is_close = '0') as a,
			(select count(`id`) as progress from trx_register_bkdn where is_close = '1') as b 
		)
		";
		$r = $this->db->query($sql)->row();

		return $r;
	}

}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */