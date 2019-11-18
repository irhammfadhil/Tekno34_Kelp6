    <div class="container mt-4">
    	<div class="card">
    		<div class="card-body">
          <h4>Edit Customer</h4>
          <p>Information about your customer here</p>
          <hr>
          <form method="POST" action="<?php echo base_url()?>DataMaster/editedCustomers" enctype="multipart/form-data">
           <?php  
           foreach ($customer->data as $cust) { ?>
            <div class="row">
              <div class="col-3 offset-1">
                <p>
                  <span class="text-orange"><i class="fa fa-id-card"></i></span>&nbsp;&nbsp;Customer Name*
                </p>
              </div>
              <div class="col-7">
                <div class="form-group">
                 <input type="hidden" class="form-control"  pattern="^[A-Za-z0-9](?!.*?[^\nA-Za-z0-9\s)(\/.#_-]).*?[A-Za-z0-9\s)(]*$" maxlength="50" required="" value="<?php echo $cust->id_customer ?>" name="id_customer">
                 <input type="text" class="form-control"  pattern="^[A-Za-z0-9](?!.*?[^\nA-Za-z0-9\s)(\/.#_-]).*?[A-Za-z0-9\s)(]*$" maxlength="50" required="" value="<?php echo $cust->customer_name ?>" name="customer_name">
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
                <input type="email" value="<?php echo $cust->customer_email ?>" class="form-control" name="customer_email" required="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-3 offset-1">
              <p>
                <span class="text-orange"><i class="fa fa-phone"></i></span>&nbsp;&nbsp;Office Phone*
              </p>
            </div>
            <div class="col-7">
              <div class="form-group">
                <input type="text" onkeypress="return isNumber(event)" onpaste="return false;"  maxlength="15" class="form-control" name="customer_phone" value="<?php echo $cust->customer_phone ?>" required="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-3 offset-1">
              <p>
                <span class="text-orange"><i class="fa fa-building"></i></span>&nbsp;&nbsp;Fax Number
              </p>
            </div>
            <div class="col-7">
              <div class="form-group">
                <input type="text" class="form-control" value="<?php echo $cust->customer_fax ?>" name="customer_fax">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-3 offset-1">
              <p>
                <span class="text-orange"><i class="fa fa-map-marker"></i></span>&nbsp;&nbsp;Address
              </p>
            </div>
            <div class="col-7">
              <div class="form-group">
                <textarea class="form-control" rows="5" name="customer_addr"><?php echo $cust->customer_addr ?></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-3 offset-1">
              <p>
                <span class="text-orange"><i class="fa fa-upload"></i></span>&nbsp;&nbsp;Company Logo
              </p>
            </div>
            <div class="col-7">
              <div class="form-group">
                <input type="file" name="customer_logo" accept=".jpg,.png,.JPG,.PNG,.jpeg,.JPEG" class="form-control"> 
                <p>*max size 10MB</p></div>

                <img style="width: 50%" src="<?php echo base_url()?>assets/customer/<?php echo $cust->customer_logo ?>">

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="col-2 float-right">
                <a href="<?php echo base_url(); ?>DataMaster/DataMasterCustomers" class="btn btn-sm btn-block btn-secondary">Cancel</a>
              </div>
              <div class="col-2 float-right">
                <button type="submit" class="btn btn-sm btn-block btn-danger bg-orange">Save</button>
              </div>
            </div>
          </div>
        <?php } ?>
      </form>
    </div>
  </div>
</div>