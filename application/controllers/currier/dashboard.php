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
        $id_currier = $this->session->userdata('data')['id'];

        $getTask = $this->m_dashboard->getTask($id_currier);
        $data = array('content' => 'currier/dashboard/home', 'sessiondata' => $this->session->userdata('data'), 'getTask' => $getTask);
        $this->load->view('currier/index', $data);
	}
}