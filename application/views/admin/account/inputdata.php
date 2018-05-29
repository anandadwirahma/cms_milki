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
    <li class="active">
      <?php echo $title; ?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">
            <?php echo $title; ?>
          </h3>
        </div>

        <?php 
      $id = '';
      $user = '';
      $password = '';
      $name = '';
      $url = 'saveData';
      
      if(isset($data_account)){
      
        $id = $data_account[0]->id;
        $user= $data_account[0]->user;
        $password = $data_account[0]->password;
        $name = $data_account[0]->name;
        $url = 'updateData';
      
      }
      ?>

        <form role="form" class="form-horizontal" action="<?php echo base_url() ?>admin/account/<?=$url;?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Username</label>
              <input type="hidden" value="<?php echo $id; ?>" name="id">
              <div class="col-sm-6">
                <input type="text" name="username" data-validation="required" class="form-control" value="<?php echo $user; ?>" placeholder="Username">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Name</label>

              <div class="col-sm-6">
                <input type="text" name="name" data-validation="required" class="form-control" value="<?php echo $name; ?>" placeholder="Name">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Rule</label>

              <div class="col-sm-2">
                <select name="rule" data-validation="required" class="form-control">
                  <option value="">-Select Rule-</option>
                  <option value="1">Admin</option>
                  <option value="2">Currier</option>
                  <!-- <option value="3">Karyawan</option> -->
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

              <div class="col-sm-6">
                <input type="password" name="password" id="password" data-validation="required" class="form-control" placeholder="Your Password">
              </div>
            </div>
          </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-primary" id="submit-form">Submit</button>
            <a href="<?php echo base_url()?>admin/account" class="btn btn-default">Kembali</a>
          </div>
        </form>
      </div>

    </div>
  </div>
</section>

<!-- JS Form Validation -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
  $.validate();
</script>
<!-- JS Check URL Image -->
<script>
  $(document).ready(function () {
    $('#submit-form').click(function () {

    });
  });
</script>