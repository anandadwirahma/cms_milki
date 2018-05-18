<!-- Header Content -->
<section class="content-header">
  <h1>
    Stock
    <small>Milki 1.0</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="#">
        <i class="fa fa-dashboard"></i> Stock</a>
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
      $id_brg = '';
      $rasa = '';
      $description = '';
      $url_img = '';
      $stock = '';
      $harga = '';
      $url = 'saveData';
      
      if(isset($data_brg)){
      
        $id_brg = $data_brg[0]->id_brg;
        $rasa= $data_brg[0]->rasa;
        $description = $data_brg[0]->description;
        $url_img = $data_brg[0]->url_img;
        $stock = $data_brg[0]->stock;
        $harga = $data_brg[0]->harga;
        $url = 'updateData';
      
      }
      ?>

        <form role="form" class="form-horizontal" action="<?php echo base_url() ?>admin/stock/<?=$url;?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Rasa</label>
              <input type="hidden" value="<?php echo $id_brg; ?>" name="id_brg">
              <div class="col-sm-6">
                <input type="text" name="rasa" data-validation="required" class="form-control" value="<?php echo $rasa; ?>" placeholder="Rasa">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Description</label>

              <div class="col-sm-6">
                <input type="text" name="description" data-validation="required" class="form-control" value="<?php echo $description; ?>"
                    placeholder="Description">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">URL Image</label>

              <div class="col-sm-6">
                <input type="text" name="url_img" id="url_img" data-validation="required" class="form-control" value="<?php echo $url_img; ?>"
                    placeholder="https://milki/milki-coklat.png">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Stock</label>

              <div class="col-sm-2">
                <input type="number" name="stock" data-validation="required" class="form-control" value="<?php echo $stock; ?>" placeholder="0">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Harga</label>

              <div class="col-sm-2">
                <input type="number" name="harga" data-validation="required" class="form-control" value="<?php echo $harga; ?>" placeholder="0">
              </div>
            </div>
          </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-primary" id="submit-form">Submit</button>
            <a href="<?php echo base_url()?>admin/stock" class="btn btn-default">Kembali</a>
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
      if ($('#url_img').val() != '') {
        if ($('#url_img').val().substring(0, 5) == 'https' && ($('#url_img').val().slice(-4) == '.jpg' || $('#url_img')
            .val().slice(-4) == '.png')) {
          return true;
        } else {
          bootbox.alert("URL must be HTTPS and image format must be JPG or PNG");
          return false;
        }
      }
    });
  });
</script>