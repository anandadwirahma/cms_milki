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
                    <?php echo $value->status_payment; ?>
                  </center>
                </td>
                <td>
                  <center>
                    <a class="btn btn-primary btn-icon" title="Show Detail." data-container="body" data-placement="bottom" data-toggle="modal" data-target="#ModalDetailOrder" data-orderid="@getbootstrap" type="button">
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
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
  $('#ModalDetailOrder').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var orderid = button.data('orderid')
    var modal = $(this)
    modal.find('.modal-title').text('Detail Order (' + orderid + ')')
    modal.find('.modal-body input').val(recipient)
  })
</script>