<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Telkomsigma | eReport</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
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
                <h3 style="color:#E04936;">Forgot Password</h3>
                <p class="text-body">Update your personal data</p>
                <form method="POST" action="<?php echo base_url()?>Login/doForgot" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" required class="form-control" name="user_email" maxlength="100">
                    </div>
                    <div class="form-group">
                        <label>New Password</label> 
                        <input type="password" required class="form-control rounded" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,12}$"  title="8-12 that contains uppercase, lowercase, and numeric without whitespace" maxlength="50" onpaste="return false;" required="" name="user_password" id="password">
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" onclick="pass()"></span>
                        <label>Confirm New Password</label> 
                        <input type="password" required class="form-control rounded" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,12}$"  title="8-12 that contains uppercase, lowercase, and numeric without whitespace" maxlength="50" onpaste="return false;" required="" name="user_password2" id="confirmpass">
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" onclick="confirmpass()"></span>
                    </div>
                    <div id="alert" style="margin-left: 0%;"></div>

                    <a href="<?php echo base_url()?>Login" class="float-right">Back to login page</a><br>
                    <div class="col-5 float-right mt-3 p-0">
                        <button type="submit" class="btn btn-sm btn-block btn-danger bg-orange" id="button" >Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-6 mt-5"> 
                <img src="<?php echo base_url(); ?>assets/img/bg-login.png" class="img-fluid mx-auto d-block">
            </div>
        </div>

        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
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
      function confirmpass() {
        var x = document.getElementById("confirmpass");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
      function Validate() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmpass").value;
        if (password != confirmPassword) {
          $(document).ready(function(){
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
              $("#success-alert").slideUp(500);
            });
          });
          return false;
        }
        return true;
      }
      $("#confirmpass").keyup(function(){
        if ($(this).val() != $('#password').val()) {
          $('#alert').empty().html(' ');
          $('#alert').append('<p style="color:red;">Not match</p>');
          $('#button').attr('disabled','disabled');
        } else {
          $('#alert').empty().html(' ');
          $('#button').removeAttr('disabled');
        }
      });
</script>
</body>

</html>