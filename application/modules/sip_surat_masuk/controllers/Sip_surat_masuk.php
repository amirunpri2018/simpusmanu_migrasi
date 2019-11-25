<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sip_surat_masuk extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_surat_masuk');
        chek_session();
        cek_menu();
    }

    function index() {
        $this->template->display('sip_surat_masuk_list');
    }

    private function _uploadFile() {
        $config['upload_path'] = 'upload/surat_masuk';
        $config['allowed_types'] = 'jpg|png|jpeg||pdf|doc|docx|xlsx';
        $config['max_size'] = 3072; //set max size allowed in Kilobyte
        //$config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file_surat')) {
            return $this->upload->data("file_name");
        }else{
            echo "<script>alert('Gagal Saat mengupload file')</script>";
        }
    }

    function view_data() {
        $no = 1;
        $tahun = $this->input->get('tahun');        
        $getdata = $this->Model_surat_masuk->getSuratMasuk($tahun);
        foreach ($getdata as $q) {
            if ($q->status == 1) {
                $status = "<span class='label label-success'>Sudah Dibaca</span>";
            } else {
                $status = "<span class='label label-danger'>Belum Dibaca</span>";
            }
            $query[] = array(
                'no' => $no++,
                'kode_surat' => $q->kode_surat,
                'nomor_surat' => $q->nomor_surat,
                'tanggal_surat' => tgl_indo($q->tanggal_surat),
                'asal_surat' => $q->asal_surat,
                'sifat_surat' => $q->sifat_surat,
                'perihal_surat' => $q->perihal_surat,
                'tujuan_surat' => $q->tujuan_surat,
                'file' => anchor_popup('upload/surat_masuk/' . $q->lampiran, $q->lampiran),
                'status' => $status,
                'action' => array(anchor('sip_disposisi_surat/create/' . $q->id_surat, '<i class="btn btn-sm btn-info fa fa-paper-plane" data-toggle="tooltip" title="Disposisi"></i>') . " " .
                    anchor('sip_surat_masuk/read/' . $q->id_surat, '<i class="btn btn-sm btn-info fa fa-eye" data-toggle="tooltip" title="Baca Surat"></i>') . " " .
                    anchor('sip_surat_masuk/update/' . $q->id_surat, '<i class="btn btn-sm btn-info glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . " " .
                    anchor('sip_surat_masuk/delete/' . $q->id_surat, '<i class="btn btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")))
            );
        }
        $result = isset($query) ? array('data' => $query): array('data' => 0);
        echo json_encode($result);
    }

    public function read($id) {
        $row = $this->Model_surat_masuk->get_by_id($id);
        if ($row) {
            $data = array(
                'id_surat' => $row->id_surat,
                'kode_surat' => $row->kode_surat,
                'nomor_surat' => $row->nomor_surat,
                'kategori_surat' => $row->kategori_surat,
                'sifat_surat' => $row->sifat_surat,
                'jenis_surat' => $row->jenis_surat,
                'tipe_surat' => $row->tipe_surat,
                'asal_surat' => $row->asal_surat,
                'tujuan_surat' => $row->tujuan_surat,
                'tanggal_surat' => $row->tanggal_surat,
                'tanggal_pencatatan' => $row->tanggal_pencatatan,
                'nama_pengirim' => $row->nama_pengirim,
                'perihal_surat' => $row->perihal_surat,
                'isi_surat' => $row->isi_surat,
                'kode_loker' => $row->kode_loker,
                'lampiran' => $row->lampiran,
            );

            $this->template->display('sip_surat_read', $data);
            $this->db->where('id_surat', $row->id_surat);
            $this->db->set('status', 1);
            $this->db->update('sip_data_surat');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sip_surat_masuk'));
        }
    }

    function cetak($id) {
        $row = $this->Model_surat_masuk->get_by_id($id);
        if ($row) {
            $data = array(
                'id_surat' => $row->id_surat,
                'nomor_surat' => $row->nomor_surat,
                'kategori_surat' => $row->kategori_surat,
                'sifat_surat' => $row->sifat_surat,
                'jenis_surat' => $row->jenis_surat,
                'tipe_surat' => $row->tipe_surat,
                'asal_surat' => $row->asal_surat,
                'tujuan_surat' => $row->tujuan_surat,
                'tanggal_surat' => $row->tanggal_surat,
                'tanggal_pencatatan' => $row->tanggal_pencatatan,
                'nama_pengirim' => $row->nama_pengirim,
                'perihal_surat' => $row->perihal_surat,
                'isi_surat' => $row->isi_surat,
                'kode_loker' => $row->kode_loker,
                'lampiran' => $row->lampiran,
            );
            $this->load->view('sip_surat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sip_surat_masuk'));
        }
    }

    function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sip_surat_masuk/create_action'),
            'id_surat' => set_value('id_surat'),
            'kode_surat' => set_value('kode_surat'),
            'nomor_surat' => set_value('nomor_surat'),
            'kategori_surat' => set_value('kategori_surat'),
            'sifat_surat' => set_value('sifat_surat'),
            'jenis_surat' => set_value('jenis_surat'),
            'tipe_surat' => set_value('tipe_surat'),
            'asal_surat' => set_value('asal_surat'),
            'tujuan_surat' => set_value('tujuan_surat'),
            'tanggal_surat' => set_value('tanggal_surat'),
            'tanggal_masuk' => set_value('tanggal_masuk'),
            'nama_pengirim' => set_value('nama_pengirim'),
            'alamat_pengirim' => set_value('alamat_pengirim'),
            'perihal_surat' => set_value('perihal_surat'),
            'isi_surat' => set_value('isi_surat'),
            'kode_loker' => set_value('kode_loker'),
        );
        $data['loker'] = $this->db->get('sip_master_loker')->result();
        $data['sifat'] = $this->db->get('sip_master_sifat')->result();
        $data['jenis'] = $this->db->get('sip_master_jenis')->result();
        $this->template->display('sip_surat_form', $data);
    }

    public function create_action() {
        $this->_rules();
        $this->form_validation->set_message('is_unique', '%s Sudah Digunakan');  
        $this->form_validation->set_rules('kode_surat', 'Kode Surat', 'trim|required|is_unique[sip_data_surat.kode_surat]');   
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            //upload config 
            $nomor_surat = $this->input->post('nomor_surat', TRUE);
            $new_name = $this->input->post('nomor_surat', TRUE);            
            $data = array(
                'nomor_surat' => $this->input->post('nomor_surat', TRUE),
                'kategori_surat' => 'Surat Masuk',
                'sifat_surat' => $this->input->post('sifat_surat', TRUE),
                'jenis_surat' => $this->input->post('jenis_surat', TRUE),
                'tipe_surat' => $this->input->post('tipe_surat', TRUE),
                'asal_surat' => $this->input->post('asal_surat', TRUE),
                'tujuan_surat' => $this->input->post('tujuan_surat', TRUE),
                'tanggal_surat' => tgl_db($this->input->post('tanggal_surat', TRUE)),
                'tanggal_pencatatan' => tgl_db($this->input->post('tanggal_masuk', TRUE)),
                'nama_pengirim' => $this->input->post('nama_pengirim', TRUE),
                'alamat_pengirim' => $this->input->post('alamat_pengirim', TRUE),
                'perihal_surat' => $this->input->post('perihal_surat', TRUE),
                'isi_surat' => $this->input->post('isi_surat', TRUE),
                'kode_loker' => $this->input->post('loker', TRUE),                
                'kode_surat' => $this->input->post('kode_surat', TRUE),
            );
            $namafile = preg_replace("/[^a-zA-Z0-9]/", "", $new_name);
            if (!empty($_FILES['file_surat']['name'])) {
                $upload = $this->_uploadFile();
                $data['lampiran'] = $upload;
            }            
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\">Berhasil Menambah Data</div>");
            $this->Model_surat_masuk->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect('sip_surat_masuk');
        }
    }

    

    function disposisi_id($id) {
        
        $data['surat'] = $this->db->get_where('sip_data_surat', array('id_surat' => $id))->row_array();
        $this->template->display('sip_surat_disposisi', $data);
    }
    
    public function disposisi($id) 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sip_surat_masuk/action_disposisi'),
            'id_disposisi' => set_value('id_disposisi'),
            'id_surat' => set_value('id_surat'),
            'id_pegawai' => set_value('id_pegawai'),
            'keterangan' => set_value('keterangan'),
        );
        $data['pegawai']=$this->db->get('simpeg_data_pegawai')->result();
        $data['surat'] = $this->db->get_where('sip_data_surat', array('id_surat' => $id))->row_array();
        $this->template->display('sip_disposisi_surat_form', $data);
    }
    
    public function action_disposisi() 
    {
        $this->_rules_disposisi();

        if ($this->form_validation->run() == FALSE) {
            $id=$this->input->post('id_surat',TRUE);
            $this->disposisi($id);
        } else {
            $data = array(
                'id_surat' => $this->input->post('id_surat',TRUE),
                'id_pegawai' => $this->input->post('id_pegawai',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE),
            );
            $this->Model_disposisi_surat->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sip_disposisi_surat'));
        }
    }

    public function update($id) {
        $row = $this->Model_surat_masuk->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sip_surat_masuk/update_action'),
                'id_surat' => set_value('id_surat', $row->id_surat),
                'kode_surat' => set_value('kode_surat',$row->kode_surat),
                'nomor_surat' => set_value('nomor_surat', $row->nomor_surat),
                'kategori_surat' => set_value('kategori_surat', $row->kategori_surat),
                'sifat_surat' => set_value('sifat_surat', $row->sifat_surat),
                'jenis_surat' => set_value('jenis_surat', $row->jenis_surat),
                'tipe_surat' => set_value('tipe_surat', $row->tipe_surat),
                'asal_surat' => set_value('asal_surat', $row->asal_surat),
                'tujuan_surat' => set_value('tujuan_surat', $row->tujuan_surat),
                'tanggal_surat' => set_value('tanggal_surat', tgl_indo($row->tanggal_surat)),
                'tanggal_masuk' => set_value('tanggal_masuk', tgl_indo($row->tanggal_pencatatan)),
                'nama_pengirim' => set_value('nama_pengirim', $row->nama_pengirim),
                'alamat_pengirim' => set_value('alamat_pengirim', $row->alamat_pengirim),
                'perihal_surat' => set_value('perihal_surat', $row->perihal_surat),
                'isi_surat' => set_value('isi_surat', $row->isi_surat),
                'kode_loker' => set_value('kode_loker', $row->kode_loker),
            );
            $data['loker'] = $this->db->get('sip_master_loker')->result();
            $data['sifat'] = $this->db->get('sip_master_sifat')->result();
            $data['jenis'] = $this->db->get('sip_master_jenis')->result();
            $this->template->display('sip_surat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sip_surat_masuk'));
        }
    }

    public function update_action() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_surat', TRUE));
        } else {
            //upload config
            $nomor_surat = $this->input->post('nomor_surat', TRUE);
            $new_name = $this->input->post('nomor_surat', TRUE);            
            $data = array(
                'nomor_surat' => $this->input->post('nomor_surat', TRUE),
                'kategori_surat' => 'Surat Masuk',
                'sifat_surat' => $this->input->post('sifat_surat', TRUE),
                'jenis_surat' => $this->input->post('jenis_surat', TRUE),
                'tipe_surat' => $this->input->post('tipe_surat', TRUE),
                'asal_surat' => $this->input->post('asal_surat', TRUE),
                'tujuan_surat' => $this->input->post('tujuan_surat', TRUE),
                'tanggal_surat' => tgl_db($this->input->post('tanggal_surat', TRUE)),
                'tanggal_pencatatan' => tgl_db($this->input->post('tanggal_masuk', TRUE)),
                'nama_pengirim' => $this->input->post('nama_pengirim', TRUE),
                'alamat_pengirim' => $this->input->post('alamat_pengirim', TRUE),
                'perihal_surat' => $this->input->post('perihal_surat', TRUE),
                'isi_surat' => $this->input->post('isi_surat', TRUE),
                'kode_loker' => $this->input->post('loker', TRUE),
                'kode_surat' => $this->input->post('kode_surat', TRUE),
            );
            $namafile = preg_replace("/[^a-zA-Z0-9]/", "", $new_name);
            if (!empty($_FILES['file_surat']['name'])) {
                $upload = $this->_uploadFile();
                $data['lampiran'] = $upload;
            }     
            $this->Model_surat_masuk->update($this->input->post('id_surat', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sip_surat_masuk'));
        }
    }

    public function delete($id) {
        $row = $this->Model_surat_masuk->get_by_id($id);
        if ($row) {
            $this->Model_surat_masuk->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sip_surat_masuk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sip_surat_masuk'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('nomor_surat', 'nomor surat', 'trim|required');
        $this->form_validation->set_rules('sifat_surat', 'sifat surat', 'trim|required');
        $this->form_validation->set_rules('jenis_surat', 'jenis surat', 'trim|required');
        $this->form_validation->set_rules('tipe_surat', 'tipe surat', 'trim|required');
        $this->form_validation->set_rules('asal_surat', 'asal surat', 'trim|required');
        $this->form_validation->set_rules('tujuan_surat', 'tujuan surat', 'trim|required');
        $this->form_validation->set_rules('tanggal_surat', 'tanggal surat', 'trim|required');
        $this->form_validation->set_rules('tanggal_masuk', 'tanggal pencatatan', 'trim|required');
        $this->form_validation->set_rules('nama_pengirim', 'nama pengirim', 'trim|required');
        $this->form_validation->set_rules('perihal_surat', 'perihal surat', 'trim|required');
        $this->form_validation->set_rules('loker', 'lokasi', 'trim|required');
        $this->form_validation->set_rules('isi_surat', 'isi surat', 'trim|required');
        //$this->form_validation->set_rules('userfile', 'lampiran', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    function _rules_disposisi() 
    {
	$this->form_validation->set_rules('id_surat', 'id surat', 'trim|required');
	$this->form_validation->set_rules('id_pegawai', 'id pegawai', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel() {
        $this->load->helper('exportexcel');
        $namaFile = "sip_data_surat.xls";
        $judul = "sip_data_surat";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nomor Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Kategori Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Sifat Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Prioritas Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Tipe Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Asal Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Tujuan Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Pencatatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Pengirim");
        xlsWriteLabel($tablehead, $kolomhead++, "Perihal Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Isi Surat");
        xlsWriteLabel($tablehead, $kolomhead++, "Id Lokasi");
        xlsWriteLabel($tablehead, $kolomhead++, "Lampiran");

        foreach ($this->Model_surat_masuk->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nomor_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->kategori_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->sifat_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->prioritas_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->tipe_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->asal_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->tujuan_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_pencatatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_pengirim);
            xlsWriteLabel($tablebody, $kolombody++, $data->perihal_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->isi_surat);
            xlsWriteLabel($tablebody, $kolombody++, $data->id_lokasi);
            xlsWriteLabel($tablebody, $kolombody++, $data->lampiran);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}
