<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('data') == null){
        	redirect('login');
        }
        $this->load->model('admin/m_report');
    }

    function index()
    {
    	$getData = $this->m_report->getData();

    	$data = array('content' => 'admin/report/report', 'sessiondata' => $this->session->userdata('data'), 'getData' => $getData);
    	$this->load->view('admin/index', $data);
    }

}

