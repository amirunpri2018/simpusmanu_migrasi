<section class='content-header'>
    <h1>
        FORM IZIN PEGAWAI
        <small>Form Master Izin</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Form Input master izin</li>
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
                                <div class='form-group'>Jenis <?php echo form_error('jenis') ?>
                                    <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Cuti, Izin, dll" value="<?php echo $jenis; ?>" />
                                </div>
                                <div class='form-group'>Keterangan <?php echo form_error('ket_izin') ?>
                                    <input type="text" class="form-control" name="keterangan" id="ket_izin" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
                                </div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id_izin" value="<?php echo $id_izin; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('simpeg_izin') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->