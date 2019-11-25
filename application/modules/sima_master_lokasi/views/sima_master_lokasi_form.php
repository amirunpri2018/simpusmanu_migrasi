<section class='content-header'>
    <h1>
        FORM MASTER LOKASI
        <small>Lokasi</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Lokasi</li>
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
                                <div class='form-group'>Lokasi <?php echo form_error('lokasi') ?>
                                    <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="<?php echo $lokasi; ?>" />
                                </div>
                                <div class='form-group'>Keterangan Lokasi <?php echo form_error('keterangan_lokasi') ?>
                                    <input type="text" class="form-control" name="keterangan_lokasi" id="keterangan_lokasi" placeholder="Keterangan Lokasi" value="<?php echo $keterangan_lokasi; ?>" />
                                </div></div><div class='box-footer'>
                                <input type="hidden" name="id_lokasi" value="<?php echo $id_lokasi; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('sima_master_lokasi') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->