<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style-step.css">
<div class="container mt-4"> 
	<div class="card">
		<div class="card-body"> 
			
      <div class="row">
        <div class="col">
         <h4 class="text-body pb-4">Template Selection</h4>
       </div>
       <div class="col-2">
         <a href="#">
          <button type="button" class="btn btn-danger btn-block float-right" style="background-color: #f4a23c; border: none; border-radius: 15px; width: 110px;">Custom &#9998;</button>
        </a>
      </div>
    </div>
    <div class="row ">
      <?php foreach ($list_template->data as $t) {?>
        <div class="col-3 text-center mb-3">                
          <a href="#" data-toggle="modal" data-target="#mymodal" data-template="<?php echo $t->template_name?>" data-id_template= "<?php echo $t->id_template ?>">
            <button type="button" class="btn btn-outline-danger text-template" value="<?php echo $t->id_template ?>">
              <img src="<?php echo base_url(); ?>assets/img/ic-template2-x.png">
              <br><?php echo $t->template_name ?>
            </button>
          </a>
        </div>
      <?php }?>  
    </div>
    <!-- MODAL POP UP -->
    <div class="modal fade" id="mymodal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <input type="text" name="" id="template_name" disabled="" style="color:black; border: none; background-color: transparent; ">
            <button class="close" type="button" data-dismiss="modal">x</button>
          </div>
          <div class="modal-body">
            <div class="container text-center">
              <embed src="https://drive.google.com/viewerng/viewer?embedded=true&url=http://118.97.82.223:8181/ereport/assets/report/%5bCustomerName%5d_%5bTemplateName%5d_%5bReportPeriode%5d.pdf" width="100%" height="600px">
              </div>
            </div>
          </div><!-- end .modal-content -->
        </div><!-- end .modal-dialog -->
      </div><!-- end .modal -->
      <!-- END MODAL -->
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#mymodal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id_template = button.data('id_template')
      //$('#id_currency').val(id_currency);
      var template_name = button.data('template')
      $('#template_name').val(template_name);
      $('.modal-title').val(template_name);
      console.log( $('#template_name').val(template_name));
      console.log( $('.template_name').val(template_name));


    }); 
  </script>

  