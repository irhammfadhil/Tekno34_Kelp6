<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Telkomsigma | eReport</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
    <style type="text/css">
      .field-icon {
          float: right;
          margin-left: -25px;
          margin-top: -25px;
          position: relative;
          z-index: 2;
      }
  </style>    
  <div class="container h-100">
    <div class="row mt-5 align-items-center">
        <div class="col-6 mt-5">
            <img src="<?php echo base_url(); ?>assets/img/logo2-color.png" class="img-fluid mb-4" width="100">
            <h3 style="color:#E04936;">Welcome,</h3>
            <p class="text-body">Login to your account</p>
            <form method="POST" action="<?php echo base_url()?>Login/doLogin" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" required class="form-control" name="user_email" maxlength="50">
                </div>
                <div class="form-group">
                    <label >Password</label> 
                    <input type="password" required class="form-control rounded"   title="8-12 that contains uppercase, lowercase, and numeric without whitespace" maxlength="50" onpaste="return false;" required="" name="user_password" id="password">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" onclick="pass()"></span>
                </div>
                <h6 class="text-danger pl-4"><?php echo $this->session->flashdata('pesan')?></h6>
                <a href="<?php echo base_url()?>Login/forgotpassword" class="float-right">Forgot Password?</a><br>
                <div class="col-5 float-right mt-3 p-0">
                 
                  <button type="submit" class="btn btn-sm btn-block btn-danger bg-orange">Login</button>
                  
              </div>
          </form>
      </div>
      <div class="col-6 mt-5"> 
        <img src="<?php echo base_url(); ?>assets/img/bg-login.png" class="img-fluid mx-auto d-block">
    </div>
</div>

<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.slim.min.js"></script>
<!-- Popper.JS -->
<script src="<?php echo base_url(); ?>/assets/js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo base_url(); ?>/assets/js/bootstrap.min.js"></script>
</div>
<script type="text/javascript">
  function pass() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
  } else {
      x.type = "password";
  }
}
</script>
</body>

</html>