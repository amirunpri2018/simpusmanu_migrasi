<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpeg_jabatan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Jabatan_model');
        chek_session();
        cek_menu();
    }

    public function index() {
        $simpeg_jabatan = $this->Jabatan_model->get_all();

        $data = array(
            'simpeg_jabatan_data' => $simpeg_jabatan
        );

        $this->template->display('simpeg_master_jabatan_list', $data);
    }

    public function read($id) {
        $row = $this->Jabatan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nama_jabatan' => $row->nama_jabatan,
                'level_jabatan' => $row->level_jabatan,
            );
            $this->template->display('simpeg_master_jabatan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_jabatan'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('simpeg_jabatan/create_action'),
            'id' => set_value('id'),
            'nama_jabatan' => set_value('nama_jabatan'),
            'level_jabatan' => set_value('level_jabatan'),
        );
        $this->template->display('simpeg_master_jabatan_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_jabatan' => $this->input->post('nama_jabatan', TRUE),
                'level_jabatan' => $this->input->post('level_jabatan', TRUE),
            );

            $this->Jabatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('simpeg_jabatan'));
        }
    }

    public function update($id) {
        $row = $this->Jabatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('simpeg_jabatan/update_action'),
                'id' => set_value('id', $row->id),
                'nama_jabatan' => set_value('nama_jabatan', $row->nama_jabatan),
                'level_jabatan' => set_value('level_jabatan', $row->level_jabatan),
            );
            $this->template->display('simpeg_master_jabatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_jabatan'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'nama_jabatan' => $this->input->post('nama_jabatan', TRUE),
                'level_jabatan' => $this->input->post('level_jabatan', TRUE),
            );

            $this->Jabatan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('simpeg_jabatan'));
        }
    }

    public function delete($id) {
        $row = $this->Jabatan_model->get_by_id($id);

        if ($row) {
            $this->Jabatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('simpeg_jabatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_jabatan'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('nama_jabatan', 'nama jabatan', 'trim|required');
        $this->form_validation->set_rules('level_jabatan', 'level jabatan', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

