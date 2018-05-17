<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('data') == null){
        	redirect('login');
        }

        $this->load->model('currier/m_dashboard'); 
    }

	public function index()
	{
        $getCurrier = $this->m_dashboard->getCurrier();

        $data = array('content' => 'currier/dashboard/home', 'sessiondata' => $this->session->userdata('data'));
        $this->load->view('currier/index', $data);
	}
}