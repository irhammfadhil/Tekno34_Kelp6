    <div class="container mt-4">
    	<div class="card">
    		<div class="card-body">
    			<h4 class="text-body pb-4">Photographers List</h4>
         <?php if($this->session->flashdata('success')!=NULL){?>
          <div class="alert alert-danger" role="alert" id="success-alert" style="display: none;"><b><?php echo $this->session->flashdata('success');?></b></div>
          <script type="text/javascript">
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
              $("#success-alert").slideUp(500);
            });
          </script>
        <?php } else if($this->session->flashdata('failed')!=NULL){ ?>
          <div class="alert alert-success" role="alert" id="failed-alert" style="display: none;"><b><?php echo $this->session->flashdata('failed');?></b></div>
          <script type="text/javascript">
            $("#failed-alert").fadeTo(2000, 500).slideUp(500, function(){
              $("#failed-alert").slideUp(500);
            });
          </script>
        <?php }  ?>
        <div class="table-reponsive">
          <table class="table" id="mytable1">
           <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Nomor Telepon</th>
              <th>Alamat</th>
              <th>Tarif</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php  

            foreach ($list_cust->data as $cust) { ?>
              <tr>
                <td></td>
                <td><?php echo $cust->customer_name ?></td>
                <td><?php echo $cust->customer_email ?></td>
                <td><?php echo $cust->customer_phone ?></td>
                <td> address </td>
                <td> fare </td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                     <a href="<?php echo base_url() . "dataMaster/editCustomer/" . $cust->id_customer; ?>"> <button class="dropdown-item" onclick=""><i class="fa fa-pencil"></i>&nbsp;Book this photographer</button></a>
                     <a href="<?php echo base_url() . "dataMaster/editCustomer/" . $cust->id_customer; ?>"> <button class="dropdown-item" onclick=""><i class="fa fa-pencil"></i>&nbsp;Edit</button></a>
                     <a href="#" data-toggle="modal" data-target="#modal_delete" data-id_customer="<?php echo $cust->id_customer ?>"><button class="dropdown-item"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                     </a>
                   </div>
                 </div>
               </td>
             </tr>
           <?php } ?>
         </tbody>
       </table>
     </div>
   </div>
 </div>
</div>




<div class="modal fade" id="modal_delete" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form method="POST" action="<?php echo base_url()?>dataMaster/delCustomer">
      <div class="modal-content">
        <div class="modal-body">
          <span>Are you sure to delete this data?</span>
          <input type="hidden" name="id_customer" id="id_customer">
        </div>
        <div class="modal-footer">
         <button type="submit" name="submit" style="cursor: pointer;" class="btn btn-default">YES</button>&nbsp;
         <button type="button" style="cursor: pointer;" class="btn btn-default" data-dismiss="modal">NO</button>

       </div>
     </div>
   </form>
 </div>
</div>


<script type="text/javascript">

  $('#modal_delete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id_customer = button.data('id_customer')
      $('#id_customer').val(id_customer);

    });

  </script>


  <?php
  if($this->session->flashdata('pesan')){
    ?>
    <div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
      <div class="modal-dialog modal-danger modal-dialog-centered modal-"  role="document">
        <div class="modal-content bg-gradient-danger">
          <div class="modal-body">
            <div class="py-3 text-center">
              <i class="ni ni-bell-55 ni-3x"></i>
              <h4 class="heading mt-4">Notification</h4>
              <span><b><?php echo $this->session->flashdata('pesan')?></b></span>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-white">OK</button> 
          </div>

        </div>
      </div>
    </div>
  <?php }
  ?>


  <?php
  if($this->session->flashdata('pesan')){
    ?>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#modalAlert').modal('show');
      });

    </script>
  <?php }
  ?>


  <script type="text/javascript">
    $(document).ready(function() {
      var t =  $('#mytable1').DataTable({
                // dom: 'Bfrtlp',
                dom: '<"row"<"col-5 offset-7"<"col-7"f><"col-5"B>>>rt<"row"<"col-6"l><"col-6"p>>',
                buttons: [
                {
                  "text": '<i class="fa fa-plus"></i>&nbsp;Add Customer',
                  "className": 'btn btn-sm btn-danger bg-orange',
                  action: function ( e, dt, button, config ) {
                    window.location = '<?php echo base_url('DataMaster/AddCustomers'); ?>';
                  }
                }],
                columnDefs        : [{
                  'searchable'    : false,
                  "orderable"     : false,
                  'targets'       : [0, 4]
                }],
                "columnDefs": [ {
                  "targets": [0,3],
                  "orderable": false
                } ],
                "order": [[ 1, 'asc' ]]
              });
      t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
        } );
      } ).draw();
    })

  </script>