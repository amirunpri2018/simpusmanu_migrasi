<section class="content-header">
    <h1>
        DISPOSISI
        <small>SURAT MASUK</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Disposisi </a></li>
        <li class="active">Surat</li>
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
                                <div class='form-group'>Nomor Surat <?php echo form_error('nomor_surat') ?>
                                    <input type="text" class="form-control" disabled name="nomor_surat" id="id_surat" value="<?php echo $surat['nomor_surat']; ?>" />
                                </div>
                                <div class='form-group'>Nama Pegawai <?php echo form_error('id_pegawai') ?>                                    
                                    <select name="id_pegawai" class="form-control " >
                                        <option value="">- Select -</option>  
                                        <?php
                                        foreach ($pegawai as $row) {
                                            echo "<option value='$row->id_pegawai'";
                                            echo $id_pegawai == $row->id_pegawai ? 'selected' : '';
                                            echo">$row->nama_pegawai </option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class='form-group'>Memo <?php echo form_error('keterangan') ?>
                                    <textarea rows="5" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan Disposisi"><?php echo $keterangan; ?></textarea>
                                </div>
                                <div class='form-group'>Status Proses <?php echo form_error('status') ?>                                    
                                    <select name="status" class="form-control " >
                                        <option value="">- Select -</option>  
                                        <?php
                                        foreach ($status_proses as $row) {
                                            echo "<option value='$row->status'";
                                            echo $status == $row->status ? 'selected' : '';
                                            echo">$row->status </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class='form-group'>Tanggal Proses <?php echo form_error('tanggal') ?>                                                                         
                                    <input type="text" class="form-control" name="tanggal" placeholder="Tanggal Proses" id="datepicker" value="<?php echo $tanggal; ?>">

                                </div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id_surat" value="<?php echo $surat['id_surat']; ?>" /> 
                                <input type="hidden" name="id_disposisi" value="<?php echo $id_disposisi; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('sip_disposisi_surat') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->