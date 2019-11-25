<section class='content-header'>
    <h1>
        FORM EDIT PENILAIAN
        <small>PEGAWAI</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data Penilaian</a></li>
        <li class='active'>Penilaian</li>
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
                    echo form_open_multipart('simpeg_data_dosen/editpenilaian');
                    ?> 
                    <table class="table">
                        <tr>
                        <input type="hidden" name="id_pegawai" value="<?php echo $penilaian['id_pegawai']; ?>">                        
                        <input type="hidden" name="id_penilaian" value="<?php echo $penilaian['id_penilaian']; ?>"  >

                        <tr>
                            <td><label>Tanggal</label></td>
                            <td>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" name="tanggal" id="datepicker" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask value="<?php echo tgl_indo($penilaian['tanggal']); ?>" >
                                    </div>
                                    <?php echo form_error('tanggal') ?>
                                </div>                        
                            </td>
                        </tr>
                        
                        <tr>
                            <td><label>Catatan Pegawai</label></td>
                            <td>
                                <div class="col-sm-6">
                                    <textarea class="form-control" rows="5" name="catatan"  placeholder="catatan "><?php echo $penilaian['catatan']; ?></textarea>
                                    <?php echo form_error('catatan') ?>
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