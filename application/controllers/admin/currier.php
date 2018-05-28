<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Currier extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('data') == null){
        	redirect('login');
        }

        $this->load->model('admin/m_currier'); 

        $getCurrier = $this->m_currier->getCurrier();
        foreach ($getCurrier as $value) {
            $id = $value->id;
            if ($value->qty == 0) {
                $this->m_currier->updateIdle($id);
            }
        }
    }

	public function index()
	{
        $getCurrier = $this->m_currier->getCurrier();

        $data = array('content' => 'admin/currier/mng_currier', 'title' => 'Management Currier' ,'sessiondata' => $this->session->userdata('data'), 'getCurrier' => $getCurrier);
        $this->load->view('admin/index', $data);
	}

    function curriertask(){

        $output = '';
        $currierid = $this->input->post('currierid');

        $getCurriertask = $this->m_currier->getCurriertask($currierid);
        
        $output .= '<dl>';
        // $orderitem = '';
        
        if (empty($getCurriertask)) {
            $output .= ' 
                   <dt>- Task is nothing -</dt>
            ';
        } else {
            foreach ($getCurriertask as $value) {
        
                $output .= ' 
                       <dt>Nama Pemesan :</dt>
                        <dd>'. $value->nama .'</dd>
                       <dt>Location :</dt>
                        <dd>'. $value->lokasi .'</dd>
                        <hr>
                ';
            }
        }
        
        echo $output;

    }

    function assign_currier(){
        $currierid = $this->input->post('currierid');

        $this->m_currier->updtStatuscurrier($currierid);
        redirect('admin/currier');
    }

}