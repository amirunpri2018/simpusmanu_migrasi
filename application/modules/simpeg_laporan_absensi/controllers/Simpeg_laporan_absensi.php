<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpeg_laporan_absensi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cuti_model');
        chek_session();
        cek_menu();
    }

    public function index() {
        if (isset($_POST['submit'])) {
            $tgl_awal = tgl_db($this->input->post('tanggal_awal', TRUE));
            $tgl_akhir = tgl_db($this->input->post('tanggal_akhir', TRUE));
            $data = array(
                'tgl_awal' => $this->input->post('tanggal_awal', TRUE),
                'tgl_akhir' => $this->input->post('tanggal_akhir', TRUE),
            );
            $this->session->set_userdata($data);
            $data['absensi'] = $this->db->query("SELECT* FROM simpeg_data_absensi as da,simpeg_master_izin as iz WHERE da.id_izin=iz.id_izin AND da.kehadiran='HADIR' AND da.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY da.tanggal DESC")->result();
            $this->template->display('simpeg_data_absensi_list', $data);
        } else {
            $bln = date('m');
            $data = array(
                'tgl_awal' => "",
                'tgl_akhir' => "",
            );
            $data['absensi'] = $this->db->query("SELECT* FROM simpeg_data_absensi as da,simpeg_master_izin as iz WHERE da.id_izin=iz.id_izin AND da.kehadiran='HADIR' ORDER BY da.tanggal DESC")->result();
            $this->template->display('simpeg_data_absensi_list', $data);
        }
    }

    function cariTglAwal() {
        $awal = tgl_db($this->input->get('awal'));
        $tgl_awal = $this->input->get('awal');
        //$akhir = tgl_db($this->input->get('akhir'));        
        $data = $this->db->query("SELECT * FROM simpeg_data_absensi WHERE tanggal='$awal' ORDER BY tanggal ASC")->result();
        echo "<label>DATA ABSENSI TANGGAL '$tgl_awal' </label>";
        echo '<a href="' . base_url('simpeg_laporan_absensi/cetak/') . '" target="_blank" ><i class="btn btn-md fa fa-print" data-toggle="tooltip" title="Print"></i>';
        echo "<table class='table table-bordered'>
                <tr>
                  <th>No</th>
                  <th>Tanggal Absensi</th>
                  <th>NIP</th>                  
                  <th>Nama Pegawai</th>
                  <th>Kehadiran</th>
                  <th>Keterangan</th>
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $pegawai = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $q->id_pegawai))->row_array();
            $izin = $this->db->get_where('simpeg_master_izin', array('id_izin' => $q->id_izin))->row_array();
            echo " 
            <tr>
                <td>$no</td>
                <td>" . tgl_balik($q->tanggal) . "</td>
                <td>" . $pegawai['nip'] . "</td>
                <td>" . $pegawai['nama_pegawai'] . "</td>
                <td>$q->kehadiran</td>
                <td>" . $izin['keterangan'] . "</td>
               
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
        $this->session->set_userdata('awal',$awal);
        $this->session->set_userdata('akhir',$akhir);
        $data = $this->db->query("SELECT * FROM simpeg_data_absensi WHERE tanggal BETWEEN '$awal' AND '$akhir' ORDER BY tanggal ASC")->result();
        echo "<label>DATA ABSENSI DARI TANGGAL '$tgl_awal' s/d '$tgl_akhir' </label>";
        echo '<a href="' . base_url('simpeg_laporan_absensi/cetak/') . '" target="_blank" ><i class="btn btn-md fa fa-print" data-toggle="tooltip" title="Print"></i>';
        echo "<table class='table table-bordered'>
                <tr>
                  <th>No</th>
                  <th>Tanggal Absensi</th>
                  <th>NIP</th>                  
                  <th>Nama Pegawai</th>
                  <th>Kehadiran</th>
                  <th>Keterangan</th>
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $pegawai = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $q->id_pegawai))->row_array();
            $izin = $this->db->get_where('simpeg_master_izin', array('id_izin' => $q->id_izin))->row_array();
            echo " 
            <tr>
                <td>$no</td>
                <td>" . tgl_balik($q->tanggal) . "</td>
                <td>" . $pegawai['nip'] . "</td>
                <td>" . $pegawai['nama_pegawai'] . "</td>
                <td>$q->kehadiran</td>
                <td>" . $izin['keterangan'] . "</td>
               
            </tr> ";
            $no++;
        }
        echo"</table>";
    }
    
    function cetak(){
        $awal = $this->session->userdata('awal');
        $akhir = $this->session->userdata('akhir');
        $tgl_awal = tgl_balik($awal);
        $tgl_akhir = tgl_balik($akhir);
        if(empty($awal) && empty($akhir)){
            $header="<label>SILAHKAN MASUKAN TANGGAL AWAL DAN TANGGAL AKHIR KEMBALI</label>";
        }else{
            $header="<label>DATA ABSENSI DARI TANGGAL '$tgl_awal' s/d '$tgl_akhir' AKBID HI PEKALONGAN</label>";
        }        
        $data = $this->db->query("SELECT * FROM simpeg_data_absensi WHERE tanggal BETWEEN '$awal' AND '$akhir' ORDER BY tanggal ASC")->result();
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
        echo $header;
        echo "<br><br>";
        echo "<table class='table table-bordered'>
                <tr>
                  <th>No</th>
                  <th>Tanggal Absensi</th>
                  <th>NIP</th>                  
                  <th>Nama Pegawai</th>
                  <th>Kehadiran</th>
                  <th>Keterangan</th>
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $pegawai = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $q->id_pegawai))->row_array();
            $izin = $this->db->get_where('simpeg_master_izin', array('id_izin' => $q->id_izin))->row_array();
            echo " 
            <tr>
                <td>$no</td>
                <td>" . tgl_balik($q->tanggal) . "</td>
                <td>" . $pegawai['nip'] . "</td>
                <td>" . $pegawai['nama_pegawai'] . "</td>
                <td>$q->kehadiran</td>
                <td>" . $izin['keterangan'] . "</td>
               
            </tr> ";
            $no++;
        }
        echo"</table>";
        $this->session->unset_userdata('awal');
        $this->session->unset_userdata('akhir');
    }

    public function excel() {
        $awal=$this->input->post('datepicker', TRUE);
        $akhir=$this->input->post('datepicker2', TRUE);
        $this->load->helper('exportexcel');
        $namaFile = "data_absensi_$awal-$akhir.xls";
        $judul = "data kehadiran pegawai";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
        xlsWriteLabel($tablehead, $kolomhead++, "NIP");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Pegawai");
        xlsWriteLabel($tablehead, $kolomhead++, "Kehadiran");
        $tglawal = tgl_db($this->input->post('datepicker', TRUE));
        $tglakhir = tgl_db($this->input->post('datepicker2', TRUE));
        $getdata = $this->db->query("SELECT * FROM simpeg_data_absensi WHERE tanggal BETWEEN '$tglawal' AND '$tglakhir' ORDER BY tanggal ASC")->result();
        //$query=$this->db->get_where('simpeg_data_absensi',array('kehadiran'=>'HADIR'))->result();
        foreach ($getdata as $data) {
            $pegawai = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $data->id_pegawai))->row_array();
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
            xlsWriteLabel($tablebody, $kolombody++, $pegawai['nip']);
            xlsWriteLabel($tablebody, $kolombody++, $pegawai['nama_pegawai']);
            xlsWriteLabel($tablebody, $kolombody++, $data->kehadiran);
            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
