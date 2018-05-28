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

}