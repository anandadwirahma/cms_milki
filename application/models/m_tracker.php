<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tracker extends CI_Model {

	public function getOrder($id_order)
	{
		$this->db->where('id_order', $id_order);
		$this->db->from('order');
		return $this->db->get()->result();
	}
	
	public function getItems($id_order)
	{
		$this->db->select('a.id_order as id_order, b.rasa as rasa, COUNT(a.id_order) as qty')
     		->from('detail_order a')
     		->join('barang b', 'a.id_brg = b.id_brg') 
     		->where('a.id_order', $id_order)
     		->group_by('id_order,rasa');
		return $this->db->get()->result();
	}

	public function updatePayment($id_order,$datetime,$status,$desc)
	{
		$this->db->query("INSERT IGNORE INTO tracker (id_order,`datetime`,`status`,description) VALUES ('$id_order','$datetime','$status','$desc');");
	}

	public function updateOrder($id_order)
	{
		$this->db->set('status_payment', 'expire');
		$this->db->where('id_order', $id_order);
		$this->db->update('order');
	}

}