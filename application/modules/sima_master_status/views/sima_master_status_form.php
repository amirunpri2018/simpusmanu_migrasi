<section class='content-header'>
    <h1>
        FROM STATUS
        <small>Status</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Status</li>
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
                                <div class='form-group'>Status <?php echo form_error('status') ?>
                                    <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                                </div>
                                <div class='form-group'>Keterangan Status <?php echo form_error('keterangan_status') ?>
                                    <input type="text" class="form-control" name="keterangan_status" id="keterangan_status" placeholder="Keterangan Status" value="<?php echo $keterangan_status; ?>" />
                                </div></div><div class='box-footer'>
                                <input type="hidden" name="id_status" value="<?php echo $id_status; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('sima_master_status') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->