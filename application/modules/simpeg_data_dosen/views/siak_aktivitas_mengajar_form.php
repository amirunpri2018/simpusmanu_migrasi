<script type="text/javascript">
    function tampilmakul() {
        var prodi = $("#kode_prodi").val();
        $.ajax({
            type: "POST",
            url: "simpeg_data_dosen/view_matakuliah",
            data: {
                'prodi': prodi,
            },
            success: function (data) {
                $("#matakuliah").html(data);
            }
        });
    }
</script>
<section class='content-header'>
    <h1>
        AKTIVITAS MENGAJAR
        <small>DOSEN</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data</a></li>
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
                                <div class='form-group'>Periode <?php echo form_error('periode') ?>
                                    <input type="text" class="form-control" name="periode" id="periode" placeholder="Periode" value="<?php echo $periode; ?>" />
                                </div>
                                <div class='form-group'>Progam Studi <?php echo form_error('progam_studi') ?>
                                    <select name="program_studi" id="kode_prodi" onChange='tampilmakul()' class="form-control" >                                                                 
                                        <option value="">- Select Prodi -</option> 
                                        <?php
                                        foreach ($prodi as $row) {
                                            echo "<option value='$row->kode_prodi'";
                                            echo $progam_studi == $row->kode_prodi ? 'selected' : '';
                                            echo">$row->nama_prodi</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class='form-group'>Matakuliah <?php echo form_error('matakuliah') ?>
                                    <select name="matakuliah" id="matakuliah" class="form-control" >                                                                 
                                        <option value="">- Select Matakuliah -</option>                                         
                                    </select>
                                </div>
                                
                                <div class='form-group'>Kelas <?php echo form_error('kelas') ?>
                                    <input type="text" class="form-control" name="kelas" id="kelas" placeholder="Kelas" value="<?php echo $kelas; ?>" />
                                </div>
                                <div class='form-group'>Rencana <?php echo form_error('rencana') ?>
                                    <input type="text" class="form-control" name="rencana" id="rencana" placeholder="Rencana" value="<?php echo $rencana; ?>" />
                                </div>
                                <div class='form-group'>Realisasi <?php echo form_error('realisasi') ?>
                                    <input type="text" class="form-control" name="realisasi" id="realisasi" placeholder="Realisasi" value="<?php echo $realisasi; ?>" />
                                </div>
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="nip" value="<?php echo $nip; ?>" />
                                <input type="hidden" name="id_mengajar" value="<?php echo $id_mengajar; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('simpeg_aktivitas_mengajar') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->