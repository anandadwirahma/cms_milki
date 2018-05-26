<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_dashboard extends CI_Model {

	public function getTask($id_currier)
	{
		$this->db->select('a.id_order as id_order,a.nama as nama,a.lokasi as loc,a.tgl as tgl')
			->from('`order` a')
     		->join('shipping b', 'a.id_order = b.id_order') 
     		->where('b.id_currier', $id_currier)
     		->where('b.status', 'on progress');
		return $this->db->get()->result();
	}

	public function update_shipping($id_order,$receiver)
	{
		$this->db->set('receiver', $receiver);
		$this->db->set('receivedate', date('Y-m-d H:i:s'));
		$this->db->set('status', 'waiting confirm');
		$this->db->where('id_order', $id_order);
		return $this->db->update('shipping');
	}

}