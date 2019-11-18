<style type="text/css">
  .field-icon {
    float: right;
    margin-left: -25px;
    margin-top: -25px;
    position: relative;
    z-index: 2;
  }
</style>  
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style-step.css">
<div class="container mt-4">
	<div class="Card">
   <div class="card-body"> 

    <h4 class="text-body mb-4">Download</h4>

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

    <!-- View Report -->
    <div class="mb-4 text-center">
      <!-- <embed src="<?php echo base_url(); ?>assets/file/template_colo.pdf" type="application/pdf" width="100%" height="600px"></embed> -->
      <!-- <embed src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?php //echo base_url().'assets/report/output.docx' ?>" width="80%" height="700px"> -->
       <!--  <embed src="https://drive.google.com/viewerng/viewer?embedded=true&url=https://ucf041c71cdd4570e31d182ea95e.dl.dropboxusercontent.com/cd/0/get/AlqUBgIMJQ8baq9KUUXjF9D_kwHtcX42G22WFsN7Ft9k4EVl5seugZf3STMQ_1FVoSgRdM-1OG4VZ61DSPAZBLXFUlp169tJBRy5ZV7LhaT1hw/file#" width="80%" height="700px"> -->
        <iframe src="https://docs.google.com/gview?url=http://118.97.82.223:8181/ereport/assets/report/<?php echo substr($report[0]['file_name'],0,-5).'.pdf'?>&embedded=true" style="display: block; width: 100%; height: 400px; border: none;">
        </iframe>
      </div>
      <!-- End View Report -->
      <br>

      <center>
        <a href="<?php echo base_url(); ?>/assets/report/<?php echo $report[0]['file_name']?>" target="_self">
          <button class="btn btn-info">DOWNLOAD REPORT</button>
        </a>
      </center>

    </div>
  </div>
</div>