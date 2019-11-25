
<section class='content-header'>
	<h1>
		SIAK_AKTIVITAS_MENGAJAR
		<small>Daftar Siak_aktivitas_mengajar</small>
	</h1>
	<ol class='breadcrumb'>
		<li><a href='#'><i class='fa fa-suitcase'></i>Seting</a></li>
		<li class='active'>Daftar Siak_aktivitas_mengajar</li>
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
	    <div class='form-group'>Nip <?php echo form_error('nip') ?>
            <input type="text" class="form-control" name="nip" id="nip" placeholder="Nip" value="<?php echo $nip; ?>" />
        </div>
	    <div class='form-group'>Periode <?php echo form_error('periode') ?>
            <input type="text" class="form-control" name="periode" id="periode" placeholder="Periode" value="<?php echo $periode; ?>" />
        </div>
	    <div class='form-group'>Progam Studi <?php echo form_error('progam_studi') ?>
            <input type="text" class="form-control" name="progam_studi" id="progam_studi" placeholder="Progam Studi" value="<?php echo $progam_studi; ?>" />
        </div>
	    <div class='form-group'>Matakuliah <?php echo form_error('matakuliah') ?>
            <input type="text" class="form-control" name="matakuliah" id="matakuliah" placeholder="Matakuliah" value="<?php echo $matakuliah; ?>" />
        </div>
	    <div class='form-group'>Kelas <?php echo form_error('kelas') ?>
            <input type="text" class="form-control" name="kelas" id="kelas" placeholder="Kelas" value="<?php echo $kelas; ?>" />
        </div>
	    <div class='form-group'>Rencana <?php echo form_error('rencana') ?>
            <input type="text" class="form-control" name="rencana" id="rencana" placeholder="Rencana" value="<?php echo $rencana; ?>" />
        </div>
	    <div class='form-group'>Realisasi <?php echo form_error('realisasi') ?>
            <input type="text" class="form-control" name="realisasi" id="realisasi" placeholder="Realisasi" value="<?php echo $realisasi; ?>" />
        </div></div><div class='box-footer'>
	    <input type="hidden" name="id_mengajar" value="<?php echo $id_mengajar; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('siak_aktivitas_mengajar') ?>" class="btn btn-default">Cancel</a>
	 </div>
            </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>
</section><!-- /.content -->