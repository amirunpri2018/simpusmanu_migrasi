<section class='content-header'>
    <h1>
        FORM JABATAN PEGAWAI
        <small>Form Data Jabatan</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data Jabatan</a></li>
        <li class='active'>Form Input data Jabatan</li>
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
                    echo form_open('simpeg_data_dosen/addjabatan');
                    ?> 
                    <table class="table">
                        <tr>
                        <input type="hidden" name="id_pegawai" value="<?php echo $pegawai['id_pegawai']; ?>">                        
                        <input type="hidden" name="nip_pegawai" value="<?php echo $pegawai['nip']; ?>"  >

                        <td style="width:15%"><label>Nama Jabatan</label></td>
                        <td>
                            <div class="col-sm-5">
                                <select name="jabatan" class="form-control " >
                                    <?php
                                    if (!empty($jabatan)) {
                                        foreach ($jabatan as $row) {
                                            echo "<option value=" . $row->id . ">" . strtoupper($row->nama_jabatan) . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>                        
                        </td>
                        </tr>
                        <tr>
                            <td><label>Unit Kerja / Bagian</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <select name="unitkerja" class="form-control " >
                                        <?php
                                        if (!empty($unitkerja)) {
                                            foreach ($unitkerja as $row) {
                                                echo "<option value=" . $row->id_unitkerja . ">" . strtoupper($row->nama_unitkerja) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Nomor SK</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nomor_sk" id="nama_pegawai" placeholder="Nomor SK Jabatan"  />
                                    <?php echo form_error('nomor_sk') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Tanggal SK</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" name="tanggal_sk" id="datepicker" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>                                    </div>
                                    <?php echo form_error('tanggal_sk') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Tanggal Mulai Jabatan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" name="tanggal_mulai" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                    </div>
                                    <?php echo form_error('tanggal_mulai') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Tanggal Selesai Jabatan</label></td>
                            <td>
                                <div class="col-sm-5">                                    
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" name="tanggal_selesai" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                    </div>
                                    <?php echo form_error('tanggal_selesai') ?>
                                </div>                        
                            </td>
                        </tr>

                        <tr>
                            <td><label>Keterangan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <textarea class="form-control" rows="3" name="keterangan"  placeholder="Keterangan"></textarea>
                                    <?php echo form_error('keterangan') ?>
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