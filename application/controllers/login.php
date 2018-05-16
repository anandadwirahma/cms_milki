<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('m_login');
    }

	function index(){

		$data = array('content' => 'setup/login');
		$this->load->view('setup/index', $data);
	
	}
	
	function ceklogin(){

		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$query = $this->m_login->cekLogin($username,$password);echo $query;
		// if($query->num_rows() > 0){
		// 	foreach ($query->result() as $value) {
		// 		$sessionArray['data'] = array(
		// 			'id'=>$value->id,                    
  //                   'username'=>$value->user,
  //                   'password'=>$value->password,
  //                   'name'=>$value->name,
  //                   'rule'=>$value->rule
  //               );
  //               $this->session->set_userdata($sessionArray);
		// 	}
		// 	echo $this->session->userdata('data')['rule'];
		// }else{
		// 	echo "FALSE";
		// }

	}
}