<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Milki Administrator</title>

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/css/normalize.min.css">
  <link rel='stylesheet prefetch' href="<?php echo base_url(); ?>assets/login/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/css/style.css">
</head>

<body>
  <?php $this->load->view($content); ?>
</body>

<script src="<?php echo base_url(); ?>assets/login/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/login/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/login/js/index.js"></script>
<script>
	$(document).ready(function () {
	    $("#loginform").submit(function () {

	        $.ajax({
	            url: "<?php echo site_url('login/ceklogin');?>",
	            type: "POST",
	            data: {
	                username: $('#Username').val(),
	                password: $('#Password').val()
	            },
	            success: function (data) {
	            	if (data == 1) {
	            		
	            		$("#alertsigin").html("<br><div class='alert alert-success'><strong>Success!</strong> Login Success.</div>").delay(800).slideToggle();
	            		setTimeout(function() {
	            			window.location="admin/dashboard";
						}, 1000);

					} else if (data == 2) {

						$("#alertsigin").html("<br><div class='alert alert-success'><strong>Success!</strong> Login Success.</div>").delay(800).slideToggle();
	            		setTimeout(function() {
	            			window.location="currier/dashboard";
						}, 1000);

	            	} else {
	            		$("#alertsigin").html("<br><div class='alert alert-danger'><strong>Wrong!</strong> Your Username/password is wrong.</div>").delay(1000).slideToggle();
	            	}
	                
	            },
	            failed: function (data) {
	                
	            }
	        });
	        return false;
	    });
	});
</script>

</html>