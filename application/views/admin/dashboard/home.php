<?php 
    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
    }

    foreach ($getDashboard as $value) {
        $trx = $value->trx;
        $revenue = rupiah($value->revenue);
    }
?>

<!-- Header Content -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Milki 1.0</small>
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
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua">
                    <i class="fa fa-shopping-cart"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">TOTAL TRANSACTION</span>
                    <span class="info-box-number">
                        <?php echo $trx; ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green">
                    <i class="fa fa-dollar"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">REVENUE</span>
                    <span class="info-box-number">
                        <?php echo $revenue; ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="clearfix visible-sm-block"></div>
        <!-- <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green">
            <i class="ion ion-ios-cart-outline"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">ORDER FAILED</span>
            <span class="info-box-number">10</span>
          </div>
        </div>
      </div> -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Admin</h3>
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
                <div class="box-body">
                    <div class="col-md-6">
                        <!-- TRANSACTION CHART -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Sales Transaction</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="chart" id="trx-chart" style="height: 300px;"></div>
                            </div>
                        </div>

                        <!-- FAVORITE CHART -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Top 5 Favorite Flavors</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="chart" id="flavors-chart" style="height: 300px; position: relative;"></div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <!-- REVENUE CHART -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Revenue</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="chart" id="revenue-chart" style="height: 300px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url(); ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>

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
            }
        )

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
    })
</script>


<!-- For Retrieve data chart -->
<script>
    $(function () {
        "use strict";

        var jsonData = $.getJSON("<?php echo base_url('admin/dashboard/revenue_chart');?>", function (jsonData) {
            //console.log(jsonData);

            // REVENUE CHART
            var revenuechart = new Morris.Line({
                element: 'revenue-chart',
                resize: true,
                data: jsonData,
                xkey: 'y',
                ykeys: ['revenue'],
                labels: ['Revenue'],
                lineColors: ['#3c8dbc'],
                hideHover: 'auto'
            });
        });

        var jsonData = $.getJSON("<?php echo base_url('admin/dashboard/transaction_chart');?>", function (
            jsonData) {
            //console.log(jsonData);

            // TRANSACTION CHART
            var trxchart = new Morris.Line({
                element: 'trx-chart',
                resize: true,
                data: jsonData,
                xkey: 'y',
                ykeys: ['success', 'failed'],
                labels: ['Total Success', 'Total Failed'],
                lineColors: ['#3c8dbc', '#FF0000'],
                hideHover: 'auto'
            });
        });

    });
</script>

<!--FAVORITE FLAVORS CHART-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var jsonData = $.ajax({ 
            url: "<?php echo base_url() . 'admin/dashboard/favorite_chart' ?>", 
            dataType: "json", 
            async: false 
        }).responseText;

        //console.log(jsonData);
        var data = new google.visualization.DataTable(jsonData); 

        var options = {
            title: ''
        };

        var chart = new google.visualization.PieChart(document.getElementById('flavors-chart'));
        chart.draw(data, options);
    }
</script>