<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpeg_penghargaan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Penghargaan_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $simpeg_penghargaan = $this->Penghargaan_model->get_all();

        $data = array(
            'simpeg_penghargaan_data' => $simpeg_penghargaan
        );

        $this->template->display('simpeg_master_penghargaan_list', $data);
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('simpeg_penghargaan/create_action'),
            'id_master_penghargaan' => set_value('id_master_penghargaan'),
            'nama_penghargaan' => set_value('nama_penghargaan'),
        );
        $this->template->display('simpeg_master_penghargaan_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_penghargaan' => $this->input->post('nama_penghargaan', TRUE),
            );

            $this->Penghargaan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('simpeg_penghargaan'));
        }
    }

    public function update($id) {
        $row = $this->Penghargaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('simpeg_penghargaan/update_action'),
                'id_master_penghargaan' => set_value('id_master_penghargaan', $row->id_master_penghargaan),
                'nama_penghargaan' => set_value('nama_penghargaan', $row->nama_penghargaan),
            );
            $this->template->display('simpeg_master_penghargaan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_penghargaan'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_master_penghargaan', TRUE));
        } else {
            $data = array(
                'nama_penghargaan' => $this->input->post('nama_penghargaan', TRUE),
            );

            $this->Penghargaan_model->update($this->input->post('id_master_penghargaan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('simpeg_penghargaan'));
        }
    }

    public function delete($id) {
        $row = $this->Penghargaan_model->get_by_id($id);

        if ($row) {
            $this->Penghargaan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('simpeg_penghargaan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_penghargaan'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('nama_penghargaan', 'nama penghargaan', 'trim|required');

        $this->form_validation->set_rules('id_master_penghargaan', 'id_master_penghargaan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
