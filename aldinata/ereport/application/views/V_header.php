<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CAPTIV GROUP</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/captiv.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/main.js"></script> -->
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <!-- <script src="<?php echo base_url(); ?>/assets/js/jquery-3.3.1.slim.min.js"></script> -->

</head>

<style type="text/css">
    .unstyled::-webkit-inner-spin-button{
     display: none;
     -webkit-appearance: none;   
 } 

 table.fixed {
  table-layout: auto;
  width: 100%;
  font-size: small;
}
th, td {
  border-bottom: 1px solid #ddd;
}
</style>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>Home"><img src="<?php echo base_url(); ?>assets/img/captiv.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="<?php echo base_url(); ?>Home"><img src="<?php echo base_url(); ?>assets/img/captiv.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse mt-4">
                <ul class="nav navbar-nav" style="font-size: 20px!important">
                    <li class="">
                        <a href="<?php echo base_url(); ?>Home"> <i class="menu-icon fa fa-home"></i><b>Home</b></a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cog"></i><b>Data Master</b></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>DataMaster/DataMasterUsers"><b>Photographers</b></a></li>
                            <!-- <li><a href="<?php //echo base_url(); ?>DataMaster/DataMasterRole">Role</a></li> -->
                            <li><a href="<?php echo base_url(); ?>DataMaster/DataMasterCustomers"><b>Customers</b></a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url(); ?>TaskAssignment"> <i class="menu-icon fa fa-list"></i><b>Task Ordering</b></a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file"></i><b>Report</b></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>Report"><b>Report List</b></a></li>
                            <li><a href="<?php echo base_url(); ?>Report/TemplateReport"><b>Report Template</b></a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-5 float-right">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="<?php echo base_url(); ?>assets/img/admin.png" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu">
                            <?php echo $this->session->userdata('user_name') ?>
                            <br>
                            <!-- <h6 class="ml-3 mt-0"><?php echo $this->session->userdata('user_email');?></h6> -->
                            <h6 class="nav-link" style="color: red"><?php echo $this->session->userdata('profile_name');?></h6>
                            <a class="nav-link" href="<?php echo base_url() . "dataMaster/editUser/" . $this->session->userdata('id_user'); ?>"><i class="fa fa-user"></i> My Profile</a>
                            

                            <!-- <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span class="count">13</span></a> -->

                            <!-- <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a> -->

                            <a class="nav-link" href="<?php echo base_url()?>Login/logout"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <script type="text/javascript">

            $(document).ready(function() {
                $('#example').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bInfo": false,
                    "bAutoWidth": false });
            });

            $(document).ready(function() {
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bInfo": false,
                    "bAutoWidth": false });
            });
        </script>