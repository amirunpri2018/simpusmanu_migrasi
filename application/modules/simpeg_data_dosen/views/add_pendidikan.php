<section class='content-header'>
    <h1>
        FORM PENDIDIKAN PEGAWAI
        <small>Form Data Pendidikan</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data Pendidikan</a></li>
        <li class='active'>Form Input data Pendidikan</li>
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
                    echo form_open('simpeg_data_dosen/addpendidikan');
                    ?> 
                    <table class="table">
                        <tr>
                            <td style="width:15%"><label>Tingkat Pendidikan</label></td>
                        <input type="hidden" name="id_pegawai" value="<?php echo $pegawai['id_pegawai']; ?>">                        
                        <input type="hidden" name="nip_pegawai" value="<?php echo $pegawai['nip']; ?>"  >
                        <td>
                            <div class="col-sm-5">
                                <select name="tingkat" class="form-control " >
                                    <option value='SD'>SD</option>
                                    <option value='SLTP'>SLTP</option>
                                    <option value='SLTA'>SLTA</option>
                                    <option value='D.3'>D.3</option>
                                    <option value='D.4'>D.4</option>
                                    <option value='S.1'>S.1</option>
                                    <option value='S.2'>S.2</option>
                                    <option value='S.3'>S.3</option>
                                </select>
                            </div>                        
                        </td>
                        </tr>
                        <tr>
                            <td><label>Nama Sekolah</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nama_sekolah" id="nama_pegawai" placeholder="Nama Sekolah"  />
                                    <?php echo form_error('nama_sekolah') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Alamat Sekolah</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat Sekolah"></textarea>
                                    <?php echo form_error('alamat') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Jurusan</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="jurusan" id="tempat_lahir" placeholder="Jurusan"  />
                                    <?php echo form_error('jurusan') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Tahun Masuk</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" name="tahun_masuk" class="form-control" placeholder="Tahun Masuk" >
                                    <?php echo form_error('tahun_masuk') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Tahun lulus</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" name="tahun_lulus" class="form-control" placeholder="Tahun Lulus" >
                                    <?php echo form_error('tahun_lulus') ?>
                                </div>                        
                            </td>
                        </tr>
                        <tr>
                            <td><label>Nomor Ijasah</label></td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nomor_ijasah"  placeholder="Nomor Ijasah" />
                                    <?php echo form_error('nomor_ijasah') ?>
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