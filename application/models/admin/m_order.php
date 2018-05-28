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
		$query = $this->db->query("SELECT x.id_currier as id,x.nama as nama,x.phone as phone,COUNT(x.status_dlv) as qty,x.`status` as `status`FROM
			(
				SELECT a.id as id_currier, a.`name` as nama,a.phone as phone,
				CASE WHEN b.`status` = 'on progress' THEN b.`status` END as status_dlv,a.`status` as `status` 
				from admin a
				LEFT JOIN shipping b 
				ON a.id = b.id_currier 
				where a.rule = 2 and a.`status` = 'idle' 
				group by id_currier,nama,phone,`status`
			) x
			group by id,nama,phone,`status`");

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
		$this->db->select('b.`name` as nama,b.phone as phone,c.lokasi as loc')
     		->from('shipping a')
     		->join('admin b', 'a.id_currier = b.id')
     		->join('order c', 'c.id_order = a.id_order')
     		->where('c.id_order', $id_order);
		return $this->db->get()->result();
	}

	public function detailReceive($id_order)
	{
		$this->db->select('a.receiver as receiver,a.receivedate as receivedate,b.status_payment as status')
     		->from('shipping a')
     		->join('order b', 'a.id_order = b.id_order')
     		->where('a.id_order', $id_order);
		return $this->db->get()->result();
	}


	public function updtOrderexpr()
	{
		$NOW = date('Y-m-d H:i:s');

		$this->db->set('status_payment', 'expired');
		$this->db->where('status_payment', '1');
		$this->db->where('DATE_ADD(tgl, INTERVAL 1 HOUR) < ', $NOW);
		return $this->db->update('order');
	}

}