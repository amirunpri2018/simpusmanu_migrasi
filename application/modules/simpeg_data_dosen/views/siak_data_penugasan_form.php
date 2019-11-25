<section class='content-header'>
    <h1>
        FORM PENUGASAN
        <small>DOSEN</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data Penugasan</a></li>
        <li class='active'>Dosen</li>
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
                                <div class='form-group'>Tahun Ajaran <?php echo form_error('tahun_ajaran') ?>
                                    <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" placeholder="Tahun Ajaran" value="<?php echo $tahun_ajaran; ?>" />
                                </div>
                                <div class='form-group'>Nama Pt <?php echo form_error('nama_pt') ?>
                                      <select name="nama_pt" id="kode_prodi" class="form-control" > 
                                        <?php
                                        foreach ($pt as $row) {
                                            echo "<option value='$row->kode_pt - $row->nama_pt'";                                            
                                            echo">".$row->kode_pt." - ".$row->nama_pt."</option>";
                                        }
                                        ?>
                                    </select> 
                                </div>
                                <div class='form-group'>Program Studi <?php echo form_error('program_studi') ?>
                                    <select name="program_studi" id="kode_prodi" class="form-control" >                                                                 
                                        <option value="">- Select Prodi -</option> 
                                        <?php
                                        foreach ($prodi as $row) {
                                            echo "<option value='$row->nama_prodi'";
                                            echo $program_studi == $row->nama_prodi ? 'selected' : '';
                                            echo">$row->nama_prodi</option>";
                                        }
                                        ?>
                                    </select>
                                </div>                                
                                <div class='form-group'>No Surat Tugas <?php echo form_error('no_surat_tugas') ?>
                                    <input type="text" class="form-control" name="no_surat_tugas" id="no_surat_tugas" placeholder="No Surat Tugas" value="<?php echo $no_surat_tugas; ?>" />
                                </div>
                                <div class='form-group'>Tgl Surat Tugas <?php echo form_error('tgl_surat_tugas') ?>
                                    <input type="text" class="form-control" name="tgl_surat_tugas" id="datepicker" placeholder="Tgl Surat Tugas" value="<?php echo $tgl_surat_tugas; ?>" />
                                </div>
                                <div class='form-group'>Tmt Surat Tugas <?php echo form_error('tmt_surat_tugas') ?>
                                    <input type="text" class="form-control" name="tmt_surat_tugas" id="datepicker1" placeholder="Tmt Surat Tugas" value="<?php echo $tmt_surat_tugas; ?>" />
                                </div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="nip" value="<?php echo $nip; ?>" /> 
                                <input type="hidden" name="id_penugasan" value="<?php echo $id_penugasan; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->