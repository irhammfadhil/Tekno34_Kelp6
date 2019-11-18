    <div class="container mt-4">
    	<div class="card">
    		<div class="card-body">
    			<h4 class="text-body pb-4">Task List</h4>
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
              <th>Photograper</th>
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
                    <?php if ($ass->id_assignmentstatus == 2) {?>

                      <button disabled="" style="background-color: #e36c0c; color:white; cursor: no-drop;" class="btn btn-sm btn-default" >
                        <i class="fa fa-file"></i>&nbsp;&nbsp;Done
                      </button>

                    <?php  }else{ ?>                 
                      <a href="<?php echo base_url() . "Report/Generate/" . $ass->id_assignment. '/'. $ass->id_customer; ?>">
                        <button style="background-color: #e36c0c; color:white;" class="btn btn-sm btn-default" >
                          <i class="fa fa-file"></i>&nbsp;&nbsp;Done
                        </button>
                      </a>
                    <?php } ?>



                    <div class="dropdown dropleft float-right">
                      <button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="    left: -55px;">
                        <a href="<?php echo base_url() . "Report/Generate/" . $ass->id_assignment. '/'. $ass->id_customer; ?>"> <button class="dropdown-item" onclick="" <?php if ($ass->id_assignmentstatus == 1 ) { echo "disabled"; } ?>><i class="fa fa-file"></i>&nbsp;Regenerate</button></a>
                        <a href="<?php echo base_url() . "TaskAssignment/editTask/" . $ass->id_assignment; ?>"> <button class="dropdown-item" onclick="" <?php if ($ass->id_assignmentstatus == 2 ) { echo "disabled"; } ?>><i class="fa fa-pencil"></i>&nbsp;Edit</button></a>
                        <a href="#" data-toggle="modal" data-target="#modal_delete" data-id_assignment="<?php echo $ass->id_assignment ?>"><button class="dropdown-item"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                        </a>
                      </div>
                    </div>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Upload File</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url()?>TaskAssignment/UploadExcel" method="POST" enctype="multipart/form-data"  id="myform">
          <div class="modal-body">
            <input type="file" accept=".xlsx,.xls" required="" name="uploadFile" class="form-control-file border">
            <br>
            <a href="<?php echo base_url(); ?>assets/templatefile/TemplateUpload1.xlsx" class="btn btn-success ml-2" download><i class="mdi mdi-file-excel-box"></i>Download Template </a>
            <button type="submit" class="btn btn-danger float-right mb-3">Upload </button>
          </div>
        </form>
      </div>
    </div>
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
                dom: '<"row"<"col-12 "<"col-9"f><"col-3"B>>>rt<"row"<"col-6"l><"col-6"p>>',
                buttons: [
                {
                 "text": '<i class="fa fa-plus"></i>&nbsp;Add Task',
                 "className": 'btn btn-sm btn-danger bg-orange mr-1',
                 action: function ( e, dt, button, config ) {
                  window.location = '<?php echo base_url('TaskAssignment/TaskAssignmentadd'); ?>';
                }
              },
              {
                "text": '<i class="fa fa-upload"></i>&nbsp;Upload Task',
                "className": 'btn btn-sm btn-success bg-green upload',
                action: function ( e, dt, button, config ) {
                  $('#myModal').modal();
                }
              },],
              columnDefs        : [{
                'searchable'    : false,
                "orderable"     : false,
                'targets'       : [0, 5]
              }],
              
              "order": [[ 1, 'asc' ]]
            });
      t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
        } );
      } ).draw();
    })

  </script>