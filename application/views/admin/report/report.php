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
        Report
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
                    <div class="form-group pull-right">
                        <div class="input-group">
                            <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                                <span>
                                    <i class="fa fa-calendar"></i> Date range picker
                                </span>
                                <i class="fa fa-caret-down"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="box-header">
                    <form action="<?php echo base_url() ?>admin/report/printpdf" method="post">
                        <input type="hidden" name="startdate" value="" id="startdate">
                        <input type="hidden" name="enddate" value="" id="enddate">

                        <button type="submit" class="btn btn-primary btn-icon" title="Tambah Data." data-container="body" data-placement="bottom" data-toggle="tooltip" type="button" href="<?php echo base_url(); ?>admin/report/printpdf"> <span class="fa fa-file-pdf-o"></span> Print PDF </button>
                    </form>
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

<!-- date-range-picker -->
<script src="<?php echo base_url(); ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Release input date -->
<script>
    if (!Date.parse($('#daterange-btn span').html())) {
        document.getElementById('startdate').value = '';
        document.getElementById('enddate').value = '';
    }
        
</script>

<!-- JS Datepicker -->
<script type="text/javascript">
    $(function () {
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },

            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'))
                
                document.getElementById('startdate').value = start.format('YYYY-MM-DD');
                document.getElementById('enddate').value = end.format('YYYY-MM-DD');
            }
        )

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
    })
</script>

<script>
    $("#alert-confirm").fadeTo(2000, 500).slideUp(500, function () {
        $("#alert-confirm").slideUp(500);
    });
</script>