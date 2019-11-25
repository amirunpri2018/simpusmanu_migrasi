<section class='content-header'>
    <h1>
        FORM DATA
        <small>Inventaris</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data</a></li>
        <li class='active'>Inventaris</li>
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
                        <form action="<?php echo $action; ?>" method="post">
                            <div class='box-body'>
                                <div class='form-group'>Kode Inventaris <?php echo form_error('kode_inventaris') ?>
                                    <input type="text" class="form-control" name="kode_inventaris" id="kode_inventaris" placeholder="Kode Inventaris" value="<?php echo $kode_inventaris; ?>" />
                                </div>
                                <div class='form-group'>Nama Inventaris <?php echo form_error('nama_inventaris') ?>
                                    <input type="text" class="form-control" name="nama_inventaris" id="nama_inventaris" placeholder="Nama Inventaris" value="<?php echo $nama_inventaris; ?>" />
                                </div>
                                <div class='form-group'>
                                    Kategori <?php echo form_error('kategori') ?>
                                    <select name="kategori" class="form-control " >
                                        <option value="">- Select -</option>  
                                        <?php                                        
                                        foreach ($mkategori as $row) {
                                            echo "<option value='$row->kategori'";
                                            echo $kategori == $row->kategori ? 'selected' : '';
                                            echo">" . strtoupper($row->kategori) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class='form-group'>Asal Inventaris <?php echo form_error('asal_inventaris') ?>
                                    <input type="text" class="form-control" name="asal_inventaris" id="asal_inventaris" placeholder="Asal Inventaris" value="<?php echo $asal_inventaris; ?>" />
                                </div>
                                <div class='form-group'>Kepemilikan <?php echo form_error('kepemilikan') ?>
                                    <input type="text" class="form-control" name="kepemilikan" id="kepemilikan" placeholder="Kepemilikan" value="<?php echo $kepemilikan; ?>" />
                                </div>
                                <div class='form-group'>Merek <?php echo form_error('merek') ?>
                                    <input type="text" class="form-control" name="merek" id="merek" placeholder="Merek" value="<?php echo $merek; ?>" />
                                </div>
                                <div class='form-group'>Harga Beli <?php echo form_error('harga_beli') ?>
                                    <input type="number" class="form-control" name="harga_beli" id="harga_beli" placeholder="Harga Beli" value="<?php echo $harga_beli; ?>" />
                                </div>
                                <div class='form-group'>Tgl Inventaris <?php echo form_error('tgl_inventaris') ?>                                    
                                    <input type="text" class="form-control" name="tgl_inventaris" id="datepicker" data-mask placeholder="Tgl Inventaris" value="<?php echo $tgl_inventaris; ?>" />
                                </div>

                                                  
                                <div class='form-group'>Lokasi <?php echo form_error('lokasi') ?>
                                    <select name="lokasi" class="form-control " >
                                        <option value="">- Select -</option>  
                                        <?php
                                        foreach ($mlokasi as $row) {
                                            echo "<option value='$row->lokasi'";
                                            echo $lokasi == $row->lokasi ? 'selected' : '';
                                            echo">" . strtoupper($row->lokasi) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div> 
                                <div class='form-group'>Keterangan <?php echo form_error('keterangan') ?>
                                    <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan"> <?php echo $keterangan; ?> </textarea>
                                </div>
                                <div class='form-group'>Status <?php echo form_error('status') ?>
                                    <select name="status" class="form-control " > 
                                        <option value="">- Select -</option>  
                                        <?php
                                        foreach ($mstatus as $row) {
                                            echo "<option value='$row->id_status'";
                                            echo $status == $row->id_status ? 'selected' : '';
                                            echo">" . strtoupper($row->status) . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id_inventaris" value="<?php echo $id_inventaris; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('sima_data_inventaris') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->