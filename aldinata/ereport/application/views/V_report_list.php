    <div class="container mt-4">
    	<div class="card"> 
    		<div class="card-body">
    			<h4 class="text-body pb-4">Report List</h4>
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
              <th>Customer Name</th>
              <th>Assignment User</th>
              <th>Due Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php  
            
            foreach ($list_assignment->data as $ass) { ?>
              <tr>
                <td></td>
                <td> <?php echo $ass->customer_name ?></td>
                <td><?php echo $ass->user_name ?></td>
                <td> <?php echo $ass->due_date ?></td>
                <td><?php if ($ass->id_assignmentstatus == 1 ) {
                  echo "Open";
                } elseif ($ass->id_assignmentstatus == 2) {
                  Echo "Completed";
                } ?></td>
                <td class="mx-auto">
                  <div class="row">                  
                    <a href="<?php echo base_url(); ?>/assets/report/<?php echo $ass->file_name ?>" target="_self">
                      <button class="btn btn-sm btn-danger bg-orange">
                        <i class="fa fa-file"></i>&nbsp;&nbsp;Download
                      </button>
                    </a>
                  <!-- <div class="dropdown">
                    <button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a href="<?php //echo base_url() . "TaskAssignment/editTask/" . $ass->id_assignment; ?>"> <button class="dropdown-item" onclick="" <?php //if ($ass->id_assignmentstatus == 2 ) { echo "disabled"; } ?>><i class="fa fa-pencil"></i>&nbsp;Edit</button></a>
                      <a href="#" data-toggle="modal" data-target="#modal_delete" data-id_assignment="<?php //echo $ass->id_assignment ?>"><button class="dropdown-item"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                      </a>
                    </div>
                  </div> -->
                </div>
              </td>
            </tr>
          <?php  } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>




<div class="modal fade" id="modal_delete" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form method="POST" action="<?php echo base_url()?>TaskAssignment/delAssignment">
      <div class="modal-content">
        <div class="modal-body">
          <span>Are you sure to delete this data?</span>
          <input type="hidden" name="id_assignment" id="id_assignment">
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
      var id_assignment = button.data('id_assignment')
      $('#id_assignment').val(id_assignment);

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
                dom: '<"row"<"col-12"<"col-12"f>>>rt<"row"<"col-12"l>>',
                buttons: [
                ],
                columnDefs        : [{
                  'searchable'    : false,
                  "orderable"     : false,
                  'targets'       : [0, 5],
                }],
                "columnDefs": [ {
                  "targets": 0,
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