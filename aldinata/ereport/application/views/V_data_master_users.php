    <div class="container mt-4">
      <div class="card">
        <div class="card-body">
          <h4 class="text-body pb-4">User List</h4>
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
                <th>Tanggal dan jam mulai</th>
                <th>Tanggal dan jam selesai</th>
                <th>Lokasi</th>
                <th>Kontak</th>
                <th>Fotografer</th>
                <th>Biaya</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php  

              foreach ($list_user->data as $user) { ?>
                <tr>
                  <td></td>
                  <td> tgljammulai </td>
                  <td> tgljamselesai </td>
                  <td> location </td>
                  <td> contact </td>
                  <td> photograph </td>
                  <td> cost </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                       <a href="<?php echo base_url() . "dataMaster/editUser/" . $user->id_user; ?>"> <button class="dropdown-item" onclick=""><i class="fa fa-pencil"></i>&nbsp;Confirm booking</button></a>
                       <a href="#" data-toggle="modal" data-target="#modal_delete" data-id_user="<?php echo $user->id_user ?>"><button class="dropdown-item"><i class="fa fa-trash"></i>&nbsp;Delete</button>
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
    <form method="POST" action="<?php echo base_url()?>dataMaster/delUser">
      <div class="modal-content">
        <div class="modal-body">
          <span>Are you sure to delete this data?</span>
          <input type="hidden" name="id_user" id="id_user">
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
      var id_user = button.data('id_user')
      $('#id_user').val(id_user);

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
                  "text": '<i class="fa fa-plus"></i>&nbsp;Add User',
                  "className": 'btn btn-sm btn-danger bg-orange',
                  action: function ( e, dt, button, config ) {
                    window.location = '<?php echo base_url('DataMaster/Adduser'); ?>';
                  }
                }],
                columnDefs        : [{
                  'searchable'    : false,
                  "orderable"     : false,
                  'targets'       : [0, 6],
                }],
                "columnDefs": [ {
                  "targets": [0,4],
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