<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siak_aktivitas_mengajar extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Siak_mengajar_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $siak_aktivitas_mengajar = $this->Siak_mengajar_model->get_all();

        $data = array(
            'siak_aktivitas_mengajar_data' => $siak_aktivitas_mengajar
        );

        $this->template->display('siak_aktivitas_mengajar_list', $data);
    }

    public function read($id) {
        $row = $this->Siak_mengajar_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_mengajar' => $row->id_mengajar,
                'nip' => $row->nip,
                'periode' => $row->periode,
                'progam_studi' => $row->progam_studi,
                'matakuliah' => $row->matakuliah,
                'kelas' => $row->kelas,
                'rencana' => $row->rencana,
                'realisasi' => $row->realisasi,
            );
            $this->template->display('siak_aktivitas_mengajar_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siak_aktivitas_mengajar'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('siak_aktivitas_mengajar/create_action'),
            'id_mengajar' => set_value('id_mengajar'),
            'nip' => set_value('nip'),
            'periode' => set_value('periode'),
            'progam_studi' => set_value('progam_studi'),
            'matakuliah' => set_value('matakuliah'),
            'kelas' => set_value('kelas'),
            'rencana' => set_value('rencana'),
            'realisasi' => set_value('realisasi'),
        );
        $this->template->display('siak_aktivitas_mengajar_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nip' => $this->input->post('nip', TRUE),
                'periode' => $this->input->post('periode', TRUE),
                'progam_studi' => $this->input->post('progam_studi', TRUE),
                'matakuliah' => $this->input->post('matakuliah', TRUE),
                'kelas' => $this->input->post('kelas', TRUE),
                'rencana' => $this->input->post('rencana', TRUE),
                'realisasi' => $this->input->post('realisasi', TRUE),
            );

            $this->Siak_mengajar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('siak_aktivitas_mengajar'));
        }
    }

    public function update($id) {
        $row = $this->Siak_mengajar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('siak_aktivitas_mengajar/update_action'),
                'id_mengajar' => set_value('id_mengajar', $row->id_mengajar),
                'nip' => set_value('nip', $row->nip),
                'periode' => set_value('periode', $row->periode),
                'progam_studi' => set_value('progam_studi', $row->progam_studi),
                'matakuliah' => set_value('matakuliah', $row->matakuliah),
                'kelas' => set_value('kelas', $row->kelas),
                'rencana' => set_value('rencana', $row->rencana),
                'realisasi' => set_value('realisasi', $row->realisasi),
            );
            $this->template->display('siak_aktivitas_mengajar_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siak_aktivitas_mengajar'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_mengajar', TRUE));
        } else {
            $data = array(
                'nip' => $this->input->post('nip', TRUE),
                'periode' => $this->input->post('periode', TRUE),
                'progam_studi' => $this->input->post('progam_studi', TRUE),
                'matakuliah' => $this->input->post('matakuliah', TRUE),
                'kelas' => $this->input->post('kelas', TRUE),
                'rencana' => $this->input->post('rencana', TRUE),
                'realisasi' => $this->input->post('realisasi', TRUE),
            );

            $this->Siak_mengajar_model->update($this->input->post('id_mengajar', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('siak_aktivitas_mengajar'));
        }
    }

    public function delete($id) {
        $row = $this->Siak_mengajar_model->get_by_id($id);

        if ($row) {
            $this->Siak_mengajar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('siak_aktivitas_mengajar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siak_aktivitas_mengajar'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('nip', 'nip', 'trim|required');
        $this->form_validation->set_rules('periode', 'periode', 'trim|required');
        $this->form_validation->set_rules('progam_studi', 'progam studi', 'trim|required');
        $this->form_validation->set_rules('matakuliah', 'matakuliah', 'trim|required');
        $this->form_validation->set_rules('kelas', 'kelas', 'trim|required');
        $this->form_validation->set_rules('rencana', 'rencana', 'trim|required');
        $this->form_validation->set_rules('realisasi', 'realisasi', 'trim|required');

        $this->form_validation->set_rules('id_mengajar', 'id_mengajar', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Siak_aktivitas_mengajar.php */
/* Location: ./application/controllers/Siak_aktivitas_mengajar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-21 08:16:01 */
/* http://harviacode.com */