<section class='content-header'>
    <h1>
        SIFAT SURAT
        <small>Form</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Sifat Surat</li>
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
                        <form action="<?php echo $action; ?>" method="post"><div class='box-body'>
                                <div class='form-group'>Kode Sifat <?php echo form_error('kode_sifat') ?>
                                    <input type="text" class="form-control" name="kode_sifat" id="kode_sifat" placeholder="Kode Sifat" value="<?php echo $kode_sifat; ?>" />
                                </div>
                                <div class='form-group'>Sifat Surat <?php echo form_error('sifat_surat') ?>
                                    <input type="text" class="form-control" name="sifat_surat" id="sifat_surat" placeholder="Sifat Surat" value="<?php echo $sifat_surat; ?>" />
                                </div></div><div class='box-footer'>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('sip_master_sifat') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->