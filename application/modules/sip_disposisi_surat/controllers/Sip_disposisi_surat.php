<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sip_disposisi_surat extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_disposisi_surat');
        chek_session();
        cek_menu();
    }

    function index() {
        $this->template->display('sip_disposisi_surat_list');
    }

    function view_data() {
        $no = 1;
        $getdata = $this->db->query("SELECT sip_disposisi_surat.id_disposisi,sip_disposisi_surat.id_surat,sip_disposisi_surat.id_pegawai,sip_disposisi_surat.keterangan,sip_disposisi_surat.status,simpeg_data_pegawai.nip,simpeg_data_pegawai.gelar_depan,
            simpeg_data_pegawai.gelar_belakang,simpeg_data_pegawai.nama_pegawai,sip_data_surat.nomor_surat,sip_data_surat.asal_surat,sip_data_surat.kode_loker,sip_data_surat.tanggal_surat,sip_master_loker.tempat_loker
            FROM sip_disposisi_surat INNER JOIN sip_data_surat ON sip_disposisi_surat.id_surat = sip_data_surat.id_surat INNER JOIN simpeg_data_pegawai ON sip_disposisi_surat.id_pegawai = simpeg_data_pegawai.id_pegawai 
            INNER JOIN sip_master_loker ON sip_data_surat.kode_loker = sip_master_loker.kode_loker ORDER BY sip_disposisi_surat.id_disposisi DESC")->result();
        foreach ($getdata as $q) {
            if ($q->status == "SELESAI DIPROSES") {
                $status = "<span class='label label-success'>$q->status</span>";
            } else {
                $status = "<span class='label label-danger'>$q->status</span>";
            }
            $query[] = array(
                'no' => $no++,
                'nomor_surat' => $q->nomor_surat,
                'tanggal_surat' => tgl_indo($q->tanggal_surat),
                'asal_surat' => $q->asal_surat,
                'tempat_loker' => $q->tempat_loker,
                'nama_pegawai' => $q->gelar_depan . $q->nama_pegawai . $q->gelar_belakang,
                'keterangan' => $q->keterangan,
                'status' => $status,
                'action' => array(anchor('sip_disposisi_surat/create/' . $q->id_surat, '<i class="btn btn-sm btn-info fa fa-paper-plane" data-toggle="tooltip" title="Disposisi"></i>') . " " .
                    anchor('sip_disposisi_surat/update/' . $q->id_disposisi, '<i class="btn btn-sm btn-info glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . " " .
                    anchor('sip_disposisi_surat/delete/' . $q->id_disposisi, '<i class="btn btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")))
            );
        }
        $result = array('data' => $query);
        echo json_encode($result);
    }

    function create($id) {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sip_disposisi_surat/create_action'),
            'id_disposisi' => set_value('id_disposisi'),
            'id_surat' => set_value('id_surat'),
            'id_pegawai' => set_value('id_pegawai'),
            'keterangan' => set_value('keterangan'),
            'status' => set_value('status'),
            'tanggal' => set_value('tanggal'),
        );
        $data['pegawai'] = $this->db->get('simpeg_data_pegawai')->result();
        $data['surat'] = $this->db->get_where('sip_data_surat', array('id_surat' => $id))->row_array();
        $data['status_proses'] = $this->db->get('sip_master_status')->result();
        $this->template->display('sip_disposisi_surat_form', $data);
    }

    function create_action() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $id = $this->input->post('id_surat', TRUE);
            $this->create($id);
        } else {
            $data = array(
                'id_surat' => $this->input->post('id_surat', TRUE),
                'id_pegawai' => $this->input->post('id_pegawai', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'status' => $this->input->post('status', TRUE),
                'tanggal_proses' => tgl_db($this->input->post('tanggal', TRUE)),
            );

            $this->Model_disposisi_surat->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sip_disposisi_surat'));
        }
    }

    public function update($id) {
        $row = $this->Model_disposisi_surat->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sip_disposisi_surat/update_action'),
                'id_disposisi' => set_value('id_disposisi', $row->id_disposisi),
                'id_surat' => set_value('id_surat', $row->id_surat),
                'id_pegawai' => set_value('id_pegawai', $row->id_pegawai),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'status' => set_value('status', $row->status),
                'tanggal' => set_value('tanggal', tgl_balik($row->tanggal_proses)),
            );
            $data['pegawai'] = $this->db->get('simpeg_data_pegawai')->result();
            $data['surat'] = $this->db->get_where('sip_data_surat', array('id_surat' => $row->id_surat))->row_array();
            $data['status_proses'] = $this->db->get('sip_master_status')->result();
            $this->template->display('sip_disposisi_surat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sip_disposisi_surat'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_disposisi', TRUE));
        } else {
            $data = array(
                'id_surat' => $this->input->post('id_surat', TRUE),
                'id_pegawai' => $this->input->post('id_pegawai', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'status' => $this->input->post('status', TRUE),
                'tanggal_proses' => tgl_db($this->input->post('tanggal', TRUE)),
            );

            $this->Model_disposisi_surat->update($this->input->post('id_disposisi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sip_disposisi_surat'));
        }
    }

    public function delete($id) {
        $row = $this->Model_disposisi_surat->get_by_id($id);

        if ($row) {
            $this->Model_disposisi_surat->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sip_disposisi_surat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sip_disposisi_surat'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('id_surat', 'id surat', 'trim|required');
        $this->form_validation->set_rules('id_pegawai', 'id pegawai', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel() {
        $this->load->helper('exportexcel');
        $namaFile = "disposisi_surat.xls";
        $judul = "disposisi_surat";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "asal Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Loker Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Disposisi");
        xlsWriteLabel($tablehead, $kolomhead++, "Memo");

        $getdata = $this->db->query("SELECT sip_disposisi_surat.id_disposisi,sip_disposisi_surat.id_surat,sip_disposisi_surat.id_pegawai,sip_disposisi_surat.keterangan,simpeg_data_pegawai.nip,simpeg_data_pegawai.gelar_depan,
            simpeg_data_pegawai.gelar_belakang,simpeg_data_pegawai.nama_pegawai,sip_data_surat.nomor_surat,sip_data_surat.asal_surat,sip_data_surat.kode_loker,sip_data_surat.tanggal_surat,sip_data_surat.status,sip_master_loker.tempat_loker
            FROM sip_disposisi_surat INNER JOIN sip_data_surat ON sip_disposisi_surat.id_surat = sip_data_surat.id_surat INNER JOIN simpeg_data_pegawai ON sip_disposisi_surat.id_pegawai = simpeg_data_pegawai.id_pegawai 
            INNER JOIN sip_master_loker ON sip_data_surat.kode_loker = sip_master_loker.kode_loker ORDER BY sip_disposisi_surat.id_disposisi DESC")->result();

        foreach ($getdata as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nomor_surat);
            xlsWriteLabel($tablebody, $kolombody++, tgl_indo($data->tanggal_surat));
            xlsWriteLabel($tablebody, $kolombody++, $data->asal_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->tempat_loker);
            xlsWriteLabel($tablebody, $kolombody++, $data->gelar_depan.$data->nama_pegawai,$data->gelar_belakang);
            xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
