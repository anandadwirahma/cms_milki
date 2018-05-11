<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracker extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-Pw65IpYG-neuNnO4FKzerfqD', 'production' => false);
        $this->load->library('midtrans');
        $this->midtrans->config($params);
        $this->load->helper('url'); 


        $this->load->model('m_tracker');
    }

	public function status()
    {
        $id_order = $this->uri->segment(3);

        $getOrder = $this->m_tracker->getOrder($id_order);
        foreach ($getOrder as $value) {
            $status = $value->status_payment;
        }

        if ($status > 1) {
            //-Trigger check status transaction
            $status_payment = $this->midtrans->status($id_order);
            $transaction_time = $status_payment->transaction_time;
            $transaction_status = $status_payment->transaction_status;
            $payment_type = $status_payment->payment_type;

            //-Update payment if expired status
            $this->m_tracker->updatePayment($id_order,$transaction_time,$transaction_status,$payment_type);
            if ($transaction_status == 'expire') {
                $this->m_tracker->updateOrder($id_order);
            }
        }


        if ($status == 1) {
            $footerTracker = "<div>
                    <center>Lakukan pembayaran sebelum :
                        <b>
                            <font color='red'>2018-04-25 14:12:33</font>
                        </b>
                    </center>
                </div>
                <br>
                <div>
                    <center>
                        <a class='btn btn-primary btn-icon' id='pay-button' id-order=" . $value->id_order .">
                            <span>Bayar</span>
                        </a>
                    </center>
                </div>";
        } elseif ($status == 2) {
            $footerTracker = "<div>
                    <center>
                        <b>
                            <font color='red'>Your payment is processing..</font>
                        </b>
                    </center>
                </div>
                <br>";
        } elseif ($status == 3) {
            $footerTracker = "<div>
                    <center>
                        <b>
                            <font color='red'>Your order is processing..</font>
                        </b>
                    </center>
                </div>
                <br>";
        } elseif ($status == 'expire') {
            $footerTracker = "<div>
                    <center>
                        <b>
                            <h2><font color='red'>Sorry Your Payment Is Expired !</font></h2>
                        </b>
                    </center>
                </div>
                <br>";
        }

        $data = array('getdata' => $getOrder, 'footerTracker' => $footerTracker);
        $this->load->view('tracker/tracker', $data);

    }

}