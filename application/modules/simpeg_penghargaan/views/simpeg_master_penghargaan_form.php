<section class='content-header'>
    <h1>
        SIMPEG_MASTER_PENGHARGAAN
        <small>Daftar Simpeg_master_penghargaan</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Seting</a></li>
        <li class='active'>Daftar Simpeg_master_penghargaan</li>
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
                                <div class='form-group'>Nama Penghargaan <?php echo form_error('nama_penghargaan') ?>
                                    <input type="text" class="form-control" name="nama_penghargaan" id="nama_penghargaan" placeholder="Nama Penghargaan" value="<?php echo $nama_penghargaan; ?>" />
                                </div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id_master_penghargaan" value="<?php echo $id_master_penghargaan; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('simpeg_penghargaan') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->