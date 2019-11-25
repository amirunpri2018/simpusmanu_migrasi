<section class='content-header'>
    <h1>
        CUTI PEGAWAI
        <small>Form Master cuti</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Form Input Cuti</li>
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
                                <div class='form-group'>Keterangan Cuti <?php echo form_error('ket_cuti') ?>
                                    <input type="text" class="form-control" name="ket_cuti" id="ket_cuti" placeholder="Ket Cuti" value="<?php echo $ket_cuti; ?>" />
                                </div></div><div class='box-footer'>
                                <input type="hidden" name="id_cuti" value="<?php echo $id_cuti; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('simpeg_cuti') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->