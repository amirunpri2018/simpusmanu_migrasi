<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sima_laporan_aset extends CI_Controller {

    function __construct() {
        parent::__construct();
        chek_session();
        cek_menu();
    }

    public function index() {
        $tgl_awal = tgl_db($this->input->post('tanggal_awal', TRUE));
        $tgl_akhir = tgl_db($this->input->post('tanggal_akhir', TRUE));
        $data = array(
            'tgl_awal' => $this->input->post('tanggal_awal', TRUE),
            'tgl_akhir' => $this->input->post('tanggal_akhir', TRUE),
        );
        $data['status'] = $this->db->get('sima_master_status')->result();
        $this->template->display('sima_laporan_aset_list', $data);
    }

    function cariStatus() {
        $status = $this->input->get('id');
        $nama_status = $this->db->get_where('sima_master_status', array('id_status' => $status))->row();
        if ($status == "all_status") {
            $cari_status = " ALL STATUS";
            $data = $this->db->get_where('sima_data_inventaris', array('penghapusan' => '0'))->result();
        } else {
            $cari_status = $nama_status->status;
            $data = $this->db->get_where('sima_data_inventaris', array('id_status' => $status, 'penghapusan' => '0'))->result();
        }
        $this->session->set_userdata('status', $status);
        echo "<label>DATA INVENTARIS DENGAN STATUS $cari_status  </label>";
        echo '<a href="' . base_url('sima_laporan_aset/cetakstatus/') . '" target="_blank" ><i class="btn btn-md fa fa-print" data-toggle="tooltip" title="Print"></i>';
        echo "<br><br>";
        echo "<table class='table table-bordered'>
                <tr>
                  <th>No</th>
                  <th>kode Aset</th>
                  <th>Nama</th>
                  <th>Merek</th>
                  <th>Tgl Inventaris</th> 
                  <th>Kategori</th>
                  <th>Lokasi</th>
                  <th>Status</th>
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $status = $this->db->get_where('sima_master_status', array('id_status' => $q->id_status))->row();
            echo " 
            <tr>
                <td>$no</td>
                <td>$q->kode_inventaris</td>
                <td>$q->nama_inventaris</td>
                <td>$q->merek</td>
                <td>" . tgl_indo($q->tgl_inventaris) . "</td>
                <td>$q->kategori</td>
                <td>$q->lokasi</td>
                <td>$status->status</td>
            </tr> ";
            $no++;
        }
        echo"</table>";
    }

    function cariTglAwal() {
        $awal = tgl_db($this->input->get('awal'));
        $tgl_awal = $this->input->get('awal');
        //$akhir = tgl_db($this->input->get('akhir'));        
        $data = $this->db->query("SELECT * FROM sima_data_inventaris WHERE tgl_inventaris='$awal' AND penghapusan='0' ORDER BY id_inventaris ASC")->result();
        echo "<label>DATA INVENTARIS TANGGAL $tgl_awal </label>";
        echo '<a href="' . base_url('sima_laporan_aset/cetak/') . '" target="_blank" ><i class="btn btn-md fa fa-print" data-toggle="tooltip" title="Print"></i>';
        echo "<table class='table table-bordered'>
                <tr>
                  <th>No</th>
                  <th>kode Aset</th>
                  <th>Nama</th>
                  <th>Merek</th>
                  <th>Tgl Inventaris</th> 
                  <th>Kategori</th>
                  <th>Lokasi</th>
                  <th>Status</th>
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $status = $this->db->get_where('sima_master_status', array('id_status' => $q->id_status))->row();
            echo " 
            <tr>
                <td>$no</td>
                <td>$q->kode_inventaris</td>
                <td>$q->nama_inventaris</td>
                <td>$q->merek</td>
                <td>" . tgl_indo($q->tgl_inventaris) . "</td>
                <td>$q->kategori</td>
                <td>$q->lokasi</td>
                <td>$status->status</td>               
            </tr> ";
            $no++;
        }
        echo"</table>";
    }

    function cariTglAkhir() {
        $status = $this->input->get('status');
        $awal = tgl_db($this->input->get('awal'));
        $akhir = tgl_db($this->input->get('akhir'));
        $tgl_awal = $this->input->get('awal');
        $tgl_akhir = $this->input->get('akhir');
        $this->session->set_userdata('awal', $awal);
        $this->session->set_userdata('akhir', $akhir);
        $this->session->set_userdata('status', $status);
        if ($status == "all_status") {
            $data = $this->db->query("SELECT * FROM sima_data_inventaris WHERE penghapusan='0' AND tgl_inventaris BETWEEN '$awal' AND '$akhir' ORDER BY id_inventaris ASC")->result();
        } else {
            $data = $this->db->query("SELECT * FROM sima_data_inventaris WHERE id_status='$status' AND penghapusan='0' AND tgl_inventaris BETWEEN '$awal' AND '$akhir' ORDER BY id_inventaris ASC")->result();
        }
        echo "<label>DATA INEVNTARIS DARI TANGGAL '$tgl_awal' s/d '$tgl_akhir' </label>";
        echo '<a href="' . base_url('sima_laporan_aset/cetak/') . '" target="_blank" ><i class="btn btn-md fa fa-print" data-toggle="tooltip" title="Print"></i>';
        echo "<table class='table table-bordered'>
                <tr>
                  <th>No</th>
                  <th>kode Aset</th>
                  <th>Nama</th>
                  <th>Merek</th>
                  <th>Tgl Inventaris</th> 
                  <th>Kategori</th>
                  <th>Lokasi</th>
                  <th>Status</th>
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $status = $this->db->get_where('sima_master_status', array('id_status' => $q->id_status))->row();
            echo " 
            <tr>
                <td>$no</td>
                <td>$q->kode_inventaris</td>
                <td>$q->nama_inventaris</td>
                <td>$q->merek</td>
                <td>" . tgl_indo($q->tgl_inventaris) . "</td>
                <td>$q->kategori</td>
                <td>$q->lokasi</td>
                <td>$status->status</td>  
            </tr> ";
            $no++;
        }
        echo"</table>";
    }

    function cetakstatus() {
        $status = $this->session->userdata('status');
        $nama_status = $this->db->get_where('sima_master_status', array('id_status' => $status))->row();
        if ($status == "all_status") {
            $cari_status = " ALL STATUS";
            $data = $this->db->get_where('sima_data_inventaris', array('penghapusan' => '0'))->result();
        } else {
            $cari_status = $nama_status->status;
            $data = $this->db->get_where('sima_data_inventaris', array('id_status' => $status, 'penghapusan' => '0'))->result();
        }
        if (empty($status)) {
            $header = "<label>SILAHKAN PILIH STATUS YANG AKAN DI CETAK</label>";
        } else {
            $header = "<label>DATA INVENTARIS DENGAN STATUS $cari_status  </label>";
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
                  <th>kode Aset</th>
                  <th>Nama</th>
                  <th>Merek</th>
                  <th>Tgl Inventaris</th> 
                  <th>Kategori</th>
                  <th>Lokasi</th>
                  <th>Status</th>
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $status = $this->db->get_where('sima_master_status', array('id_status' => $q->id_status))->row();
            echo " 
            <tr>
                <td>$no</td>
                <td>$q->kode_inventaris</td>
                <td>$q->nama_inventaris</td>
                <td>$q->merek</td>
                <td>" . tgl_indo($q->tgl_inventaris) . "</td>
                <td>$q->kategori</td>
                <td>$q->lokasi</td>
                <td>$status->status</td>  
            </tr> ";
            $no++;
        }
        echo"</table>";
        $this->session->unset_userdata('status');
        $this->session->unset_userdata('awal');
        $this->session->unset_userdata('akhir');
    }

    function cetak() {
        $awal = $this->session->userdata('awal');
        $akhir = $this->session->userdata('akhir');
        $tgl_awal = tgl_balik($awal);
        $tgl_akhir = tgl_balik($akhir);
        $status = $this->session->userdata('status');
        $nama_status = $this->db->get_where('sima_master_status', array('id_status' => $status))->row();
        if ($status == "all_status") {
            $cari_status = " ALL STATUS";
            $data = $this->db->query("SELECT * FROM sima_data_inventaris WHERE penghapusan='0' AND tgl_inventaris BETWEEN '$awal' AND '$akhir' ORDER BY id_inventaris ASC")->result();
        } else {
            $cari_status = $nama_status->status;
            $getdata = $this->db->query("SELECT * FROM sima_data_inventaris WHERE id_status=$status AND penghapusan='0' AND tgl_inventaris BETWEEN '$awal' AND '$akhir' ORDER BY id_inventaris ASC")->result();
        }
        if (empty($status)) {
            $header = "<label>SILAHKAN PILIH STATUS YANG AKAN DI CETAK</label>";
        } else if (empty($awal) && ($akhir)) {
            $header = "<label>SILAHKAN MASUKAN TANGGAL AWAL DAN TANGGAL AKHIR KEMBALI</label>";
        }else{
            $header="<label>DATA INVENTARIS TANGGAL '$tgl_awal' s/d '$tgl_akhir' AKBID HI PEKALONGAN";
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
                  <th>kode Aset</th>
                  <th>Nama</th>
                  <th>Merek</th>
                  <th>Tgl Inventaris</th> 
                  <th>Kategori</th>
                  <th>Lokasi</th>
                  <th>Status</th>
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $status = $this->db->get_where('sima_master_status', array('id_status' => $q->id_status))->row();
            echo " 
            <tr>
                <td>$no</td>
                <td>$q->kode_inventaris</td>
                <td>$q->nama_inventaris</td>
                <td>$q->merek</td>
                <td>" . tgl_indo($q->tgl_inventaris) . "</td>
                <td>$q->kategori</td>
                <td>$q->lokasi</td>
                <td>$status->status</td>  
            </tr> ";
            $no++;
        }
        echo"</table>";
        $this->session->unset_userdata('status');
    }

    function excel() {
        $awal = $this->input->post('datepicker', TRUE);
        $akhir = $this->input->post('datepicker2', TRUE);
        $this->load->helper('exportexcel');
        $namaFile = "Status_data_aset_$awal-$akhir.xls";
        $judul = "Status Data Aset ";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Status");

        $status = $this->input->post('status');
        $tglawal = tgl_db($this->input->post('datepicker', TRUE));
        $tglakhir = tgl_db($this->input->post('datepicker2', TRUE));
        if ($status == "all_status") {
            $getdata = $this->db->query("SELECT * FROM sima_data_inventaris WHERE penghapusan='0' AND tgl_inventaris BETWEEN '$tglawal' AND '$tglakhir' ORDER BY id_inventaris ASC")->result();
        } else {
            $getdata = $this->db->query("SELECT * FROM sima_data_inventaris WHERE id_status=$status AND penghapusan='0' AND tgl_inventaris BETWEEN '$tglawal' AND '$tglakhir' ORDER BY id_inventaris ASC")->result();
        }
        foreach ($getdata as $data) {
            $namastatus = $this->db->get_where('sima_master_status', array('id_status' => $data->id_status))->row();
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
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
            xlsWriteLabel($tablebody, $kolombody++, $namastatus->status);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
