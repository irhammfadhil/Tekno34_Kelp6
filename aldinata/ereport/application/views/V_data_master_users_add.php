<style type="text/css">
  .field-icon {
    float: right;
    margin-left: -25px;
    margin-top: -25px;
    position: relative;
    z-index: 2;
  }
</style>        
<div class="container mt-4">
	<div class="card">
		<div class="card-body">
      <h4>Add User</h4>
      <p>Information about user here</p>
      <hr>
      <form method="POST" action="<?php echo base_url()?>DataMaster/addedUser" enctype="multipart/form-data">
        <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-id-card"></i></span>&nbsp;&nbsp;NIK*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
              <input type="text" class="form-control" pattern="^[A-Za-z0-9](?!.*?[^\nA-Za-z0-9\s)(\/.#_-]).*?[A-Za-z0-9\s)(]*$" maxlength="15" required="" name="user_nik">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-user"></i></span>&nbsp;&nbsp;Name*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
              <input type="text" class="form-control"  pattern="^[A-Za-z0-9](?!.*?[^\nA-Za-z0-9\s)(\/.#_-]).*?[A-Za-z0-9\s)(]*$" maxlength="100" required="" name="user_name">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-envelope"></i></span>&nbsp;&nbsp;Email*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
              <input type="email" class="form-control" name="user_email" required="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-phone"></i></span>&nbsp;&nbsp;Phone Number*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
              <input type="text" onkeypress="return isNumber(event)" onpaste="return false;"  maxlength="15" class="form-control" name="user_phone" required="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-id-badge"></i></span>&nbsp;&nbsp;User Profile*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
              <select class="form-control" name="id_profile"  required="">
                <option value="" selected="" disabled="">Select Profile</option>
                <?php foreach ($list_profile->data as $p) {?>
                  <option value="<?php echo $p->id_profile ?>"><?php echo $p->profile_name ?></option>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-key"></i></span>&nbsp;&nbsp;Password*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
              <input type="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,12}$"  title="8-12 that contains uppercase, lowercase, and numeric without whitespace" maxlength="50" onpaste="return false;" required="" name="user_password" id="password">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" onclick="pass()"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-check-circle-o"></i></span>&nbsp;&nbsp;Confirm Password*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
              <input type="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,12}$"  title="8-12 that contains uppercase, lowercase, and numeric without whitespace" maxlength="50" onpaste="return false;" required="" name="user_password2" id="confirmpass">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" onclick="confirmpass()"></span>
            </div>
            <div id="alert" style="margin-left: 0%;"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="col-2 float-right">
              <a href="<?php echo base_url(); ?>DataMaster/DataMasterUsers" class="btn btn-sm btn-block btn-secondary" >Cancel</a>
            </div>
            <div class="col-2 float-right">
              <button type="submit" class="btn btn-sm btn-block btn-danger bg-orange">Save</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
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