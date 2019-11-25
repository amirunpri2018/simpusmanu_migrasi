<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpeg_izin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Izin_model');
        chek_session();
        cek_menu();
    }

    public function index() {
        $simpeg_izin = $this->Izin_model->get_all();

        $data = array(
            'simpeg_izin_data' => $simpeg_izin
        );

        $this->template->display('simpeg_master_izin_list', $data);
    }

    public function read($id) {
        $row = $this->Izin_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_izin' => $row->id_izin,
                'ket_izin' => $row->ket_izin,
            );
            $this->template->display('simpeg_master_izin_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_izin'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('simpeg_izin/create_action'),
            'id_izin' => set_value('id_izin'),
            'jenis' => set_value('jenis'),
            'keterangan' => set_value('keterangan'),
        );
        $this->template->display('simpeg_master_izin_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'jenis' => $this->input->post('jenis', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
            );

            $this->Izin_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('simpeg_izin'));
        }
    }

    public function update($id) {
        $row = $this->Izin_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('simpeg_izin/update_action'),
                'id_izin' => set_value('id_izin', $row->id_izin),
                'jenis' => set_value('jenis'),
                'keterangan' => set_value('keterangan'),
            );
            $this->template->display('simpeg_master_izin_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_izin'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_izin', TRUE));
        } else {
            $data = array(
                'jenis' => $this->input->post('jenis', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
            );

            $this->Izin_model->update($this->input->post('id_izin', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('simpeg_izin'));
        }
    }

    public function delete($id) {
        $row = $this->Izin_model->get_by_id($id);

        if ($row) {
            $this->Izin_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('simpeg_izin'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_izin'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('jenis', 'Jenis', 'trim');
        $this->form_validation->set_rules('id_izin', 'id_izin', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
