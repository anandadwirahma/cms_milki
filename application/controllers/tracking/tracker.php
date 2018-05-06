<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tracker extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // if($this->session->userdata('data') == null){
        // 	redirect('login');
        // }
        $this->load->model('m_tracker');
    }

    public function index()
    {

    }

	public function status()
    {
        $id_order = $this->uri->segment(3);

        $getOrder = $this->m_tracker->getOrder($id_order);
        foreach ($getOrder as $value) {
            $status = $value->status_payment;
        }

        $defaultcolor = "#F5998E";
        $succescolor = "#98D091";

        $data = array('getdata' => $getOrder);
        $this->load->view('tracker/tracker', $data);
    }

}