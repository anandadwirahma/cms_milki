<?php 
  echo $this->session->flashdata("alert-confirm"); 

  function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
  }

?>

<html>
<head>
<title>A simple, clean, and responsive HTML invoice template</title>
<style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
</style>
</head>
<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
    <tr class="top">
        <td colspan="7">
            <table>
            <tr>
                <td class="title">
                    <img src="<?php echo base_url() ?>assets/img/milkilogo.png" style="width:100%; max-width:250px;">
                </td>
                <td rowspan=2>
                     Created: <?php echo date("F j, Y"); ?>
                </td>
            </tr>
            <tr>
                <td>
                     MILKI Store<br>
                     Jalan Elit Raya, Komplek Timah Rt/Rw 002/012,<br>
                     Tugu, Cimanggis, Tugu, Cimanggis,<br>
                     Kota Depok, Jawa Barat 16451
                </td>
            </tr>
            </table>
        </td>
    </tr>
    <tr class="information">
        <td colspan="7">
            <table>
            <tr>
                <td>
                    <center>
                    <h1>Sales Report</h1>
                    </center>
                </td>
            </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="7">
             Period : <?php echo $period; ?>
        </td>
    </tr>
    <tr class="heading">
        <td>
            <center>Order ID</center>
        </td>
        <td>
            <center>Order Date</center>
        </td>
        <td>
            <center>Customer Name</center>
        </td>
        <td>
            <center>Total Order</center>
        </td>
        <td colspan="3">
            <center>Total Harga</center>
        </td>
    </tr>
    <?php foreach ($report as $value) : ?>
    <tr class="item">
        <td>
            <center><?php echo $value->id_order; ?></center>
        </td>
        <td>
            <center><?php echo date("Y-m-d", strtotime($value->periode)); ?></center>
        </td>
        <td>
            <center><?php echo $value->custname; ?></center>
        </td>
        <td>
            <center><?php echo $value->trx; ?></center>
        </td>
        <td colspan="3">
            <center><?php echo rupiah($value->harga); ?></center>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td>
        </td>
    </tr>
    <tr>
        <td>
        </td>
    </tr>
    <tr>
        <td>
        </td>
    </tr>
    <tr>
        <td colspan="4">
        </td>
        <td colspan="4">
            <h3 align="left">Summary</h3>
        </td>
    </tr>
    <?php foreach ($summary as $value) : ?>
    <tr class="item">
        <td colspan="4">
            <center></center>
        </td>
        <td>
            <center>Total Transaction</center>
        </td>
        <td colspan="2">
            <?php if($value->trx != ''){ echo $value->trx; } else { echo "0";} ?>
        </td>
    </tr>
    <tr class="item">
        <td colspan="4">
            <center></center>
        </td>
        <td>
            <center>Transaction Success</center>
        </td>
        <td colspan="2">
            <?php if($value->success != ''){ echo $value->success; } else { echo "0";}  ?>
        </td>
    </tr>
    <tr class="item">
        <td colspan="4">
            <center></center>
        </td>
        <td>
            <center>Transaction Failed</center>
        </td>
        <td colspan="2">
            <?php if($value->failed != ''){ echo $value->failed; } else { echo "0";} ?>
        </td>
    </tr>
    <tr class="item">
        <td colspan="4">
            <center></center>
        </td>
        <td>
            <center>Revenue</center>
        </td>
        <td colspan="2">
            <?php if($value->revenue != ''){ echo rupiah($value->revenue); } else { echo "0";} ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </table>
</div>
</body>
</html>