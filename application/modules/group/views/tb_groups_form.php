<section class='content-header'>
    <h1>
        Group User
        <small>Form Groups User</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Seting</a></li>
        <li class='active'>Daftar Tb_groups</li>
    </ol>
</section>        
<section class='content'>
    <div class='row'>
        <!-- left column -->
        <div class='col-md-12'>
            <!-- general form elements -->
            <div class='box box-primary'>
                <div class='box-header'>
                    <div class='col-md-5'>
                        <form action="<?php echo $action; ?>" method="post">
                            <div class='box-body'>
                                <div class='form-group'>Usergroup <?php echo form_error('usergroup') ?>
                                    <input type="text" class="form-control" name="usergroup" id="usergroup" placeholder="Usergroup" value="<?php echo $usergroup; ?>" />
                                </div>
                                <div class='form-group'>Description <?php echo form_error('description') ?>
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $description; ?>" />
                                </div>
                                <div class="form-group">Modul Aplikasi <?php echo form_error('apps'); ?>
                                    <select name="apps" id="apps" class="form-control " >
                                        <?php
                                        if ($group_apps == "SIP") {
                                            echo "<option value='SIMPEG'>KEPEGAWAIAN</option> 
                                                    <option value='SIP' selected>INFORMASI PERSURATAN</option>
                                                    <option value='SIMA'>MANAJEMEN ASET</option> 
                                                    <option value='SIAKAD'>SIAKAD</option>";
                                        } else if ($group_apps == "SIMA") {
                                            echo "<option value='SIMPEG'>KEPEGAWAIAN</option> 
                                                    <option value='SIP'>INFORMASI PERSURATAN</option>
                                                    <option value='SIMA' selected>MANAJEMEN ASET</option> 
                                                    <option value='SIAKAD'>SIAKAD</option>";
                                        } else if ($group_apps == "SIAKAD") {
                                            echo "<option value='SIMPEG'>KEPEGAWAIAN</option> 
                                                    <option value='SIP'>INFORMASI PERSURATAN</option>
                                                    <option value='SIMA'>MANAJEMEN ASET</option> 
                                                    <option value='SIAKAD' selected>SIAKAD</option>";
                                        } else {
                                            echo "<option value='SIMPEG' selected>KEPEGAWAIAN</option> 
                                                    <option value='SIP'>INFORMASI PERSURATAN</option>
                                                    <option value='SIMA'>MANAJEMEN ASET</option> 
                                                    <option value='SIAKAD'>SIAKAD</option>";
                                        }
                                        ?>

                                    </select>   
                                </div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="gid" value="<?php echo $gid; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('group') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->