<?php 
  echo $this->session->flashdata("alert-confirm"); 

  function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
  }

?>

<!-- Header Content -->
<section class="content-header">
  <h1>
    Stock
    <small>Milki 1.0</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="#">
        <i class="fa fa-dashboard"></i> Report</a>
    </li>
    <li class="active">Data Report</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data Report</h3>
        </div>
        <div class="box-header">
          <a class="btn btn-primary btn-icon" title="Tambah Data." data-container="body" data-placement="bottom" data-toggle="tooltip"
              type="button" href="<?php echo base_url(); ?>admin/stock/addstock">
            <span class="fa fa-plus"></span> Tambah Barang
          </a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>
                  <center>Customer Name</center>
                </th>
                <th>
                  <center>Trx Date</center>
                </th>
                <th>
                  <center>Total Order</center>
                </th>
                <th>
                  <center>Total Harga</center>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($getData as $value) { ?>
              <tr>
                <td>
                  <center>
                    <?php echo $value->custname; ?>
                  </center>
                </td>
                <td>
                  <center>
                    <?php echo $value->periode; ?>
                  </center>
                </td>
                <td>
                  <center>
                    <?php echo $value->trx; ?>
                  </center>
                </td>
                <td>
                  <center>
                    <?php echo rupiah($value->harga); ?>
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
  $("#alert-confirm").fadeTo(2000, 500).slideUp(500, function () {
    $("#alert-confirm").slideUp(500);
  });
</script>