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
            "ajax": "<?php echo base_url('simpeg_data_dosen/view_data'); ?>",
            "columns": [
                {"mData": "no"},
                {"mData": "nama_pegawai"},
                {"mData": "nidn"},
                {"mData": "nip"},                
                {"mData": "jenis_kelamin"},
                {"mData": "alamat"},
                {"mData": "status_pegawai"},                
                {"mData": "detail"},
            ]
        });
    });
</script>   
<section class='content-header'>
    <h1>
        DATA DOSEN
        <small>Seluruh Dosen</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data</a></li>
        <li class='active'>Dosen</li>
    </ol>
</section>  

<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>
                    <h3 class='box-title'><?php echo anchor('simpeg_data_dosen/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?>
                        </h3>
                </div><!-- /.box-header -->
                <div class='box-body table-responsive'>
                     <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dosen</th>
                                <th>NIDN</th> 
                                <th>NIK</th>
                                <th>L/P</th>
                                <th style="width: 20%">Alamat</th>                                                         
                                <th>Status Dosen</th>  
                                <th>View</th>
                            </tr>
                        </thead>
                        
                    </table>					
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

