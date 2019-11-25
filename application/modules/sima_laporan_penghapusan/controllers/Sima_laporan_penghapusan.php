<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sima_laporan_penghapusan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('Model_sima_pemusnahan', 'M_image'));
        chek_session();
        cek_menu();
    }

    function index() {
        $tgl_awal = tgl_db($this->input->post('tanggal_awal', TRUE));
        $tgl_akhir = tgl_db($this->input->post('tanggal_akhir', TRUE));
        $data = array(
            'tgl_awal' => $this->input->post('tanggal_awal', TRUE),
            'tgl_akhir' => $this->input->post('tanggal_akhir', TRUE),
        );
        $this->template->display('sima_pemusnahan_inv_list', $data);
    }

    function cariTglAwal() {
        $awal = tgl_db($this->input->get('awal'));
        $tgl_awal = $this->input->get('awal');
        //$akhir = tgl_db($this->input->get('akhir'));        
        $data = $this->db->query("SELECT * FROM sima_pemusnahan_inv WHERE tanggal='$awal' ORDER BY id_hapus ASC")->result();
        echo "<label>DATA PENGHAPUSAN INVENTARIS TANGGAL $tgl_awal </label>";
        echo '<a href="' . base_url('sima_laporan_penghapusan/cetak/') . '" target="_blank" ><i class="btn btn-md fa fa-print" data-toggle="tooltip" title="Print"></i>';
        echo "<table class='table table-bordered'>
                <tr>
                  <th>No</th>
                  <th>Tgl Pemusanahan</th>
                  <th>kode Aset</th>
                  <th>Nama</th>
                  <th>Merek</th>
                  <th>Tgl Inventaris</th> 
                  <th>Kategori</th>
                  <th>Keterangan Pemusnahan</th>
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $aset = $this->db->get_where('sima_data_inventaris', array('kode_inventaris' => $q->kode_inventaris))->row();
            echo " 
            <tr>
                <td>$no</td>
                <td>" . tgl_indo($q->tanggal) . "</td>
                <td>$q->kode_inventaris</td>
                <td>$aset->nama_inventaris</td>
                <td>$aset->merek</td>
                <td>" . tgl_indo($aset->tgl_inventaris) . "</td>
                <td>$aset->kategori</td>
                <td>$q->keterangan</td>            
            </tr> ";
            $no++;
        }
        echo"</table>";
    }

    function cariTglAkhir() {
        $awal = tgl_db($this->input->get('awal'));
        $akhir = tgl_db($this->input->get('akhir'));
        $tgl_awal = $this->input->get('awal');
        $tgl_akhir = $this->input->get('akhir');
        $this->session->set_userdata('awal', $awal);
        $this->session->set_userdata('akhir', $akhir);
        $data = $this->db->query("SELECT * FROM sima_pemusnahan_inv WHERE tanggal BETWEEN '$awal' AND '$akhir' ORDER BY id_hapus ASC")->result();
        echo "<label>DATA PEMUSNAHAN INVENNTARIS DARI TANGGAL '$tgl_awal' s/d '$tgl_akhir' </label>";
        echo '<a href="' . base_url('sima_laporan_penghapusan/cetak/') . '" target="_blank" ><i class="btn btn-md fa fa-print" data-toggle="tooltip" title="Print"></i>';
        echo"<br><br>";
        echo "<table class='table table-bordered'>
                <tr>
                  <th>No</th>
                  <th>Tgl Pemusanahan</th>
                  <th>kode Aset</th>
                  <th>Nama</th>
                  <th>Merek</th>
                  <th>Tgl Inventaris</th> 
                  <th>Kategori</th>
                  <th>Keterangan Pemusnahan</th>
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $aset = $this->db->get_where('sima_data_inventaris', array('kode_inventaris' => $q->kode_inventaris))->row();
            echo " 
            <tr>
                <td>$no</td>
                <td>" . tgl_indo($q->tanggal) . "</td>
                <td>$q->kode_inventaris</td>
                <td>$aset->nama_inventaris</td>
                <td>$aset->merek</td>
                <td>" . tgl_indo($aset->tgl_inventaris) . "</td>
                <td>$aset->kategori</td>
                <td>$q->keterangan</td>            
            </tr> ";
            $no++;
        }
        echo"</table>";
    }

    function cetak() {
        $awal = $this->session->userdata('awal');
        $akhir = $this->session->userdata('akhir');
        $tgl_awal = tgl_balik($awal);
        $tgl_akhir = tgl_balik($akhir);
        $data = $this->db->query("SELECT * FROM sima_pemusnahan_inv WHERE tanggal BETWEEN '$awal' AND '$akhir' ORDER BY id_hapus ASC")->result();

        if (empty($awal) && ($akhir)) {
            $header = "<label>SILAHKAN MASUKAN TANGGAL AWAL DAN TANGGAL AKHIR KEMBALI</label>";
        } else {
            $header = "<label>PEMUSNAHAN INVENTARIS TANGGAL '$tgl_awal' s/d '$tgl_akhir' AKBID HI PEKALONGAN";
        }
        echo '<head>
                <style>
                table {
                    border-collapse: collapse;
                }

                table, td, th {
                    border: 1px solid black;
                }
                </style>
                </head>
                <body>';
        echo '<body onload="window.print();">';
        echo "<br><br>";
        echo $header;
        echo "<br><br>";
        echo "<table class='table table-bordered'>
                <tr>
                  <th>No</th>
                  <th>Tgl Pemusanahan</th>
                  <th>kode Aset</th>
                  <th>Nama</th>
                  <th>Merek</th>
                  <th>Tgl Inventaris</th> 
                  <th>Kategori</th>
                  <th>Keterangan Pemusnahan</th>
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $aset = $this->db->get_where('sima_data_inventaris', array('kode_inventaris' => $q->kode_inventaris))->row();
            echo " 
            <tr>
                <td>$no</td>
                <td>" . tgl_indo($q->tanggal) . "</td>
                <td>$q->kode_inventaris</td>
                <td>$aset->nama_inventaris</td>
                <td>$aset->merek</td>
                <td>" . tgl_indo($aset->tgl_inventaris) . "</td>
                <td>$aset->kategori</td>
                <td>$q->keterangan</td>            
            </tr> ";
            $no++;
        }
        echo"</table>";
    }

    function excel() {
        $awal = $this->input->post('datepicker', TRUE);
        $akhir = $this->input->post('datepicker2', TRUE);
        $this->load->helper('exportexcel');
        $namaFile = "Pemusnahan_Aset_$awal-$akhir.xls";
        $judul = "Pemusnahan Data Aset ";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");        
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Pemusnahan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Inventaris");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Inventaris");
        xlsWriteLabel($tablehead, $kolomhead++, "Asal Inventaris");
        xlsWriteLabel($tablehead, $kolomhead++, "Kepemilikan");
        xlsWriteLabel($tablehead, $kolomhead++, "Merek");
        xlsWriteLabel($tablehead, $kolomhead++, "Harga Beli");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Inventaris");
        xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kategori");
        xlsWriteLabel($tablehead, $kolomhead++, "Lokasi");
        xlsWriteLabel($tablehead, $kolomhead++, "Keterang Pemusnahan");

        $status = $this->input->post('status');
        $tglawal = tgl_db($this->input->post('datepicker', TRUE));
        $tglakhir = tgl_db($this->input->post('datepicker2', TRUE));
        $getdata = $this->db->query("SELECT * FROM sima_pemusnahan_inv WHERE tanggal BETWEEN '$tglawal' AND '$tglakhir' ORDER BY id_hapus ASC")->result();

        foreach ($getdata as $q) {
            $data = $this->db->get_where('sima_data_inventaris', array('kode_inventaris' => $q->kode_inventaris))->row();
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $q->tanggal);
            xlsWriteLabel($tablebody, $kolombody++, $data->kode_inventaris);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_inventaris);
            xlsWriteLabel($tablebody, $kolombody++, $data->asal_inventaris);
            xlsWriteLabel($tablebody, $kolombody++, $data->kepemilikan);
            xlsWriteLabel($tablebody, $kolombody++, $data->merek);
            xlsWriteLabel($tablebody, $kolombody++, $data->harga_beli);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_inventaris);
            xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
            xlsWriteLabel($tablebody, $kolombody++, $data->kategori);
            xlsWriteLabel($tablebody, $kolombody++, $data->lokasi);
            xlsWriteLabel($tablebody, $kolombody++, $q->keterangan);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
