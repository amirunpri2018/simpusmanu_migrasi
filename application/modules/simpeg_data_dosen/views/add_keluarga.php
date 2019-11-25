<section class='content-header'>
    <h1>
        FORM KELUARGA PEGAWAI
        <small>Form Data Keluarga</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data Keluarga</a></li>
        <li class='active'>Form Input data Keluarga</li>
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
                    echo form_open('simpeg_data_dosen/addkeluarga');
                    ?> 
                    <table class="table">
                        <tr>
                        <input type="hidden" name="id_pegawai" value="<?php echo $pegawai['id_pegawai']; ?>">                        
                        <input type="hidden" name="nip_pegawai" value="<?php echo $pegawai['nip']; ?>"  >
                        <td style="width: 15%"><label>Nama Keluarga</label></td>
                        <td>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="keluarga" id="nama_pegawai" placeholder="Nama Keluarga"  />
                                <?php echo form_error('keluarga') ?>
                            </div>                        
                        </td>
                        </tr>
                        <tr>
                            <td><label>Tempat Lahir</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir"  />
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
                                        <input type="text" class="form-control" name="tgl_lahir" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                    </div>
                                    <?php echo form_error('tgl_lahir') ?>
                                </div>                        
                            </td>
                        </tr>                        
                        <tr>
                            <td><label>Hubungan Keluarga</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="status" placeholder="Hubungan Keluarga"  />
                                    <?php echo form_error('status') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Pekerjaan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="pekerjaan" placeholder="Pekerjaan"  />
                                    <?php echo form_error('pekrjaan') ?>
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