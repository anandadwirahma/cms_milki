<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Order extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('data') == null){
        	redirect('login');
        }
        $this->load->model('admin/m_order');

        $params = array('server_key' => 'SB-Mid-server-Pw65IpYG-neuNnO4FKzerfqD', 'production' => false);
        $this->load->library('midtrans');
        $this->midtrans->config($params);
        $this->load->helper('url'); 

        //cront update status expired
        $this->m_order->updtOrderexpr();
    }

	public function index()
	{
        $getData = $this->m_order->getData();
        $data = array('content' => 'admin/order/order', 'sessiondata' => $this->session->userdata('data'), 'getdata' => $getData);

        $this->load->view('admin/index', $data);
	}

    public function detail()
    {
        $output = '';
        $id_order = $this->input->post('orderid');

        $getOrder = $this->m_order->getOrder($id_order);
        $getItems = $this->m_order->getItems($id_order);
        
        $output .= '<dl>';
        foreach ($getOrder as $value) {
            $tgl = $value->tgl;
            $nama = $value->nama;
            $lokasi = $value->lokasi;
            $harga = number_format($value->harga,2,',','.');

            if ($value->status_payment == 1) {

                $status = '<a class="btn btn-warning btn-icon" data-container="body" data-placement="bottom" style="pointer-events: none;cursor:default;" data-toggle="tooltip"> <span>Waiting Payment</span> </a>';
            
            } else if ($value->status_payment == 2) {
                
                $status = '<a class="btn btn-info btn-icon" data-container="body" data-placement="bottom" style="pointer-events: none;cursor:default;" data-toggle="tooltip"> <span>Confirm Payment</span> </a>';

            } else if ($value->status_payment == 3) {
                
                $status = '<a class="btn btn-primary btn-icon" data-container="body" data-placement="bottom" style="pointer-events: none;cursor:default;" data-toggle="tooltip"> <span>Processing Order</span> </a>';
            
            } else if ($value->status_payment == 4) {
                
                $status = '<a class="btn btn-warning btn-icon" data-container="body" data-placement="bottom" style="pointer-events: none;cursor:default;" data-toggle="tooltip"> <span>Order Shipped</span> </a>';
            
            } else if ($value->status_payment == 5) {
                
                $status = '<a class="btn btn-success btn-icon" data-container="body" data-placement="bottom" style="pointer-events: none;cursor:default;" data-toggle="tooltip"> <span>Order Received</span> </a>';
            
            }


        }

        $orderitem = '';
        foreach ($getItems as $value) {
            $orderitem .= '<li>Milki ' . $value->rasa . ' : ' . $value->qty . '</li>';   
        }


            $output .= ' 
                <dt>Tanggal Pemesanan :</dt>
                    <dd>'. $tgl . '</dd>
                <dt>Nama Pemesan :</dt>
                    <dd>'. $nama . '</dd>
                <dt>Location :</dt>
                    <dd>'. $lokasi . '</dd>
                <dt>Detail Order :</dt>
                    <dd>
                        <ul style="list-style-type:disc">' . $orderitem . '</ul>
                    </dd>
                <dt>Total Harga :</dt>
                    <dd>'. "Rp " . $harga . '</dd>
                <dt>Status Pembelian :</dt>
                    <dd>'. $status . '</dd>
            ';

            echo $output;
    }

    function status (){
        $id_order = $this->uri->segment(4);
        $getOrder = $this->m_order->getOrder($id_order);
        $getTracker = $this->m_order->getTracker($id_order);
        $detailShipping = $this->m_order->detailShipping($id_order);
        $detailReceive = $this->m_order->detailReceive($id_order);

        $data = array('content' => 'admin/order/status_order', 'title' => 'Status Order' ,'sessiondata' => $this->session->userdata('data'),'getdata' => $getOrder, 'getTracker' => $getTracker, 'detailShipping' => $detailShipping, 'detailReceive' => $detailReceive);
        $this->load->view('admin/index', $data);
    }

    function currier(){
        $id_order = $this->uri->segment(4);

        $getCurrier = $this->m_order->getCurrier();

        $data = array('content' => 'admin/order/select_currier', 'title' => 'Select Currier' ,'sessiondata' => $this->session->userdata('data'), 'getCurrier' => $getCurrier, 'id_order' => $id_order);
        $this->load->view('admin/index', $data);
    }

    function curriertask(){

        $output = '';
        $currierid = $this->input->post('currierid');

        $getCurriertask = $this->m_order->getCurriertask($currierid);
        
        $output .= '<dl>';
        // $orderitem = '';
        foreach ($getCurriertask as $value) {
        
            $output .= ' 
                   <dt>Nama Pemesan :</dt>
                    <dd>'. $value->nama .'</dd>
                   <dt>Location :</dt>
                    <dd>'. $value->lokasi .'</dd>
                    <hr>
            ';
        }

        echo $output;

    }

    function process_currier(){
        $orderid = $this->input->post('orderid');
        $currierid = $this->input->post('currierid');
        $shippingid = rand(pow(10, 5-1), pow(10, 5)-1);

        $data = array(
            "id_shipping" => $shippingid,
            "id_currier" => $currierid,
            "id_order" => $orderid,
            "status" => 'on progress',
            "datetime" => date('Y-m-d H:i:s')
        );
        $this->m_order->saveShipping($data);

        $data = array(
                "id_order" => $orderid,
                "datetime" => date('Y-m-d H:i:s'),
                "status" => 'on delivery',
                "description" => $currierid
            );
        $this->m_order->updateTracker($data);
        $this->m_order->updtStatusorder($orderid,4);

        redirect('admin/order/status/'. $orderid);
    }

}