<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sima_data_perawatan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_sima_perawatan');
        chek_session();
        cek_menu();
    }

    public function index() {
        $this->template->display('sima_perawatan_inv_list');
    }

    function view_data() {
        $no = 1;
        $getdata = $this->db->get('sima_perawatan_inv')->result();
        foreach ($getdata as $q) {
            if ($q->status == "OPEN") {
                $status = "<span class='label label-danger'>" . $q->status . "</span>";
            } elseif ($q->status == "CLOSED") {
                $status = "<span class='label label-success'>" . $q->status . "</span>";
            } elseif ($q->status == "PROCESS") {
                $status = "<span class='label label-info'>" . $q->status . "</span>";
            } else {
                $status = "<span class='label label-warning'>" . $q->status . "</span>";
            }
            $nama = $this->db->get_where('sima_data_inventaris', array('kode_inventaris' => $q->kode_inventaris))->row_array();
            $query[] = array(
                'no' => $no++,
                'no_transaksi' => $q->no_transaksi,
                'kode_inventaris' => $q->kode_inventaris,
                'nama_inventaris' => $nama['nama_inventaris'],
                'tgl_perawatan' => tgl_indo($q->tgl_perawatan),
                'tgl_selesai' => tgl_indo($q->tgl_selesai),
                'tindakan_perawatan' => $q->tindakan_perawatan,
                'biaya' => rupiah($q->biaya),
                'status' => '<center>' . $status . '</center>',
                'action' => array(anchor('sima_data_perawatan/update/' . $q->id_perawatan, '<i class="btn btn-sm btn-info glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . " " .
                    anchor('sima_data_perawatan/delete/' . $q->id_perawatan, '<i class="btn btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")))
            );
        }
        $result = array('data' => $query);
        echo json_encode($result);
    }

    public function read($id) {
        $row = $this->Model_sima_perawatan->get_by_id($id);
        if ($row) {
            $data = array(
                'id_perawatan' => $row->id_perawatan,
                'no_transaksi' => $row->no_transaksi,
                'kode_inventaris' => $row->kode_inventaris,
                'tgl_perawatan' => $row->tgl_perawatan,
                'tindakan_perawatan' => $row->tindakan_perawatan,
                'biaya' => $row->biaya,
            );
            $this->template->display('sima_perawatan_inv_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sima_data_perawatan'));
        }
    }

    public function addcreate($id) {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sima_data_perawatan/create_action'),
            'id_perawatan' => set_value('id_perawatan'),
            'no_transaksi' => $this->Model_sima_perawatan->kdotomatis(),
            'kode_inventaris' => $id,
            'tgl_perawatan' => set_value('tgl_perawatan'),
            'tgl_selesai' => set_value('tgl_selesai'),
            'tindakan_perawatan' => set_value('tindakan_perawatan'),
            'biaya' => set_value('biaya'),
            'status' => set_value('status'),
        );
        $data['inv'] = $this->db->get('sima_data_inventaris')->result();
        $this->template->display('sima_perawatan_inv_form', $data);
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sima_data_perawatan/create_action'),
            'id_perawatan' => set_value('id_perawatan'),
            'no_transaksi' => $this->Model_sima_perawatan->kdotomatis(),
            'kode_inventaris' => set_value('kode_inventaris'),
            'tgl_perawatan' => set_value('tgl_perawatan'),
            'tgl_selesai' => set_value('tgl_selesai'),
            'tindakan_perawatan' => set_value('tindakan_perawatan'),
            'biaya' => set_value('biaya'),
            'status' => set_value('status'),
        );
        $data['inv'] = $this->db->get('sima_data_inventaris')->result();
        $this->template->display('sima_perawatan_inv_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            if (empty($this->input->post('tgl_selesai', TRUE))) {
                $tgl_selesai = "";
            } else {
                $tgl_selesai = tgl_db($this->input->post('tgl_selesai', TRUE));
            }
            $data = array(
                'no_transaksi' => $this->input->post('no_transaksi', TRUE),
                'kode_inventaris' => $this->input->post('kode_inventaris', TRUE),
                'tgl_perawatan' => tgl_db($this->input->post('tgl_perawatan', TRUE)),
                'tgl_selesai' => $tgl_selesai,
                'tindakan_perawatan' => $this->input->post('tindakan_perawatan', TRUE),
                'status' => $this->input->post('status', TRUE),
                'biaya' => $this->input->post('biaya', TRUE),
            );

            $this->Model_sima_perawatan->insert($data);
            if ($this->input->post('status', TRUE) != 'CLOSED') {
                $this->db->query('UPDATE sima_data_inventaris SET id_status="3"');
            } else {
                $this->db->query('UPDATE sima_data_inventaris SET id_status="1"');
            }
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sima_data_perawatan'));
        }
    }

    public function update($id) {
        $row = $this->Model_sima_perawatan->get_by_id($id);

        if ($row) {
            if ($row->tgl_selesai == '0000-00-00') {
                $tgl_selesai = "";
            } else {
                $tgl_selesai = tgl_balik($row->tgl_selesai);
            }
            $data = array(
                'button' => 'Update',
                'action' => site_url('sima_data_perawatan/update_action'),
                'id_perawatan' => set_value('id_perawatan', $row->id_perawatan),
                'no_transaksi' => set_value('no_transaksi', $row->no_transaksi),
                'kode_inventaris' => set_value('kode_inventaris', $row->kode_inventaris),
                'tgl_perawatan' => set_value('tgl_perawatan', tgl_balik($row->tgl_perawatan)),
                'tgl_selesai' => set_value('tgl_selesai', $tgl_selesai),
                'tindakan_perawatan' => set_value('tindakan_perawatan', $row->tindakan_perawatan),
                'biaya' => set_value('biaya', $row->biaya),
                'status' => set_value('status', $row->status),
            );
            $data['inv'] = $this->db->get('sima_data_inventaris')->result();
            $this->template->display('sima_perawatan_inv_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sima_data_perawatan'));
        }
    }

    public function update_action() {
        $this->_rules_update();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_perawatan', TRUE));
        } else {
            $data = array(
                'kode_inventaris' => $this->input->post('kode_inventaris', TRUE),
                'tgl_perawatan' => tgl_db($this->input->post('tgl_perawatan', TRUE)),
                'tgl_selesai' => tgl_db($this->input->post('tgl_selesai', TRUE)),
                'tindakan_perawatan' => $this->input->post('tindakan_perawatan', TRUE),
                'status' => $this->input->post('status', TRUE),
                'biaya' => $this->input->post('biaya', TRUE),
            );
            if ($this->input->post('status', TRUE) != 'CLOSED') {
                $this->db->query('UPDATE sima_data_inventaris SET id_status="3"');
            } else {
                $this->db->query('UPDATE sima_data_inventaris SET id_status="1"');
            }
            $this->Model_sima_perawatan->update($this->input->post('id_perawatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sima_data_perawatan'));
        }
    }

    public function delete($id) {
        $row = $this->Model_sima_perawatan->get_by_id($id);

        if ($row) {
            $this->Model_sima_perawatan->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sima_data_perawatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sima_data_perawatan'));
        }
    }

    public function _rules() {
        $this->form_validation->set_message('is_unique', '%s Sudah Ada');
        $this->form_validation->set_rules('no_transaksi', 'no transaksi', 'trim|required|is_unique[sima_perawatan_inv.no_transaksi]');
        $this->form_validation->set_rules('kode_inventaris', 'kode inventaris', 'trim|required');
        $this->form_validation->set_rules('tgl_perawatan', 'tgl perawatan', 'trim|required');
        $this->form_validation->set_rules('tindakan_perawatan', 'tindakan perawatan', 'trim|required');
        $this->form_validation->set_rules('id_perawatan', 'id_perawatan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_update() {
        $this->form_validation->set_rules('kode_inventaris', 'kode inventaris', 'trim|required');
        $this->form_validation->set_rules('tgl_perawatan', 'tgl perawatan', 'trim|required');
        $this->form_validation->set_rules('tgl_selesai', 'tgl selesai', 'trim|required');
        $this->form_validation->set_rules('tindakan_perawatan', 'tindakan perawatan', 'trim|required');
        $this->form_validation->set_rules('id_perawatan', 'id_perawatan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
