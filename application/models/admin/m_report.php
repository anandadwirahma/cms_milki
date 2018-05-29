<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_report extends CI_Model {

	public function getData()
	{
		$this->db->select('a.nama as custname,a.tgl as periode,COUNT(b.id_brg) as trx,a.harga as harga')
     		->from('order a')
     		->join('detail_order b', 'a.id_order = b.id_order')
     		->group_by('custname,periode,harga');
		return $this->db->get()->result();
	}

	// public function getReportall()
	// {
	// 	$this->db->select('a.id_order as id_order, a.tgl as periode, a.nama as custname, COUNT(b.id_brg) as trx, a.harga as harga')
 //     		->from('order a')
 //     		->join('detail_order b', 'a.id_order = b.id_order')
 //     		->group_by('id_order,periode,custname,harga')
 //     		->order_by('periode');
	// 	return $this->db->get()->result();
	// }

	public function getReport($startdate,$enddate)
	{
		$this->db->select('a.id_order as id_order, a.tgl as periode, a.nama as custname, COUNT(b.id_brg) as trx, a.harga as harga')
     		->from('order a')
     		->where('DATE_FORMAT(a.tgl, "%Y-%m-%d") >=', $startdate)
     		->where('DATE_FORMAT(a.tgl, "%Y-%m-%d") <=', $enddate)
     		->join('detail_order b', 'a.id_order = b.id_order')
     		->group_by('id_order,periode,custname,harga')
     		->order_by('periode');
		return $this->db->get()->result();
	}

	// public function getSumall()
	// {
	// 	$this->db->select('COUNT(id_order) as trx,count(CASE WHEN status_payment = 5 then id_order END) as success,count(CASE WHEN status_payment = "expired" then id_order END) as failed,sum(CASE WHEN status_payment = 5 THEN harga END) as revenue')
 //     		->from('order');
	// 	return $this->db->get()->result();
	// }

	public function getSum($startdate,$enddate)
	{
		$this->db->select('COUNT(id_order) as trx,count(CASE WHEN status_payment = 5 then id_order END) as success,count(CASE WHEN status_payment = "expired" then id_order END) as failed,sum(CASE WHEN status_payment = 5 THEN harga END) as revenue')
			->where('DATE_FORMAT(tgl, "%Y-%m-%d") >=', $startdate)
     		->where('DATE_FORMAT(tgl, "%Y-%m-%d") <=', $enddate)
     		->from('order');
		return $this->db->get()->result();
	}
}