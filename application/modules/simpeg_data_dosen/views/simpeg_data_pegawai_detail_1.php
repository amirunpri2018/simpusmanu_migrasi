<section class='content-header'>
    <h1>
        DETAIL DATA DOSEN
        <small><?php echo strtoupper($pegawai['nama_pegawai']) ?></small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data</a></li>
        <li class='active'>Dosen</li>
    </ol>
</section>  
<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <div align="center">                        
                        <img class="img-responsive avatar-view"  src="<?php echo base_url('upload/profiles/' . $pegawai['foto']); ?>" width="200" heigth="200" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center"><?php echo strtoupper($pegawai['nama_pegawai']) ?></h3>

                    <p class="text-muted text-center"><?php echo $jabatan['nama_jabatan'] ?></p>

                    <ul class="list-group list-group-unbordered">                        
                        <li class="list-group-item">
                            <b>Tempat Lahir</b> <a class="pull-right"><?php echo $pegawai['tempat_lahir'] ?></a>
                        </li>
                         <li class="list-group-item">
                            <b>Tgl Lahir</b> <a class="pull-right"><?php echo tgl_indo($pegawai['tanggal_lahir']) ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Jenis Kelamin</b> <a class="pull-right"><?php echo $pegawai['jenis_kelamin'] ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Agama</b> <a class="pull-right"><?php echo $pegawai['agama'] ?></a>
                        </li>
                    </ul>

                    <a href="<?php echo base_url('siak_data_dosen/update/' . $pegawai['id_pegawai']); ?>" class="btn btn-primary btn-block"><b>Edit</b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> Pendidikan</strong>
                    <p class="text-muted">
                        <?php echo $pend_akhir['tingkat_pendidikan'],"- ".$pend_akhir['nama_sekolah']," - ".$pend_akhir['alamat_sekolah'];?>
                    </p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat Lengkap</strong>
                    <p class="text-muted"><?php echo $pegawai['alamat'] ?></p>
                    <hr>
                    <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
                    <p>
                        <?php echo $pegawai['keahlian'] ?>
                    </p>
                    <hr>
                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                    <p><?php echo $pegawai['catatan'] ?></p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#pegawai" data-toggle="tab" aria-expanded="true">Detail Dosen</a></li>
                    <li class=""><a href="#pendidikan" data-toggle="tab" aria-expanded="false">Riwayat Pendidikan</a></li>
                    <li class=""><a href="#pelatihan" data-toggle="tab" aria-expanded="false">Pelatihan</a></li>
                    <li class=""><a href="#penghargaan" data-toggle="tab" aria-expanded="false">Penghargaan</a></li>
                    <li class=""><a href="#jabatan" data-toggle="tab" aria-expanded="false">Riwayat Jabatan</a></li>
                    <li class=""><a href="#keluarga" data-toggle="tab" aria-expanded="false">Keluarga</a></li>
                    <li class=""><a href="#penilaian" data-toggle="tab" aria-expanded="false">Penilaian</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="pegawai">
                        <div class="row">
                            <div class="col-md-10 ">                        
                                <br>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td style="text-align:right">NIP :</td>
                                            <td><?php echo $pegawai['nip'] ?></td>                    
                                        </tr>                                        
                                        <tr>
                                            <td style="text-align:right ">Nama Dosen:</td>
                                            <td style="width:65%"><?php echo $pegawai['gelar_depan'].' '.strtoupper($pegawai['nama_pegawai'].' '.$pegawai['gelar_belakang']) ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:right">NIDN :</td>
                                            <td><?php echo $pegawai['nidn'] ?></td>                    
                                        </tr>
                                        <tr>
                                            <td style="text-align:right">Tanggal Masuk :</td>
                                            <td><?php echo tgl_lengkap($pegawai['tanggal_masuk']) ?></td>                    
                                        </tr>
                                        <tr>
                                            <td style="text-align:right">Nomor NPWP :</td>
                                            <td><?php echo $pegawai['no_npwp'] ?></td>                    
                                        </tr>
                                        <tr>
                                            <td style="text-align:right">Status Aktif :</td>
                                            <td><?php echo $status['nama_status'] ?></td>                    
                                        </tr>
                                        <tr>
                                            <td style="text-align:right">Unit Kerja / Bagian :</td>
                                            <td><?php echo $unitkerja['nama_unitkerja'] ?></td>                    
                                        </tr>
                                        <tr>
                                            <td style="text-align:right">Jabatan :</td>
                                            <td><?php echo $jabatan['nama_jabatan'] ?></td>                    
                                        </tr>
                                        <tr>
                                            <td style="text-align:right">No. SK Jabatan :</td>
                                            <td><?php echo $pegawai['nomor_sk_jabatan'] ?></td>                    
                                        </tr>
                                        
                                        <tr>
                                            <td style="text-align:right">Alamat Lengkap :</td>
                                            <td><?php echo $pegawai['alamat'] ?></td>                    
                                        </tr>
                                        <tr>
                                            <td style="text-align:right">No. SK Jabatan :</td>
                                            <td><?php echo $pegawai['nomor_sk_jabatan'] ?></td>                    
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="pendidikan">

                        <strong><i class="fa fa-book margin-r-5"></i> RIWAYAT PENDIDIKAN [ <a><?php echo anchor('siak_data_dosen/addpendidikan/' . $pegawai['id_pegawai'], 'Add New') ?></a> ]</strong>                            
                        <br><br>
                        <table class="table ">
                            <tbody>
                                <tr>
                                    <td><label>Jenjang</label></td>
                                    <td><label>Nama Sekolah</label></td>
                                    <td><label>Jurusan</label></td>
                                    <td><label>Tahun Masuk</label></td>
                                    <td><label>Tahun Lulus</label></td>
                                    <td><label>No. Ijasah</label></td>
                                    <td><label>Alamat</label></td>
                                    <td><label>Aksi</label></td>                              
                                </tr>
                                <?php
                                foreach ($pendidikan as $row) {
                                    echo"
                                        <tr>                                     
                                            <td>" . $row->tingkat_pendidikan . "</td>
                                            <td>" . $row->nama_sekolah . "</td>
                                            <td>" . $row->jurusan . "</td>                                      
                                            <td>" . $row->tahun_masuk . "</td>  
                                            <td>" . $row->tahun_lulus . "</td>
                                            <td>" . $row->nomor_ijasah . "</td>
                                            <td>" . $row->alamat_sekolah . "</td>
                                            <td>" . anchor('siak_data_dosen/editpendidikan/' . $row->id_pendidikan, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                                        </tr> ";
                                }
                                ?>                           
                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="pelatihan">
                        <strong><i class="fa fa-book margin-r-5"></i>PELATIHAN & SEMINAR [ <a><?php echo anchor('siak_data_dosen/addpelatihan/' . $pegawai['id_pegawai'], 'Add New') ?></a> ]</strong>                            
                        <br><br>
                        <table class="table ">
                            <tbody>
                                <tr>
                                    <td><label>Kategori</label></td>
                                    <td><label>Nama</label></td>
                                    <td><label>Tempat</label></td>
                                    <td><label>Tanggal</label></td>
                                    <td><label>Penyelenggara</label></td>
                                    <td><label>Waktu</label></td>
                                    <td><label>Catatan</label></td>
                                    <td><label>Aksi</label></td>                              
                                </tr>
                                <?php
                                foreach ($pelatihan as $row) {
                                    echo"
                                        <tr>                                     
                                            <td>" . $row->jenis_pelatihan . "</td>
                                            <td>" . $row->nama_pelatihan . "</td>
                                            <td>" . $row->nama_lokasi . "</td>                                      
                                            <td>" . tgl_indo($row->tanggal) . "</td>  
                                            <td>" . $row->penyelenggara . "</td>
                                            <td>" . $row->lama_pelatihan . "</td>
                                            <td>" . $row->catatan . "</td>
                                            <td>" . anchor('siak_data_dosen/editpelatihan/' . $row->id_data_pelatihan, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                                        </tr> ";
                                }
                                ?>                           
                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="penghargaan">
                        <strong><i class="fa fa-book margin-r-5"></i>PENGHARGAAN [ <a><?php echo anchor('siak_data_dosen/addpenghargaan/' . $pegawai['id_pegawai'], 'Add New') ?></a> ]</strong>                            
                        <br><br>
                        <table class="table ">
                            <tbody>
                                <tr>
                                    <td><label>Nama Penghargaan</label></td>
                                    <td><label>Nomor</label></td>
                                    <td><label>Tanggal</label></td>
                                    <td><label>Keterangan</label></td>                                    
                                    <td><label>Aksi</label></td>                              
                                </tr>
                                <?php
                                foreach ($penghargaan as $row) {
                                    echo"
                                        <tr>                                     
                                            <td>" . $row->nama_penghargaan . "</td>
                                            <td>" . $row->nomor_penghargaan . "</td>
                                            <td>" . $row->tanggal_penghargaan . "</td>                                      
                                            <td>" . $row->keterangan . "</td>
                                            <td>" . anchor('siak_data_dosen/editpenghargaan/' . $row->id_penghargaan, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                                        </tr> ";
                                }
                                ?>                           
                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="jabatan">
                        <strong><i class="fa fa-book margin-r-5"></i>RIWAYAT JABATAN [ <a><?php echo anchor('siak_data_dosen/addjabatan/' . $pegawai['id_pegawai'], 'Add New') ?></a> ]</strong>                            
                        <br><br>
                        <table class="table ">
                            <tbody>
                                <tr>
                                    <td><label>Jabatan</label></td>
                                    <td><label>Unit Kerja</label></td>
                                    <td><label>Nomor SK</label></td>
                                    <td style="width: 10%"><label>Tgl SK</label></td>                                    
                                    <td style="width: 20%"><label>Periode</label></td>
                                    <td><label>Uraian</label></td>
                                    <td><label>Aksi</label></td>                              
                                </tr>
                                <?php
                                foreach ($riwayatjab as $row) {
                                    echo"
                                        <tr>                                     
                                            <td>" . $row->nama_jabatan . "</td>
                                            <td>" . $row->nama_unitkerja . "</td>
                                            <td>" . $row->nomor_sk . "</td>                                      
                                            <td>" . tgl_balik($row->tanggal_sk) . "</td>  
                                            <td>" . tgl_balik($row->tanggal_mulai) . " s/d " . tgl_balik($row->tanggal_selesai) . "</td>                                            
                                            <td>" . $row->uraian . "</td>
                                            <td>" . anchor('siak_data_dosen/editjabatan/' . $row->id_riwayat_jabatan, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                                        </tr> ";
                                }
                                ?>                           
                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="keluarga">
                        <strong><i class="fa fa-users margin-r-5"></i> DATA KELUARGA [ <a><?php echo anchor('siak_data_dosen/addkeluarga/' . $pegawai['id_pegawai'], 'Add New') ?></a> ]</strong>                            
                        <br><br>
                        <table class="table ">
                            <tbody>
                                <tr>
                                    <td><label>Nama</label></td>
                                    <td><label>Tempat, Tgl Lahir</label></td>
                                    <td><label>Hubungan Keluarga</label></td>
                                    <td><label>Pekerjaan</label></td>
                                    <td><label>Aksi</label></td>                              
                                </tr>
                                <?php
                                foreach ($keluarga as $row) {
                                    echo"
                                                <tr>                                     
                                                  <td>" . $row->nama_keluarga . "</td>
                                                  <td>" . $row->tempat_lahir . ',' . $row->tanggal_lahir . "</td>
                                                  <td>" . $row->status_keluarga . "</td>                                      
                                                  <td>" . $row->pekerjaan . "</td>                                                   
                                                  <td>" . anchor('siak_data_dosen/editkeluarga/' . $row->id_keluarga, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                                                </tr> ";
                                }
                                ?>                           
                            </tbody>
                        </table>
                        </table>
                    </div>
                    
                    <div class="tab-pane" id="penilaian">
                        <strong><i class="fa fa-users margin-r-5"></i>PENILAIAN/CATATAN [ <a><?php echo anchor('siak_data_dosen/addpenilaian/' . $pegawai['id_pegawai'], 'Add New') ?></a> ]</strong>                            
                        <br><br>
                        <table class="table ">
                            <tbody>
                                <tr>                                    
                                    <td><label>Tanggal</label></td>
                                    <td><label>Catatan Pegawai</label></td>                                   
                                    <td><label>Aksi</label></td>                              
                                </tr>
                                <?php
                                foreach ($penilaian as $row) {
                                    echo"
                                                <tr>                                     
                                                  <td>" . tgl_indo($row->tanggal). "</td>                                                                                    
                                                  <td>" . $row->catatan . "</td>                                                   
                                                  <td>" . anchor('siak_data_dosen/editpenilaian/' . $row->id_penilaian, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                                                </tr> ";
                                }
                                ?>                           
                            </tbody>
                        </table>
                        </table>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>