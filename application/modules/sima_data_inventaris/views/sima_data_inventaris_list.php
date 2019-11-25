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
<script src="<?php echo base_url('assets/datatables/jQuery-2.1.4.min.js') ?>"></script>
<script>
    $(document).ready(function () {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#mytable').dataTable({
            "Processing": true,
            "ServerSide": true,
            "iDisplayLength": 25,
            "oLanguage": {
                "sSearch": "Search Data :  ",
                "sZeroRecords": "No records to display",
                "sEmptyTable": "No data available in table"
            },
            "ajax": "<?php echo base_url('sima_data_inventaris/view_data'); ?>",
            "columns": [
                {"mData": "no"},
                {"mData": "kode_inventaris"},
                {"mData": "nama_inventaris"},
                {"mData": "merek"},
                {"mData": "tgl_inventaris"},
                {"mData": "kategori"},
                {"mData": "lokasi"},
                {"mData": "status"},
                {"mData": "action"}
            ]
        });
    });
</script>  
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>
                    <h3 class='box-title'><?php echo anchor('sima_data_inventaris/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?>
                        <?php echo anchor(site_url('sima_data_inventaris/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>                                
                                <th>Merek</th>
                                <th>Tgl Inventaris</th> 
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th style="text-align:center" width="140px">Action</th>
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

