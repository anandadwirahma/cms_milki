<!-- Header Content -->
<section class="content-header">
  <h1>
    Currier
    <small>Milki 1.0</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="#">
        <i class="fa fa-dashboard"></i> Currier</a>
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
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>
                  <center>Nama Currier</center>
                </th>
                <th>
                  <center>Phone</center>
                </th>
                <th>
                  <center>Qty Capacity</center>
                </th>
                <th>
                  <center>Status</center>
                </th>
                <th>
                  <center>Select</center>
                </th>
                <th>
                  <center>Action</center>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($getCurrier as $value) { ?>
              <tr>
                <td>
                  <center>
                    <?php echo $value->nama; ?>
                  </center>
                </td>
                <td>
                  <center>
                    <?php echo $value->phone; ?>
                  </center>
                </td>
                <td>
                  <center>
                    <?php echo $value->qty . '/5'; ?>
                  </center>
                </td>
                <td>
                  <center>
                    <?php echo $value->status; ?>
                  </center>
                </td>
                <td>
                  <center>
                    <?php if ($value->status == 'ondelivery') {
            echo "--";
            } else {?>
                    <input type="checkbox" name="checkcurrier" id="<?php echo $value->id; ?>" value="1" tabIndex="1" id_currier="<?php echo $value->id; ?>"
                        onClick="ckChange(this)">
                    <?php } ?>
                  </center>
                </td>
                <td>
                  <center>
                    <a class="btn btn-primary btn-icon" id="selectCurrier" title="Show Detail." type="button" id-currier="<?php echo $value->id; ?>"
                        currier-name="<?php echo $value->nama; ?>">
                      <span class="fa fa-search"></span>
                    </a>
                  </center>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <form role="form" class="form-horizontal" action="<?php echo base_url() ?>admin/currier/assign_currier" method="post">
            <input type="hidden" name="currierid" id="currierid" value="">
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" id="submit-form">Assign Delivery</button>
              <!-- <a href="<?php echo base_url()?>admin/order" class="btn btn-default">Kembali</a> -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal Detail Order -->
<div class="modal fade" id="currierTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">New message</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="currierTask_result"></div>
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

<!-- Js For Modal -->
<script>
  $(document).on("click", "#selectCurrier", function () {

    var currierid = $(this).attr('id-currier');
    var curriername = $(this).attr('currier-name');

    $.ajax({
      url: "<?php echo site_url('admin/currier/curriertask');?>",
      type: "POST",
      data: {
        currierid: currierid,
      },
      success: function (data) {
        $('#currierTask_result').html(data);
        $('.modal-title').text('Task For : ' + curriername)
        $('#currierTaskModal').modal('show');
      },
      error: function (data) {
        alert('Error');
      }
    });
    return false;
  });
</script>

<script>
  function ckChange(ckType) {
    var ckName = document.getElementsByName(ckType.name);
    var checked = document.getElementById(ckType.id);

    if (checked.checked) {
      for (var i = 0; i < ckName.length; i++) {

        if (!ckName[i].checked) {
          ckName[i].disabled = true;
        } else {
          ckName[i].disabled = false;
          document.getElementById('currierid').value = $(ckType).attr('id_currier');
        }
      }
    } else {
      for (var i = 0; i < ckName.length; i++) {
        ckName[i].disabled = false;
        document.getElementById('currierid').value = '';
      }
    }
  }
</script>