<section class='content-header'>
    <h1>
        DATA ABSENSI
        <small>Form Input Absensi Pegawai</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Absensi</a></li>
        <li class='active'>Form Absensi Pegawai</li>
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
                        <form action="<?php echo $action; ?>" method="post">
                            <div class='box-body'>                                
                                <div class='form-group'>Nama Pegawai <?php echo form_error('id_pegawai') ?>
                                    <select name="id_pegawai" class="form-control " >
                                        <?php
                                        if (!empty($pegawai)) {
                                            foreach ($pegawai as $row) {
                                                echo "<option value=" . $row->id_pegawai . ">" . strtoupper($row->nama_pegawai) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class='form-group'>Tanggal <?php echo form_error('tanggal') ?>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" name="tanggal" placeholder="Tanggal Absensi" id="datepicker" value="<?php echo $tanggal; ?>">
                                    </div>                                       
                                </div>
                                <div class='form-group'>Kehadiran <?php echo form_error('kehadiran') ?>
                                    <select name="kehadiran" class="form-control">
                                        <option value='HADIR' >HADIR</option>
                                        <option value='TIDAK' >TIDAK</option>
                                    </select>                                    
                                </div>
                                <div class='form-group'>Keterangan<?php echo form_error('id_izin') ?>
                                    <select name="id_izin" class="form-control " >
                                        <?php
                                        if (!empty($izin)) {
                                            foreach ($izin as $row) {
                                                echo "<option value=" . $row->id_izin . ">" . strtoupper($row->jenis) . " | " . strtoupper($row->keterangan) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>                                    
                                </div>
                                <div class='form-group'>Dari Tanggal <?php echo form_error('tgl_awal') ?>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" name="tgl_awal" id="datepicker2" placeholder="dd-mm-yy" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask value="<?php echo $tgl_awal; ?>">
                                    </div>                                        
                                </div>
                                <div class='form-group'>Sampai Tanggal <?php echo form_error('tgl_akhir') ?>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" name="tgl_akhir" id="datepicker3" placeholder="dd-mm-yy" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask value="<?php echo $tgl_akhir; ?>">
                                    </div>                                        
                                </div>
                                <div class='form-group'>File Lampiran <?php echo form_error('file') ?>
                                    <input type="file" name="userfile" id="exampleInputFile">
                                    <p class="help-block">Type file harus .jpg/.png /.pdf/.doc /.docx</p>
                                </div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id_absensi" value="<?php echo $id_absensi; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('simpeg_data_absensi') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->