<section class='content-header'>
    <h1>
        UNIT KERJA
        <small>Form Unit Kerja</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Form Input unit kerja</li>
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
                                <div class='form-group'>Nama Unit Kerja <?php echo form_error('nama_unitkerja') ?>
                                    <input type="text" class="form-control" name="nama_unitkerja" id="nama_unitkerja" placeholder="Nama Unitkerja" value="<?php echo $nama_unitkerja; ?>" />
                                </div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id_unitkerja" value="<?php echo $id_unitkerja; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('simpeg_unit_kerja') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->