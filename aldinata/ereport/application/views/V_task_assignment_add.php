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
      <h4>Add Task Assignment</h4>
      <p>Information about task assignment here</p>
      <hr>
      <form method="POST" action="<?php echo base_url()?>TaskAssignment/addedTask" enctype="multipart/form-data">

        <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-id-badge"></i></span>&nbsp;&nbsp;Customer Name*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
              <select class="form-control" name="id_customer" required="" >
                <option value="" selected="" disabled="">Select Customer</option>
                <?php foreach ($list_customer->data as $c) {?>
                  <option value="<?php echo $c->id_customer ?>"><?php echo $c->customer_name ?></option>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-user-circle"></i></span>&nbsp;&nbsp;Assignment User*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
              <select class="form-control" name="id_user" required="">
                <option value="" selected="" disabled="">Select User</option>
                <?php foreach ($list_user->data as $u) {?>
                  <option value="<?php echo $u->id_user ?>"><?php echo $u->user_name ?></option>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-3 offset-1">
            <p>
              <span class="text-orange"><i class="fa fa-calendar"></i></span>&nbsp;&nbsp;Due Date*
            </p>
          </div>
          <div class="col-7">
            <div class="form-group">
              <input type="date" class="unstyled form-control" onkeypress="return false;"  required="" name="due_date">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="col-2 float-right">
              <a href="<?php echo base_url(); ?>TaskAssignment" class="btn btn-sm btn-block btn-secondary">Cancel</a>
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
  $(document).ready(function() {
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("due_date")[0].setAttribute('min', today);

  });
</script>
