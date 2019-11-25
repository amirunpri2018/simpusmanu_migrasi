<section class='content-header'>
    <h1>
        DISPOSISI
        <small>Surat Masuk</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Disposisi</a></li>
        <li class='active'>Surat</li>
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
            "ajax": "<?php echo base_url('sip_disposisi_surat/view_data'); ?>",
            "columns": [
                {"mData": "no"},
                {"mData": "nomor_surat"},
                {"mData": "tanggal_surat"},
                {"mData": "asal_surat"},
                {"mData": "tempat_loker"},
                {"mData": "nama_pegawai"},
                {"mData": "keterangan"},
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
                    <h3 class='box-title'>
                        <?php echo anchor(site_url('sip_disposisi_surat/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-primary btn-sm"'); ?>
                    </h3>
                </div><!-- /.box-header -->
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Tgl Surat</th>
                                <th>Dari</th>
                                <th>Loker Surat</th>     
                                <th>Disposisi</th>
                                <th>Memo</th>
                                <th>Status Proses</th>
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

