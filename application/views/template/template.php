<head>
    <meta charset="UTF-8">
    <title>S. I. M. | <?php echo $this->uri->segment(1); ?></title>
    <link href='<?php echo base_url("assets/images/favicon.ico"); ?>' rel='shortcut icon' type='image/x-icon'/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.3.2 -->        
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" >
    <!--datepicker -->
    <link href="<?php echo base_url('assets/datepicker/datepicker3.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/datepicker/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet" type="text/css">
    <!-- font Awesome -->
    <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">       
    <!-- DATA TABLES -->    
    <link href="<?php echo base_url('assets/css/dataTables.bootstrap.css'); ?>" rel="stylesheet">

    <!-- fullCalendar 2.2.5-->
    <link href='<?php echo base_url('assets/fullcalendar/fullcalendar.min.css'); ?>' rel='stylesheet' />
    <link href='<?php echo base_url('assets/fullcalendar/fullcalendar.print.css'); ?>' rel='stylesheet' media='print' />
    <link href="<?php echo base_url('assets/fullcalendar/bootstrapValidator.min.css'); ?>" rel="stylesheet" />

    <link href="<?php echo base_url(); ?>assets/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-timepicker.min.css" rel="stylesheet" />

    <!-- Theme style -->
    <link href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>" rel="stylesheet">
    <!-- AdminLTE Skins. Choose a skin from the css/skins -->
    <link href="<?php echo base_url('assets/css/skins/_all-skins.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/css/bootstrap-combobox.css'); ?>" rel="stylesheet" type="text/css" >
    <!-- css untuk export datatable -->

</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php echo $_header; ?>

        <?php echo $_sidebar; ?>
        <!-- Right side column. Contains the navbar and content of the page -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php echo $_content; ?> 
        </div><!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.0
            </div>
            <strong>Copyright &copy; 2015-2016 <a href="http://andrianext.web.id">Andrianext</a> - </strong> All rights reserved
        </footer>

        <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url('assets/js/jQuery-2.1.4.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('assets/datatables/jquery.dataTables.min.js'); ?>"></script>
    <!-- Datepicker -->
    <script src="<?php echo base_url('assets/datepicker/bootstrap-datepicker.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datepicker/locales/bootstrap-datepicker.id.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/dataTables.bootstrap.js'); ?>"></script>
    <!-- Datepicker -->
    <script src="<?php echo base_url('assets/datepicker/bootstrap-datetimepicker.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datepicker/locales/bootstrap-datetimepicker.id.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/input-mask/jquery.inputmask.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/input-mask/jquery.inputmask.date.extensions.js') ?>"></script>    

    <script src="<?php echo base_url('assets/js/app.min.js'); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url('assets/js/demo.js'); ?>"></script>
    <!-- treeview -->
    <script src="<?php echo base_url('assets/js/tree-view/jquery.cookie.js'); ?>"></script>  
    <script src="<?php echo base_url('assets/js/tree-view/jquery.treeview.js'); ?>"></script>  
    <script src="<?php echo base_url('assets/js/tree-view/demo.js'); ?>"></script>    
    <script src="<?php echo base_url('assets/js/bootstrap-combobox.js'); ?>"></script>


    <!-- fullCalendar 2.2.5 -->
    <script src='<?php echo base_url('assets/fullcalendar/moment.min.js') ?>'></script>
    <script src="<?php echo base_url('assets/fullcalendar/bootstrapValidator.min.js') ?>"></script>

    <script src="<?php echo base_url('assets/fullcalendar/fullcalendar.min.js') ?>"></script>
    <script src='<?php echo base_url(); ?>assets/js/bootstrap-colorpicker.min.js'></script>
    <script src='<?php echo base_url(); ?>assets/js/bootstrap-timepicker.min.js'></script>
    <script src='<?php echo base_url(); ?>assets/js/main.js'></script>


</body>
<script type="text/javascript">
    $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
        $("[data-mask]").inputmask();
        $('#datepicker').datepicker({
            autoclose: true
        });
        $('#datepicker1').datepicker({
            autoclose: true
        });
        $('#datepicker2').datepicker({
            autoclose: true
        });
        $('#datepicker3').datepicker({
            autoclose: true
        });
        $('#datepicker4').datepicker({
            autoclose: true
        });
        $('#datepicker5').datepicker({
            autoclose: true
        });
        $('#datepicker6').datepicker({
            autoclose: true
        });
        $('#datepicker7').datepicker({
            autoclose: true
        });
        $('#datepicker8').datepicker({
            autoclose: true
        });
        $('#datepicker9').datepicker({
            autoclose: true
        });
        $('#datepicker10').datepicker({
            autoclose: true
        });
        $('#datepicker11').datepicker({
            autoclose: true
        });
        $('#datepicker12').datepicker({
            autoclose: true
        });
        $('#datepicker13').datepicker({
            autoclose: true
        });
        $('#datetimepicker').datetimepicker({
            autoclose: true
        });
        $('#timepicker').timepicker({
            autoclose: true
        });
        $('#timepicker2').timepicker({
            howMeridian: false
        });
    });
</script>



