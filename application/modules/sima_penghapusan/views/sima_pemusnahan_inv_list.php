<section class='content-header'>
    <h1>
        DATA PEMUSNAHAN 
        <small>Aset/Inventaris</small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Pemusnahan</a></li>
        <li class='active'>Aset/Inventaris</li>
    </ol>
</section>        
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>
                    <h3 class='box-title'><?php echo anchor('sima_penghapusan/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Inventaris</th>
                                <th>Nama Inventaris</th>
                                <th>Keterangan</th>
                                <th>Lampiran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($sima_penghapusan_data as $sima_penghapusan) {
                                $inv=$this->db->get_where('sima_data_inventaris',array('kode_inventaris'=>$sima_penghapusan->kode_inventaris))->row_array();
                                if($sima_penghapusan->lampiran==""){
                                    $lampiran="Tidak ada file lampiran";
                                }else{
                                    $lampiran=anchor_popup('upload/aset/' . $sima_penghapusan->lampiran, $sima_penghapusan->lampiran);
                                }
                                ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo tgl_indo($sima_penghapusan->tanggal) ?></td>
                                    <td><?php echo anchor('sima_data_inventaris/read2/'.$sima_penghapusan->kode_inventaris,$sima_penghapusan->kode_inventaris) ?></td>
                                    <td><?php echo $inv['nama_inventaris'] ?></td>
                                    <td><?php echo $sima_penghapusan->keterangan ?></td>
                                    <td><?php echo  $lampiran ?></td>
                                    
                                    <td style="text-align:center" width="140px">
                                        <?php
                                        echo anchor(site_url('sima_penghapusan/update/' . $sima_penghapusan->id_hapus), '<i class="fa fa-pencil-square-o"></i>', array('data-toggle' => 'tooltip', 'title' => 'edit', 'class' => 'btn btn-info btn-sm'));
                                        echo '  ';
                                        echo anchor(site_url('sima_penghapusan/delete/' . $sima_penghapusan->id_hapus), '<i class="fa fa-trash-o"></i>', 'data-toggle="tooltip" title="delete" class="btn btn-info btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>					
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script src="<?php echo base_url('assets/datatables/jquery-1.11.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#mytable").dataTable();
    });
</script>