<?php

  function location_more($location){
    $result = substr($location, 0, 45).' more...';
    return $result;
  }

?>

  <!-- Header Content -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
      <li>
        <a href="#">
          <i class="fa fa-dashboard"></i> Home</a>
      </li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Task List</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="box-body">
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
                            <center>Action</center>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($getTask as $value) { ?>
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
                              <?php echo location_more($value->loc); ?>
                            </center>
                          </td>
                          <td>
                            <center>
                              <a class="btn btn-primary btn-icon" id="btnDetail" title="Show Detail." type="button" id-order="<?php echo $value->id_order; ?>">
                                <span class="fa fa-search"></span>
                              </a>
                              <a class="btn btn-primary btn-icon" id="btnConfirm" title="Confirm Delivered." type="button" id-order="<?php echo $value->id_order; ?>">
                                <span class="fa fa-check"></span>
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


    <!-- Modal Confirm Delivered -->
  <div class="modal fade" id="detailconfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">New message</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" action="<?php echo base_url() ?>currier/dashboard/received" method="post">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Recipient:</label>
              <input type="text" class="form-control" data-validation="required" placeholder="Recipient Name" name="recipient">
              <input type="hidden" class="form-control" name="orderid" id="poporderid" value="">
            </div>

            <div class="modal-footer">
              <input type="submit" class="btn btn-primary">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>

  <!-- JS Form Validation -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
  <script>
    $.validate();
  </script>

  <script>
    $(document).on("click", "#btnConfirm", function () {

      var orderid = $(this).attr('id-order');
      
      $('.modal-title').text('Order ID : #' + orderid)
      document.getElementById("poporderid").value = orderid
      $('#detailconfirmModal').modal('show');
      
    });
  </script>