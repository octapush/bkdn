<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif extends CI_Controller {

	public function autoAlertEmail()
	{
		$regBkdn = $this->db->get_where('trx_register_bkdn', array('is_close' => '1'))->result();

		if (count($regBkdn) != 0) {
			// proses email notif

			// config email smtp
			$config = Array(
			    'protocol' => 'smtp',
			    'smtp_host' => 'ssl://smtp.googlemail.com',
			    'smtp_port' => 465,
			    'smtp_user' => 'it.transfnb@gmail.com',
			    'smtp_pass' => 'neverG!v3Up^^',
			    'mailtype'  => 'html', 
			    'charset'   => 'iso-8859-1'
			);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			// put data emailtmpl
			$emailTmpl = $this->db->get('mst_emailtmpl')->row();

			// send email
			foreach ($regBkdn as $row) {
					$convertDate = date("Y-m-d", strtotime($row->tgl_pj));

					$currentDate = strtotime(date("Y-m-d"));
					$recordDate  = strtotime(date($convertDate));

					$dateDiff 	= $recordDate - $currentDate;
					$resultDiff = floor($dateDiff/(60*60*24));

					if ($resultDiff <= 7) {
						$this->email->initialize($config);

						$this->email->from('noreply@bkdn.com', 'No Reply');
						$this->email->to('a.syakur14@gmail.com');

						$this->email->subject($emailTmpl->name . ' ' . $row->no_kontrak);
						$this->email->message($emailTmpl->bodymsg);

						// add att
						// $this->email->attach('assets/attch/dita.jpg');
						// $this->email->attach('assets/attch/file.pdf');

						if (! $this->email->send()) {
							echo "\n\n Error Send Email: \n\n";
							
							echo $this->email->print_debugger();
						}
					}
				}
		}
	}

	public function manualAlertEmail($id = FALSE)
	{
		try {
			if (empty($id)) {
				throw new Exception("Error Processing Request", 1);
			} else {
				$row = $this->db->get_where('trx_register_bkdn', array('is_close' => '1', 'code_customer' => $id))->row();

				if (empty($row) || ! $row) {
					throw new Exception("Error Processing Request Data", 1);
				} else {
					// proses send email
					$config = Array(
					    'protocol' => 'smtp',
					    'smtp_host' => 'ssl://smtp.googlemail.com',
					    'smtp_port' => 465,
					    'smtp_user' => 'it.transfnb@gmail.com',
					    'smtp_pass' => 'neverG!v3Up^^',
					    'mailtype'  => 'html', 
					    'charset'   => 'iso-8859-1'
					);
					$this->load->library('email', $config);
					$this->email->set_newline("\r\n");

					// put data emailtmpl
					$emailTmpl = $this->db->get('mst_emailtmpl')->row();

					$this->email->initialize($config);

					$this->email->from('noreply@bkdn.com', 'No Reply');
					$this->email->to('a.syakur14@gmail.com');

					$this->email->subject($emailTmpl->name . ' ' . $row->no_kontrak);
					$this->email->message($emailTmpl->bodymsg);

					// add att
					// $this->email->attach('assets/attch/dita.jpg');
					// $this->email->attach('assets/attch/file.pdf');

					if (! $this->email->send()) {
						echo "\n\n Error Send Email: \n\n";
						
						echo $this->email->print_debugger();
					}
				}
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

}

/* End of file Notif.php */
/* Location: ./application/controllers/Notif.php */