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
      <h4>Edit User Profile</h4>
      <p>Information about your user here</p>
      <hr>
      <form method="POST" action="<?php echo base_url()?>DataMaster/editedUser" enctype="multipart/form-data">
       <?php  
       foreach ($user->data as $u) { ?>
         <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-id-card"></i></span>&nbsp;&nbsp;NIK*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
             <input type="hidden" class="form-control"  pattern="^[A-Za-z0-9](?!.*?[^\nA-Za-z0-9\s)(\/.#_-]).*?[A-Za-z0-9\s)(]*$" maxlength="15" required="" value="<?php echo $u->id_user ?>" name="id_user">
             <input type="text" class="form-control"  pattern="^[A-Za-z0-9](?!.*?[^\nA-Za-z0-9\s)(\/.#_-]).*?[A-Za-z0-9\s)(]*$" maxlength="15" required="" value="<?php echo $u->user_nik ?>" name="user_nik">
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
           <input type="hidden" class="form-control"  pattern="^[A-Za-z0-9](?!.*?[^\nA-Za-z0-9\s)(\/.#_-]).*?[A-Za-z0-9\s)(]*$" maxlength="100" required="" value="<?php echo $u->id_user ?>" name="id_user">
           <input type="text" class="form-control"  pattern="^[A-Za-z0-9](?!.*?[^\nA-Za-z0-9\s)(\/.#_-]).*?[A-Za-z0-9\s)(]*$" maxlength="100" required="" value="<?php echo $u->user_name ?>" name="user_name">
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
          <input readonly="" type="email" value="<?php echo $u->user_email ?>" class="form-control" name="user_email">
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
          <input type="text" onkeypress="return isNumber(event)" onpaste="return false;"  maxlength="15" class="form-control" name="user_phone" value="<?php echo $u->user_phone ?>" required="">
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
        <?php if ($this->session->userdata('id_profile')== 1) {
          if ($this->session->userdata('id_user')== $u->id_user) {
            ?>
            <div class="form-group">
              <label><?php echo $this->session->userdata('profile_name');?></label>
            </div>
          <?php }else{ ?>
            <div class="form-group">
              <select class="form-control" name="id_profile"  required="">
                <option value="" selected="" disabled="">Select Profile</option>
                <?php foreach ($list_profile->data as $p) {?>
                  <option <?php if ($u->id_profile == $p->id_profile){
                    echo "selected";
                  } ?>
                  value="<?php echo $p->id_profile ?>"><?php echo $p->profile_name ?></option>
                  <?php echo "selected"; ?>
                <?php }?>
              </select>
            </div>
          <?php } }else{ ?>
           <div class="form-group">
            <label><?php echo $u->profile_name?></label>
          </div>
        <?php  } ?>

      </div>
    </div>
    <div class="row">
      <div class="col-3 offset-1">
        <input type="checkbox" class="form-check-input" name="checkchange" id="checkchange" value="1"> Change Password
      </div>
    </div>

    <br>

    <div id="passhide" style="display: none;">
      <div class="row">
        <div class="col-3 offset-1">
          <p>
            <span class="text-orange"><i class="fa fa-key"></i></span>&nbsp;&nbsp;Old Password
          </p>
        </div>
        <div class="col-7">
          <div class="form-group">
            <input type="hidden" class="form-control" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,12}$"  title="8-12 that contains uppercase, lowercase, and numeric without whitespace" maxlength="50" onpaste="return false;" name="user_password_old" id="user_password_old" value="<?php echo $u->user_password ?>">
            <input type="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,12}$"  title="8-12 that contains uppercase, lowercase, and numeric without whitespace" maxlength="50" onpaste="return false;" name="user_cofirmpassword_old" id="oldpassword">
            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" onclick="oldpass()"></span>
          </div>
          <div id="alert1" style="margin-left: 0%;"></div>
          <!-- <div id="alert2" style="margin-left: 0%;"></div> -->
        </div>
      </div>
      <div class="row">
        <div class="col-3 offset-1">
          <p>
            <span class="text-orange"><i class="fa fa-key"></i></span>&nbsp;&nbsp;New Password
          </p>
        </div>
        <div class="col-7">
          <div class="form-group">
            <input type="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,12}$"  title="8-12 that contains uppercase, lowercase, and numeric without whitespace" maxlength="50" onpaste="return false;" name="user_password" id="password">
            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" onclick="pass()"></span>
          </div>
          <div id="alert3" style="margin-left: 0%;"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-3 offset-1">
          <p>
            <span class="text-orange"><i class="fa fa-check-circle-o"></i></span>&nbsp;&nbsp;Confirm New Password
          </p>
        </div>
        <div class="col-7">
          <div class="form-group">
            <input type="password" class="form-control" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,12}$"  title="8-12 that contains uppercase, lowercase, and numeric without whitespace" maxlength="50" onpaste="return false;" name="user_password2" id="confirmpass">
            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" onclick="confirmpass()"></span>
          </div>
          <div id="alert2" style="margin-left: 0%;"></div>
          <!-- <div id="alert" style="margin-left: 0%;"></div> -->
        </div>
      </div>
    </div>


  </div>
  <div class="row">
    <div class="col-12">
      <div class="col-2 float-right">
       <a href="<?php echo base_url(); ?>DataMaster/DataMasterUsers" class="btn btn-sm btn-block btn-secondary" >Cancel</a>
     </div>
     <div class="col-2 float-right">
      <button type="submit" class="btn btn-sm btn-block btn-danger bg-orange" id="button" >Save</button>
    </div>
  </div>
</div>
<br>
<?php } ?>
</form>
</div>
</div>
</div>

<script type="text/javascript">
  function oldpass() {
    var x = document.getElementById("oldpassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

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

      // function validate_old() {
      //   var oldpassword = document.getElementById("oldpassword").value;
      //   var confirmOldPassword = document.getElementById("confirmoldpassword").value;
      //   if (oldpassword != confirmOldPassword) {
      //     $(document).ready(function(){
      //       $("#success-alert2").fadeTo(2000, 500).slideUp(500, function(){
      //         $("#success-alert2").slideUp(500);
      //       });
      //     });
      //     return false;
      //   }
      //   return true;
      // }
      // $("#confirmoldpassword").keyup(function(){
      //   if ($(this).val() != $('#oldpassword').val()) {
      //     $('#alert2').empty().html(' ');
      //     $('#alert2').append('<p style="color:red;">Old password does not match</p>');
      //     $('#button2').attr('disabled','disabled');
      //   } else {
      //     $('#alert2').empty().html(' ');
      //     $('#button2').removeAttr('disabled');
      //   }
      // });
//check old pass
$("#password").keyup(function(){
  var password = $(this).val();
  $.ajax({
    url: '<?php echo base_url('DataMaster/checkpass'); ?>',
    type: 'POST',
    data: {
      id:'<?php echo $this->uri->segment(3); ?>',
      pass : password,
    },
    success: function (response) {
      console.log(password + ' | ' + response);
      if(response == 'same'){
        $('#alert3').empty().html(' ');
        $('#alert3').append("<p style='color:red;'>New password can't be same as old password</p>");
        $('#button').attr('disabled','disabled');
        console.log('same');
      } else {
        console.log('diff');
        $('#alert3').empty().html(' ');
        $('#button').removeAttr('disabled');
      }
    }
  });
});

$("#oldpassword").keyup(function(){
  var password = $(this).val();
  $.ajax({
    url: '<?php echo base_url('DataMaster/checkpass'); ?>',
    type: 'POST',
    data: {
      id:'<?php echo $this->uri->segment(3); ?>',
      pass : password,
    },
    success: function (response) {
      console.log(password + ' | ' + response);
      if(response == 'diff'){
        $('#alert1').empty().html(' ');
        $('#alert1').append("<p style='color:red;'>Not match</p>");
        $('#button').attr('disabled','disabled');
        console.log('same');
      } else {
       console.log('diff');
       $('#alert1').empty().html(' ');
       $('#button').removeAttr('disabled');
     }
   }
 });
});

$("#confirmpass").keyup(function(){
  if ($(this).val() != $('#password').val()) {
    $('#alert2').empty().html(' ');
    $('#alert2').append('<p style="color:red;">Not match</p>');
    $('#button').attr('disabled','disabled');
  } else {
    $('#alert2').empty().html(' ');
    $('#button').removeAttr('disabled');
  }
});


 // -- passhide
 $( document ).ready(function() {
  $( "#passhide" ).hide();
  $( "#checkchange" ).prop('checked',false);
});

 $( "#checkchange" ).click(function() {
  if ($( "#checkchange" ).prop('checked')) {
      // console.log('hehehe');
      $( "#passhide" ).show();
      $("#oldpassword").prop('required',true);
      $("#password").prop('required',true);
      $("#confirmpass").prop('required',true);
    }else{
      // console.log('hohohoho');
      $("#passhide" ).hide();
      $("#oldpassword").prop('required',false);
      $("#password").prop('required',false);
      $("#confirmpass").prop('required',false);
      $("#oldpassword").val('');
      $("#password").val('');
      $("#confirmpass").val('');
      $('#notif').empty().html(' ');
      $('#button').removeAttr('disabled');
    }
  });
</script>