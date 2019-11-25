<section class='content-header'>
    <h1>
        DATA PEGAWAI
        <small>Seluruh Pegawai</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data</a></li>
        <li class='active'>Pegawai</li>
    </ol>
</section>  
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>                
                    <div class="col-md-4">
                        <?php echo anchor(site_url('simpeg_laporan_pegawai/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?>
                        
                    </div>
                    <div class="col-md-4 text-center">
                        <div style="margin-top: 8px" id="message">
                            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                        </div>
                    </div>
                    <div class="col-md-1 text-right">
                    </div>
                    <div class="col-md-3 text-right">
                        <form action="<?php echo site_url('simpeg_laporan_pegawai/index'); ?>" class="form-inline" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                <span class="input-group-btn">
                                    <?php
                                    if ($q <> '') {
                                        ?>
                                        <a href="<?php echo site_url('simpeg_laporan_pegawai'); ?>" class="btn btn-default">Reset</a>
                                        <?php
                                    }
                                    ?>
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">                         
                        <tr>
                            <th>No</th>
                            <th with="80px">Nip</th>
                            <th>Nama Pegawai</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>Tanggal Masuk</th>  
                            <th>Status</th>
                            <th>Unitkerja</th>
                            <th>Jabatan</th>                        
                            <th>Keahlian</th>
                            <th>Catatan</th>                            
                        </tr><?php
                        foreach ($simpeg_laporan_pegawai_data as $simpeg_laporan_pegawai) {
                            $status=$this->db->get_where('simpeg_master_status_pegawai',array('id_status'=>$simpeg_laporan_pegawai->id_status))->row_array();
                            $jabatan=$this->db->get_where('simpeg_master_jabatan',array('id'=>$simpeg_laporan_pegawai->id_jabatan))->row_array();
                            $unit=$this->db->get_where('simpeg_master_unit_kerja',array('id_unitkerja'=>$simpeg_laporan_pegawai->id_unitkerja))->row_array();
                            ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $simpeg_laporan_pegawai->nip ?></td>
                                <td><?php echo $simpeg_laporan_pegawai->nama_pegawai ?></td>
                                <td><?php echo $simpeg_laporan_pegawai->tempat_lahir ?></td>
                                <td><?php echo tgl_indo($simpeg_laporan_pegawai->tanggal_lahir) ?></td>
                                <td><?php echo $simpeg_laporan_pegawai->jenis_kelamin ?></td>
                                <td><?php echo $simpeg_laporan_pegawai->agama ?></td>
                                <td><?php echo $simpeg_laporan_pegawai->alamat ?></td>
                                <td><?php echo tgl_indo($simpeg_laporan_pegawai->tanggal_masuk) ?></td>
                                <td><?php echo $status['nama_status'] ?></td>
                                <td><?php echo $unit['nama_unitkerja'] ?></td>
                                <td><?php echo $jabatan['nama_jabatan'] ?></td>                               
                                <td><?php echo $simpeg_laporan_pegawai->keahlian ?></td>
                                <td><?php echo $simpeg_laporan_pegawai->catatan ?></td>                                
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <br>            
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-primary">Total Data : <?php echo $total_rows ?></a>
                            
                        </div>
                        <div class="col-md-6 text-right">
                            <?php echo $pagination ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section><!-- /.content -->