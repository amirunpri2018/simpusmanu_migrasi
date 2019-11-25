<section class='content-header'>
    <h1>
        FORM EDIT PENGHARGAAN 
        <small>Form Data Penghargaan</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data Penghargaan</a></li>
        <li class='active'>Form Input data Penghargaan</li>
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
                    echo form_open('simpeg_data_dosen/editpenghargaan');
                    ?> 
                    <table class="table">
                        <tr>
                        <input type="hidden" name="id_pegawai" value="<?php echo $penghargaan['id_pegawai']; ?>">
                        <input type="hidden" name="id_penghargaan" value="<?php echo $penghargaan['id_penghargaan']; ?>">                          
                        <td style="width:15%"><label>Nama Penghargaan</label></td>
                        <td>
                            <div class="col-sm-5">
                                <select name="penghargaan" class="form-control " >
                                    <?php
                                    foreach ($master as $row) {
                                        echo "<option value='$row->id_master_penghargaan'";
                                        echo $penghargaan['id_master_penghargaan'] == $row->id_master_penghargaan ? 'selected' : '';
                                        echo">" . strtoupper($row->nama_penghargaan) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>                        
                        </td>
                        </tr>                           
                        <tr>
                            <td><label>Tanggal Pengharggan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" name="tanggal" id="datepicker" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask value="<?php echo tgl_indo($penghargaan['tanggal_penghargaan']); ?>" >
                                    </div>                                      
                                    <?php echo form_error('tanggal') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Nomor Penghargaan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="no_penghargaan" value="<?php echo $penghargaan['nomor_penghargaan']; ?>" placeholder="Nomor Penghargaan"  />
                                    <?php echo form_error('no_penghargaan') ?>
                                </div>                        
                            </td>
                        </tr>                        
                        <tr>
                            <td><label>Keterangan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <textarea class="form-control" rows="3" name="keterangan"  placeholder="Keterangan Penghargaan"><?php echo $penghargaan['keterangan']; ?></textarea>
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