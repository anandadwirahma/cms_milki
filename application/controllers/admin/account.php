<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('data') == null){
        	redirect('login');
        }
        $this->load->model('admin/m_account');
    }

	public function index()
	{
        $getData = $this->m_account->getData();
        $data = array('content' => 'admin/account/account', 'sessiondata' => $this->session->userdata('data'), 'getdata' => $getData);
        $this->load->view('admin/index', $data);
	}

    public function add()
    {
        $data = array('content' => 'admin/account/inputdata', 'title' => 'Tambah Account' ,'sessiondata' => $this->session->userdata('data'), 'data_account' => null);
        $this->load->view('admin/index', $data);
    }

    public function saveData()
    {
        $data = array(
            "user" => $this->input->post('username'),
            "password" => md5($this->input->post('password')),
            "name" => $this->input->post('name')
        );
        
        $this->m_account->saveData($data);

        $this->session->set_flashdata("alert-confirm", "<section class=\"content-header\" id=\"alert-confirm\"> <div class=\"alert alert-success\"><strong>Success!</strong> Data successfully inserted.</div></section>");
        redirect('admin/account');
    }

    public function edit()
    {
        $id = $this->uri->segment(4);
        $getData = $this->m_account->getDataid($id);
        $data = array('content' => 'admin/account/inputdata', 'title' => 'Edit Account' ,'sessiondata' => $this->session->userdata('data'), 'data_account' => $getData);
        $this->load->view('admin/index', $data);
    }

    public function updateData()
    {
        $id = $this->input->post('id');
        $data = array(
            "user" => $this->input->post('username'),
            "password" => md5($this->input->post('password')),
            "name" => $this->input->post('name')
        );

        $this->m_account->updateData($id,$data);

        $this->session->set_flashdata("alert-confirm", "<section class=\"content-header\" id=\"alert-confirm\"> <div class=\"alert alert-success\"><strong>Success!</strong> Data successfully updated.</div></section>");
        redirect('admin/account');
    }

    public function delete()
    {
        $id = $this->uri->segment(4);

        $this->m_account->deleteData($id);

        $this->session->set_flashdata("alert-confirm", "<section class=\"content-header\" id=\"alert-confirm\"> <div class=\"alert alert-success\"><strong>Success!</strong> Data successfully deleted.</div></section>");
        redirect('admin/account');
    }

}