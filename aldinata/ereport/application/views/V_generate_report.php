
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script type="text/javascript">

</script>
<style>
    .ui-datepicker-calendar {
        display: none;
    }
</style>

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

            <h4 class="text-body mb-4">Report Generator</h4>
            <form id="regForm" method="POST" action="<?php echo base_url(); ?>Report/ReportGenerate/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>">
                <div class="row mb-4 justify-content-center" style="text-align:center;">
                    <span class="col-4 step text-white">Template</span>
                    <span class="col-4 step text-white">Information</span>
                    <span class="col-4 step text-white">Insight</span>
                </div>

                <!-- Template Select -->
                <div class="tab"> 
                    <div class="row btn-group btn-group-toggle" data-toggle="buttons">
                        <?php foreach($list_template->data as $t) {?>
                            <div class="col-4 mb-3">
                                <label class="btn btn-outline-danger pt-2 pr-4 pl-1 text-template" data-id_template="<?php echo $t->id_template ?>"  id="temp<?php echo $t->id_template ?>" onclick="myFunction(<?php echo $t->id_template ?>)">
                                    <input type="radio" style="visibility:hidden;" name="id_template" id="id_template" autocomplete="off" checked="" value="<?php echo $t->id_template ?>">
                                    <img src="<?php echo base_url(); ?>assets/img/ic-template2-x.png">
                                    <br><?php echo $t->template_name;  ?>
                                </label>
                            </div>
                        <?php }?> 
<!--                     <div class="col-4 mb-3">
                        <label class="btn btn-outline-danger pt-2 pr-4 pl-1 text-template">
                            <input type="radio" style="visibility:hidden;" name="options" id="option2" autocomplete="off">
                            <img src="<?php //echo base_url(); ?>assets/img/ic-template1-c.png">
                            <br>Manage Service
                        </label>                
                    </div> -->
                </div>
            </div>
            <!-- End Template Select -->
            
            <!-- Information Insert -->
            <div class="tab">
                <div class="form-group row mt-4">
                    <label class="col-sm-3 offset-sm-1 col-form-label">
                        <i class="fa fa-font text-orange"></i>&nbsp;Report Title*
                    </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" pattern="^[A-Za-z0-9](?!.*?[^\nA-Za-z0-9\s)(\/.#_-]).*?[A-Za-z0-9\s)(]*$" maxlength="100" name="report_title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 offset-sm-1 col-form-label">
                        <i class="fa fa-list-ol text-orange"></i>&nbsp;Report Number*
                    </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" pattern="^[A-Za-z0-9](?!.*?[^\nA-Za-z0-9\s)(\/.#_-]).*?[A-Za-z0-9\s)(]*$" maxlength="50" name="report_number" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 offset-sm-1 col-form-label">
                        <i class="fa fa-list-ol text-orange"></i>&nbsp;Agreement Number*
                    </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" pattern="^[A-Za-z0-9](?!.*?[^\nA-Za-z0-9\s)(\/.#_-]).*?[A-Za-z0-9\s)(]*$" maxlength="50" name="agreement_number" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 offset-sm-1 col-form-label">
                        <i class="fa fa-align-center text-orange"></i>&nbsp;Subject*
                    </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" pattern="^[A-Za-z0-9](?!.*?[^\nA-Za-z0-9\s)(\/.#_-]).*?[A-Za-z0-9\s)(]*$" maxlength="100" name="subject" required>
                    </div>
                </div>
                <div class="form-group row text-center">
                    <label class="col-sm-3 offset-sm-1 col-form-label text-left">
                        <i class="fa fa-calendar text-orange"></i>&nbsp;Report Period*
                    </label>
                    <div class="col-sm-1">
                        <input class="unstyled date-picker" onkeypress="return false;"  required="" name="report_periode">
                        <input type="hidden" name="" id="id_template_val">
                    </div>
                    
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 offset-sm-1 col-form-text text-muted">*) required field</label>
                    <!-- <div class="col-sm-7"><input type="submit"></div> -->
                </div>
            </div>
            <!-- End Information Insert -->

            <!-- Insight Insert -->
            <div class="tab">
                <div class="accordion template" id="accordionExample">
                    <!-- Insert 1 -->

                    <!-- <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Executive Summary
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div> -->
                    <!-- Insert 2 -->
                    <!-- <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Application Performance
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div> -->
                    <!-- Insert 3 -->
                    <!-- <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">System Performance
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- End Insight Insert -->

            <div style="overflow:auto;">
                <div style="float:right;">
                    <button class="btn step-btn" style="background-color:  #b53f2f!important;color: white;" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button class="btn step-btn btn-danger bg-orange" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
            </div>

        </form>

    </div>
</div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/form-step.js">
  $(document).ready(function() {
    var today = new Date().toISOString().split('T')[0];
    console.log(today);
    document.getElementsByName("due_date")[0].setAttribute('min', today);

});
</script>
<script type="text/javascript">

//    $("label[id^='temp']").click(function() {
        // var id_template = $(this).data('id_template');
        // var id_customer = <?php //echo $this->uri->segment(4)?>;
        // $.post('<?php //echo base_url(); ?>Report/GenMenu/'+id_customer, {
        //     id_template: id_template,
        // },
        // function(data) {

        //     console.log(data);
        //     console.log('asjdhajsdhjashdjash');
        //     $('.template').empty().html(' ');
        //     tambahin list dari data
        //     $('.template').append(data);

        // });
  //  });

  function myFunction(id_template) {
   $('#id_template_val').val(id_template);

   var id_customer = <?php echo $this->uri->segment(4)?>;
   $.post('<?php echo base_url(); ?>Report/GenMenu/'+id_customer, {
    id_template: id_template,
},
function(data) {

    console.log(data);
    console.log('asjdhajsdhjashdjash');
    $('.template').empty().html(' ');
        //tambahin list dari data
        $('.template').append(data);


    });
}


$(function() {
    $('.date-picker').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            console.log(inst.selectedYear);
            console.log(inst.selectedMonth);
            var year = inst.selectedYear;
            var bulan = inst.selectedMonth;
            var montt = bulan + 1;
            var montkemaren = bulan;
            var montbesok = bulan + 2;
            var month = new Array();
            month[0] = "January";
            month[1] = "February";
            month[2] = "March";
            month[3] = "April";
            month[4] = "May";
            month[5] = "June";
            month[6] = "July";
            month[7] = "August";
            month[8] = "September";
            month[9] = "October";
            month[10] = "November";
            month[11] = "December";

            var d = new Date("'"+montt+"'");
            var n = month[d.getMonth()];
            var dkemaren = new Date("'"+montkemaren+"'");
            var nkemaren = month[dkemaren.getMonth()];
            var dbesok = new Date("'"+montbesok+"'");
            var nbesok = month[dbesok.getMonth()];
            // var mon_now = strtotime()

            console.log(montt);

            var id_template = $('#id_template_val').val();


            var id_customer = <?php echo $this->uri->segment(4)?>;
            $.post('<?php echo base_url(); ?>Report/GenMenu/'+id_customer +'/'+montt+'/'+year, {
                id_template: id_template,
            },
            function(data) {

                //console.log(data);
                $('.template').empty().html(' ');
                $('.template').append(data);
                $('.month_now').text(n);
                $('.month_yesterday').text(nkemaren);
                $('.month_tomorrow').text(nbesok);
                console.log(montt);
                console.log(n);

            });

        }

    });
});

</script>