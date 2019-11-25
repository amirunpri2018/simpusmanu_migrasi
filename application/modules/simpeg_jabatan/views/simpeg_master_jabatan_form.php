<section class='content-header'>
    <h1>
        MASTER JABATAN
        <small>Form Master Jabatan</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Form Input Jabatan</li>
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
                                <div class='form-group'>Nama Jabatan <?php echo form_error('nama_jabatan') ?>
                                    <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" placeholder="Nama Jabatan" value="<?php echo $nama_jabatan; ?>" />
                                </div>
                                <div class='form-group'>Induk Jabatan <?php echo form_error('level_jabatan') ?>
                                    <input type="text" class="form-control" name="level_jabatan" id="level_jabatan" placeholder="Induk Jabatan" value="<?php echo $level_jabatan; ?>" />
                                </div></div><div class='box-footer'>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('simpeg_jabatan') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->