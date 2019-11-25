<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpeg_laporan_cuti extends CI_Controller {

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
            $data['absensi'] = $this->db->query("SELECT* FROM simpeg_data_absensi as da,simpeg_master_izin as iz WHERE da.id_izin=iz.id_izin AND da.kehadiran='TIDAK' AND da.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY da.tanggal DESC")->result();
            $this->template->display('simpeg_data_absensi_list', $data);
        } else {
            $bln = date('m');
            $data['absensi'] = $this->db->query("SELECT* FROM simpeg_data_absensi as da,simpeg_master_izin as iz WHERE da.id_izin=iz.id_izin AND da.kehadiran='TIDAK' ORDER BY da.tanggal DESC")->result();
            $this->template->display('simpeg_data_absensi_list', $data);
        }
    }

    public function excel() {
        $this->load->helper('exportexcel');
        $namaFile = "data_cuti_pegawai.xls";
        $judul = "data cuti pegawai";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Awal");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Akhir");
        
        $query=$this->db->get_where('simpeg_data_absensi',array('kehadiran'=>'TIDAK'))->result();
        foreach ($query as $data) {
            $pegawai=$this->db->get_where('simpeg_data_pegawai',array('id_pegawai'=>$data->id_pegawai))->row_array();
            $izin=$this->db->get_where('simpeg_master_izin',array('id_izin'=>$data->id_izin))->row_array();
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
            xlsWriteLabel($tablebody, $kolombody++, $pegawai['nip']);
            xlsWriteLabel($tablebody, $kolombody++, $pegawai['nama_pegawai']);
            xlsWriteLabel($tablebody, $kolombody++, $data->kehadiran);
            xlsWriteLabel($tablebody, $kolombody++, $izin['keterangan']);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_awal);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_akhir);
            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
