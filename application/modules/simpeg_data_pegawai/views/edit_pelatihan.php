<section class='content-header'>
    <h1>
        FORM EDIT PELATIHAN 
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
                    echo form_open_multipart('simpeg_data_pegawai/editpelatihan');
                    ?> 
                    <table class="table">
                        <tr>
                        <input type="hidden" name="id_pegawai" value="<?php echo $pelatihan['id_pegawai']; ?>">                        
                        <input type="hidden" name="id_data_pelatihan" value="<?php echo $pelatihan['id_data_pelatihan']; ?>"  >

                        <td style="width:15%"><label>Nama Pelatihan</label></td>
                        <td>
                            <div class="col-sm-5">
                                <select name="pelatihan" class="form-control " >
                                    <?php
                                    foreach ($master as $row) {
                                        echo "<option value='$row->id_pelatihan'";
                                        echo $pelatihan['id_pelatihan'] == $row->id_pelatihan ? 'selected' : '';
                                        echo">" . strtoupper($row->nama_pelatihan) . "</option>";
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
                                        foreach ($tempat as $row) {
                                            echo "<option value='$row->id_lokasi'";
                                            echo $pelatihan['id_lokasi'] == $row->id_lokasi ? 'selected' : '';
                                            echo">" . strtoupper($row->nama_lokasi) . "</option>";
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
                                        <input type="text" class="form-control" name="tanggal_pelatihan" id="datepicker" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask value="<?php echo tgl_indo($pelatihan['tanggal']); ?>" >
                                    </div>
                                    <?php echo form_error('tanggal_pelatihan') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Penyelanggara</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="penyelenggara" value="<?php echo $pelatihan['penyelenggara']; ?>"placeholder="Penyelanggara"  />
                                    <?php echo form_error('penyelenggara') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Lama Pelatihan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="waktu" value="<?php echo $pelatihan['lama_pelatihan']; ?>" placeholder="Lama Pelatihan"  />
                                    <?php echo form_error('waktu') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Catatan/Resume</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <textarea class="form-control" rows="3" name="catatan"  placeholder="catatan "><?php echo $pelatihan['catatan']; ?></textarea>
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