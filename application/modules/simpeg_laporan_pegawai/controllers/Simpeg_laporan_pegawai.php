<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpeg_laporan_pegawai extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Pegawai_model');
        chek_session();
        cek_menu();
    }

    public function index() {
        $data['status'] = $this->db->get('simpeg_master_status_pegawai')->result();
        $this->template->display('simpeg_laporan_pegawai', $data);
    }

    function cariKategori() {
        $status = $this->input->get('id');
        $kategori = $this->input->get('kategori');
        $nama_status=$this->db->get_where('simpeg_master_status_pegawai',array('id_status'=>$status))->row_array();
        if ($status == "all_status" && $kategori == "all_kategori") {
            $data = $this->db->get('simpeg_data_pegawai')->result();
            $header="<label>DATA DOSEN & PEGAWAI POLITEKNIK PUSMANU</label>";
        }else if($status == "all_status"){
            $data = $this->db->get_where('simpeg_data_pegawai', array('jenis_pegawai' => $kategori))->result();
            $header="<label>DATA ".strtoupper($kategori)." POLITEKNIK PUSMANU</label>";
        }else {
            $data = $this->db->get_where('simpeg_data_pegawai', array('id_status' => $status, 'jenis_pegawai' => $kategori))->result();
            $header="<label>DATA ".strtoupper($kategori)." DENGAN STATUS ". strtoupper($nama_status['nama_status'])." POLITEKNIK PUSMANU</label>";            
        }
        echo $header;
        echo '<a href="' . base_url('simpeg_laporan_pegawai/cetak/') . '" target="_blank" ><i class="btn btn-md fa fa-print" data-toggle="tooltip" title="Print"></i>';
        echo "<br><br>";
        echo "<table class='table table-bordered'>
                <tr>
                  <th>No</th>
                  <th>NIP</th>
                  <th>Nama Pegawai</th>
                  <th>Gender</th>
                  <th>Alamat</th> 
                  <th>Tanggal Masuk</th>                  
                  <th>Unit Kerja</th>
                  <th>Jabatan</th>
                  <th>Status</th>
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $jabatan = $this->db->get_where('simpeg_master_jabatan', array('id' => $q->id_jabatan))->row_array();
            $status = $this->db->get_where('simpeg_master_status_pegawai', array('id_status' => $q->id_status))->row_array();
            $unitkerja = $this->db->get_where('simpeg_master_unit_kerja', array('id_unitkerja' => $q->id_unitkerja))->row_array();
            echo " 
            <tr>
                <td>$no</td>
                <td>$q->nip</td>
                <td>$q->nama_pegawai</td>
                <td>$q->jenis_kelamin</td>
                <td>$q->alamat</td>
                <td>" . tgl_indo($q->tanggal_masuk) . "</td>
                <td>" . $unitkerja['nama_unitkerja'] . "</td>
                <td>" . $jabatan['nama_jabatan'] . "</td>
                <td>" . $status['nama_status'] . "</td>
            </tr> ";
            $no++;
        }
        echo"</table>";
    }

    function cariStatus() {
        $status = $this->input->get('id');
        $kategori = $this->input->get('kategori');
        $this->session->set_userdata('status',$status);
        $this->session->set_userdata('kategori',$kategori);
        $nama_status=$this->db->get_where('simpeg_master_status_pegawai',array('id_status'=>$status))->row_array();
        if ($kategori == "all_kategori" && $status == "all_status" ) {
            $data = $this->db->get('simpeg_data_pegawai')->result();
            $header="<label>DATA DOSEN & PEGAWAI POLITEKNIK PUSMANU</label>";
        }else if($kategori == "all_kategori"){
            $data = $this->db->get_where('simpeg_data_pegawai', array('status_pegawai' =>$status))->result();
            $header="<label>DATA DOSEN & PEGAWAI POLITEKNIK PUSMANU</label>";
        }else if($kategori == "Dosen" && $status == "all_status"){
            $data = $this->db->get_where('simpeg_data_pegawai', array('jenis_pegawai' =>'Dosen'))->result();
            $header="<label>DATA DOSEN POLITEKNIK PUSMANU</label>";
        }else if($kategori == "Pegawai" && $status == "all_status"){
            $data = $this->db->get_where('simpeg_data_pegawai', array('jenis_pegawai' =>'Pegawai'))->result();
            $header="<label>DATA PEGAWAI POLITEKNIK PUSMANU</label>";
        }else {
            $data = $this->db->get_where('simpeg_data_pegawai', array('status_pegawai' => $status, 'jenis_pegawai' => $kategori))->result();
            $header="<label>DATA ".strtoupper($kategori)." DENGAN STATUS ". strtoupper($nama_status['nama_status'])." POLITEKNIK PUSMANU</label>";                        
        }
        echo $header;
        echo '<a href="' . base_url('simpeg_laporan_pegawai/cetak/') . '" target="_blank" ><i class="btn btn-md fa fa-print" data-toggle="tooltip" title="Print"></i>';
        echo "<br><br>";
        echo "<table class='table table-bordered'>
                <tr>
                  <th>No</th>
                  <th>NIP</th>
                  <th>Nama Pegawai</th>
                  <th>Gender</th>
                  <th>Alamat</th> 
                  <th>Tanggal Masuk</th>                  
                  <th>Unit Kerja</th>
                  <th>Jabatan</th>
                  <th>Status</th>
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $jabatan = $this->db->get_where('simpeg_master_jabatan', array('id' => $q->id_jabatan))->row_array();
            $status = $this->db->get_where('simpeg_master_status_pegawai', array('id_status' => $q->id_status))->row_array();
            $unitkerja = $this->db->get_where('simpeg_master_unit_kerja', array('id_unitkerja' => $q->id_unitkerja))->row_array();
            echo " 
            <tr>
                <td>$no</td>
                <td>$q->nip</td>
                <td>$q->nama_pegawai</td>
                <td>$q->jenis_kelamin</td>
                <td>$q->alamat</td>
                <td>" . tgl_indo($q->tanggal_masuk) . "</td>
                <td>" . $unitkerja['nama_unitkerja'] . "</td>
                <td>" . $jabatan['nama_jabatan'] . "</td>
                <td>" . $status['nama_status'] . "</td>
            </tr> ";
            $no++;
        }
        echo"</table>";
    }
    
    function cetak(){
        $status = $this->session->userdata('status');
        $kategori = $this->session->userdata('kategori');
        $nama_status=$this->db->get_where('simpeg_master_status_pegawai',array('id_status'=>$status))->row_array();
        if ($kategori == "all_kategori" && $status == "all_status" ) {
            $data = $this->db->get('simpeg_data_pegawai')->result();
            $header="<label>DATA DOSEN & PEGAWAI POLITEKNIK PUSMANU</label>";
        }else if($kategori == "all_kategori"){
            $data = $this->db->get_where('simpeg_data_pegawai', array('id_status' =>$status))->result();
            $header="<label>DATA DOSEN & PEGAWAI POLITEKNIK PUSMANU</label>";
        }else if($kategori == "Dosen" && $status == "all_status"){
            $data = $this->db->get_where('simpeg_data_pegawai', array('jenis_pegawai' =>'Dosen'))->result();
            $header="<label>DATA DOSEN POLITEKNIK PUSMANU</label>";
        }else if($kategori == "Pegawai" && $status == "all_status"){
            $data = $this->db->get_where('simpeg_data_pegawai', array('jenis_pegawai' =>'Pegawai'))->result();
            $header="<label>DATA PEGAWAI POLITEKNIK PUSMANU</label>";
        }else {
            $data = $this->db->get_where('simpeg_data_pegawai', array('id_status' => $status, 'jenis_pegawai' => $kategori))->result();
            $header="<label>DATA ".strtoupper($kategori)." DENGAN STATUS ". strtoupper($nama_status['nama_status'])." POLITEKNIK PUSMANU</label>";                        
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
        echo $header;        
        echo "<br><br>";
        echo "<table class='table table-bordered'>
                <tr>
                  <th>No</th>
                  <th>NIP</th>
                  <th>Nama Pegawai</th>
                  <th>Gender</th>
                  <th>Alamat</th> 
                  <th>Tanggal Masuk</th>                  
                  <th>Unit Kerja</th>
                  <th>Jabatan</th>
                  <th>Status</th>
                </tr>";
        $no = 1;
        foreach ($data as $q) {
            $jabatan = $this->db->get_where('simpeg_master_jabatan', array('id' => $q->id_jabatan))->row_array();
            $status = $this->db->get_where('simpeg_master_status_pegawai', array('id_status' => $q->id_status))->row_array();
            $unitkerja = $this->db->get_where('simpeg_master_unit_kerja', array('id_unitkerja' => $q->id_unitkerja))->row_array();
            echo " 
            <tr>
                <td>$no</td>
                <td>$q->nip</td>
                <td>$q->nama_pegawai</td>
                <td>$q->jenis_kelamin</td>
                <td>$q->alamat</td>
                <td>" . tgl_indo($q->tanggal_masuk) . "</td>
                <td>" . $unitkerja['nama_unitkerja'] . "</td>
                <td>" . $jabatan['nama_jabatan'] . "</td>
                <td>" . $status['nama_status'] . "</td>
            </tr> ";
            $no++;
        }
        echo"</table>";
        $this->session->unset_userdata('status');
        $this->session->unset_userdata('kategori');
    }

    public function index2() {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'simpeg_laporan_pegawai/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'simpeg_laporan_pegawai/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'simpeg_laporan_pegawai/index.html';
            $config['first_url'] = base_url() . 'simpeg_laporan_pegawai/index.html';
        }

        $config['per_page'] = 50;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pegawai_model->total_rows($q);
        $simpeg_laporan_pegawai = $this->Pegawai_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'simpeg_laporan_pegawai_data' => $simpeg_laporan_pegawai,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->display('simpeg_data_pegawai_list', $data);
    }

    function excel() {
        $this->load->helper('exportexcel');
        $namaFile = "laporan_data_pegawai.xls";
        $judul = "Laporan Data Pegawai ";
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
        xlsWriteLabel($tablehead, $kolomhead++, "NIDN");
        xlsWriteLabel($tablehead, $kolomhead++, "NIP");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Pegawai");
        xlsWriteLabel($tablehead, $kolomhead++, "Tempat,Tgl Lahir");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
        xlsWriteLabel($tablehead, $kolomhead++, "Agama");
        xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Masuk");
        xlsWriteLabel($tablehead, $kolomhead++, "Unit Kerja");
        xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        xlsWriteLabel($tablehead, $kolomhead++, "NPWP");
        xlsWriteLabel($tablehead, $kolomhead++, "Keahlian");
        xlsWriteLabel($tablehead, $kolomhead++, "Catatan");
        xlsWriteLabel($tablehead, $kolomhead++, "No HP");
        xlsWriteLabel($tablehead, $kolomhead++, "Email");
        
        $kategori = $this->input->post('kategori');
        $status = $this->input->post('status');
        
        if ($kategori=="all_kategori" && $status =="all_status") {
            $getdata = $this->db->get('simpeg_data_pegawai')->result();
        }else if($kategori =="all_kategori"){
            $getdata = $this->db->get_where('simpeg_data_pegawai', array('id_status' =>$status))->result();
        }else if($kategori == "Dosen" && $status == "all_status"){
            $getdata = $this->db->get_where('simpeg_data_pegawai', array('jenis_pegawai' =>$kategori))->result();
        }else if($kategori == "Pegawai" && $status == "all_status"){
            $getdata = $this->db->get_where('simpeg_data_pegawai', array('jenis_pegawai' =>'Pegawai'))->result();
        }else {
            $getdata = $this->db->get_where('simpeg_data_pegawai', array('id_status' => $status, 'jenis_pegawai' => $kategori))->result();
        }
        foreach ($getdata as $data) {
            $jabatan = $this->db->get_where('simpeg_master_jabatan', array('id' => $data->id_jabatan))->row_array();
            $status = $this->db->get_where('simpeg_master_status_pegawai', array('id_status' => $data->id_status))->row_array();
            $unitkerja = $this->db->get_where('simpeg_master_unit_kerja', array('id_unitkerja' => $data->id_unitkerja))->row_array();

            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nidn);
            xlsWriteLabel($tablebody, $kolombody++, $data->nip);
            xlsWriteLabel($tablebody, $kolombody++, $data->gelar_depan.$data->nama_pegawai.$data->gelar_belakang);
            xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir.', '.tgl_indo($data->tanggal_lahir));
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
            xlsWriteLabel($tablebody, $kolombody++, $data->agama);
            xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
            xlsWriteLabel($tablebody, $kolombody++, tgl_indo($data->tanggal_masuk));
            xlsWriteLabel($tablebody, $kolombody++, $unitkerja['nama_unitkerja']);
            xlsWriteLabel($tablebody, $kolombody++, $jabatan['nama_jabatan']);
            xlsWriteLabel($tablebody, $kolombody++, $status['nama_status']);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_npwp);
            xlsWriteLabel($tablebody, $kolombody++, $data->keahlian);
            xlsWriteLabel($tablebody, $kolombody++, $data->catatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
            xlsWriteLabel($tablebody, $kolombody++, $data->email);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function excel2() {
        $this->load->helper('exportexcel');
        $namaFile = "simpeg_data_pegawai.xls";
        $judul = "simpeg_data_pegawai";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nip");
        xlsWriteLabel($tablehead, $kolomhead++, "Nip Lama");
        xlsWriteLabel($tablehead, $kolomhead++, "No Kartu Pegawai");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Pegawai");
        xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
        xlsWriteLabel($tablehead, $kolomhead++, "Agama");
        xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Masuk");
        xlsWriteLabel($tablehead, $kolomhead++, "No Npwp");
        xlsWriteLabel($tablehead, $kolomhead++, "Kartu Askes Pegawai");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        xlsWriteLabel($tablehead, $kolomhead++, "Unitkerja");
        xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Nomor Sk Jabatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Sk Jabatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Mulai Jabatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Selesai Jabatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Keahlian");
        xlsWriteLabel($tablehead, $kolomhead++, "Catatan");
        foreach ($this->Pegawai_model->get_data() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nip);
            xlsWriteLabel($tablebody, $kolombody++, $data->nip_lama);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_kartu_pegawai);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_pegawai);
            xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
            xlsWriteLabel($tablebody, $kolombody++, tgl_indo($data->tanggal_lahir));
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
            xlsWriteLabel($tablebody, $kolombody++, $data->agama);
            xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
            xlsWriteLabel($tablebody, $kolombody++, tgl_indo($data->tanggal_masuk));
            xlsWriteLabel($tablebody, $kolombody++, $data->no_npwp);
            xlsWriteLabel($tablebody, $kolombody++, $data->kartu_askes_pegawai);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_unitkerja);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_jabatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->nomor_sk_jabatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_sk_jabatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_mulai_jabatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_selesai_jabatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->keahlian);
            xlsWriteLabel($tablebody, $kolombody++, $data->catatan);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
