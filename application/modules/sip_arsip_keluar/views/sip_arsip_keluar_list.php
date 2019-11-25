<script type="text/javascript">
    function tglAwal() {
        var awal = $("#datepicker").val();
        //var akhir= $("#datepicker2").val();
        $.ajax({
            type: "get",
            url: "sip_arsip_keluar/cariTglAwal",
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
        $.ajax({
            type: "get",
            url: "sip_arsip_keluar/cariTglAkhir",
            data: {
                'awal': awal,
                'akhir': akhir,
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
        DATA SURAT KELUAR
        <small>Surat Keluar</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Surat</a></li>
        <li class='active'>Keluar</li>
    </ol>
</section>

<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>
                    <div class="col-md-6 ">
                        <?php echo form_open('sip_arsip_keluar/excel'); ?>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>                                    
                                <input type="text" class="form-control" name="datepicker" id="datepicker" value="<?php echo $tgl_awal ?>" placeholder="Dari tanggal" onchange='tglAwal()' >                                    

                            </div>
                        </div> 
                        <div class="col-sm-5">
                            <div class="input-group"> 
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div> 
                                <input type="text" class="form-control" name="datepicker2" id="datepicker2" value="<?php echo $tgl_akhir ?>" placeholder="Sampai tanggal" onchange='tglAkhir()'>                             
                            </div>
                        </div> 
                        <button type="submit" class="btn btn-primary btn-flat" ><i class="fa fa-file-excel-o"></i> Excel</button>
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

