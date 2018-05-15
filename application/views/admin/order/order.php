<?php 
  echo $this->session->flashdata("alert-confirm"); 

  function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
  }

  function location_more($location){
    $result = substr($location, 0, 45).' more...';
    return $result;
  }
?>


<!-- Header Content -->
<section class="content-header">
  <h1>
    Order
    <small>Milki 1.0</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="#">
        <i class="fa fa-dashboard"></i> Order</a>
    </li>
    <li class="active">Data Order</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data Order</h3>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>
                  <center>Tanggal</center>
                </th>
                <th>
                  <center>Nama</center>
                </th>
                <th>
                  <center>Lokasi</center>
                </th>
                <th>
                  <center>Harga</center>
                </th>
                <th>
                  <center>Status</center>
                </th>
                <th>
                  <center>Action</center>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($getdata as $value) { ?>
              <tr>
                <td>
                  <center>
                    <?php echo $value->tgl; ?>
                  </center>
                </td>
                <td>
                  <center>
                    <?php echo $value->nama; ?>
                  </center>
                </td>
                <td>
                  <center>
                    <?php echo location_more($value->lokasi); ?>
                  </center>
                </td>
                <td>
                  <center>
                    <?php echo rupiah($value->harga); ?>
                  </center>
                </td>
                <td>
                  <center>
                    <?php 
                      if ($value->status_payment == 1) {
                          $status = '<a href="'. base_url() .'admin/order/status/'. $value->id_order .'" class="btn btn-warning btn-icon" data-container="body" data-placement="bottom" data-toggle="tooltip"> <span>Waiting Payment</span> </a>';
                      } elseif ($value->status_payment == 2) {
                        $status = '<a href="'. base_url() .'admin/order/status/'. $value->id_order .'" class="btn btn-info btn-icon" data-container="body" data-placement="bottom" data-toggle="tooltip"> <span>Confirm Payment</span> </a>';
                      } elseif ($value->status_payment == 3) {
                        $status = '<a href="'. base_url() .'admin/order/status/'. $value->id_order .'" class="btn btn-primary btn-icon" data-container="body" data-placement="bottom" data-toggle="tooltip"> <span>Processing Order</span> </a>';
                      } elseif ($value->status_payment == 4) {
                        $status = '<a href="'. base_url() .'admin/order/status/'. $value->id_order .'" class="btn btn-warning btn-icon" data-container="body" data-placement="bottom" data-toggle="tooltip"> <span>Order Shipped</span> </a>';
                      } elseif ($value->status_payment == 5) {
                        $status = '<a href="'. base_url() .'admin/order/status/'. $value->id_order .'" class="btn btn-success btn-icon" data-container="body" data-placement="bottom" data-toggle="tooltip"> <span>Order Received</span> </a>';
                      } elseif ($value->status_payment == 'expire') {
                        $status = '<a href="'. base_url() .'admin/order/status/'. $value->id_order .'" class="btn btn-danger btn-icon" data-container="body" data-placement="bottom" data-toggle="tooltip"> <span>Expired Payment</span> </a>';
                      }

                      echo $status;
                    ?>
                  </center>
                </td>
                <td>
                  <center>
                    <a class="btn btn-primary btn-icon" id="btnDetail" title="Show Detail." type="button" id-order="<?php echo $value->id_order; ?>">
                      <span class="fa fa-search"></span>
                    </a>
                  </center>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal Detail Order -->
<div class="modal fade" id="detailorderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">New message</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="detailOrder_result"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $("#alert-confirm").fadeTo(2000, 500).slideUp(500, function () {
    $("#alert-confirm").slideUp(500);
  });
</script>

<script>
  $(document).on("click", "#btnDetail", function () {

    var orderid = $(this).attr('id-order');

    $.ajax({
      url: "<?php echo site_url('admin/order/detail');?>",
      type: "POST",
      data: {
        orderid: orderid
      },
      success: function (data) {
        $('#detailOrder_result').html(data);
        $('.modal-title').text('Order ID : #' + orderid)
        $('#detailorderModal').modal('show');
      },
      error: function (data) {
        alert('Error');
      }
    });
    return false;
  });
</script>