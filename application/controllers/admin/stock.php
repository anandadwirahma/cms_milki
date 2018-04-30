<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('data') == null){
        	redirect('login');
        }
        $this->load->model('admin/m_stock');
    }

	public function index()
	{
        $getData = $this->m_stock->getData();
        $data = array('content' => 'admin/stock/stock', 'sessiondata' => $this->session->userdata('data'), 'getdata' => $getData);
        $this->load->view('admin/index', $data);
	}

    public function addstock()
    {
        $data = array('content' => 'admin/stock/inputdata', 'title' => 'Tambah Barang' ,'sessiondata' => $this->session->userdata('data'), 'data_brg' => null);
        $this->load->view('admin/index', $data);
    }

    public function saveData()
    {
        $data = array(
            "rasa" => $this->input->post('rasa'),
            "stock" => $this->input->post('stock'),
            "harga" => $this->input->post('harga'),
            "description" => $this->input->post('description'),
            "url_img" => $this->input->post('url_img')
        );

        $this->m_stock->saveData($data);

        $this->session->set_flashdata("alert-confirm", "<section class=\"content-header\" id=\"alert-confirm\"> <div class=\"alert alert-success\"><strong>Success!</strong> Data successfully inserted.</div></section>");
        redirect('admin/stock');
    }

    public function edit()
    {
        $id_brg = $this->uri->segment(4);
        $getData = $this->m_stock->getDataid($id_brg);
        $data = array('content' => 'admin/stock/inputdata', 'title' => 'Edit Barang' ,'sessiondata' => $this->session->userdata('data'), 'data_brg' => $getData);
        $this->load->view('admin/index', $data);
    }

    public function updateData()
    {
        $id_brg = $this->input->post('id_brg');
        $data = array(
            "rasa" => $this->input->post('rasa'),
            "stock" => $this->input->post('stock'),
            "harga" => $this->input->post('harga'),
            "description" => $this->input->post('description'),
            "url_img" => $this->input->post('url_img')
        );

        $this->m_stock->updateData($id_brg,$data);

        $this->session->set_flashdata("alert-confirm", "<section class=\"content-header\" id=\"alert-confirm\"> <div class=\"alert alert-success\"><strong>Success!</strong> Data successfully updated.</div></section>");
        redirect('admin/stock');
    }

    public function delete()
    {
        $id_brg = $this->uri->segment(4);

        $this->m_stock->deleteData($id_brg);

        $this->session->set_flashdata("alert-confirm", "<section class=\"content-header\" id=\"alert-confirm\"> <div class=\"alert alert-success\"><strong>Success!</strong> Data successfully deleted.</div></section>");
        redirect('admin/stock');
    }
}