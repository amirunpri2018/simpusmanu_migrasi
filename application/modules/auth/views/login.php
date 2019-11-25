<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>S. I. M. | Login</title>
        <link href='<?php echo base_url("assets/images/favicon.ico"); ?>' rel='shortcut icon' type='image/x-icon'/>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" >
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">  
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>" rel="stylesheet">        
        <!-- iCheck -->
        <link href="<?php echo base_url('assets/js/plugins/iCheck/square/blue.css'); ?>" rel="stylesheet"> 
        <link href="<?php echo base_url('assets/css/main_style.css'); ?>" rel="stylesheet" >

    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/images/' . $this->session->userdata('logo')); ?>" alt="Kopkar picture">
                <a href="#" ><b class="primary-color">S.I.M. </b><?php echo $this->session->userdata('nama') ?></a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg text-bold"> Login Dengan User & Password Anda</p>
                <div id="infoMessage">
                    <?php
                    echo form_open('auth/index');
                    if (validation_errors() || $this->session->flashdata('error')) {
                        ?>
                        <?php echo "<span class='red-text' >" . validation_errors() . "</span>" ?>                                        
                        <?php echo "<span class='red-text' >" . $this->session->flashdata('error') . "</span>" ?>

                    <?php } ?>                   
                    <div class="form-group has-feedback">
                        <input type="text" name="username" class="form-control" placeholder="Username"  autofocus required oninvalid="setCustomValidity('Username Invalid')"  oninput="setCustomValidity('')"/>
                        <span class="glyphicon  glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required oninvalid="setCustomValidity('Password tidak boleh kosong')"  oninput="setCustomValidity('')"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">    
                            <div class="checkbox icheck">

                            </div>                        
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" name='submit' class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div><!-- /.col -->
                    </div>

                    <a href="<?php echo base_url('web'); ?>">[Kembali kehalaman Portal]</a><br> 
                </div><!-- /.login-box-body -->
            </div><!-- /.login-box -->

            <script src="<?php echo base_url('assets/js/jQuery-2.1.4.min.js'); ?>"></script> 
            <!-- Bootstrap 3.3.2 JS -->
            <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script> 

            <script src="<?php echo base_url('assets/js/icheck.min.js'); ?>"></script>       

    </body>
</html>
