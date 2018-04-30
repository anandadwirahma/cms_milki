<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('data') == null){
        	redirect('login');
        }
        $this->load->model('admin/m_order');
    }

	public function index()
	{
        $getData = $this->m_order->getData();
        $data = array('content' => 'admin/order/order', 'sessiondata' => $this->session->userdata('data'), 'getdata' => $getData);
        $this->load->view('admin/index', $data);
	}

}