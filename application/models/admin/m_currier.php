<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_currier extends CI_Model {

	public function getCurrier()
	{
		$query = $this->db->query("SELECT x.id_currier as id,x.nama as nama,x.phone as phone,COUNT(x.status_dlv) as qty,x.`status` as `status`FROM
			(
				SELECT a.id as id_currier, a.`name` as nama,a.phone as phone,
				CASE WHEN b.`status` = 'on progress' THEN b.`status` END as status_dlv,a.`status` as `status` 
				from admin a
				LEFT JOIN shipping b 
				ON a.id = b.id_currier 
				where a.rule = 2
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

	public function updtStatuscurrier($currierid)
	{
		$this->db->set('status', 'ondelivery');
		$this->db->where('id', $currierid);
		return $this->db->update('admin');
	}

	public function updateIdle($id_currier)
	{
		$this->db->set('status', 'idle');
		$this->db->where('id', $id_currier);
		$this->db->update('admin');
	}

}