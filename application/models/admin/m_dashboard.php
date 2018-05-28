<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_dashboard extends CI_Model {

	public function getRevenue()
	{
		$query = $this->db->query("SELECT  DATE_FORMAT(tgl, '%Y%m')  AS periode, sum(harga) as harga FROM `order` group by periode");

		return $query->result();
	}

	public function getTrx()
	{
		$query = $this->db->query("SELECT  DATE_FORMAT(tgl, '%Y%m')  AS periode, count(CASE WHEN status_payment = 5 THEN status_payment END) AS total_succes, count(CASE WHEN status_payment = 'expired' THEN status_payment END) AS total_failed FROM `order` WHERE status_payment in (5,'expired') group by periode");

		return $query->result();
	}

	public function getDashboard()
	{
		$query = $this->db->query("select COUNT(*) as trx ,SUM(CASE WHEN status_payment = 5 THEN harga END) AS revenue from `order`");

		return $query->result();
	}

	public function getFavorite()
	{
		$this->db->select('c.rasa as rasa,COUNT(a.id_brg) as total')
     		->from('detail_order a')
     		->join('`order` b', 'a.id_order = b.id_order')
     		->join('barang c', 'a.id_brg = c.id_brg') 
     		->where('b.status_payment', '5')
     		->group_by('rasa')
     		->order_by('total')
     		->limit(5);
		return $this->db->get()->result();
	}
}