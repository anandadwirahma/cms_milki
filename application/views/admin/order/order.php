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
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
    $("#alert-confirm").fadeTo(2000, 500).slideUp(500, function(){
        $("#alert-confirm").slideUp(500);
    });
</script>