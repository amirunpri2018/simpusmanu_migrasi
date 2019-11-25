<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpeg_cuti extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Cuti_model');
        chek_session();
        cek_menu();
    }

    public function index() {
        $simpeg_cuti = $this->Cuti_model->get_all();

        $data = array(
            'simpeg_cuti_data' => $simpeg_cuti
        );

        $this->template->display('simpeg_master_cuti_list', $data);
    }

    public function read($id) {
        $row = $this->Cuti_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_cuti' => $row->id_cuti,
                'ket_cuti' => $row->ket_cuti,
            );
            $this->template->display('simpeg_master_cuti_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_cuti'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('simpeg_cuti/create_action'),
            'id_cuti' => set_value('id_cuti'),
            'ket_cuti' => set_value('ket_cuti'),
        );
        $this->template->display('simpeg_master_cuti_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'ket_cuti' => $this->input->post('ket_cuti', TRUE),
            );

            $this->Cuti_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('simpeg_cuti'));
        }
    }

    public function update($id) {
        $row = $this->Cuti_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('simpeg_cuti/update_action'),
                'id_cuti' => set_value('id_cuti', $row->id_cuti),
                'ket_cuti' => set_value('ket_cuti', $row->ket_cuti),
            );
            $this->template->display('simpeg_master_cuti_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_cuti'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_cuti', TRUE));
        } else {
            $data = array(
                'ket_cuti' => $this->input->post('ket_cuti', TRUE),
            );

            $this->Cuti_model->update($this->input->post('id_cuti', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('simpeg_cuti'));
        }
    }

    public function delete($id) {
        $row = $this->Cuti_model->get_by_id($id);

        if ($row) {
            $this->Cuti_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('simpeg_cuti'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_cuti'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('ket_cuti', 'ket cuti', 'trim|required');

        $this->form_validation->set_rules('id_cuti', 'id_cuti', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
