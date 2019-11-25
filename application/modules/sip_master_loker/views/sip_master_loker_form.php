<section class='content-header'>
    <h1>
        FORM LOKER SURAT
        <small>Form Data Loker</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Form Loker</li>
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
                                <div class='form-group'>Kode Loker <?php echo form_error('kode_loker') ?>
                                    <input type="text" class="form-control" name="kode_loker" id="kode_loker" placeholder="Kode Loker" value="<?php echo $kode_loker; ?>" />
                                </div>
                                <div class='form-group'>Tempat Loker <?php echo form_error('tempat_loker') ?>
                                    <input type="text" class="form-control" name="tempat_loker" id="tempat_loker" placeholder="Tempat Loker" value="<?php echo $tempat_loker; ?>" />
                                </div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('sip_master_loker') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->