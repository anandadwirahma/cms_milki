<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('data') == null){
        	redirect('login');
        }
        $this->load->model('admin/m_dashboard');
        $this->load->helper('string'); 

    }

	public function index()
	{
        $getDashboard = $this->m_dashboard->getDashboard();

        $data = array('content' => 'admin/dashboard/home', 'sessiondata' => $this->session->userdata('data'), 'getDashboard' => $getDashboard);
        $this->load->view('admin/index', $data);
	}

    public function revenue_chart()
    {
        $json = array();
        $revData = $this->m_dashboard->getRevenue();

        foreach ($revData as $value) {
            $json[] = array('y' => $value->periode, 'revenue' => $value->harga);
        }
        
        echo json_encode($json);
    }

    public function transaction_chart()
    {
        $json = array();
        $revData = $this->m_dashboard->getTrx();

        foreach ($revData as $value) {
            $json[] = array('y' => $value->periode, 'success' => $value->total_succes, 'failed' => $value->total_failed);
        }
        
        echo json_encode($json);
    }

    public function favorite_chart()
    {
        $favData = $this->m_dashboard->getFavorite();

        //convert data to json
         $responce->cols[] = array( 
            "id" => "", 
            "label" => "Rasa", 
            "pattern" => "", 
            "type" => "string" 
        );
        $responce->cols[] = array( 
            "id" => "", 
            "label" => "Total", 
            "pattern" => "", 
            "type" => "number" 
        );

        foreach($favData as $value) 
        { 
            $responce->rows[]["c"] = array( 
                array( 
                    "v" => $value->rasa, 
                    "f" => null 
                ) , 
                array( 
                    "v" => (int)$value->total, 
                    "f" => null 
                ) 
            ); 
        }
        
        echo json_encode($responce);
    }

}