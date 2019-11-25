<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpeg_data_absensi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Absensi_model');
        chek_session();
        cek_menu();
    }

    public function index() {
        if (isset($_POST['submit'])) {
            $tgl_awal= tgl_db($this->input->post('tanggal_awal',TRUE));
            $tgl_akhir= tgl_db($this->input->post('tanggal_akhir',TRUE));
            $data['absensi'] = $this->db->query("SELECT* FROM simpeg_data_absensi WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tanggal DESC")->result();
            $this->template->display('simpeg_data_absensi_list', $data);
        } else {
            $bln = date('m');
            $data['absensi'] = $this->db->query("SELECT* FROM simpeg_data_absensi WHERE MONTH(tanggal)=$bln ORDER BY tanggal DESC")->result();
            $this->template->display('simpeg_data_absensi_list', $data);
        }
    }

    public function read($id) {
        $row = $this->Absensi_model->get_by_id($id);
        if ($row) {
            $id_pegawai = $row->id_pegawai;
            $id_izin = $row->id_izin;
            $pegawai = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id_pegawai))->row_array();
            $izin = $this->db->get_where('simpeg_master_izin', array('id_izin' => $id_izin))->row_array();
            $data = array(
                'id_absensi' => $row->id_absensi,
                'tanggal' => $row->tanggal,
                'nama_pegawai' => $pegawai['nama_pegawai'],
                'kehadiran' => $row->kehadiran,
                'id_izin' => $row->id_izin,
                'jenis_izin' => $izin['jenis'],
                'ket_izin' => $izin['keterangan'],
                'tgl_awal' => $row->tgl_awal,
                'tgl_akhir' => $row->tgl_akhir,
                'file' => $row->file,
            );
            $this->template->display('simpeg_data_absensi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_data_absensi'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('simpeg_data_absensi/create_action'),
            'id_absensi' => set_value('id_absensi'),
            'tanggal' => set_value('tanggal'),
            'id_pegawai' => set_value('id_pegawai'),
            'kehadiran' => set_value('kehadiran'),
            'id_izin' => set_value('id_izin'),
            'tgl_awal' => set_value('tgl_awal'),
            'tgl_akhir' => set_value('tgl_akhir'),
            'file' => set_value('file'),
        );
        $data['pegawai'] = $this->db->get('simpeg_data_pegawai')->result();
        $data['izin'] = $this->db->get('simpeg_master_izin')->result();
        $this->template->display('simpeg_data_absensi_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'tanggal' => tgl_db($this->input->post('tanggal', TRUE)),
                'id_pegawai' => $this->input->post('id_pegawai', TRUE),
                'kehadiran' => $this->input->post('kehadiran', TRUE),
                'id_izin' => $this->input->post('id_izin', TRUE),
                'tgl_awal' => tgl_db($this->input->post('tgl_awal', TRUE)),
                'tgl_akhir' => tgl_db($this->input->post('tgl_akhir', TRUE)),
                'file' => $this->input->post('file', TRUE),
            );

            $this->Absensi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('simpeg_data_absensi'));
        }
    }

    public function update($id) {
        $row = $this->Absensi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('simpeg_data_absensi/update_action'),
                'id_absensi' => set_value('id_absensi', $row->id_absensi),
                'tanggal' => set_value('tanggal', $row->tanggal),
                'id_pegawai' => set_value('id_pegawai', $row->id_pegawai),
                'kehadiran' => set_value('kehadiran', $row->kehadiran),
                'id_izin' => set_value('id_izin', $row->id_izin),
                'tgl_awal' => set_value('tgl_awal', $row->tgl_awal),
                'tgl_akhir' => set_value('tgl_akhir', $row->tgl_akhir),
                'file' => set_value('file', $row->file),
            );
            $this->template->display('simpeg_data_absensi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_data_absensi'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_absensi', TRUE));
        } else {
            $data = array(
                'tanggal' => $this->input->post('tanggal', TRUE),
                'id_pegawai' => $this->input->post('id_pegawai', TRUE),
                'kehadiran' => $this->input->post('kehadiran', TRUE),
                'id_izin' => $this->input->post('id_izin', TRUE),
                'tgl_awal' => $this->input->post('tgl_awal', TRUE),
                'tgl_akhir' => $this->input->post('tgl_akhir', TRUE),
                'file' => $this->input->post('file', TRUE),
            );

            $this->Absensi_model->update($this->input->post('id_absensi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('simpeg_data_absensi'));
        }
    }

    public function delete($id) {
        $row = $this->Absensi_model->get_by_id($id);

        if ($row) {
            $this->Absensi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('simpeg_data_absensi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_data_absensi'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
        $this->form_validation->set_rules('id_pegawai', 'id pegawai', 'trim|required');
        $this->form_validation->set_rules('kehadiran', 'kehadiran', 'trim|required');
        $this->form_validation->set_rules('id_izin', 'id izin', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel() {
        $this->load->helper('exportexcel');
        $namaFile = "simpeg_data_absensi.xls";
        $judul = "simpeg_data_absensi";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Id Pegawai");
        xlsWriteLabel($tablehead, $kolomhead++, "Kehadiran");
        xlsWriteLabel($tablehead, $kolomhead++, "Id Izin");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Awal");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Akhir");
        xlsWriteLabel($tablehead, $kolomhead++, "File");

        foreach ($this->Absensi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_pegawai);
            xlsWriteLabel($tablebody, $kolombody++, $data->kehadiran);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_izin);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_awal);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_akhir);
            xlsWriteLabel($tablebody, $kolombody++, $data->file);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
