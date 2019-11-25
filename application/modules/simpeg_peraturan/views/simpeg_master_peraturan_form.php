<section class='content-header'>
    <h1>
        PERATURAN PEGAWAI
        <small>Form Peraturan Pegawai</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Form Input Peraturan</li>
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
                                <div class='form-group'>Nama Peraturan <?php echo form_error('nama_peraturan') ?>
                                    <input type="text" class="form-control" name="nama_peraturan" id="nama_peraturan" placeholder="Nama Peraturan" value="<?php echo $nama_peraturan; ?>" />
                                </div></div><div class='box-footer'>
                                <input type="hidden" name="id_peraturan" value="<?php echo $id_peraturan; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('simpeg_peraturan') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->