<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_order extends CI_Model {

	public function getData()
	{
		$query = $this->db->get('order');
		return $query->result();
	}

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

	public function getTracker($id_order)
	{
		$this->db->select('`status`,id_order,datetime,description')
			->distinct()
			->from('tracker')
			->where('id_order', $id_order)
			->order_by("datetime", "asc");
		return $this->db->get()->result();
	}

	public function getCurrier()
	{
		$query = $this->db->query("SELECT * from admin where rule = 2 and `status` = 'idle' and `id` NOT IN (SELECT DISTINCT id_currier FROM shipping where `status` != 'delivered')");
		
		return $query->result();
	}

	public function getCurriertask($currierid)
	{
		$this->db->select('b.nama as nama, b.lokasi as lokasi')
     		->from('shipping a')
     		->join('order b', 'a.id_order = b.id_order') 
     		->where('a.id_currier', $currierid);
		return $this->db->get()->result();
	}

	public function saveShipping($data)
	{
		$this->db->insert('shipping',$data);
	}

	public function updtStatusorder($id_order,$status)
	{
		$this->db->set('status_payment', $status);
		$this->db->where('id_order', $id_order);
		return $this->db->update('order');
	}

	public function updateTracker($data)
	{
		$this->db->insert('tracker',$data);
	}

	public function detailShipping($id_order)
	{
		$this->db->select('c.`name` as nama,c.phone as phone,b.lokasi as loc')
     		->from('shipping a')
     		->join('order b', 'a.id_order = b.id_order')
     		->join('admin c', 'a.id_currier = c.id') 
     		->where('a.id_order', $id_order);
		return $this->db->get()->result();
	}

}