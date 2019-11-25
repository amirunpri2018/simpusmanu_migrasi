<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sip_master_loker extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Loker_model');
        chek_session();
        cek_menu();
    }

    public function index() {
        $sip_master_loker = $this->Loker_model->get_all();

        $data = array(
            'sip_master_loker_data' => $sip_master_loker
        );

        $this->template->display('sip_master_loker_list', $data);
    }

    public function read($id) {
        $row = $this->Loker_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'kode_loker' => $row->kode_loker,
                'tempat_loker' => $row->tempat_loker,
            );
            $this->template->display('sip_master_loker_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sip_master_loker'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sip_master_loker/create_action'),
            'id' => set_value('id'),
            'kode_loker' => set_value('kode_loker'),
            'tempat_loker' => set_value('tempat_loker'),
        );
        $this->template->display('sip_master_loker_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_loker' => $this->input->post('kode_loker', TRUE),
                'tempat_loker' => $this->input->post('tempat_loker', TRUE),
            );

            $this->Loker_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sip_master_loker'));
        }
    }

    public function update($id) {
        $row = $this->Loker_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sip_master_loker/update_action'),
                'id' => set_value('id', $row->id),
                'kode_loker' => set_value('kode_loker', $row->kode_loker),
                'tempat_loker' => set_value('tempat_loker', $row->tempat_loker),
            );
            $this->template->display('sip_master_loker_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sip_master_loker'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'kode_loker' => $this->input->post('kode_loker', TRUE),
                'tempat_loker' => $this->input->post('tempat_loker', TRUE),
            );

            $this->Loker_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sip_master_loker'));
        }
    }

    public function delete($id) {
        $row = $this->Loker_model->get_by_id($id);

        if ($row) {
            $this->Loker_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sip_master_loker'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sip_master_loker'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('kode_loker', 'kode loker', 'trim|required');
        $this->form_validation->set_rules('tempat_loker', 'tempat loker', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
