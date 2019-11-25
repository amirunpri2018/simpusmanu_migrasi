<script src="<?php echo base_url('assets/datatables/jQuery-2.1.4.min.js') ?>"></script>
<script>
    $(document).ready(function () {
        ajaxLoad();
    });

    function ajaxLoad(){
        var tahun = $("#tahun").val();
        $.fn.dataTable.ext.errMode = 'throw';
        $('#mytable').dataTable({
            "Processing": true,
            "ServerSide": true,
            "iDisplayLength": 25,
            "bDestroy": true,
            "autoWidth": false,
            "fixedColumns": true,
            "oLanguage": {
                "sSearch": "Search Data :  ",
                "sZeroRecords": "No records to display",
                "sEmptyTable": "No data available in table"
            },
            "ajax": {
                "url": "<?php echo base_url('sip_surat_masuk/view_data'); ?>",
                "type": "GET",
                "data": {                   
                    'tahun': tahun
                }
            },
            "columns": [
                {"mData": "no"},
                {"mData": "kode_surat"},
                {"mData": "nomor_surat"},
                {"width":"10%","mData": "tanggal_surat"},
                {"mData": "sifat_surat"},
                {"mData": "perihal_surat"},
                {"mData": "asal_surat"},
                {"mData": "tujuan_surat"},
                {"mData": "status"},
                {"mData": "action"}
            ]
        });
    }
</script>  
<section class='content-header'>
    <h1>
        DATA SURAT MASUK
        <small>Surat Masuk</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Surat</a></li>
        <li class='active'>Masuk</li>
    </ol>
</section>
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header'>                    
                    <div class="col-lg-2">
                        <h3 class='box-title'><?php echo anchor('sip_surat_masuk/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?>
                        </h3>
                    </div>
                    <div class="col-lg-7">   
                        <table>
                            <tr>
                                <td style="width:50px">Tahun</td>
                                <td style="width:200px">
                                    <select name="tahun" id="tahun" class="form-control" onchange="ajaxLoad()">
                                        <?php
                                            $thn = date('Y');
                                            for ($x = $thn; $x >= $thn-5; $x--) {
                                                echo '<option value="'.$x.'">'.$x.'</option>';
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>                            
                        </table>  
                    </div>                     
                </div>
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Surat</th>
                                <th>Nomor Surat</th>
                                <th style="text-align:center;width:10%">Tgl Surat</th>
                                <th>Sifat</th>
                                <th>Perihal</th>     
                                <th>Pengirim</th>
                                <th>Untuk</th>
                                <th>Status</th>
                                <th style="text-align:center;width:15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>					
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

