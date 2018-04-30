<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_stock extends CI_Model {

	public function getData()
	{
		$query = $this->db->get('barang');
		return $query->result();
	}

	public function getDataid($id_brg)
	{
		$this->db->where('id_brg', $id_brg);
		$this->db->from('barang');
		return $this->db->get()->result();
	}

	public function saveData($data)
	{
		$this->db->insert('barang',$data);
	}

	public function updateData($id_brg,$data)
	{
		$this->db->where('id_brg', $id_brg);
		return $this->db->update('barang', $data);
	}

	public function deleteData($id_brg)
	{
		$this->db->where('id_brg', $id_brg);
		return $this->db->delete('barang');
	}
}