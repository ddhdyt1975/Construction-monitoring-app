
<body class="hold-transition login-page" style="background-color:#FFFFFF">
    <div class="login-box">
        <div class="login-logo">
        <a href="<?= base_url() ?>"><img  style="width:80%" src="<?=base_url()?>assets/logo_hires.png"></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="<?= base_url() ?>Auth/validate_credentials" method="post">
            <div class="form-group has-feedback">
                <input type="email" id ="username" name="username" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                   <!--  <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div> -->
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>
<!-- 
        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="<?php echo $login_url_fb?>" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
            <div href="<?php echo $login_url_gm?>" class="g-signin2" >Sign in using Google</div>
            <a href="<?= base_url() ?>auth/validate_credentials" class="btn btn-block btn-social btn-twitter btn-flat"><i class="fa fa-twitter"></i> Sign in using Twitter</a>
        </div>
        
        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a> -->
    </div>
</div>
<script src="<?= base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'  
    });
  });


</script>
</body>