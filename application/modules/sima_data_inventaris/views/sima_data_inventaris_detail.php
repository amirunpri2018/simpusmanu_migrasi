<section class='content-header'>
    <h1>
        DATA ASET
        <small><?php echo $kode_inventaris ?></small>
    </h1>
    <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-suitcase'></i>Data</a></li>
        <li class='active'>Aset</li>
    </ol>
</section>  
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#read" data-toggle="tab" aria-expanded="true">Detail</a></li>
                    <li class=""><a href="#perawatan" data-toggle="tab" aria-expanded="false">Perawatan</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="read">                        
                        <table class="table table-bordered">
                            <tr><td>Kode Inventaris</td><td><?php echo $kode_inventaris; ?></td></tr>
                            <tr><td>Nama Inventaris</td><td><?php echo $nama_inventaris; ?></td></tr>
                            <tr><td>Asal Inventaris</td><td><?php echo $asal_inventaris; ?></td></tr>
                            <tr><td>Kepemilikan</td><td><?php echo $kepemilikan; ?></td></tr>
                            <tr><td>Merek</td><td><?php echo $merek; ?></td></tr>
                            <tr><td>Harga Beli</td><td><?php echo $harga_beli; ?></td></tr>
                            <tr><td>Tgl Inventaris</td><td><?php echo $tgl_inventaris; ?></td></tr>
                            <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
                            <tr><td>Kategori</td><td><?php echo $kategori; ?></td></tr>
                            <tr><td>Lokasi</td><td><?php echo $lokasi; ?></td></tr>
                            <tr><td>Status</td><td><?php echo $status['status']; ?></td></tr>
                        </table>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="perawatan">
                        <strong><i class="fa fa-book margin-r-5"></i> RIWAYAT PERAWATAN [ <a><?php echo anchor('sima_data_perawatan/addcreate/' . $kode_inventaris, 'Add New') ?></a> ]</strong>                            
                        <br><br>
                        <table class="table ">
                            <tbody>
                                <tr>
                                    <td><label>No Transaksi</label></td>
                                    <td><label>Tgl Perawatan</label></td>
                                    <td><label>Tgl Selesai</label></td>
                                    <td><label>Tindakan Perawatan</label></td>
                                    <td><label>Status</label></td>
                                    <td><label>Biaya</label></td>                                  
                                    <td><label>Aksi</label></td>                              
                                </tr>
                                <?php
                                foreach ($perawatan as $row) {
                                    echo"
                                        <tr>                                     
                                            <td>" . $row->no_transaksi . "</td>
                                            <td>" . tgl_indo($row->tgl_perawatan) . "</td>
                                            <td>" . tgl_indo($row->tgl_selesai) . "</td>
                                            <td>" . $row->tindakan_perawatan . "</td>    
                                            <td>" . $row->status . "</td> 
                                            <td>" . rupiah($row->biaya) . "</td>                                              
                                            <td>" . anchor('sima_data_perawatan/update/' . $row->id_perawatan, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                                        </tr> ";
                                }
                                ?>                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>