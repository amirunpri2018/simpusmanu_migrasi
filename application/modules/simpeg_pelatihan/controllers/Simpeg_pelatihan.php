<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpeg_pelatihan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Pelatihan_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $simpeg_pelatihan = $this->Pelatihan_model->get_all();

        $data = array(
            'simpeg_pelatihan_data' => $simpeg_pelatihan
        );

        $this->template->display('simpeg_master_pelatihan_list', $data);
    }

    public function read($id) {
        $row = $this->Pelatihan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_pelatihan' => $row->id_pelatihan,
                'nama_pelatihan' => $row->nama_pelatihan,
                'jenis_pelatihan' => $row->jenis_pelatihan,
                'level_pelatihan' => $row->level_pelatihan,
            );
            $this->template->display('simpeg_master_pelatihan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_pelatihan'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('simpeg_pelatihan/create_action'),
            'id_pelatihan' => set_value('id_pelatihan'),
            'nama_pelatihan' => set_value('nama_pelatihan'),
            'jenis_pelatihan' => set_value('jenis_pelatihan'),
            'level_pelatihan' => set_value('level_pelatihan'),
        );
        $this->template->display('simpeg_master_pelatihan_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_pelatihan' => $this->input->post('nama_pelatihan', TRUE),
                'jenis_pelatihan' => $this->input->post('jenis_pelatihan', TRUE),
                'level_pelatihan' => $this->input->post('level_pelatihan', TRUE),
            );

            $this->Pelatihan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('simpeg_pelatihan'));
        }
    }

    public function update($id) {
        $row = $this->Pelatihan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('simpeg_pelatihan/update_action'),
                'id_pelatihan' => set_value('id_pelatihan', $row->id_pelatihan),
                'nama_pelatihan' => set_value('nama_pelatihan', $row->nama_pelatihan),
                'jenis_pelatihan' => set_value('jenis_pelatihan', $row->jenis_pelatihan),
                'level_pelatihan' => set_value('level_pelatihan', $row->level_pelatihan),
            );
            $this->template->display('simpeg_master_pelatihan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_pelatihan'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pelatihan', TRUE));
        } else {
            $data = array(
                'nama_pelatihan' => $this->input->post('nama_pelatihan', TRUE),
                'jenis_pelatihan' => $this->input->post('jenis_pelatihan', TRUE),
                'level_pelatihan' => $this->input->post('level_pelatihan', TRUE),
            );

            $this->Pelatihan_model->update($this->input->post('id_pelatihan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('simpeg_pelatihan'));
        }
    }

    public function delete($id) {
        $row = $this->Pelatihan_model->get_by_id($id);

        if ($row) {
            $this->Pelatihan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('simpeg_pelatihan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_pelatihan'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('nama_pelatihan', 'nama pelatihan', 'trim|required');
        $this->form_validation->set_rules('jenis_pelatihan', 'jenis pelatihan', 'trim|required');
        $this->form_validation->set_rules('level_pelatihan', 'level pelatihan', 'trim|required');

        $this->form_validation->set_rules('id_pelatihan', 'id_pelatihan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Simpeg_pelatihan.php */
/* Location: ./application/controllers/Simpeg_pelatihan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-03-27 19:45:57 */
/* http://harviacode.com */