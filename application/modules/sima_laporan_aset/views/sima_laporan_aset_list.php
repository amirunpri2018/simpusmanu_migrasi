<script type="text/javascript">
    function getAll() {
        cariStatus();
    }
    function cariStatus() {
        var id = $("#status").val();
        $.ajax({
            type: "get",
            url: "sima_laporan_aset/cariStatus",
            data: "id=" + id,
            success: function (html) {
                {
                    $("#hasilcari").html(html);
                }
            }
        });
    }
    function tglAwal() {
        var awal = $("#datepicker").val();
        //var akhir= $("#datepicker2").val();
        $.ajax({
            type: "get",
            url: "sima_laporan_aset/cariTglAwal",
            data: {
                'awal': awal,
            },
            success: function (html) {
                {
                    $("#hasilcari").html(html);
                }
            }
        });
    }

    function tglAkhir() {
        var awal = $("#datepicker").val();
        var akhir = $("#datepicker2").val();
        var status = $("#status").val();
        $.ajax({
            type: "get",
            url: "sima_laporan_aset/cariTglAkhir",
            data: {
                'awal': awal,
                'akhir': akhir,
                'status': status,
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
        DATA ASET
        <small>Barang/Gedung</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data</a></li>
        <li class='active'>Aset</li>
    </ol>
</section>  
<body onload="getAll()">
    <section class='content'>
        <div class='row'>
            <div class='col-xs-12'>
                <div class='box box-primary'>  
                    <div class='box-header with-border'>
                        <div class="col-md-12 ">
                            <?php echo form_open('sima_laporan_aset/excel'); ?>
                            <div class="col-sm-4">
                                <label>Status Aset</label>
                                <div class="input-group">
                                    <div class="form-group">                                    
                                        <select name="status" id="status" onchange='cariStatus()' class="form-control " >
                                            <option value="all_status">ALL DATA</option>
                                            <?php
                                            if (!empty($status)) {
                                                foreach ($status as $row) {
                                                    echo "<option value=" . $row->id_status . ">" . strtoupper($row->status) . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3"><label>Tgl Inventaris Awal</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>                                    
                                    <input type="text" class="form-control" name="datepicker" id="datepicker" value="<?php echo $tgl_awal ?>" placeholder="Dari tanggal inventaris" onchange='tglAwal()' >                                    

                                </div>
                            </div> 
                            <div class="col-sm-3"><label>Tgl Inventaris Akhir</label>
                                <div class="input-group"> 
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div> 
                                    <input type="text" class="form-control" name="datepicker2" id="datepicker2" value="<?php echo $tgl_akhir ?>" placeholder="Sampai tanggal inventarsi" onchange='tglAkhir()'>                             
                                </div>
                            </div> 
                            <div class="col-sm-2"><label>Export Excel</label>
                                <button type="submit" class="btn btn-primary btn-flat" ><i class="fa fa-file-excel-o"></i> Excel</button>
                            </div>

                            </form>                        
                        </div>  
                    </div><!-- /.box-header -->
                    <div class='box-body table-responsive'>
                        <div id="hasilcari">

                        </div> 
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</body>