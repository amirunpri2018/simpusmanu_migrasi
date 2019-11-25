<section class='content-header'>
    <h1>
        FORM PERAWATAN
        <small>ASET/ INVENTARIS</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>FORM</a></li>
        <li class='active'>Perawatan</li>
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
                                <div class='form-group'>No Transaksi <?php echo form_error('no_transaksi') ?>
                                    <input type="text" class="form-control" name="no_transaksi"  id="no_transaksi" placeholder="No Transaksi" value="<?php echo $no_transaksi; ?>" />
                                </div>
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
                                <div class='form-group'>Tgl Perbaikan <?php echo form_error('tgl_perawatan') ?>
                                    <input type="text" class="form-control" name="tgl_perawatan" id="datepicker" data-mask placeholder="tanggal perbaikan" value="<?php echo $tgl_perawatan; ?>" />
                                </div>
                                <div class='form-group'>Tgl Selesai Perbaikan <?php echo form_error('tgl_selesai') ?>
                                    <input type="text" class="form-control" name="tgl_selesai" id="datepicker2" data-mask placeholder="tanggal selesai" value="<?php echo $tgl_selesai; ?>" />
                                </div>
                                <div class='form-group'>Tindakan Perawatan <?php echo form_error('tindakan_perawatan') ?>
                                    <textarea class="form-control" name="tindakan_perawatan" id="tindakan_perawatan" placeholder="Tindakan Perawatan" ><?php echo $tindakan_perawatan; ?></textarea>
                                </div>
                                <div class='form-group'>Biaya <?php echo form_error('biaya') ?>
                                    <input type="number" class="form-control" name="biaya" id="biaya" placeholder="Biaya" value="<?php echo $biaya; ?>" />
                                    * jika ada biaya perawatan
                                </div>
                                <div class='form-group'>Status Perbaikan <?php echo form_error('status') ?>
                                    <select name="status" class="form-control " > 
                                        <option value='<?php echo $status; ?>'><?php echo $status;'selected' ?></option> 
                                        <option value="OPEN">OPEN</option>                               
                                        <option value="PROCESS">PROCESS</option> 
                                        <option value="PENDING">PENDING</option>
                                        <option value="CLOSED">CLOSED</option>                                
                                    </select>   
                                </div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id_perawatan" value="<?php echo $id_perawatan; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('sima_data_perawatan') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->