<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-Pw65IpYG-neuNnO4FKzerfqD', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	

		$this->load->model('m_payment');
    }

    public function index()
    {
    	$this->load->view('payment/checkout_snap');
    }

    public function token()
    {
			
		$order_id = $this->input->post('orderid');
		
		$getOrder = $this->m_payment->getOrder($order_id);
		foreach ($getOrder as $value) {
			$nama = $value->nama;
			$tgl = $value->tgl;
			$lokasi = $value->lokasi;
			$harga = (int)$value->harga;
			$email = $value->email;
			$phone = $value->phone;
		}

		// Required
		$transaction_details = array(
		  'order_id' => $order_id,
		  'gross_amount' => $harga, // no decimal allowed for creditcard
		);


		$getItems = $this->m_payment->getItems($order_id);

		foreach ($getItems as $value) {
            $item_details[] = array(
              'id' => $value->id_order,
              'price' => $value->harga,
              'quantity' => $value->qty,
              'name' => $value->rasa
            );

        }

		
		// Optional
		$billing_address = array(
		  'first_name'    => $nama,
		  //'last_name'     => "Litani",
		  'address'       => $lokasi,
		  //'city'          => "Jakarta",
		  //'postal_code'   => "16602",
		  'phone'         => $phone,
		  'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array(
		  'first_name'    => "Tejo",
		  //'last_name'     => "Supriadi",
		  'address'       => $lokasi,
		  // 'city'          => "Jakarta",
		  // 'postal_code'   => "16601",
		  'phone'         => "085123456789",
		  'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
		  'first_name'    => $nama,
		  // 'last_name'     => "Rahma",
		  'email'         => $email,
		  'phone'         => $phone,
		  'billing_address'  => $billing_address,
		  'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 2
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    public function checkout()
    {
    	$result = json_decode($this->input->post('result_data'));
    	// echo 'RESULT <br><pre>';
    	// var_dump($result);
    	// echo '</pre>' ;

    	$order_id = $result->order_id;
    	$status_payment = $this->midtrans->status($result->order_id);
    	$data = array(
	            "id_order" => $order_id,
	            "datetime" => $status_payment->transaction_time,
	            "status" => $status_payment->transaction_status,
	            "description" => $status_payment->payment_type
        	);

    	if ($result->payment_type == 'credit_card') {
        	$status = 3;
    	} elseif ($result->payment_type == 'bank_transfer') {
    		$status = 2;
    	}


    	$this->m_payment->updateTracker($data); //update tracker
    	$this->m_payment->updtStatusorder($order_id, $status); //update status in table order
    	redirect('/tracker/status/' . $order_id, 'refresh');

    }

    public function notification()
    {
    	$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);

		echo $result;
    }
}