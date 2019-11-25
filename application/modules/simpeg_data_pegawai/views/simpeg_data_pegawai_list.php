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
            "ajax": "<?php echo base_url('simpeg_data_pegawai/view_data'); ?>",
            "columns": [
                {"mData": "no"},
                {"mData": "nip"},
                {"mData": "nama_pegawai"},
                {"mData": "tempat_lahir"},
                {"mData": "tanggal_lahir"},                
                {"mData": "unit_kerja"},
                {"mData": "status_pegawai"},
                {"mData": "detail"},
            ]
        });
    });
</script>
<section class='content-header'>
    <h1>
        DATA PEGAWAI
        <small>Seluruh Pegawai</small>
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
                    <h3 class='box-title'><?php echo anchor('simpeg_data_pegawai/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?>
                        </h3>
                </div><!-- /.box-header -->
                <div class='box-body table-responsive'>
                     <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>                                
                                <th>Nama Pegawai</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>        
                                <th>Bagian</th> 
                                <th>Status Pegawai</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        
                    </table>					
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

