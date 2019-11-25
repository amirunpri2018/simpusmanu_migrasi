<section class='content-header'>
    <h1>
        MASTER KATEGORI
        <small>Form kategori</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Kategori</li>
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
                                <div class='form-group'>Kategori <?php echo form_error('kategori') ?>
                                    <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Kategori" value="<?php echo $kategori; ?>" />
                                </div>
                                <div class='form-group'>Keterangan Kategori <?php echo form_error('keterangan_kategori') ?>
                                    <input type="text" class="form-control" name="keterangan_kategori" id="keterangan_kategori" placeholder="Keterangan Kategori" value="<?php echo $keterangan_kategori; ?>" />
                                </div></div><div class='box-footer'>
                                <input type="hidden" name="id_kategori" value="<?php echo $id_kategori; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('sima_master_kategori') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->