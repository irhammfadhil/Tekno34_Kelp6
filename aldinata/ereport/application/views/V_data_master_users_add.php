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
      <h4>Add New Booking</h4>
      <p>Information about user here</p>
      <hr>
      <form method="POST" action="<?php echo base_url()?>DataMaster/addedUser" enctype="multipart/form-data">
        <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-id-card"></i></span>&nbsp;&nbsp;Tanggal dan jam mulai*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
              <input type="datetime-local" class="form-control" required="" name="booking_date_start">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-id-card"></i></span>&nbsp;&nbsp;Tanggal dan jam selesai*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
              <input type="datetime-local" class="form-control" required="" name="booking_date_end">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-envelope"></i></span>&nbsp;&nbsp;Lokasi*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
              <input type="text" class="form-control" name="booking_location" required="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-phone"></i></span>&nbsp;&nbsp;Kontak yang dapat dihubungi*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
              <input type="text" onkeypress="return isNumber(event)" onpaste="return false;"  maxlength="15" class="form-control" name="booking_phone" required="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="col-2 float-right">
              <a href="<?php echo base_url(); ?>DataMaster/DataMasterUsers" class="btn btn-sm btn-block btn-secondary" >Cancel</a>
            </div>
            <div class="col-2 float-right">
              <button type="submit" class="btn btn-sm btn-block btn-danger bg-orange">Add New Booking</button>
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