<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sip_master_jenis extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Jenis_model');
        chek_session();
        cek_menu();
    }

    public function index() {
        $sip_master_jenis = $this->Jenis_model->get_all();

        $data = array(
            'sip_master_jenis_data' => $sip_master_jenis
        );

        $this->template->display('sip_master_jenis_list', $data);
    }

    public function read($id) {
        $row = $this->Jenis_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'kode_jenis' => $row->kode_jenis,
                'jenis_surat' => $row->jenis_surat,
            );
            $this->template->display('sip_master_jenis_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sip_master_jenis'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sip_master_jenis/create_action'),
            'id' => set_value('id'),
            'kode_jenis' => set_value('kode_jenis'),
            'jenis_surat' => set_value('jenis_surat'),
        );
        $this->template->display('sip_master_jenis_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_jenis' => $this->input->post('kode_jenis', TRUE),
                'jenis_surat' => $this->input->post('jenis_surat', TRUE),
            );

            $this->Jenis_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sip_master_jenis'));
        }
    }

    public function update($id) {
        $row = $this->Jenis_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sip_master_jenis/update_action'),
                'id' => set_value('id', $row->id),
                'kode_jenis' => set_value('kode_jenis', $row->kode_jenis),
                'jenis_surat' => set_value('jenis_surat', $row->jenis_surat),
            );
            $this->template->display('sip_master_jenis_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sip_master_jenis'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'kode_jenis' => $this->input->post('kode_jenis', TRUE),
                'jenis_surat' => $this->input->post('jenis_surat', TRUE),
            );

            $this->Jenis_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sip_master_jenis'));
        }
    }

    public function delete($id) {
        $row = $this->Jenis_model->get_by_id($id);

        if ($row) {
            $this->Jenis_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sip_master_jenis'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sip_master_jenis'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('kode_jenis', 'kode jenis', 'trim|required');
        $this->form_validation->set_rules('jenis_surat', 'jenis surat', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
