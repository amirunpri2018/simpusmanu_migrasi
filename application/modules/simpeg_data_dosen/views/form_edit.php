<section class='content-header'>
    <h1>
        UPDATE DATA DOSEN
        <small>Form Data Dosen</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data Dosen</a></li>
        <li class='active'>Form Input data Dosen</li>
    </ol>
</section>        
<section class='content'>
    <div class='row'>
        <!-- left column -->
        <div class='col-md-12'>
            <!-- general form elements -->
            <div class='box box-primary'>
                <div class='box-header'>
                    <?php
                    echo form_open_multipart('simpeg_data_dosen/update');
                    ?> 
                    <table class="table">
                        <tr>
                            <td style="width:15%"><label>NIK</label></td>
                        <input type="hidden" name="id_pegawai" value="<?php echo $pegawai['id_pegawai']; ?>"  >
                        <input type="hidden" name="nip_pegawai" value="<?php echo $pegawai['nip']; ?>"  >
                        <td>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="nip" disabled id="nip" placeholder="Nomor Induk Pegawai" value="<?php echo $pegawai['nip']; ?>" />                         
                                <?php echo form_error('nip') ?>
                            </div>                        
                        </td>
                        </tr>
                        <tr>
                            <td><label>NIDN</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nidn" id="nama_pegawai" placeholder="NIDN" value="<?php echo $pegawai['nidn']; ?>" />
                                   
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Nama Pegawai</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" placeholder="Nama Pegawai" value="<?php echo $pegawai['nama_pegawai']; ?>" />
                                    <?php echo form_error('nama_pegawai') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Gelar Depan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="gelar_depan" id="nama_pegawai" placeholder="Gelar Depan" value="<?php echo $pegawai['gelar_depan']; ?>" />
                                   
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Gelar Belakang</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="gelar_belakang" id="nama_pegawai" placeholder="Gelar Belakang" value="<?php echo $pegawai['gelar_belakang']; ?>" />
                                   
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Tempat Lahir</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $pegawai['tempat_lahir']; ?>" />
                                    <?php echo form_error('tempat_lahir') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Tanggal Lahir</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" name="tanggal_lahir" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask value="<?php echo tgl_indo($pegawai['tanggal_lahir']); ?>">
                                    </div>                                    
                                    <?php echo form_error('tanggal_lahir') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Jenis Kelamin</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <select name="jenis_kelamin" class="form-control " >
                                        <?php
                                        if ($pegawai['jenis_kelamin'] == "Laki-Laki") {
                                            echo "<option value='Laki-Laki' selected>Laki-Laki</option> 
                                               <option value='Perempuan'>Perempuan</option>";
                                        } else {
                                            echo "<option value='Laki-Laki' >Laki-Laki</option> 
                                               <option value='Perempuan' selected>Perempuan</option>";
                                        }
                                        ?>
                                    </select>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Alamat Lengkap</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $pegawai['alamat']; ?></textarea>
                                    <?php echo form_error('alamat') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Agama</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <select name="agama" class="form-control " >
                                        <?php
                                        foreach ($agama as $k) {
                                            echo "<option value='$k->agama'";
                                            echo $pegawai['agama'] == $k->agama ? 'selected' : '';
                                            echo">" . strtoupper($k->agama) . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('agama') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Unit Kerja/ Bagian</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <select name="unitkerja" class="form-control" >
                                        <?php
                                        foreach ($unitkerja as $row) {
                                            echo "<option value='$row->id_unitkerja'";
                                            echo $pegawai['id_unitkerja'] == $row->id_unitkerja ? 'selected' : '';
                                            echo">" . $row->nama_unitkerja . "</option>";
                                        }
                                        ?>
                                    </select> 
                                    <?php echo form_error('unitkerja') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Jabatan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <select name="jabatan" class="form-control">
                                        <?php
                                        foreach ($jabatan as $row) {
                                            echo "<option value='$row->id'";
                                            echo $pegawai['id_jabatan'] == $row->id ? 'selected' : '';
                                            echo">" . $row->nama_jabatan . "</option>";
                                        }
                                        ?>
                                    </select> 
                                    <?php echo form_error('jabatan') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>SK Jabatan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" name="nomor_sk" class="form-control" value="<?php echo $pegawai['nomor_sk_jabatan']; ?>"  >
                                    <?php echo form_error('nomor_sk') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Status Dosen</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <select name="status" class="form-control" id="inputError">
                                        <?php
                                        foreach ($status as $row) {
                                            echo "<option value='$row->id_status'";
                                            echo $pegawai['id_status'] == $row->id_status ? 'selected' : '';
                                            echo">" . $row->nama_status . "</option>";
                                        }
                                        ?>
                                    </select> 
                                    <?php echo form_error('status') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Tanggal Masuk</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" name="tanggal_masuk" id="datepicker" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask value="<?php echo tgl_indo($pegawai['tanggal_masuk']); ?>">
                                    </div>                                      
                                    <?php echo form_error('tanggal_masuk') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>No. NPWP</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" name="npwp" class="form-control" value="<?php echo $pegawai['no_npwp']; ?>"  >
                                    <?php echo form_error('npwp') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Keahlian</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" name="keahlian" class="form-control" value="<?php echo $pegawai['keahlian']; ?>"  >
                                    <?php echo form_error('keahlian') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Catatan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <textarea class="form-control" rows="3" name="catatan"  placeholder="catatan "><?php echo $pegawai['catatan']; ?></textarea>
                                    <?php echo form_error('catatan') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Foto</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="file" name="userfile" id="exampleInputFile">
                                    <p class="help-block">Type gambar harus .jpg/.png</p>
                                </div>                        
                            </td>
                        </tr>
                    </table>
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button> 
                        <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
                    </div>
                    </form>  
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->