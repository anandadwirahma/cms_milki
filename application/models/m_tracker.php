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

	public function detailShipping($id_order)
	{
		$this->db->select('b.`name` as nama,b.phone as phone,c.lokasi as loc,a.status as status')
     		->from('shipping a')
     		->join('admin b', 'a.id_currier = b.id')
     		->join('order c', 'c.id_order = a.id_order')
     		->where('c.id_order', $id_order);
		return $this->db->get()->result();
	}

	public function updateShipping($id_order)
	{
		$this->db->set('status', 'done');
		$this->db->where('id_order', $id_order);
		$this->db->update('shipping');
	}

	public function updateTracker($data)
	{
		$this->db->insert('tracker',$data);
	}

	public function updtStatusorder($id_order,$status)
	{
		$this->db->set('status_payment', $status);
		$this->db->where('id_order', $id_order);
		return $this->db->update('order');
	}

}