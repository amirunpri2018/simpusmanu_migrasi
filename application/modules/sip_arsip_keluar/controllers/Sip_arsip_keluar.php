<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sip_arsip_keluar extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_arsip_keluar');
        chek_session();
        cek_menu();
    }

    function index() {
        $data = array(
            'tgl_awal' => $this->input->post('tanggal_awal', TRUE),
            'tgl_akhir' => $this->input->post('tanggal_akhir', TRUE),
        );
        $this->template->display('sip_arsip_keluar_list', $data);
    }

    function view_data() {
        $no = 1;
        $this->db->order_by('id_surat', 'DESC');
        $getdata = $this->db->get_where('sip_data_surat', array('kategori_surat' => 'Surat Keluar'))->result();
        //$getdata=$this->db->query("SELECT * FROM sip_data_surat as ds,sip_master_loker as loker WHERE ds.kode_loker = loker.kode_loker AND ds.kategori_surat = 'Surat Masuk'")->result();
        foreach ($getdata as $q) {
            if ($q->status == 1) {
                $status = "<span class='label label-success'>Sudah Dibaca</span>";
            } else {
                $status = "<span class='label label-danger'>Belum Dibaca</span>";
            }
            $query[] = array(
                'no' => $no++,
                'nomor_surat' => $q->nomor_surat,
                'tanggal_surat' => tgl_indo($q->tanggal_surat),
                'asal_surat' => $q->asal_surat,
                'kode_loker' => $q->kode_loker,
                'perihal_surat' => $q->perihal_surat,
                'tujuan_surat' => $q->tujuan_surat,
                'file' => anchor_popup('upload/surat_masuk/' . $q->lampiran, $q->lampiran),
                'status' => $status,
                'action' => array(anchor('sip_arsip_masuk/read/' . $q->id_surat, '<i class="btn btn-sm btn-info fa fa-eye" data-toggle="tooltip" title="Baca Surat"></i>'))
            );
        }
        $result = array('data' => $query);
        echo json_encode($result);
    }

    function cariTglAwal() {
        $awal = tgl_db($this->input->get('awal'));
        $tgl_awal = $this->input->get('awal');
        //$akhir = tgl_db($this->input->get('akhir'));        
        $data = $this->db->query("SELECT * FROM sip_data_surat WHERE tanggal_surat='$awal' AND kategori_surat='Surat Keluar' ORDER BY id_surat DESC")->result();
        echo "<label>DATA SURAT KELUAR TANGGAL $tgl_awal </label>";
        echo '<a href="' . base_url('sip_arsip_keluar/cetak/') . '" target="_blank" ><i class="btn btn-md fa fa-print" data-toggle="tooltip" title="Print"></i>';
        echo "<table class='table table-bordered'>
                <tr>
                  <th>No</th>
                  <th>Nomor Surat</th>
                  <th>Tgl Surat</th>  
                  <th>Tujuan</th>
                  <th>Perihal</th>
                  <th>Lokasi Arsip</th>                 
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $loker = $this->db->get_where('sip_master_loker', array('kode_loker' => $q->kode_loker))->row_array();
            echo " 
            <tr>
                <td>$no</td>
                <td>$q->nomor_surat</td>
                <td>" . tgl_indo($q->tanggal_surat) . "</td>
                <td>$q->tujuan_surat</td>
                <td>$q->perihal_surat</td>
                <td>" . $loker['tempat_loker'] . "(" . $q->kode_loker . ")" . "</td>               
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
        $data = $this->db->query("SELECT * FROM sip_data_surat WHERE tanggal_surat BETWEEN '$awal' AND '$akhir' AND kategori_surat='Surat Keluar' ORDER BY id_surat DESC")->result();
        echo "<label>DATA SURAT KELUAR TANGGAL $tgl_awal s/d TANGGAL $tgl_akhir</label>";
        echo '<a href="' . base_url('sip_arsip_keluar/cetak/') . '" target="_blank" ><i class="btn btn-md fa fa-print" data-toggle="tooltip" title="Print"></i>';
        echo "<table class='table table-bordered'>
                <tr>
                  <th>No</th>
                  <th>Nomor Surat</th>
                  <th>Tgl Surat</th>  
                  <th>Tujuan</th>
                  <th>Perihal</th>
                  <th>Lokasi Arsip</th>                 
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $loker = $this->db->get_where('sip_master_loker', array('kode_loker' => $q->kode_loker))->row_array();
            echo " 
            <tr>
                <td>$no</td>
                <td>$q->nomor_surat</td>
                <td>" . tgl_indo($q->tanggal_surat) . "</td>
                <td>$q->tujuan_surat</td>
                <td>$q->perihal_surat</td>
                <td>" . $loker['tempat_loker'] . "(" . $q->kode_loker . ")" . "</td>               
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
        if (empty($awal) && empty($akhir)) {
            $header = "<label>SILAHKAN MASUKAN TANGGAL AWAL DAN TANGGAL AKHIR KEMBALI</label>";
        } else {
            $header = "<label>DATA SURAT KELUAR TANGGAL $tgl_awal s/d $tgl_akhir <br>POLITEKNIK PUSMANU PEKALONGAN</label>";
        }
        $data = $this->db->query("SELECT * FROM sip_data_surat WHERE tanggal_surat BETWEEN '$awal' AND '$akhir' AND kategori_surat='Surat Keluar' ORDER BY id_surat ASC")->result();
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
                  <th>Nomor Surat</th>
                  <th>Tgl Surat</th>  
                  <th>Pengirim</th>
                  <th>Perihal</th>
                  <th>Lokasi Arsip</th>  
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $loker = $this->db->get_where('sip_master_loker', array('kode_loker' => $q->kode_loker))->row_array();
            echo " 
            <tr>
                <td>$no</td>
                <td>$q->nomor_surat</td>
                <td>" . tgl_indo($q->tanggal_surat) . "</td>
                <td>$q->asal_surat</td>
                <td>$q->perihal_surat</td>
                <td>" . $loker['tempat_loker'] . "(" . $q->kode_loker . ")" . "</td>     
               
            </tr> ";
            $no++;
        }
        echo"</table>";
        $this->session->unset_userdata('awal');
        $this->session->unset_userdata('akhir');
    }

    function excel() {
        $awal = $this->input->post('datepicker', TRUE);
        $akhir = $this->input->post('datepicker2', TRUE);
        $this->load->helper('exportexcel');
        $namaFile = "data_surat_keluar_$awal-$akhir.xls";
        $judul = "data_surat_keluar";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nomor Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Kategori Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Sifat Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Tipe Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Tujuan Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Isi Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Pengirim");
        xlsWriteLabel($tablehead, $kolomhead++, "Perihal Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Lokasi Arsip");
        xlsWriteLabel($tablehead, $kolomhead++, "Lampiran");
        $tglawal = tgl_db($this->input->post('datepicker', TRUE));
        $tglakhir = tgl_db($this->input->post('datepicker2', TRUE));
        $getdata = $this->db->query("SELECT * FROM sip_data_surat WHERE tanggal_surat BETWEEN '$tglawal' AND '$tglakhir' AND kategori_surat='Surat Keluar' ORDER BY id_surat ASC")->result();
        //$getdata = $this->db->get_where('sip_data_surat', array('kategori_surat' => 'Surat Masuk'))->result();
        foreach ($getdata as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nomor_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->kategori_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->sifat_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->tipe_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->tujuan_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_surat);
            xlsWriteLabel($tablebody, $kolombody++, strip_tags($data->isi_surat));
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_pengirim);
            xlsWriteLabel($tablebody, $kolombody++, $data->perihal_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->kode_loker);
            xlsWriteLabel($tablebody, $kolombody++, $data->lampiran);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
