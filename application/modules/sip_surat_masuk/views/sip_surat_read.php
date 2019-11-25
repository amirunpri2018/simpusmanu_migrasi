<section class="content-header">
    <h1>
        DETAIL
        <small>SURAT MASUK</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Transkasi</a></li>
        <li class="active">Surat Masuk</li>
    </ol>
</section>

<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header"> Manajemen Surat
                <small class="pull-right">Date : <?php echo tgl_indo($tanggal_pencatatan); ?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <table class="table-borderless">
                <tr>
                    <td style="width: 100px">Nomor Surat</td> 
                    <td>: <?php echo $nomor_surat; ?></td> 
                </tr> 
                <tr>
                    <td>Sifat</td>
                    <td>: <?php echo $sifat_surat; ?></td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>: <?php echo $perihal_surat; ?></td>
                </tr>                
            </table>
            <br><br>
            <b>Kepada Yth;</b><br>
            <?php echo $tujuan_surat; ?>
            <br><br>
            <b>Isi Surat</b>

        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">

        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Pekalongan, <?php echo tgl_indo($tanggal_surat); ?></b><br>

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-10">
            <table class="table-borderless">
                <thead>
                    <tr>
                        <?php echo $isi_surat; ?>
                    </tr>
                </thead>

            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">

        </div>
        <div class="col-sm-4 invoice-col">

        </div>
        <div class="col-sm-4 invoice-col">
            <br>
            <br>
            Mengetahui,

            <br>
            <br>
            <br>
            <?php echo $nama_pengirim; ?>
            <br>
            <br>
            <br>
        </div>

    </div>
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            Lampiran:
            <br>
            <?php 
            if (empty($lampiran)){
                echo "# Tidak ada lampiran file";
            }else{
                echo "1. ", anchor_popup('upload/surat_masuk/' . $lampiran, $lampiran); 
            }            
            ?>
            <br>
            <br>
            <br>
        </div>

    </div>
    <!--
     <div class="row no-print">
         <div class="col-xs-12">
             <a href="<?php echo base_url('sip_surat_masuk/cetak/' . $id_surat); ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
             
         </div>
     </div>
    -->
    <div class="box-footer">               
        <a href="<?php echo site_url('sip_surat_masuk'); ?>" class="btn btn-primary ">Kembali</a>
    </div> 
</section>