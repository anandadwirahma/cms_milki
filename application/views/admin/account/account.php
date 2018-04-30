<?php echo $this->session->flashdata("alert-confirm"); ?>

<!-- Header Content -->
<section class="content-header">
  <h1>
    Admin
    <small>Milki 1.0</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="#">
        <i class="fa fa-dashboard"></i> Admin</a>
    </li>
    <li class="active">Show Data</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data Admin</h3>
        </div>
        <div class="box-header">
          <a class="btn btn-primary btn-icon" title="Tambah Data." data-container="body" data-placement="bottom" data-toggle="tooltip"
              type="button" href="<?php echo base_url(); ?>admin/account/add">
            <span class="fa fa-plus"></span> Tambah Account
          </a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>
                  <center>id</center>
                </th>
                <th>
                  <center>Username</center>
                </th>
                <th>
                  <center>Name</center>
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
                    <?php echo $value->id; ?>
                  </center>
                </td>
                <td>
                  <center>
                    <?php echo $value->user; ?>
                  </center>
                </td>
                <td>
                  <center>
                    <?php echo $value->name; ?>
                  </center>
                </td>
                <td>
                  <center>
                    <a class="btn btn-primary btn-icon" title="Edit Data." data-container="body" data-placement="bottom" data-toggle="tooltip"
                        type="button" href="<?php echo base_url() ?>admin/account/edit/<?=$value->id;?>">
                      <span class="fa fa-pencil-square-o"></span>
                    </a>
                    <a class="btn btn-danger btn-icon" title="Delete Data." data-container="body" data-placement="bottom" data-toggle="tooltip" type="button" onclick="return confirm('Are you sure delete this data ?')" href="<?php echo base_url() ?>admin/account/delete/<?=$value->id;?>">
                      <span class="fa fa-trash-o"></span>
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

<script>
    $("#alert-confirm").fadeTo(2000, 500).slideUp(500, function(){
        $("#alert-confirm").slideUp(500);
    });
</script>