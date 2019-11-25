<section class='content-header'>
    <h1>
        MASTER PELATIHAN & SEMINAR
        <small>Form Master Pelatihan & Seminar</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Master</a></li>
        <li class='active'>Form Input Pelatihan & Seminar</li>
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
                                <div class='form-group'>Nama Pelatihan <?php echo form_error('nama_pelatihan') ?>
                                    <input type="text" class="form-control" name="nama_pelatihan" id="nama_pelatihan" placeholder="Nama Pelatihan" value="<?php echo $nama_pelatihan; ?>" />
                                </div>                                
                                <div class="form-group">
                                    Jenis <?php echo form_error('jenis_pelatihan'); ?>
                                    <select name="jenis_pelatihan" id="jenis_pelatihan" class="form-control " >
                                        <option value='<?php echo $jenis_pelatihan ?>'><?php echo strtoupper($jenis_pelatihan) ;'selected' ?></option> 
                                        <option value='Pelatihan'>PELATIHAN</option>
                                        <option value='Seminar'>SEMINAR</option>                                        
                                    </select>                                    
                                </div>   
                                <div class='form-group'>Level Pelatihan <?php echo form_error('level_pelatihan') ?>
                                    <input type="text" class="form-control" name="level_pelatihan" id="level_pelatihan" placeholder="Level Pelatihan" value="<?php echo $level_pelatihan; ?>" />
                                </div></div><div class='box-footer'>
                                <input type="hidden" name="id_pelatihan" value="<?php echo $id_pelatihan; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('simpeg_pelatihan') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->