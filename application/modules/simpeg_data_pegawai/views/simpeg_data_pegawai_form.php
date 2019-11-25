<section class='content-header'>
    <h1>
        DATA PEGAWAI
        <small>Form Data Pegawai</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data Pegawai</a></li>
        <li class='active'>Form Input data Pegawai</li>
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
                        <?php
                        echo form_open('simpeg_data_pegawai/create_action');
                        ?> 
                        <div class='box-body'>
                            <div class='form-group'>
                                <label>NIK</label> <?php echo form_error('nip') ?>
                                <input type="text" class="form-control" name="nip" id="nip" placeholder="Nomor Induk Karyawan" value="<?php echo $nip; ?>" />
                            </div>                                
                            <div class='form-group'>
                                <label>Nama Pegawai</label>  <?php echo form_error('nama_pegawai') ?>
                                <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" placeholder="Nama Pegawai" value="<?php echo $nama_pegawai; ?>" />
                            </div>
                            <div class='form-group'>
                                <label>Tempat Lahir</label> <?php echo form_error('tempat_lahir') ?>
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>" />
                            </div>                            
                            <div class="form-group"><label>Tanggal Lahir</label> <?php echo form_error('tanggal_lahir') ?>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" name="tanggal_lahir" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                </div>
                            </div>
                            <div class='form-group'>
                                <label>Jenis Kelamin </label><?php echo form_error('jenis_kelamin') ?>
                                <select name="jenis_kelamin" class="form-control " >
                                    <option value='Laki-Laki'>Laki-Laki</option>
                                    <option value='Perempuan'>Perempuan</option>
                                </select>
                            </div>
                            <div class='form-group'>
                                <label>Alamat</label> <?php echo form_error('alamat') ?>
                                <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                            </div>
                            <div class='form-group'>
                                <label>Agama </label><?php echo form_error('agama') ?>
                                <select name="agama" class="form-control " >
                                    <?php
                                    if (!empty($agama)) {
                                        foreach ($agama as $row) {
                                            echo "<option value=" . $row->agama . ">" . strtoupper($row->agama) . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Unite Kerja / Bagian</label><?php echo form_error('unitkerja', '<div class="text-red">', '</div>'); ?>
                                <div class="form-group">
                                    <select name="unitkerja" class="form-control" id="inputError">
                                        <?php
                                        if (!empty($unitkerja)) {
                                            foreach ($unitkerja as $row) {
                                                echo "<option value=" . $row->id_unitkerja . ">" . $row->nama_unitkerja . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>                                                          
                                </div>  
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label><?php echo form_error('jabatan', '<div class="text-red">', '</div>'); ?>
                                <div class="form-group">
                                    <select name="jabatan" class="form-control">
                                        <?php
                                        if (!empty($jabatan)) {
                                            foreach ($jabatan as $row) {
                                                echo "<option value=" . $row->id . ">" . $row->nama_jabatan . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>                                                          
                                </div>  
                            </div>
                            <div class="form-group">
                                <label>Status Pegawai</label><?php echo form_error('status', '<div class="text-red">', '</div>'); ?>
                                <div class="form-group">
                                    <select name="status" class="form-control" id="inputError">
                                        <?php
                                        if (!empty($status)) {
                                            foreach ($status as $row) {
                                                echo "<option value=" . $row->id_status . ">" . $row->nama_status . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>                                                          
                                </div>  
                            </div>   
                        </div>
                        <div class='box-footer'>                            
                            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                            <a href="<?php echo site_url('simpeg_data_pegawai') ?>" class="btn btn-default">Cancel</a>
                        </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->