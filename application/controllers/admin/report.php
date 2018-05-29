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

    function printpdf(){
        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');

        $data = [];
        if ($startdate == '' and $enddate == '') {
            
            $startdate = date('Y-m-d');
            $enddate = date('Y-m-d');

            $data['period'] = $startdate . " - " . $enddate;
            $data['report'] = $this->m_report->getReport($startdate,$enddate);
            $data['summary'] = $this->m_report->getSum($startdate,$enddate);
        } else {
            $data['period'] = $startdate . " - " . $enddate;
            $data['report'] = $this->m_report->getReport($startdate,$enddate);
            $data['summary'] = $this->m_report->getSum($startdate,$enddate);
        }
                
        // //load mpdf libray
        $this->load->library('M_pdf');
        $mpdf = $this->m_pdf->load([
            'mode' => 'utf-8',
            'format' => 'A4'
        ]);

        $pdfFilePath = "milkireport-".date('Ymd')."pdf";
        $view = $this->load->view('admin/report/v_report', $data, true);

        $mpdf->WriteHTML($view);
        $mpdf->Output($pdfFilePath, "D");
    }
}