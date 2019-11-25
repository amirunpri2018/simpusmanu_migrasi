<section class='content-header'>
    <h1>
        DETAIL ABSENSI PEGAWAI
        <small><?php echo $nama_pegawai ?></small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Seting</a></li>
        <li class='active'>Daftar Simpeg_data_absensi</li>
    </ol>
</section>   
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class='box-header'>
                    <br>
                    <table class="table table-bordered">
                        <tr>
                            <td>Tanggal</td>
                            <td><?php echo tgl_lengkap($tanggal); ?></td>
                        </tr>
                        <tr>
                            <td>Nama Pegawai</td>
                            <td><?php echo $nama_pegawai; ?></td>
                        </tr>
                        <tr><td>Kehadiran</td><td><?php echo $kehadiran; ?></td></tr>
                        <tr><td>Izin / Cuti</td><td><?php echo $jenis_izin; ?></td></tr>
                        <tr><td>Keterangan Izin</td><td><?php echo $ket_izin; ?></td></tr>
                        <tr><td>Dari Tanggal</td><td><?php echo tgl_lengkap($tgl_awal); ?></td></tr>
                        <tr><td>Sampai Tanggal</td><td><?php echo tgl_lengkap($tgl_akhir); ?></td></tr>
                        <tr><td>File Lampiran</td><td><?php echo $file; ?></td></tr>
                    </table>
                    <div class='box-footer'>
                        <a href="<?php echo site_url('simpeg_data_absensi') ?>" class="btn btn-primary">Back</a>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->