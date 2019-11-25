<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sima_penghapusan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('Model_sima_pemusnahan', 'M_image'));
        chek_session();
        cek_menu();
    }

    public function index() {
        $sima_penghapusan = $this->db->get('sima_pemusnahan_inv')->result();
        $data = array(
            'sima_penghapusan_data' => $sima_penghapusan
        );

        $this->template->display('sima_pemusnahan_inv_list', $data);
    }

    public function read($id) {
        $row = $this->Model_sima_pemusnahan->get_by_id($id);
        if ($row) {
            $data = array(
                'id_hapus' => $row->id_hapus,
                'tanggal' => $row->tanggal,
                'kode_inventaris' => $row->kode_inventaris,
                'keterangan' => $row->keterangan,
                'lampiran' => $row->lampiran,
            );
            $this->template->display('sima_pemusnahan_inv_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sima_penghapusan'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sima_penghapusan/create_action'),
            'id_hapus' => set_value('id_hapus'),
            'tanggal' => set_value('tanggal'),
            'kode_inventaris' => set_value('kode_inventaris'),
            'keterangan' => set_value('keterangan'),
            'lampiran' => set_value('lampiran'),
        );
        $data['inv'] = $this->db->get_where('sima_data_inventaris', array('penghapusan' => '0'))->result();
        $this->template->display('sima_pemusnahan_inv_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $config['upload_path'] = './upload/aset';
            $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
            $config['max_size'] = '2000';
            $this->load->library('upload', $config);
            $this->upload->do_upload('file_inv');
            $up_data = $this->upload->data();
            $data = array(
                'tanggal' => tgl_db($this->input->post('tanggal', TRUE)),
                'kode_inventaris' => $this->input->post('kode_inventaris', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'lampiran' => $up_data['file_name'],
            );
            $kode = $this->input->post('kode_inventaris', TRUE);
            $this->Model_sima_pemusnahan->insert($data);
            $this->db->query("UPDATE sima_data_inventaris SET penghapusan='1' WHERE sima_data_inventaris.kode_inventaris ='$kode'");
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sima_penghapusan'));
        }
    }

    public function update($id) {
        $row = $this->Model_sima_pemusnahan->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sima_penghapusan/update_action'),
                'id_hapus' => set_value('id_hapus', $row->id_hapus),
                'tanggal' => set_value('tanggal', tgl_balik($row->tanggal)),
                'kode_inventaris' => set_value('kode_inventaris', $row->kode_inventaris),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'lampiran' => set_value('lampiran', $row->lampiran),
            );
            $data['inv'] = $this->db->get('sima_data_inventaris')->result();
            $this->template->display('sima_pemusnahan_inv_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sima_penghapusan'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_hapus', TRUE));
        } else {
            $this->M_image->do_upload();
            $gambar = $this->upload->file_name;
            $data = array(
                'tanggal' => tgl_db($this->input->post('tanggal', TRUE)),
                'kode_inventaris' => $this->input->post('kode_inventaris', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'lampiran' => $gambar,
            );

            $this->Model_sima_pemusnahan->update($this->input->post('id_hapus', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sima_penghapusan'));
        }
    }

    public function delete($id) {
        $row = $this->Model_sima_pemusnahan->get_by_id($id);

        if ($row) {
            $this->Model_sima_pemusnahan->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sima_penghapusan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sima_penghapusan'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
        $this->form_validation->set_rules('kode_inventaris', 'kode inventaris', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('id_hapus', 'id_hapus', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
