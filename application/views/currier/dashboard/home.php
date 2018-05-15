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
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua">
          <i class="ion ion-ios-gear-outline"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">CPU Traffic</span>
          <span class="info-box-number">90
            <small>%</small>
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red">
          <i class="fa fa-google-plus"></i>
        </span>

        <div class="info-box-content">
          <span class="info-box-text">Likes</span>
          <span class="info-box-number">41,410</span>
        </div>
      </div>
    </div>
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green">
          <i class="ion ion-ios-cart-outline"></i>
        </span>
        <div class="info-box-content">
          <span class="info-box-text">Sales</span>
          <span class="info-box-number">760</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow">
          <i class="ion ion-ios-people-outline"></i>
        </span>
        <div class="info-box-content">
          <span class="info-box-text">New Members</span>
          <span class="info-box-number">2,000</span>
        </div>
      </div>
    </div>
  </div>

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
                      <?php //foreach ($getdata as $value) { ?>
                      <tr>
                        <td>
                          <center>
                            2018-04-25 14:12:33
                          </center>
                        </td>
                        <td>
                          <center>
                            fifi
                          </center>
                        </td>
                        <td>
                          <center>
                            Jl. Tebet Barat Dalam VIIE No.17, Tebet Bar., more...
                          </center>
                        </td>
                        <td>
                          <center>
                            <a class="btn btn-primary btn-icon" id="btnDetail" title="Show Detail." type="button" id-order="<?php //echo $value->id_order; ?>">
                              <span class="fa fa-search"></span>
                            </a>
                          </center>
                        </td>
                      </tr>
                      <?php //} ?>
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