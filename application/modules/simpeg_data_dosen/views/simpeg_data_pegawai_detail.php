<section class='content-header'>
    <h1>
        DATA DOSEN
        <small><?php echo strtoupper($pegawai['nama_pegawai']) ?></small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data</a></li>
        <li class='active'>Dosen</li>
    </ol>
</section>  
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Data Dosen</h3>

                </div><!-- /.box-header -->
                <div class="row">
                    <div class="col-md-9">                        
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width:18%">Nama* </td>
                                    <td><?php echo ': ' . strtoupper($pegawai['nama_pegawai']) ?></td> 
                                </tr>                                        
                                <tr>
                                    <td>Tempat Lahir*</td>
                                    <td ><?php echo ': ' . $pegawai['tempat_lahir'] ?></td>
                                    <td style="width:15%"></td>
                                    <td style="width:18%">Tanggal Lahir*</td>
                                    <td><?php echo ': ' . tgl_balik($pegawai['tanggal_lahir']) ?></td> 
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td><?php echo ': ' . $pegawai['jenis_kelamin'] ?></td>  
                                    <td style="width:15%"></td>
                                    <td style="width:18%">Agama*</td>
                                    <td><?php echo ': ' . $agama['agama'] ?></td>
                                </tr> 
                                <tr>
                                    <td>Status Aktif</td>
                                    <td><?php echo ': ' . $status['nama_status'] ?></td>  
                                    <td style="width:15%"></td>
                                    <td style="width:18%">NIDN</td>
                                    <td><?php echo ': ' . $pegawai['nidn'] ?></td>
                                </tr> 

                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div align="center">                        
                        <img class="img-responsive avatar-view"  src="<?php echo base_url('upload/profiles/' . $pegawai['foto']); ?>" width="150" heigth="150" alt="User profile picture">
                    </div>
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#pegawai" data-toggle="tab" aria-expanded="true"><dt>Detail Dosen</dt></a></li>
                                <li class=""><a href="#keluarga" data-toggle="tab" aria-expanded="false"><dt>Keluarga</dt></a></li>
                                <li class=""><a href="#penugasan" data-toggle="tab" aria-expanded="false"><dt>Penugasan</dt></a></li>
                                <li class=""><a href="#mengajar" data-toggle="tab" aria-expanded="false"><dt>Aktivitas Mengajar</dt></a></li>
                                <li class=""><a href="#bimbingan" data-toggle="tab" aria-expanded="false"><dt>Mahasiswa Bimbingan</dt></a></li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                        <dt>Action<span class="caret"></span></dt>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class=""><a href="#pendidikan" data-toggle="tab" aria-expanded="false"><dt>Riwayat Pendidikan</dt></a></li>
                                        <li class=""><a href="#jabatan" data-toggle="tab" aria-expanded="false"><dt>Riwayat Jabatan</dt></a></li>
                                        <li class=""><a href="#sertifikasi" data-toggle="tab" aria-expanded="false"><dt>Riwayat Sertifikasi</dt></a></li>
                                        <li class=""><a href="#penelitian" data-toggle="tab" aria-expanded="false"><dt>Riwayat Penilitian<dt></a></li>
                                        <li class=""><a href="#fungsional" data-toggle="tab" aria-expanded="false"><dt>Riwayat Fungsional<dt></a></li>
                                         <li role="presentation" class="divider"></li>
                                         <li class=""><a role="menuitem" tabindex="-1" href="<?php echo base_url('simpeg_data_dosen/update/' . $pegawai['id_pegawai']) ?>"><dt>Edit Detail Dosen</dt></a></li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="pegawai">
                                    <div class="row">
                                        <div class="col-md-7 ">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align:right">Nama Ibu * </td>
                                                        <td><?php echo': ' . $pegawai['nama_ibu'] ?></td>                    
                                                    </tr>                                                   
                                                    <tr>
                                                        <td style="text-align:right">NIK</td>
                                                        <td><?php echo ': ' . $pegawai['nip'] ?></td>                    
                                                    </tr>                                        
                                                    <tr>
                                                        <td style="text-align:right ">No NPWP</td>
                                                        <td style="width:65%"><?php echo ': ' . $pegawai['no_npwp'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right">Ikatan Kerja</td>
                                                        <td><?php echo ': ' . $pegawai['nidn'] ?></td>                    
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right">Tanggal Masuk</td>
                                                        <td><?php echo ': ' . tgl_balik($pegawai['tanggal_masuk']) ?></td>                    
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right">Status Pegawai </td>
                                                        <td><?php echo ': ' . $pegawai['status_pegawai'] ?></td>                    
                                                    </tr>                                                   
                                                    <tr>
                                                        <td style="text-align:right">Unit Kerja / Bagian</td>
                                                        <td><?php echo ': ' . $unitkerja['nama_unitkerja'] ?></td>                    
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right">Jabatan </td>
                                                        <td><?php echo ': ' . $jabatan['nama_jabatan'] ?></td>                    
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right">No. SK Jabatan</td>
                                                        <td><?php echo ': ' . $pegawai['nomor_sk_jabatan'] ?></td>                    
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right">Tgl SK Jabatan</td>
                                                        <td><?php echo ': ' . tgl_balik($pegawai['tanggal_sk_jabatan']) ?></td>                    
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right">No. SK CPNS</td>
                                                        <td><?php echo ': ' . $pegawai['nomor_sk_jabatan'] ?></td>                    
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right">Tgl SK CPNS</td>
                                                        <td><?php echo ': ' . tgl_balik($pegawai['tanggal_sk_cpns']) ?></td>                    
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right">Alamat Lengkap</td>
                                                        <td><?php echo ': ' . $pegawai['alamat'] ?></td>                    
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right">Kota/Kabupaten</td>
                                                        <td><?php echo ': ' . $pegawai['kota'] ?></td>                    
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right">Telepon/Hp</td>
                                                        <td><?php echo ': ' . $pegawai['telepon'] ?></td>                    
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:right">Email</td>
                                                        <td><?php echo ': ' . $pegawai['email'] ?></td>                    
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="pendidikan">

                                    <strong><i class="fa fa-book margin-r-5"></i> RIWAYAT PENDIDIKAN [ <a><?php echo anchor('simpeg_data_dosen/addpendidikan/' . $pegawai['id_pegawai'], 'Add New') ?></a> ]</strong>                            
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
                                            <td>" . anchor('simpeg_data_dosen/editpendidikan/' . $row->id_pendidikan, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                                        </tr> ";
                                            }
                                            ?>                           
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="pelatihan">
                                    <strong><i class="fa fa-book margin-r-5"></i>PELATIHAN & SEMINAR [ <a><?php echo anchor('simpeg_data_dosen/addpelatihan/' . $pegawai['id_pegawai'], 'Add New') ?></a> ]</strong>                            
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
                                            <td>" . anchor('simpeg_data_dosen/editpelatihan/' . $row->id_data_pelatihan, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                                        </tr> ";
                                            }
                                            ?>                           
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="penghargaan">
                                    <strong><i class="fa fa-book margin-r-5"></i>PENGHARGAAN [ <a><?php echo anchor('simpeg_data_dosen/addpenghargaan/' . $pegawai['id_pegawai'], 'Add New') ?></a> ]</strong>                            
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
                                            <td>" . anchor('simpeg_data_dosen/editpenghargaan/' . $row->id_penghargaan, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                                        </tr> ";
                                            }
                                            ?>                           
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="jabatan">
                                    <strong><i class="fa fa-book margin-r-5"></i>RIWAYAT JABATAN [ <a><?php echo anchor('simpeg_data_dosen/addjabatan/' . $pegawai['id_pegawai'], 'Add New') ?></a> ]</strong>                            
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
                                            <td>" . anchor('simpeg_data_dosen/editjabatan/' . $row->id_riwayat_jabatan, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                                        </tr> ";
                                            }
                                            ?>                           
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="keluarga">
                                    <strong><i class="fa fa-users margin-r-5"></i> DATA KELUARGA [ <a><?php echo anchor('simpeg_data_dosen/addkeluarga/' . $pegawai['id_pegawai'], 'Add New') ?></a> ]</strong>                            
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
                                                  <td>" . $row->tempat_lahir . ',' . tgl_balik($row->tanggal_lahir) . "</td>
                                                  <td>" . $row->status_keluarga . "</td>                                      
                                                  <td>" . $row->pekerjaan . "</td>                                                   
                                                  <td>" . anchor('simpeg_data_dosen/editkeluarga/' . $row->id_keluarga, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                                                </tr> ";
                                            }
                                            ?>                           
                                        </tbody>
                                    </table>
                                    </table>
                                </div>
                                <div class="tab-pane" id="penugasan">
                                    <strong><i class="fa fa-eject margin-r-5"></i> Penugasan Dosen [ <a><?php echo anchor('simpeg_data_dosen/create_penugasan/' . $pegawai['nip'], 'Add New') ?></a> ]</strong>                            
                                    <br><br>
                                    <table class="table ">
                                        <tbody>
                                            <tr>
                                                <td><label>Tahun Ajaran</label></td>
                                                <td><label>Perguruan Tinggi</label></td>
                                                <td><label>Program Studi</label></td>
                                                <td><label>No Surat Tugas</label></td>
                                                <td><label>Tgl Surat Tugas</label></td>
                                                <td><label>TMT Surat Tugas</label></td>
                                                <td><label>Aksi</label></td>                              
                                            </tr>
                                            <?php
                                            foreach ($penugasan as $row) {
                                                echo"
                                                <tr>                                     
                                                  <td>" . $row->tahun_ajaran . "</td>
                                                  <td>" . $row->nama_pt . "</td>
                                                  <td>" . $row->program_studi . "</td>                                      
                                                  <td>" . $row->no_surat_tugas . "</td>  
                                                  <td>" . tgl_balik($row->tgl_surat_tugas) . "</td> 
                                                  <td>" . tgl_balik($row->tmt_surat_tugas) . "</td>
                                                  <td>" . anchor('simpeg_data_dosen/update_penugasan/' . $row->id_penugasan, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                                                </tr> ";
                                            }
                                            ?>                           
                                        </tbody>
                                    </table>
                                    </table>
                                </div>
                                <div class="tab-pane" id="mengajar">
                                    <strong><i class="fa fa-eject margin-r-5"></i> Aktivitas Mengajar [ <a><?php echo anchor('simpeg_data_dosen/create_mengajar/' . $pegawai['nip'], 'Add New') ?></a> ]</strong>                            
                                    <br><br>
                                    <table class="table ">
                                        <tbody>
                                            <tr>
                                                <td><label>No</label></td>
                                                <td><label>Periode</label></td>
                                                <td><label>Program Studi</label></td>
                                                <td><label>Mata Kuliah</label></td>
                                                <td><label>Kelas</label></td>
                                                <td><label>Rencan</label></td>
                                                <td><label>Realisasi</label></td>                              
                                            </tr>
                                            <?php
                                            $no=1;
                                            foreach ($mengajar as $row) {
                                                echo"
                                                <tr>                                     
                                                  <td>" . $no++. "</td>
                                                  <td>" . $row->periode . "</td>
                                                  <td>" . $row->program_studi . "</td>                                      
                                                  <td>" . $row->matakuliah . "</td>  
                                                  <td>" . $row->kelas . "</td> 
                                                  <td>" . $row->rencana . "</td>
                                                  <td>" . $row->realisasi . "</td>                                                  
                                                </tr> ";
                                            }
                                            ?>                           
                                        </tbody>
                                    </table>
                                    </table>
                                </div>

                                <div class="tab-pane" id="penilaian">
                                    <strong><i class="fa fa-users margin-r-5"></i>PENILAIAN/CATATAN [ <a><?php echo anchor('simpeg_data_dosen/addpenilaian/' . $pegawai['id_pegawai'], 'Add New') ?></a> ]</strong>                            
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
                                                  <td>" . tgl_indo($row->tanggal) . "</td>                                                                                    
                                                  <td>" . $row->catatan . "</td>                                                   
                                                  <td>" . anchor('simpeg_data_dosen/editpenilaian/' . $row->id_penilaian, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
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
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>