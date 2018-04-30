<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_login extends CI_Model {

	public function cekLogin($username,$password)
	{
		$this->db->where('user',$username);
		$this->db->where('password',$password);
		$this->db->from('admin');
		return $this->db->get();
	}

}