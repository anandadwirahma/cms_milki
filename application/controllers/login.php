<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$data = array('content' => 'setup/login');
		$this->load->view('setup/index', $data);
	}
	
}