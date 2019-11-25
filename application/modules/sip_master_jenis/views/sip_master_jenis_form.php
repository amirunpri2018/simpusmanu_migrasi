<section class='content-header'>
    <h1>
        FORM JENIS DOKUMEN SURAT
        <small>Input Jenis Dokumen</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Form Jenis Dokumen</li>
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
                                <div class='form-group'>Jenis Surat <?php echo form_error('jenis_surat') ?>
                                    <input type="text" class="form-control" name="jenis_surat" id="jenis_surat" placeholder="Jenis Dokumen Surat" value="<?php echo $jenis_surat; ?>" />
                                </div>
                                <div class='form-group'>Kode Jenis <?php echo form_error('kode_jenis') ?>
                                    <input type="text" class="form-control" name="kode_jenis" id="kode_jenis" placeholder="Kode Jenis Dokumen" value="<?php echo $kode_jenis; ?>" />
                                </div>
                            </div>
                            <div class='box-footer'>   
                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('sip_master_jenis') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->