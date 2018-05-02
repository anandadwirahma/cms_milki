<div class="container">
  <div class="login-logo off-canvas">
    <a href="#">
      <img src="<?php echo base_url(); ?>assets/img/milkilogo.png;" width="40%" height="40%" alt="company logo">
    </a>
  </div>

  <div class="form-container off-canvas">
    <form id="loginform" method="post" role="form" class="form-signin">
      <center>
        <h2>MILKI ADMIN</h2>
      </center>

      <div class="form-group">
        <label for="EmailAddress">
          <span>*</span> Username</label>
        <input type="text" class="form-control" name="username" id="Username" aria-required="true" aria-invalid="true" required>
      </div>

      <div class="form-group">
        <label for="EmailAddress">
          <span>*</span> Password</label>
        <input type="password" class="form-control" name="password" id="Password" aria-required="true" aria-invalid="true" required>
      </div>

      <div class="checkbox">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" id="submit-login" type="submit">Sign in</button>

    </form>

    <div id="alertsigin">  
    </div>
    
  </div>

  <!-- /container -->

</div>