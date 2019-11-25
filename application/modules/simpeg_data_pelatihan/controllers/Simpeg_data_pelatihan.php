<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpeg_data_pelatihan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Pelatihan_model');
        chek_session();
        cek_menu();
    }

    function index() {
       $this->template->display('simpeg_data_pelatihan_list');
    }

    function view_data() {

        $no = 1;
        $getdata = $this->db->query("SELECT simpeg_data_pelatihan.id_data_pelatihan,simpeg_data_pegawai.nip,simpeg_data_pegawai.nama_pegawai,simpeg_master_pelatihan.nama_pelatihan,
            simpeg_master_pelatihan.jenis_pelatihan,simpeg_master_lokasi_pelatihan.nama_lokasi,simpeg_data_pelatihan.tanggal,simpeg_data_pelatihan.penyelenggara,simpeg_data_pelatihan.lama_pelatihan,simpeg_data_pelatihan.catatan,simpeg_data_pelatihan.file
            FROM simpeg_data_pelatihan INNER JOIN simpeg_data_pegawai ON simpeg_data_pelatihan.id_pegawai = simpeg_data_pegawai.id_pegawai 
            INNER JOIN simpeg_master_lokasi_pelatihan ON simpeg_data_pelatihan.id_lokasi = simpeg_master_lokasi_pelatihan.id_lokasi INNER JOIN simpeg_master_pelatihan ON simpeg_data_pelatihan.id_pelatihan = simpeg_master_pelatihan.id_pelatihan 
            ORDER BY simpeg_data_pelatihan.id_data_pelatihan DESC")->result();
        foreach ($getdata as $q) {
            $query[] = array(
                'no' => $no++,
                'nip' => $q->nip,
                'nama_pegawai' => anchor('simpeg_data_pegawai/detail/' . $q->nip, $q->nama_pegawai),
                'jenis_pelatihan' => strtoupper($q->jenis_pelatihan),
                'nama_pelatihan' => $q->nama_pelatihan,
                'nama_lokasi' => $q->nama_lokasi,
                'tanggal' => tgl_lengkap($q->tanggal),
                'penyelenggara' => $q->penyelenggara,
                'lama_pelatihan' => $q->lama_pelatihan,
                'catatan' => $q->catatan,
                'file'=> anchor('/upload/pelatihan/'.$q->file,$q->file),
                'edit' => anchor('simpeg_data_pegawai/editpelatihan/' . $q->id_data_pelatihan, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>')
            );
        }
        $result = array('data' => $query);
        echo json_encode($result);
    }

    function read($id) {
        $row = $this->Pelatihan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_data_pelatihan' => $row->id_data_pelatihan,
                'id_pegawai' => $row->id_pegawai,
                'id_pelatihan' => $row->id_pelatihan,
                'id_lokasi' => $row->id_lokasi,
                'tanggal' => $row->tanggal,
                'penyelenggara' => $row->penyelenggara,
                'lama_pelatihan' => $row->lama_pelatihan,
                'catatan' => $row->catatan,
            );
            $this->template->display('simpeg_data_pelatihan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_data_pelatihan'));
        }
    }

    function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('simpeg_data_pelatihan/create_action'),
            'id_data_pelatihan' => set_value('id_data_pelatihan'),
            'id_pegawai' => set_value('pegawai'),
            'id_pelatihan' => set_value('pelatihan'),
            'id_lokasi' => set_value('lokasi'),
            'tanggal' => set_value('tanggal'),
            'penyelenggara' => set_value('penyelenggara'),
            'lama_pelatihan' => set_value('lama_pelatihan'),
            'catatan' => set_value('catatan'),
        );
        $data['pegawai']=  $this->db->get('simpeg_data_pegawai')->result();
        $data['pelatihan']=  $this->db->get('simpeg_master_pelatihan')->result();
        $data['lokasi']=  $this->db->get('simpeg_master_lokasi_pelatihan')->result();
        $this->template->display('simpeg_data_pelatihan_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $id_pegawai=$this->input->post('pegawai', TRUE);
            $new_name = $id_pegawai.kode_tanggal();
            $config['upload_path'] = './upload/pelatihan';
            $config['allowed_types'] = 'jpg|png|pdf|doc|docx|xls|xlsx';
            $config['max_size'] = '5000';
            //$config['max_width'] = '3000';
            //$config['max_height'] = '3000';
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->do_upload('file_upload');
            $up_data = $this->upload->data();
            $tanggal=$this->input->post('tanggal', TRUE);
            $data = array(
                'id_pegawai' => $this->input->post('pegawai', TRUE),
                'id_pelatihan' => $this->input->post('pelatihan', TRUE),
                'id_lokasi' => $this->input->post('lokasi', TRUE),
                'tanggal' => tgl_db($tanggal),
                'penyelenggara' => $this->input->post('penyelenggara', TRUE),
                'lama_pelatihan' => $this->input->post('lama_pelatihan', TRUE),
                'catatan' => $this->input->post('catatan', TRUE),
                'file'=>$up_data['file_name'],
            );

            $this->Pelatihan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');            
            redirect(site_url('simpeg_data_pelatihan'));
        }
    }

    public function delete($id) {
        $row = $this->Pelatihan_model->get_by_id($id);

        if ($row) {
            $this->Pelatihan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('simpeg_data_pelatihan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_data_pelatihan'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('pegawai', 'id pegawai', 'trim|required');
        $this->form_validation->set_rules('pelatihan', 'id pelatihan', 'trim|required');
        $this->form_validation->set_rules('lokasi', 'id lokasi', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
        $this->form_validation->set_rules('penyelenggara', 'penyelenggara', 'trim|required');
        $this->form_validation->set_rules('lama_pelatihan', 'lama pelatihan', 'trim|required');
        $this->form_validation->set_rules('catatan', 'catatan', 'trim|required');

        $this->form_validation->set_rules('id_data_pelatihan', 'id_data_pelatihan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel() {
        $this->load->helper('exportexcel');
        $namaFile = "simpeg_data_pelatihan.xls";
        $judul = "Data Pelatihan Pegawai";
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
        xlsWriteLabel($tablehead, $kolomhead++, "NIP");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Pegawai");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelatihan");
        xlsWriteLabel($tablehead, $kolomhead++, "Tempat");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
        xlsWriteLabel($tablehead, $kolomhead++, "Penyelenggara");
        xlsWriteLabel($tablehead, $kolomhead++, "Lama Pelatihan");
        xlsWriteLabel($tablehead, $kolomhead++, "Catatan");

        foreach ($this->Pelatihan_model->get_data() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->nip);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_pegawai);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_pelatihan);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelatihan);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_lokasi);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
            xlsWriteLabel($tablebody, $kolombody++, $data->penyelenggara);
            xlsWriteLabel($tablebody, $kolombody++, $data->lama_pelatihan);
            xlsWriteLabel($tablebody, $kolombody++, $data->catatan);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
