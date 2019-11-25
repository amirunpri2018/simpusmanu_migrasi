<section class='content-header'>
    <h1>
        PERAWATAN 
        <small>ASET/ INVENTARIS</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Perawatan</a></li>
        <li class='active'>Aset/Inventaris</li>
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
            "ajax": "<?php echo base_url('sima_data_perawatan/view_data'); ?>",
            "columns": [
                {"mData": "no"},
                {"mData": "no_transaksi"},
                {"mData": "kode_inventaris"},
                {"mData": "nama_inventaris"},  
                {"mData": "tgl_perawatan"},
                {"mData": "tindakan_perawatan"},
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
                    <h3 class='box-title'><?php echo anchor('sima_data_perawatan/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Kode Inventaris</th>
                                <th>Nama Inventaris</th>
                                <th>Tgl Perawatan</th>
                                <th>Tindakan Perawatan</th>
                                <th>Status</th>
                                <th>Action</th>
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

