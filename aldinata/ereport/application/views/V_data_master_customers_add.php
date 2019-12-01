        <div class="container mt-4">
          <div class="card">
            <div class="card-body">
              <h4>Add New Photographer</h4>
              <p>Information about your customer here</p>
              <hr>
              <form method="POST" action="<?php echo base_url()?>DataMaster/addedCustomers" enctype="multipart/form-data">
               <div class="row">
                <div class="col-3 offset-1">
                  <p>
                    <span class="text-orange"><i class="fa fa-id-card"></i></span>&nbsp;&nbsp;Nama*
                  </p>
                </div>
                <div class="col-7">
                  <div class="form-group">
                    <input type="text" class="form-control"  pattern="^[A-Za-z0-9](?!.*?[^\nA-Za-z0-9\s)(\/.#_-]).*?[A-Za-z0-9\s)(]*$" maxlength="50" required="" name="photographer_name">
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
                    <input type="email" class="form-control" name="photographer_email" required="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-3 offset-1">
                  <p>
                    <span class="text-orange"><i class="fa fa-phone"></i></span>&nbsp;&nbsp;No Telepon / HP*
                  </p>
                </div>
                <div class="col-7">
                  <div class="form-group">
                    <input type="text" onkeypress="return isNumber(event)" onpaste="return false;"  maxlength="15" class="form-control" name="photographer_phone" required="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-3 offset-1">
                  <p>
                    <span class="text-orange"><i class="fa fa-map-marker"></i></span>&nbsp;&nbsp;Alamat*
                  </p>
                </div>
                <div class="col-7">
                  <div class="form-group">
                    <textarea class="form-control" rows="5" name="photographer_addr" required=""></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-3 offset-1">
                  <p>
                    <span class="text-orange"><i class="fa fa-map-marker"></i></span>&nbsp;&nbsp;Tarif*
                  </p>
                </div>
                <div class="col-7">
                  <div class="form-group">
                    <textarea class="form-control" rows="5" name="photographer_fare" required=""></textarea>
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
            </form>
          </div>
        </div>
      </div>