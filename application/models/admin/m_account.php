<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_account extends CI_Model {

	public function getData()
	{
		$query = $this->db->get('admin');
		return $query->result();
	}

	public function getDataid($id)
	{
		$this->db->where('id', $id);
		$this->db->from('admin');
		return $this->db->get()->result();
	}

	public function saveData($data)
	{
		$this->db->insert('admin',$data);
	}

	public function updateData($id,$data)
	{
		$this->db->where('id', $id);
		return $this->db->update('admin', $data);
	}

	public function deleteData($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('admin');
	}

}