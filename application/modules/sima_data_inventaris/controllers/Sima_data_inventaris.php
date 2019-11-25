<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sima_data_inventaris extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_data_inventaris');
        chek_session();
        cek_menu();
    }

    public function index() {
        $this->template->display('sima_data_inventaris_list');
    }

    function view_data() {
        $no = 1;
        $getdata = $this->db->query('SELECT * FROM sima_data_inventaris as aset,sima_master_status as st WHERE aset.id_status=st.id_status AND penghapusan="0" ORDER BY aset.id_inventaris DESC')->result();
        foreach ($getdata as $q) {
            if ($q->status == "DIGUNAKAN") {
                $status = "<span class='label label-success'>" . $q->status . "</span>";
            } elseif ($q->status == "SIAP DIGUNAKAN") {
                $status = "<span class='label label-info'>" . $q->status . "</span>";
            } elseif ($q->status == "DIPERBAIKI") {
                $status = "<span class='label label-warning'>" . $q->status . "</span>";
            } else {
                $status = "<span class='label label-warning'>" . $q->status . "</span>";
            }
            $query[] = array(
                'no' => $no++,
                'kode_inventaris' => $q->kode_inventaris,
                'nama_inventaris' => $q->nama_inventaris,
                'merek' => $q->merek,
                'tgl_inventaris' => tgl_indo($q->tgl_inventaris),
                'kategori' => $q->kategori,
                'lokasi' => $q->lokasi,
                'status' => $status,
                'action' => array(anchor('sima_data_inventaris/read/' . $q->id_inventaris, '<i class="btn btn-sm btn-info fa fa-eye" data-toggle="tooltip" title="Detail"></i>') . " " .
                    anchor('sima_data_inventaris/update/' . $q->id_inventaris, '<i class="btn btn-sm btn-info glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . " " .
                    anchor('sima_data_inventaris/delete/' . $q->id_inventaris, '<i class="btn btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")))
            );
        }
        $result = array('data' => $query);
        echo json_encode($result);
    }

    public function read($id) {
        $row = $this->Model_data_inventaris->get_by_id($id);
        if ($row) {
            $data = array(
                'id_inventaris' => $row->id_inventaris,
                'kode_inventaris' => $row->kode_inventaris,
                'nama_inventaris' => $row->nama_inventaris,
                'asal_inventaris' => $row->asal_inventaris,
                'kepemilikan' => $row->kepemilikan,
                'merek' => $row->merek,
                'harga_beli' => rupiah($row->harga_beli),
                'tgl_inventaris' => tgl_indo($row->tgl_inventaris),
                'keterangan' => $row->keterangan,
                'kategori' => $row->kategori,
                'lokasi' => $row->lokasi,
                'id_status' => $row->id_status,
            );
            $data['status'] = $this->db->get_where('sima_master_status', array('id_status' => $row->id_status))->row_array();
            $data['perawatan'] = $this->db->get_where('sima_perawatan_inv', array('kode_inventaris' => $row->kode_inventaris))->result();
            $this->template->display('sima_data_inventaris_detail', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sima_data_inventaris'));
        }
    }
    
    function read2($id) {
        $row = $this->db->get_where('sima_data_inventaris',array('kode_inventaris'=>$id))->row();
        if ($row) {
            $data = array(
                'id_inventaris' => $row->id_inventaris,
                'kode_inventaris' => $row->kode_inventaris,
                'nama_inventaris' => $row->nama_inventaris,
                'asal_inventaris' => $row->asal_inventaris,
                'kepemilikan' => $row->kepemilikan,
                'merek' => $row->merek,
                'harga_beli' => rupiah($row->harga_beli),
                'tgl_inventaris' => tgl_indo($row->tgl_inventaris),
                'keterangan' => $row->keterangan,
                'kategori' => $row->kategori,
                'lokasi' => $row->lokasi,
                'id_status' => $row->id_status,
            );
            $data['status'] = $this->db->get_where('sima_master_status', array('id_status' => $row->id_status))->row_array();
            $data['perawatan'] = $this->db->get_where('sima_perawatan_inv', array('kode_inventaris' => $row->kode_inventaris))->result();
            $this->template->display('sima_data_inventaris_detail', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sima_data_inventaris'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sima_data_inventaris/create_action'),
            'id_inventaris' => set_value('id_inventaris'),
            'kode_inventaris' => set_value('kode_inventaris'),
            'nama_inventaris' => set_value('nama_inventaris'),
            'asal_inventaris' => set_value('asal_inventaris'),
            'kepemilikan' => set_value('kepemilikan'),
            'merek' => set_value('merek'),
            'harga_beli' => set_value('harga_beli'),
            'tgl_inventaris' => set_value('tgl_inventaris'),
            'keterangan' => set_value('keterangan'),
            'kategori' => set_value('kategori'),
            'lokasi' => set_value('lokasi'),
            'status' => set_value('status'),
        );
        $data['mkategori'] = $this->db->get('sima_master_kategori')->result();
        $data['mlokasi'] = $this->db->get('sima_master_lokasi')->result();
        $data['mstatus'] = $this->db->get('sima_master_status')->result();
        $this->template->display('sima_data_inventaris_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_inventaris' => $this->input->post('kode_inventaris', TRUE),
                'nama_inventaris' => $this->input->post('nama_inventaris', TRUE),
                'asal_inventaris' => $this->input->post('asal_inventaris', TRUE),
                'kepemilikan' => $this->input->post('kepemilikan', TRUE),
                'merek' => $this->input->post('merek', TRUE),
                'harga_beli' => $this->input->post('harga_beli', TRUE),
                'tgl_inventaris' => tgl_db($this->input->post('tgl_inventaris', TRUE)),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'kategori' => $this->input->post('kategori', TRUE),
                'lokasi' => $this->input->post('lokasi', TRUE),
                'id_status' => $this->input->post('status', TRUE),
            );

            $this->db->insert('sima_data_inventaris', $data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sima_data_inventaris'));
        }
    }

    public function update($id) {
        $row = $this->Model_data_inventaris->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sima_data_inventaris/update_action'),
                'id_inventaris' => set_value('id_inventaris', $row->id_inventaris),
                'kode_inventaris' => set_value('kode_inventaris', $row->kode_inventaris),
                'nama_inventaris' => set_value('nama_inventaris', $row->nama_inventaris),
                'asal_inventaris' => set_value('asal_inventaris', $row->asal_inventaris),
                'kepemilikan' => set_value('kepemilikan', $row->kepemilikan),
                'merek' => set_value('merek', $row->merek),
                'harga_beli' => set_value('harga_beli', $row->harga_beli),
                'tgl_inventaris' => set_value('tgl_inventaris', tgl_balik($row->tgl_inventaris)),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'kategori' => set_value('kategori', $row->kategori),
                'lokasi' => set_value('lokasi', $row->lokasi),
                'status' => set_value('status', $row->id_status),
            );
            $data['mkategori'] = $this->db->get('sima_master_kategori')->result();
            $data['mlokasi'] = $this->db->get('sima_master_lokasi')->result();
            $data['mstatus'] = $this->db->get('sima_master_status')->result();
            $this->template->display('sima_data_inventaris_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sima_data_inventaris'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_inventaris', TRUE));
        } else {
            $data = array(
                'kode_inventaris' => $this->input->post('kode_inventaris', TRUE),
                'nama_inventaris' => $this->input->post('nama_inventaris', TRUE),
                'asal_inventaris' => $this->input->post('asal_inventaris', TRUE),
                'kepemilikan' => $this->input->post('kepemilikan', TRUE),
                'merek' => $this->input->post('merek', TRUE),
                'harga_beli' => $this->input->post('harga_beli', TRUE),
                'tgl_inventaris' => tgl_db($this->input->post('tgl_inventaris', TRUE)),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'kategori' => $this->input->post('kategori', TRUE),
                'lokasi' => $this->input->post('lokasi', TRUE),
                'id_status' => $this->input->post('status', TRUE),
            );

            $this->Model_data_inventaris->update($this->input->post('id_inventaris', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sima_data_inventaris'));
        }
    }

    public function delete($id) {
        $row = $this->Model_data_inventaris->get_by_id($id);

        if ($row) {
            $this->Model_data_inventaris->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sima_data_inventaris'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sima_data_inventaris'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('kode_inventaris', 'kode inventaris', 'trim|required');
        $this->form_validation->set_rules('nama_inventaris', 'nama inventaris', 'trim|required');
        $this->form_validation->set_rules('asal_inventaris', 'asal inventaris', 'trim|required');
        $this->form_validation->set_rules('kepemilikan', 'kepemilikan', 'trim|required');
        $this->form_validation->set_rules('merek', 'merek', 'trim|required');
        $this->form_validation->set_rules('harga_beli', 'harga beli', 'trim|required|numeric');
        $this->form_validation->set_rules('tgl_inventaris', 'tgl inventaris', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
        $this->form_validation->set_rules('lokasi', 'lokasi', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        $this->form_validation->set_rules('id_inventaris', 'id_inventaris', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel() {
        $this->load->helper('exportexcel');
        $namaFile = "data_inventaris.xls";
        $judul = "data_inventaris";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Inventaris");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Inventaris");
        xlsWriteLabel($tablehead, $kolomhead++, "Asal Inventaris");
        xlsWriteLabel($tablehead, $kolomhead++, "Kepemilikan");
        xlsWriteLabel($tablehead, $kolomhead++, "Merek");
        xlsWriteLabel($tablehead, $kolomhead++, "Harga Beli");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Inventaris");
        xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kategori");
        xlsWriteLabel($tablehead, $kolomhead++, "Lokasi");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");

        foreach ($this->Model_data_inventaris->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->kode_inventaris);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_inventaris);
            xlsWriteLabel($tablebody, $kolombody++, $data->asal_inventaris);
            xlsWriteLabel($tablebody, $kolombody++, $data->kepemilikan);
            xlsWriteLabel($tablebody, $kolombody++, $data->merek);
            xlsWriteNumber($tablebody, $kolombody++, $data->harga_beli);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_inventaris);
            xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
            xlsWriteLabel($tablebody, $kolombody++, $data->kategori);
            xlsWriteLabel($tablebody, $kolombody++, $data->lokasi);
            xlsWriteLabel($tablebody, $kolombody++, $data->status);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
