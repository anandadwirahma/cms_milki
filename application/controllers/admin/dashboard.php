<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('data') == null){
        	redirect('login');
        }

    }

	public function index()
	{
        $data = array('content' => 'admin/dashboard/home', 'sessiondata' => $this->session->userdata('data'));
        $this->load->view('admin/index', $data);
	}
}