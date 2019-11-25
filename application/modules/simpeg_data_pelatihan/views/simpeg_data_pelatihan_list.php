<section class='content-header'>
    <h1>
        DATA PELATIHAN & SEMINAR
        <small>Daftar Data Pelatihan</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data Pelatihan</a></li>
        <li class='active'>Daftar pelatihan</li>
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
            "ajax": "<?php echo base_url('simpeg_data_pelatihan/view_data'); ?>",
            "columns": [
                {"mData": "no"},
                {"mData": "nama_pegawai"},
                {"mData": "jenis_pelatihan"},
                {"mData": "nama_pelatihan"},
                {"mData": "nama_lokasi"},
                {"mData": "tanggal"},
                {"mData": "penyelenggara"},
                {"mData": "lama_pelatihan"},
                {"mData": "catatan"},
                {"mData": "file"},
                {"mData": "edit"},
            ]
        });
    });
</script>   
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>
                    <h3 class='box-title'><?php echo anchor('simpeg_data_pelatihan/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?>
                        <?php echo anchor(site_url('simpeg_data_pelatihan/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th>No</th>                                
                                <th>Nama Pegawai</th>
                                <th>Jenis Pelatihan</th>
                                <th>Pelatihan</th>
                                <th>Tempat</th>
                                <th width="100px">Tanggal</th>
                                <th>Penyelenggara</th>
                                <th>Lama Pelatihan</th>
                                <th>Resume</th>  
                                <th>File</th>  
                                <th>Aksi</th>
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

