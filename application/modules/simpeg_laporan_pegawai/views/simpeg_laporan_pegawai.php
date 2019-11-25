<script type="text/javascript">
    function cariStatus() {
        var id = $("#status").val();
        var kategori = $("#kategori").val();
        $.ajax({
            type: "get",
            url: "simpeg_laporan_pegawai/cariStatus",
            data: {
                'id': id,
                'kategori': kategori,
            },
            success: function (html) {
                {
                    $("#hasilcari").html(html);
                }
            }
        });
    }

    function cariKategori() {
        var id = $("#status").val();
        var kategori = $("#kategori").val();
        $.ajax({
            type: "get",
            url: "simpeg_laporan_pegawai/cariKategori",
            data: {
                'id': id,
                'kategori': kategori,
            },
            success: function (html) {
                {
                    $("#hasilcari").html(html);
                }
            }
        });
    }

</script>

<section class='content-header'>
    <h1>
        DATA PEGAWAI
        <small>PEGAWAI</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data</a></li>
        <li class='active'>Pegawai</li>
    </ol>
</section>  
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>
                    <?php echo form_open('simpeg_laporan_pegawai/excel'); ?>
                    <div class="col-xs-3">
                        <label>Dosen/Pegawai</label>
                        <div class="input-group">
                            <div class="form-group">                                    
                                <select name="kategori" id="kategori" onchange='cariKategori()' class="form-control " >
                                    <option value="all_kategori">DOSEN & PEGAWAI</option>
                                    <option value="Dosen">DOSEN</option>
                                    <option value="Pegawai">PEGAWAI</option>
                                </select>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <label>Status Pegawai</label>
                        <div class="input-group">
                            <div class="form-group">                                    
                                <select name="status" id="status" onchange='cariStatus()' class="form-control " >
                                    
                                    <option value="all_status">ALL STATUS</option>
                                    <?php
                                    if (!empty($status)) {
                                        foreach ($status as $row) {
                                            echo "<option value=" . $row->id_status . ">" . strtoupper($row->nama_status) . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-flat" ><i class="fa fa-file-excel-o"></i> Excel</button>
                            </span>
                        </div>
                    </div>
                    </form>
                </div><!-- /.box-header -->
                <div class='box-body table-responsive'>
                    <div id="hasilcari">

                    </div> 
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

