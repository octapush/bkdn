<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

	

	public function response($httResponse,$message){
		if($message!=""){
			return json_encode(array('success'=>$httResponse,'message'=>$message));
		}
	}
	public function put(){
		if (!$this->input->is_ajax_request() && empty($this->session->userdata('id'))) {
            return $this->response('404','No direct script access allowed');
        }

        $id = $this->input->post('id',true);
        $username = $this->input->post('username',true);
        $password = $this->input->post('password',true);

        if(empty($id)){
        	return $this->response('503','Id tidak boleh kosong');
        }else if(empty($username)){
        	return $this->response('503','Username tidak boleh kosong');
        }else if(empty($password)){
        	return $this->response('503','Password tidak boleh kosong');
        }else{
        	$data = array(
			        'modby' => $this->session->userdata('code'), //CODE EMPLOYEEE
			        'username' => $username,
			        'password' => md5($password)
			);
        	$this->db->set('moddt','NOW()',FALSE);
        	$this->db->where('id', $id);
			$save = $this->db->update('mst_employee', $data);
			if($save){
				return $this->response('200','Account dengan id '.$id.' berhasil di update');
			}else{
				return $this->response('200','Account dengan id '.$id.' gagal di update');
			}
        }
	}
}