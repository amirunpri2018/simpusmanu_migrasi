<section class='content-header'>
    <h1>
        FORM PELATIHAN PEGAWAI
        <small>Form Data PELATIHAN</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data Pelatihan</a></li>
        <li class='active'>Form Input data Pelatihan</li>
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
                    echo form_open_multipart('simpeg_data_dosen/addpelatihan');
                    ?> 
                    <table class="table">
                        <tr>
                        <input type="hidden" name="id_pegawai" value="<?php echo $pegawai['id_pegawai']; ?>">                        
                        <input type="hidden" name="nip_pegawai" value="<?php echo $pegawai['nip']; ?>"  >

                        <td style="width:15%"><label>Nama Pelatihan</label></td>
                        <td>
                            <div class="col-sm-5">
                                <select name="pelatihan" class="form-control " >
                                    <?php
                                    if (!empty($pelatihan)) {
                                        foreach ($pelatihan as $row) {
                                            echo "<option value=" . $row->id_pelatihan . ">" . strtoupper($row->nama_pelatihan) . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>                        
                        </td>
                        </tr>
                        <tr>
                            <td><label>Tempat Pelatihan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <select name="tempat" class="form-control " >
                                        <?php
                                        if (!empty($tempat)) {
                                            foreach ($tempat as $row) {
                                                echo "<option value=" . $row->id_lokasi . ">" . strtoupper($row->nama_lokasi) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>                        
                            </td>
                        </tr>        
                        <tr>
                            <td><label>Tanggal Pelatihan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" name="tanggal_pelatihan" id="datepicker" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                    </div>                                    
                                    <?php echo form_error('tanggal_pelatihan') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Penyelanggara</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="penyelenggara" id="nama_pegawai" placeholder="Penyelanggara"  />
                                    <?php echo form_error('penyelenggara') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Lama Pelatihan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="waktu" id="nama_pegawai" placeholder="Lama Pelatihan"  />
                                    <?php echo form_error('waktu') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Catatan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <textarea class="form-control" rows="3" name="catatan"  placeholder="catatan "></textarea>
                                    <?php echo form_error('catatan') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>File Lampiran</label></td>
                            <td>
                                <div class="col-sm-5">                                
                                    <input type="file" name="file_upload" id="exampleInputFile">
                                    <p class="help-block">Max 5MB, Type file.jpg/.png/.pdf/.doc/.xls/</p>                             
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