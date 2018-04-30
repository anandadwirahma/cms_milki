<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_order extends CI_Model {

	public function getData()
	{
		$query = $this->db->get('order');
		return $query->result();
	}

}