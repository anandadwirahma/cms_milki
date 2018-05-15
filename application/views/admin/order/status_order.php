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
          <?php foreach ($getdata as $value) { ?>
          <h3>
            Order ID -
            <?php echo $value->id_order; ?>
          </h3>
          <div class="row">
            <div class="col-md-12">
              <ul class="timeline">
                <li class="time-label">
                  <span class="bg-blue">
                    Sunday, 10 Feb 2014
                  </span>
                </li>
                <li>
                  <?php
                    if(1 <= $value->status_payment){ 
                      $waiting_payment = "<i class='fa fa-cc-discover bg-green'></i>";
                    } else {
                      $waiting_payment = "<i class='fa fa-cc-discover bg-red'></i>";
                    }
                    echo $waiting_payment;
                  ?>
                    <div class="timeline-item">
                      <span class="time">
                        <?php foreach ($getTracker as $v_track) { if($v_track->status == 'waiting payment') { ?>
                        <i class="fa fa-clock-o"></i>
                        <?php echo $v_track->datetime; } else { echo '-'; } } ?>
                      </span>
                      <h3 class="timeline-header no-border">Waiting payment.</h3>
                    </div>
                </li>
                <li>
                  <?php
                    if(2 <= $value->status_payment){ 
                      $checkout_payment = "<i class='fa fa-check-square-o bg-green'></i>";
                    } else {
                      $checkout_payment = "<i class='fa fa-check-square-o bg-red'></i>";
                    }
                    echo $checkout_payment;
                  ?>
                    <div class="timeline-item">
                      <span class="time">
                        <?php foreach ($getTracker as $v_track) { if($v_track->status == 'capture') { ?>
                        <i class="fa fa-clock-o"></i>
                        <?php echo $v_track->datetime; } else { echo '-'; } } ?>
                      </span>
                      <h3 class="timeline-header no-border">Checkout payment.
                      </h3>
                    </div>
                </li>
                <li>
                  <?php
                    if(3 <= $value->status_payment){ 
                      $process_order = "<i class='fa fa-dropbox bg-green'></i>";
                    } else {
                      $process_order = "<i class='fa fa-dropbox bg-red'></i>";
                    }
                    echo $process_order;
                  ?>
                    <div class="timeline-item">
                      <span class="time">
                        <?php foreach ($getTracker as $v_track) { if($v_track->status == 'processing order') { ?>
                        <i class="fa fa-clock-o"></i>
                        <?php echo $v_track->datetime; } else { echo '-'; } } ?>
                      </span>
                      <h3 class="timeline-header no-border">Processing order.
                        <a href="<?php echo base_url(); ?>admin/order/currier/<?=$value->id_order;?>">Choose Currier</a>
                      </h3>
                    </div>
                </li>
                <li>
                  <?php
                    if(4 <= $value->status_payment){ 
                      $shipped_order = "<i class='fa fa-truck bg-green'></i>";
                    } else {
                      $shipped_order = "<i class='fa fa-truck bg-red'></i>";
                    }
                    echo $shipped_order;
                  ?>
                    <div class="timeline-item">
                      <span class="time">
                        <?php foreach ($getTracker as $v_track) { if($v_track->status == 'on delivery') { ?>
                        <i class="fa fa-clock-o"></i>
                        <?php echo $v_track->datetime; } else { echo '-'; } } ?>
                      </span>
                      <h3 class="timeline-header">The order on delivery.</h3>
                      <div class="timeline-body">
                        <?php 
                          if ($detailShipping == '') {
                            echo "-";
                          } else {
                            foreach ($detailShipping as $v_shipping) { ?>
                              Currir Name : <?php echo $v_shipping->nama; ?>
                              </br>
                              Phone Number : <?php echo $v_shipping->phone; ?>
                              </br>
                              Destination : <?php echo $v_shipping->loc; ?>
                        <?php 
                            } 
                          }
                        ?>
                      </div>
                    </div>
                </li>
                <li>
                  <?php
                    if(5 <= $value->status_payment){ 
                      $received_order = "<i class='fa fa-check bg-green'></i>";
                    } else {
                      $received_order = "<i class='fa fa-check bg-red'></i>";
                    }
                    echo $received_order;
                  ?>
                    <div class="timeline-item">
                      <span class="time">
                        <i class="fa fa-clock-o"></i> 28-03-2018 15:00:00
                      </span>
                      <h3 class="timeline-header">Your order is received.</h3>
                      <div class="timeline-body">
                        Received By : Firdha Imamah
                        </br>
                        Time : 081234678456
                        </br>
                      </div>
                    </div>
                </li>
              </ul>
            </div>
            <!-- /.col -->
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>