<section class='content-header'>
    <h1>
        DATA ABSENSI PEGAWAI
        <small>Daftar Absensi</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data</a></li>
        <li class='active'>Absensi Pegawai</li>
    </ol>
</section>        
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>
                    <div class="col-md-6">
                        <h3 class='box-title'><?php echo anchor('simpeg_data_absensi/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?>
                            <?php echo anchor(site_url('simpeg_data_absensi/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?></h3>
                    </div>                    
                    <div class="col-md-6 ">
                        <?php echo form_open('simpeg_data_absensi'); ?>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>                                    
                                <input type="text" class="form-control" name="tanggal_awal" id="datepicker" placeholder="Dari tanggal" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>                                    
                            </div>
                        </div> 
                        <div class="col-sm-5">
                            <div class="input-group"> 
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div> 
                                <input type="text" class="form-control" name="tanggal_akhir" id="datepicker2" placeholder="Sampai tanggal" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                            </div>
                        </div> 
                        <button class="btn btn-primary" type="submit" name="submit">Search</button>
                        </form>
                    </div>    
                </div><!-- /.box-header -->
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Pegawai</th>
                                <th>Kehadiran</th>
                                <th>Keterangan</th>                               
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($absensi as $simpeg_data_absensi) {
                                $id_pegawai = $simpeg_data_absensi->id_pegawai;
                                $id_izin = $simpeg_data_absensi->id_izin;
                                $pegawai = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id_pegawai))->row_array();
                                $izin = $this->db->get_where('simpeg_master_izin', array('id_izin' => $id_izin))->row_array();
                                ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo tgl_balik($simpeg_data_absensi->tanggal) ?></td>
                                    <td><?php echo $pegawai['nama_pegawai']; ?></td>
                                    <td><?php echo $simpeg_data_absensi->kehadiran ?></td>
                                    <td><?php echo $izin['keterangan']; ?></td>                                 
                                    <td style="text-align:center" width="140px">
                                        <?php
                                        echo anchor(site_url('simpeg_data_absensi/read/' . $simpeg_data_absensi->id_absensi), '<i class="fa fa-eye"></i>', array('data-toggle' => 'tooltip', 'title' => 'detail', 'class' => 'btn btn-info btn-sm'));
                                        echo '  ';
                                        echo anchor(site_url('simpeg_data_absensi/delete/' . $simpeg_data_absensi->id_absensi), '<i class="fa fa-trash-o"></i>', 'data-toggle="tooltip" title="delete" class="btn btn-info btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>					
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script src="<?php echo base_url('assets/datatables/jquery-1.11.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#mytable").dataTable();
    });
</script>
