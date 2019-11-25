<section class='content-header'>
    <h1>
        FORM PEMUSNAHAN
        <small>Aset/Inventaris</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Form</a></li>
        <li class='active'>Aset/Inventaris</li>
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
                        echo form_open_multipart($action);
                        ?>
                        <div class='box-body'>
                            <div class='form-group'>
                                Kode Aset/Inventaris <?php echo form_error('kode_inventaris') ?>
                                <select name="kode_inventaris" class="form-control " >
                                    <option value="">- Select -</option>  
                                    <?php
                                    foreach ($inv as $row) {
                                        echo "<option value='$row->kode_inventaris'";
                                        echo $kode_inventaris == $row->kode_inventaris ? 'selected' : '';
                                        echo">" . $row->kode_inventaris . ' ( ' . $row->nama_inventaris . ' )' . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>    
                            <div class='form-group'>Tanggal <?php echo form_error('tanggal') ?>
                                <input type="text" class="form-control" name="tanggal" id="datepicker" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
                            </div>

                            <div class='form-group'>Keterangan <?php echo form_error('keterangan') ?>
                                <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
                            </div>
                            <div class='form-group'>Lampiran <?php echo form_error('lampiran') ?>                                   
                                <input type="file" name="file_inv" id="exampleInputFile">
                                <p class="help-block">Type file .jpg/.png/.doc/.docx/.pdf</p>
                            </div>
                        </div>
                        <div class='box-footer'>
                            <input type="hidden" name="id_hapus" value="<?php echo $id_hapus; ?>" /> 
                            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                            <a href="<?php echo site_url('sima_penghapusan') ?>" class="btn btn-default">Cancel</a>
                        </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->