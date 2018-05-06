<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Order extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('data') == null){
        	redirect('login');
        }
        $this->load->model('admin/m_order');
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

}