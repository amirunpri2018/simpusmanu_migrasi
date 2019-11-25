<section class='content-header'>
    <h1>
        FORM MASTER VISI & MISI
        <small>Form Visi & Misi</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Form Input Visi& Misi</li>
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
                                <div class='form-group'>Visi & Misi <?php echo form_error('visimisi') ?>
                                    <input type="text" class="form-control" name="visimisi" id="visimisi" placeholder="Visimisi" value="<?php echo $visimisi; ?>" />
                                </div></div><div class='box-footer'>
                                <input type="hidden" name="id_visimisi" value="<?php echo $id_visimisi; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('simpeg_visi_misi') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->