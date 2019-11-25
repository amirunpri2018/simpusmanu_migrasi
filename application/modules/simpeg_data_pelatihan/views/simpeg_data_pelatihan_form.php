<section class='content-header'>
    <h1>
        DATA PELATIHAN
        <small>Daftar Data Pelatihan</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Pelatihan</a></li>
        <li class='active'>Daftar Pelatihan</li>
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
                         <?php echo form_open_multipart($action);?>
                            <div class='box-body'>
                                <div class='form-group'>Nama Pegawai <?php echo form_error('pegawai') ?>
                                    <select name="pegawai" class="form-control " >
                                        <?php
                                        if (!empty($pegawai)) {
                                            foreach ($pegawai as $row) {
                                                echo "<option value=" . $row->id_pegawai . ">" . strtoupper($row->nama_pegawai) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class='form-group'>Nama Pelatihan <?php echo form_error('pelatihan') ?>
                                    <select name="pelatihan" class="form-control " >
                                        <?php
                                        if (!empty($pelatihan)) {
                                            foreach ($pelatihan as $row) {
                                                echo "<option value=" . $row->id_pelatihan . ">" . strtoupper($row->jenis_pelatihan) . " | " . $row->nama_pelatihan . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class='form-group'>Tempat Pelatihan <?php echo form_error('lokasi') ?>
                                    <select name="lokasi" class="form-control " >
                                        <?php
                                        if (!empty($lokasi)) {
                                            foreach ($lokasi as $row) {
                                                echo "<option value=" . $row->id_lokasi . ">" . strtoupper($row->nama_lokasi) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">Tanggal <?php echo form_error('tanggal') ?>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" name="tanggal" id="datepicker" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                    </div>
                                </div>
                                <div class='form-group'>Penyelenggara <?php echo form_error('penyelenggara') ?>
                                    <input type="text" class="form-control" name="penyelenggara" id="penyelenggara" placeholder="Penyelenggara" value="<?php echo $penyelenggara; ?>" />
                                </div>
                                <div class='form-group'>Lama Pelatihan <?php echo form_error('lama_pelatihan') ?>
                                    <input type="text" class="form-control" name="lama_pelatihan" id="lama_pelatihan" placeholder="Lama Pelatihan" value="<?php echo $lama_pelatihan; ?>" />
                                </div>
                                <div class='form-group'>Resume <?php echo form_error('catatan') ?>
                                    <textarea rows="5" class="form-control" name="catatan" id="catatan" placeholder="Catatan"><?php echo $catatan; ?></textarea>
                                </div>
                                <div class='form-group'>
                                    <input type="file" name="file_upload" id="exampleInputFile">
                                    <p class="help-block">Max 5MB, Type file.jpg/.png/.pdf/.doc/.xls/</p>
                                </div> 
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id_data_pelatihan" value="<?php echo $id_data_pelatihan; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('simpeg_data_pelatihan') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->
