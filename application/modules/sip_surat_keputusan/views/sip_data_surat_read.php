
<section class='content-header'>
	<h1>
		SIP_DATA_SURAT
		<small>Daftar Sip_data_surat</small>
	</h1>
	<ol class='breadcrumb'>
		<li><a href='#'><i class='fa fa-suitcase'></i>Seting</a></li>
		<li class='active'>Daftar Sip_data_surat</li>
	</ol>
</section>   
<section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box box-primary'>
                <div class='box-header'>
                <h3 class='box-title'> Detail Sip_data_surat Read</h3>
        <table class="table table-bordered">
	    <tr><td>Nomor Surat</td><td><?php echo $nomor_surat; ?></td></tr>
	    <tr><td>Kategori Surat</td><td><?php echo $kategori_surat; ?></td></tr>
	    <tr><td>Sifat Surat</td><td><?php echo $sifat_surat; ?></td></tr>
	    <tr><td>Prioritas Surat</td><td><?php echo $prioritas_surat; ?></td></tr>
	    <tr><td>Jenis Surat</td><td><?php echo $jenis_surat; ?></td></tr>
	    <tr><td>Tipe Surat</td><td><?php echo $tipe_surat; ?></td></tr>
	    <tr><td>Asal Surat</td><td><?php echo $asal_surat; ?></td></tr>
	    <tr><td>Tujuan Surat</td><td><?php echo $tujuan_surat; ?></td></tr>
	    <tr><td>Tanggal Surat</td><td><?php echo $tanggal_surat; ?></td></tr>
	    <tr><td>Tanggal Pencatatan</td><td><?php echo $tanggal_pencatatan; ?></td></tr>
	    <tr><td>Nama Pengirim</td><td><?php echo $nama_pengirim; ?></td></tr>
	    <tr><td>Perihal Surat</td><td><?php echo $perihal_surat; ?></td></tr>
	    <tr><td>Isi Surat</td><td><?php echo $isi_surat; ?></td></tr>
	    <tr><td>Id Lokasi</td><td><?php echo $id_lokasi; ?></td></tr>
	    <tr><td>Lampiran</td><td><?php echo $lampiran; ?></td></tr>
	</table>
        <div class='box-footer'>
        <a href="<?php echo site_url('sip_surat_masuk') ?>" class="btn btn-primary">Back</a>
        </div>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->