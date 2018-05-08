<!doctype html>
<html>

<head>
	<title>MILKI</title>
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-7FdXho5u4vkP219w"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
	    rel='stylesheet' type='text/css'>
	<link href="<?php echo base_url() ?>assets/trackorder/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>

	<div class="header">
		<h1>MILKI TRACKING ORDER</h1>
	</div>

	<div class="content">
		<?php foreach ($getdata as $value) { ?>
		<div class="content1">
			<h2>Order ID:
				<?php echo '#'. $value->id_order; ?>
			</h2>
		</div>
		<div class="content2">
			<div class="content2-header1">
				<p>Nama:
					<span>
						<?php echo $value->nama; ?>
					</span>
				</p>
			</div>
			<div class="content2-header1">
				<p>Status :
					<span>
						<?php 
							  if ($value->status_payment == 1) {
		                        echo "Waiting Payment";
		                      } elseif ($value->status_payment == 2) {
		                        echo "Checkout Payment";
		                      } elseif ($value->status_payment == 3) {
		                        echo "Processing Order";
		                      } elseif ($value->status_payment == 4) {
		                        echo "Order Shipped";
		                      } elseif ($value->status_payment == 5) {
		                        echo "Order Received";
		                      } elseif ($value->status_payment == 'expire') {
		                ?>		
		                		<font color='red'><?php echo "Expired Payment"; ?></font>
		                <?php
		                      }
                      	?>
					</span>
				</p>
			</div>
			<div class="content2-header1">
				<p>Order Date :
					<span>
						<?php echo $value->tgl; ?>
					</span>
				</p>
			</div>
			<div class="clear"></div>
		</div>
		<div class="content3">
			<div class="shipment">
				<div class="confirm">
					<div class="imgcircle" style="background-color:<?php if(1 <= $value->status_payment){ ?> #98D091 <?php } else { ?> #F5998E <?php } ?>;">
						<img src="<?php echo base_url() ?>assets/trackorder/images/payment.png">
					</div>
					<span class="line" style="background-color:<?php if(1 <= $value->status_payment){ ?> #98D091 <?php } else { ?> #F5998E <?php } ?>;"></span>
					<p>Waiting Payment</p>
				</div>
				<div class="process">
					<div class="imgcircle" style="background-color:<?php if(2 <= $value->status_payment){ ?> #98D091 <?php } else { ?> #F5998E <?php } ?>;">
						<img src="<?php echo base_url() ?>assets/trackorder/images/checkout.png">
					</div>
					<span class="line" style="background-color:<?php if(2 <= $value->status_payment){ ?> #98D091 <?php } else { ?> #F5998E <?php } ?>;"></span>
					<p>Checkout Payment</p>
				</div>
				<div class="quality">
					<div class="imgcircle" style="background-color:<?php if(3 <= $value->status_payment){ ?> #98D091 <?php } else { ?> #F5998E <?php } ?>;">
						<img src="<?php echo base_url() ?>assets/trackorder/images/packaging.png">
					</div>
					<span class="line" style="background-color:<?php if(3 <= $value->status_payment){ ?> #98D091 <?php } else { ?> #F5998E <?php } ?>;"></span>
					<p>Processing Order</p>
				</div>
				<div class="dispatch">
					<div class="imgcircle" style="background-color:<?php if(4 <= $value->status_payment){ ?> #98D091 <?php } else { ?> #F5998E <?php } ?>;">
						<img src="<?php echo base_url() ?>assets/trackorder/images/shipped.png">
					</div>
					<span class="line" style="background-color:<?php if(4 <= $value->status_payment){ ?> #98D091 <?php } else { ?> #F5998E <?php } ?>;"></span>
					<p>Order Shipped</p>
				</div>
				<div class="delivery">
					<div class="imgcircle" style="background-color:<?php if(5 <= $value->status_payment){ ?> #98D091 <?php } else { ?> #F5998E <?php } ?>;">
						<img src="<?php echo base_url() ?>assets/trackorder/images/received.png">
					</div>
					<p>Order Received</p>
				</div>
				<div class="clear"></div>
			</div>
			<br>
			<div>
				<?php echo $footerTracker; ?>
			</div>
		</div>
		<?php }; ?>

	</div>

	<div class="footer">
		<p>Copyright © 2018 Milki. All rights reserved.</p>
	</div>


	<!-- Form For Payment Midtrans -->
	<form id="payment-form" method="post" action="<?=site_url()?>payment/snap/checkout">
		<input type="hidden" name="result_type" id="result-type" value="">
		</div>
		<input type="hidden" name="result_data" id="result-data" value="">
		</div>
	</form>
	<!-- Javascript For Payment Midtrans -->
	<script type="text/javascript">
		$('#pay-button').click(function (event) {
			event.preventDefault();
			var orderid = $(this).attr('id-order');
			$(this).attr("disabled", "disabled");

			$.ajax({
				url: '<?=site_url()?>payment/snap/token',
				cache: false,
				type: "POST",
			     data: {
			     	orderid: orderid
			    },
				success: function (data) {
					console.log('token = ' + data);

					var resultType = document.getElementById('result-type');
					var resultData = document.getElementById('result-data');

					function changeResult(type, data) {
						$("#result-type").val(type);
						$("#result-data").val(JSON.stringify(data));
						//resultType.innerHTML = type;
						//resultData.innerHTML = JSON.stringify(data);
					}

					snap.pay(data, {

						onSuccess: function (result) {
							changeResult('success', result);
							console.log(result.status_message);
							console.log(result);
							$("#payment-form").submit();
						},
						onPending: function (result) {
							changeResult('pending', result);
							console.log(result.status_message);
							$("#payment-form").submit();
						},
						onError: function (result) {
							changeResult('error', result);
							console.log(result.status_message);
							$("#payment-form").submit();
						}
					});
				}
			});
		});
	</script>

</body>

</html>