<section class="content-header">
    <h1>
        MANAJEMEN
        <small>SURAT KELUAR</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Surat</a></li>
        <li class="active">Keluar</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Manajemen Surat</h3>                        
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    echo form_open_multipart($action);
                    ?>
                    <div class="row">
                        <div class="col-md-12" >
                            <table class="table" >
                                <tr>
                                    <td style="text-align:right;width:10%">Nomor Surat</td>
                                    <td style="width:30%">
                                        <div>
                                            <input type="text" class="form-control" name="nomor_surat" value="<?php echo $nomor_surat ?>" required oninvalid="setCustomValidity('Nomor Surat!')"
                                                   oninput="setCustomValidity('')" placeholder="Nomor Surat">
                                        </div>
                                    </td>
                                    <td style="width:10%">
                                        <input type="text" name="kode_surat" class="form-control" placeholder="kode Surat" value="<?php echo $kode_surat ?>">
                                    </td>
                                    <td style="text-align:right;with:10%">Perihal</td>
                                    <td style="width:40%">
                                        <div>
                                            <input type="text" class="form-control" name="perihal_surat" value="<?php echo $perihal_surat ?>" required oninvalid="setCustomValidity('Perihal!')"
                                                   oninput="setCustomValidity('')" placeholder="perihal">
                                        </div>
                                        <?php echo form_error('perihal') ?>
                                    </td>                                    
                                </tr>
                                <tr>
                                    <td style="text-align:right">Jenis Surat</td>
                                    <td colspan="2">
                                        <div>
                                            <select name="jenis_surat" class="form-control" st> 
                                                <option value="">- Select -</option>  
                                                <?php
                                                foreach ($jenis as $row) {
                                                    echo "<option value='$row->jenis_surat'";
                                                    echo $jenis_surat == $row->jenis_surat ? 'selected' : '';
                                                    echo">" . $row->jenis_surat . " (" . $row->kode_jenis . ")</option>";
                                                }
                                                ?>
                                            </select> 
                                        </div> 
                                        <?php echo form_error('jenis_surat') ?>
                                    </td>
                                    <td style="text-align:right">Kepada</td>
                                    <td>
                                        <div>
                                            <input type="text" class="form-control" name="tujuan_surat" value="<?php echo $tujuan_surat ?>" required oninvalid="setCustomValidity('Tujuan pengiriman !')"
                                                   oninput="setCustomValidity('')" placeholder="Tujuan Pengiriman">
                                        </div>
                                        <?php echo form_error('tujuan_surat') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right">Tanggal Surat</td>
                                    <td colspan="2">
                                        <div>                                            
                                            <input type="text" class="form-control" name="tanggal_surat" id="datepicker" value="<?php echo $tanggal_surat; ?>" data-mask placeholder="Tanggal Surat">
                                        </div>
                                        <?php echo form_error('tanggal_surat') ?>
                                    </td>
                                    <td style="text-align:right">Nama Pengirim</td>
                                    <td>
                                        <div>
                                            <input type="text" class="form-control" name="nama_pengirim" value="<?php echo $nama_pengirim ?>" required oninvalid="setCustomValidity('Nama Pengirim !')"
                                                   oninput="setCustomValidity('')" placeholder="Nama Pengirim">
                                        </div>
                                        <?php echo form_error('nama_pengirim') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right">Sifat Surat</td>
                                    <td colspan="2">
                                        <div>
                                            <select name="sifat_surat" class="form-control" id="supplier">
                                                <option value="">- Select -</option>     
                                                <?php
                                                foreach ($sifat as $row) {
                                                    echo "<option value='$row->sifat_surat'";
                                                    echo $sifat_surat == $row->sifat_surat ? 'selected' : '';
                                                    echo">" . $row->sifat_surat . " (" . $row->kode_sifat . ")</option>";
                                                }
                                                ?>
                                            </select> 
                                        </div>
                                        <?php echo form_error('sifat_surat') ?>
                                    </td>
                                    <td style="text-align:right">Alamat Tujuan</td>
                                    <td>
                                        <div>
                                            <textarea class="form-control" name="alamat_tujuan" required oninvalid="setCustomValidity('Alamat pengirim !')"
                                                      oninput="setCustomValidity('')" placeholder="Alamat tujuan"><?php echo $alamat_tujuan ?></textarea>
                                        </div>
                                        <?php echo form_error('alamat') ?>
                                    </td>
                                </tr>                               
                                <tr>    
                                    <td style="text-align: right">Lampiran</td>
                                    <td colspan="2">
                                        <div>
                                            <input type="file" name="file_surat" id="exampleInputFile">
                                            <p class="help-block">Type file.jpg/.png/.pdf/.doc/.xls/</p>
                                        </div>                        
                                    </td>
                                    <td style="text-align: right">Loker</td>
                                    <td>
                                        <div>
                                            <select name="loker" class="form-control" id="supplier">                                                                 
                                                <option value="">- Select -</option>     
                                                <?php
                                                foreach ($loker as $row) {
                                                    echo "<option value='$row->kode_loker'";
                                                    echo $kode_loker == $row->kode_loker ? 'selected' : '';
                                                    echo">" . $row->tempat_loker . " (" . $row->kode_loker . ")</option>";
                                                }
                                                ?>
                                            </select> 
                                            <?php echo form_error('loker') ?>
                                        </div>                         
                                    </td>

                                </tr>
                                <tr>
                                    <td style="text-align:right">Isi Surat</td>
                                    <td colspan="4">
                                        <div>
                                            <form>
                                                <textarea id="editor1" name="isi_surat" rows="10" cols="80"><?php echo $isi_surat ?>                                          
                                                </textarea>
                                            </form>
                                        </div>
                                        <?php echo form_error('isi_surat') ?>
                                    </td>
                                </tr>

                            </table>
                        </div> 
                    </div>
                    <div class="box-footer">    
                        <div class="col-xs-12">
                            <input type="hidden" name="id_surat" value="<?php echo $id_surat; ?>" />
                            <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> <?php echo $button ?></button>  
                            <a href="<?php echo site_url('sip_surat_keluar'); ?>" class="btn btn-primary ">Kembali</a>
                        </div>
                    </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script src="<?php echo base_url('assets/datatables/jquery-1.11.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');

    });
</script>