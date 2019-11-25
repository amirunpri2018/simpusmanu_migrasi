<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpeg_data_pegawai extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('Data_pegawai_model', 'M_image'));
        chek_session();
        cek_menu();
    }

    public function index() {
        $this->template->display('simpeg_data_pegawai_list');
    }

    function view_data() {
        $no = 1;       
        $this->db->ORDER_BY('id_pegawai','DESC');
        $getdata = $this->db->get_where('simpeg_data_pegawai', array('jenis_pegawai' => 'Pegawai'))->result();
        //$getdata=$this->db->query("SELECT * FROM simpeg_data_pegawai WHERE jenis_pegawai")
        foreach ($getdata as $q) {
            $status = $this->db->get_where('simpeg_master_status_pegawai', array('id_status' => $q->status_pegawai))->row();
            $bagian= $this->db->get_where('simpeg_master_unit_kerja', array('id_unitkerja' => $q->id_unitkerja))->row();
            $query[] = array(
                'no' => $no++,
                'nip' => $q->nip,
                'nama_pegawai' => $q->nama_pegawai,
                'tempat_lahir' => $q->tempat_lahir,
                'tanggal_lahir' => tgl_indo($q->tanggal_lahir),
                'status_pegawai' => $status->nama_status,
                'unit_kerja' => $bagian->nama_unitkerja,
                'detail' => anchor('simpeg_data_pegawai/detail/' . $q->nip, '<i class="btn btn-info btn-sm fa fa-eye" data-toggle="tooltip" title="View Detail"></i>')
            );
        }
        $result = array('data' => $query);
        echo json_encode($result);
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'nip' => set_value('nip'),
            'nama_pegawai' => set_value('nama_pegawai'),
            'tempat_lahir' => set_value('tempat_lahir'),
            'tanggal_lahir' => set_value('tanggal_lahir'),
            'jenis_kelamin' => set_value('jenis_kelamin'),
            'agama' => set_value('agama'),
            'status_pegawai' => set_value('status_pegawai'),
            'alamat' => set_value('alamat'),
        );
        $data['jabatan'] = $this->db->get('simpeg_master_jabatan')->result();
        $data['unitkerja'] = $this->db->get('simpeg_master_unit_kerja')->result();
        $data['status'] = $this->db->get('simpeg_master_status_pegawai')->result();
        $data['agama'] = $this->db->get('simpeg_master_agama')->result();
        $this->template->display('simpeg_data_pegawai_form', $data);
    }

    public function create_action() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $tanggal = $this->input->post('tanggal_lahir', TRUE);
            $data = array(
                'nip' => $this->input->post('nip', TRUE),
                'nama_pegawai' => $this->input->post('nama_pegawai', TRUE),
                'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                'tanggal_lahir' => tgl_db($tanggal),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'agama' => $this->input->post('agama', TRUE),
                'id_jabatan' => $this->input->post('jabatan', TRUE),
                'status_pegawai' => $this->input->post('status', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'id_unitkerja' => $this->input->post('unitkerja', TRUE),
                'foto' => 'avatar.png',
            );

            $this->Data_pegawai_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('simpeg_data_pegawai'));
        }
    }

    function detail($id) {
        $pegawai = $this->db->get_where('simpeg_data_pegawai', array('nip' => $id))->row_array();
        $id_pegawai = $pegawai['id_pegawai'];
        $data['riwayatjab'] = $this->db->query("SELECT* FROM simpeg_data_riwayat_jabatan as rj,simpeg_master_jabatan as mj,simpeg_master_unit_kerja as uk "
                        . "WHERE rj.id_pegawai='$id_pegawai' AND rj.id_jabatan=mj.id AND rj.id_unit_kerja=uk.id_unitkerja ORDER BY rj.id_riwayat_jabatan ASC")->result();
        $data['penghargaan'] = $this->db->query("SELECT* FROM simpeg_data_penghargaan as dp,simpeg_master_penghargaan as mp WHERE dp.id_pegawai='$id_pegawai' AND dp.id_master_penghargaan=mp.id_master_penghargaan")->result();
        $data['pelatihan'] = $this->db->query("SELECT* FROM simpeg_data_pelatihan as dp,simpeg_master_pelatihan as mp,simpeg_master_lokasi_pelatihan as lp WHERE dp.id_pegawai='$id_pegawai' AND dp.id_pelatihan=mp.id_pelatihan AND dp.id_lokasi=lp.id_lokasi ORDER BY dp.tanggal ASC")->result();
        $data['pendidikan'] = $this->db->get_where('simpeg_data_pendidikan', array('id_pegawai' => $id_pegawai))->result();
        $data['pend_akhir'] = $this->db->query("SELECT* FROM simpeg_data_pendidikan WHERE id_pegawai ='$id_pegawai' ORDER BY id_pendidikan DESC LIMIT 1")->row_array();
        $data['keluarga'] = $this->db->get_where('simpeg_data_keluarga', array('id_pegawai' => $id_pegawai))->result();
        $data['unitkerja'] = $this->db->get_where('simpeg_master_unit_kerja', array('id_unitkerja' => $pegawai['id_unitkerja']))->row_array();
        $data['status'] = $this->db->get_where('simpeg_master_status_pegawai', array('id_status' => $pegawai['id_status']))->row_array();
        $data['jabatan'] = $this->db->get_where('simpeg_master_jabatan', array('id' => $pegawai['id_jabatan']))->row_array();
        $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('nip' => $id))->row_array();
        $data['penilaian'] = $this->db->get_where('simpeg_penilaian', array('id_pegawai' => $id_pegawai))->result();
        $this->template->display('simpeg_data_pegawai_detail', $data);
    }

    function update() {
        if (isset($_POST['submit'])) {
            $this->_rules_update();
            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('id_pegawai', TRUE);
                $data['agama'] = $this->db->get('simpeg_master_agama')->result();
                $data['unitkerja'] = $this->db->get('simpeg_master_unit_kerja')->result();
                $data['status'] = $this->db->get('simpeg_master_status_pegawai')->result();
                $data['jabatan'] = $this->db->get('simpeg_master_jabatan')->result();
                $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
                $this->template->display('form_edit', $data);
            } else {
                $this->M_image->do_upload();
                $gambar = $this->upload->file_name;
                $data = array('nama_pegawai' => $this->input->post('nama_pegawai', TRUE),
                    'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                    'tanggal_lahir' => tgl_db($this->input->post('tanggal_lahir', TRUE)),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                    'alamat' => $this->input->post('alamat', TRUE),
                    'agama' => $this->input->post('agama', TRUE),
                    'id_unitkerja' => $this->input->post('unitkerja', TRUE),
                    'id_jabatan' => $this->input->post('jabatan', TRUE),
                    'id_status' => $this->input->post('status', TRUE),
                    'nomor_sk_jabatan' => $this->input->post('nomor_sk', TRUE),
                    'tanggal_masuk' => tgl_db($this->input->post('tanggal_masuk', TRUE)),
                    'no_npwp' => $this->input->post('npwp', TRUE),
                    'keahlian' => $this->input->post('keahlian', TRUE),
                    'catatan' => $this->input->post('catatan', TRUE),
                    'foto' => $gambar
                );
                $data2 = array('nama_pegawai' => $this->input->post('nama_pegawai', TRUE),
                    'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                    'tanggal_lahir' => tgl_db($this->input->post('tanggal_lahir', TRUE)),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                    'alamat' => $this->input->post('alamat', TRUE),
                    'agama' => $this->input->post('agama', TRUE),
                    'id_unitkerja' => $this->input->post('unitkerja', TRUE),
                    'id_jabatan' => $this->input->post('jabatan', TRUE),
                    'id_status' => $this->input->post('status', TRUE),
                    'nomor_sk_jabatan' => $this->input->post('nomor_sk', TRUE),
                    'tanggal_masuk' => tgl_db($this->input->post('tanggal_masuk', TRUE)),
                    'no_npwp' => $this->input->post('npwp', TRUE),
                    'keahlian' => $this->input->post('keahlian', TRUE),
                    'catatan' => $this->input->post('catatan', TRUE),
                );
                $id = $this->input->post('id_pegawai', TRUE);
                $nip = $this->input->post('nip_pegawai', TRUE);
                $this->db->where('id_pegawai', $id);
                if (!empty($gambar)) {
                    $this->db->update('simpeg_data_pegawai', $data);
                } else {
                    $this->db->update('simpeg_data_pegawai', $data2);
                }
                redirect('simpeg_data_pegawai/detail/' . $nip);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['agama'] = $this->db->get('simpeg_master_agama')->result();
            $data['unitkerja'] = $this->db->get('simpeg_master_unit_kerja')->result();
            $data['status'] = $this->db->get('simpeg_master_status_pegawai')->result();
            $data['jabatan'] = $this->db->get('simpeg_master_jabatan')->result();
            $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
            $this->template->display('form_edit', $data);
        }
    }
    
     function addpenilaian() {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
            $this->form_validation->set_rules('catatan', 'Catatan Pegawai', 'trim|required');
            $this->form_validation->set_error_delimiters('<span class = "text-danger">', '</span>');
            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('id_pegawai', TRUE);
                $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
                $this->template->display('add_penilaian', $data);
            } else {
                $data = array('id_pegawai' => $this->input->post('id_pegawai', TRUE),
                    'tanggal' => tgl_db($this->input->post('tanggal', TRUE)),
                    'catatan' => $this->input->post('catatan', TRUE)
                );
                $nip = $this->input->post('nip_pegawai', TRUE);
                $this->db->insert('simpeg_penilaian', $data);
                redirect('simpeg_data_dosen/detail/' . $nip);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
            $this->template->display('add_penilaian', $data);
        }
    }

    function editpenilaian() {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
            $this->form_validation->set_rules('catatan', 'Catatan Pegawai', 'trim|required');
            $id = $this->input->post('id_penilaian', TRUE);
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'tanggal' => tgl_db($this->input->post('tanggal', TRUE)),
                    'catatan' => $this->input->post('catatan', TRUE)
                );
                $id_pegawai = $this->input->post('id_pegawai', TRUE);
                $pegawai = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id_pegawai))->row_array();
                $nip = $pegawai['nip'];
                $this->db->where('id_penilaian', $id);
                $this->db->update('simpeg_penilaian', $data);
                redirect('simpeg_data_dosen/detail/' . $nip);
            } else {
                $data['penilaian'] = $this->db->get_where('simpeg_penilaian', array('id_penilaian' => $id))->row_array();
                $this->template->display('edit_penilaian', $data);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['penilaian'] = $this->db->get_where('simpeg_penilaian', array('id_penilaian' => $id))->row_array();
            $this->template->display('edit_penilaian', $data);
        }
    }
    
    function addkeluarga() {
        if (isset($_POST['submit'])) {
            $this->_rules_keluarga();
            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('id_pegawai', TRUE);
                $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
                $this->template->display('add_keluarga', $data);
            } else {
                $data = array('id_pegawai' => $this->input->post('id_pegawai', TRUE),
                    'nama_keluarga' => $this->input->post('keluarga', TRUE),
                    'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                    'tanggal_lahir' => tgl_db($this->input->post('tgl_lahir', TRUE)),
                    'status_keluarga' => $this->input->post('status', TRUE),
                    'pekerjaan' => $this->input->post('pekerjaan', TRUE)
                );
                $nip = $this->input->post('nip_pegawai', TRUE);
                $this->db->insert('simpeg_data_keluarga', $data);
                redirect('simpeg_data_pegawai/detail/' . $nip);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
            $this->template->display('add_keluarga', $data);
        }
    }

    function editkeluarga() {
        if (isset($_POST['submit'])) {
            $this->_rules_keluarga();
            $id = $this->input->post('id_keluarga', TRUE);
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'nama_keluarga' => $this->input->post('keluarga', TRUE),
                    'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                    'tanggal_lahir' => tgl_db($this->input->post('tgl_lahir', TRUE)),
                    'status_keluarga' => $this->input->post('status', TRUE),
                    'pekerjaan' => $this->input->post('pekerjaan', TRUE)
                );
                $id_pegawai = $this->input->post('id_pegawai', TRUE);
                $pegawai = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id_pegawai))->row_array();
                $nip = $pegawai['nip'];
                $this->db->where('id_keluarga', $id);
                $this->db->update('simpeg_data_keluarga', $data);
                redirect('simpeg_data_pegawai/detail/' . $nip);
            } else {
                $data['keluarga'] = $this->db->get_where('simpeg_data_keluarga', array('id_keluarga' => $id))->row_array();
                $this->template->display('edit_keluarga', $data);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['keluarga'] = $this->db->get_where('simpeg_data_keluarga', array('id_keluarga' => $id))->row_array();
            $this->template->display('edit_keluarga', $data);
        }
    }

    function addjabatan() {
        if (isset($_POST['submit'])) {
            $this->_rules_jabatan();
            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('id_pegawai', TRUE);
                $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
                $data['unitkerja'] = $this->db->get('simpeg_master_unit_kerja')->result();
                $data['jabatan'] = $this->db->get('simpeg_master_jabatan')->result();
                $this->template->display('add_jabatan', $data);
            } else {
                $data = array('id_pegawai' => $this->input->post('id_pegawai', TRUE),
                    'id_jabatan' => $this->input->post('jabatan', TRUE),
                    'id_unit_kerja' => $this->input->post('unitkerja', TRUE),
                    'nomor_sk' => $this->input->post('nomor_sk', TRUE),
                    'tanggal_sk' => tgl_db($this->input->post('tanggal_sk', TRUE)),
                    'tanggal_mulai' => tgl_db($this->input->post('tanggal_mulai', TRUE)),
                    'tanggal_selesai' => tgl_db($this->input->post('tanggal_selesai', TRUE)),
                    'uraian' => $this->input->post('keterangan', TRUE)
                );
                $nip = $this->input->post('nip_pegawai', TRUE);
                $this->db->insert('simpeg_data_riwayat_jabatan', $data);
                redirect('simpeg_data_pegawai/detail/' . $nip);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
            $data['unitkerja'] = $this->db->get('simpeg_master_unit_kerja')->result();
            $data['jabatan'] = $this->db->get('simpeg_master_jabatan')->result();
            $this->template->display('add_jabatan', $data);
        }
    }

    function editjabatan() {
        if (isset($_POST['submit'])) {
            $this->_rules_jabatan();
            $id = $this->input->post('id_jabatan', TRUE);
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'id_jabatan' => $this->input->post('jabatan', TRUE),
                    'id_unit_kerja' => $this->input->post('unitkerja', TRUE),
                    'nomor_sk' => $this->input->post('nomor_sk', TRUE),
                    'tanggal_sk' => tgl_db($this->input->post('tanggal_sk', TRUE)),
                    'tanggal_mulai' => tgl_db($this->input->post('tanggal_mulai', TRUE)),
                    'tanggal_selesai' => tgl_db($this->input->post('tanggal_selesai', TRUE)),
                    'uraian' => $this->input->post('keterangan', TRUE)
                );
                $id_pegawai = $this->input->post('id_pegawai', TRUE);
                $pegawai = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id_pegawai))->row_array();
                $nip = $pegawai['nip'];
                $this->db->where('id_riwayat_jabatan', $id);
                $this->db->update('simpeg_data_riwayat_jabatan', $data);
                redirect('simpeg_data_pegawai/detail/' . $nip);
            } else {
                $data['jabatan'] = $this->db->get_where('simpeg_data_riwayat_jabatan', array('id_riwayat_jabatan' => $id))->row_array();
                $data['unitkerja'] = $this->db->get('simpeg_master_unit_kerja')->result();
                $data['master'] = $this->db->get('simpeg_master_jabatan')->result();
                $this->template->display('edit_jabatan', $data);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['jabatan'] = $this->db->get_where('simpeg_data_riwayat_jabatan', array('id_riwayat_jabatan' => $id))->row_array();
            $data['unitkerja'] = $this->db->get('simpeg_master_unit_kerja')->result();
            $data['master'] = $this->db->get('simpeg_master_jabatan')->result();
            $this->template->display('edit_jabatan', $data);
        }
    }

    function addpenghargaan() {
        if (isset($_POST['submit'])) {
            $this->_rules_penghargaan();
            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('id_pegawai', TRUE);
                $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
                $data['master'] = $this->db->get('simpeg_master_penghargaan')->result();
                $this->template->display('add_penghargaan', $data);
            } else {
                $data = array('id_pegawai' => $this->input->post('id_pegawai', TRUE),
                    'id_master_penghargaan' => $this->input->post('penghargaan', TRUE),
                    'nomor_penghargaan' => $this->input->post('no_penghargaan', TRUE),
                    'tanggal_penghargaan' => tgl_db($this->input->post('tanggal', TRUE)),
                    'keterangan' => $this->input->post('keterangan', TRUE)
                );
                $nip = $this->input->post('nip_pegawai', TRUE);
                $this->db->insert('simpeg_data_penghargaan', $data);
                redirect('simpeg_data_pegawai/detail/' . $nip);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
            $data['master'] = $this->db->get('simpeg_master_penghargaan')->result();
            $this->template->display('add_penghargaan', $data);
        }
    }

    function editpenghargaan() {
        if (isset($_POST['submit'])) {
            $this->_rules_penghargaan();
            $id = $this->input->post('id_penghargaan', TRUE);
            if ($this->form_validation->run() == FALSE) {
                $data['penghargaan'] = $this->db->get_where('simpeg_data_penghargaan', array('id_penghargaan' => $id))->row_array();
                $data['master'] = $this->db->get('simpeg_master_penghargaan')->result();
                $this->template->display('edit_penghargaan', $data);
            } else {
                $data = array(
                    'id_master_penghargaan' => $this->input->post('penghargaan', TRUE),
                    'nomor_penghargaan' => $this->input->post('no_penghargaan', TRUE),
                    'tanggal_penghargaan' => tgl_db($this->input->post('tanggal', TRUE)),
                    'keterangan' => $this->input->post('keterangan', TRUE)
                );
                $id_pegawai = $this->input->post('id_pegawai', TRUE);
                $pegawai = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id_pegawai))->row_array();
                $nip = $pegawai['nip'];
                $this->db->where('id_penghargaan', $id);
                $this->db->update('simpeg_data_penghargaan', $data);
                redirect('simpeg_data_pegawai/detail/' . $nip);
                //echo print_r($data);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['penghargaan'] = $this->db->get_where('simpeg_data_penghargaan', array('id_penghargaan' => $id))->row_array();
            $data['master'] = $this->db->get('simpeg_master_penghargaan')->result();
            $this->template->display('edit_penghargaan', $data);
        }
    }

    function addpelatihan() {
        if (isset($_POST['submit'])) {
            $this->_rules_pelatihan();
            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('id_pegawai', TRUE);
                $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
                $data['pelatihan'] = $this->db->get('simpeg_master_pelatihan')->result();
                $data['tempat'] = $this->db->get('simpeg_master_lokasi_pelatihan')->result();
                $this->template->display('add_pelatihan', $data);
            } else {
                $id_pegawai = $this->input->post('id_pegawai', TRUE);
                $new_name = $id_pegawai . kode_tanggal();
                $config['upload_path'] = './upload/pelatihan';
                $config['allowed_types'] = 'jpg|png|pdf|doc|docx|xls|xlsx';
                $config['max_size'] = '5000';
                //$config['max_width'] = '3000';
                //$config['max_height'] = '3000';
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                $this->upload->do_upload('file_upload');
                $up_data = $this->upload->data();
                $data = array('id_pegawai' => $this->input->post('id_pegawai', TRUE),
                    'id_pelatihan' => $this->input->post('pelatihan', TRUE),
                    'id_lokasi' => $this->input->post('tempat', TRUE),
                    'tanggal' => tgl_db($this->input->post('tanggal_pelatihan', TRUE)),
                    'penyelenggara' => $this->input->post('penyelenggara', TRUE),
                    'lama_pelatihan' => $this->input->post('waktu', TRUE),
                    'catatan' => $this->input->post('catatan', TRUE),
                    'file'=>$up_data['file_name'],
                );
                $nip = $this->input->post('nip_pegawai', TRUE);
                $this->db->insert('simpeg_data_pelatihan', $data);
                redirect('simpeg_data_pegawai/detail/' . $nip);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
            $data['pelatihan'] = $this->db->get('simpeg_master_pelatihan')->result();
            $data['tempat'] = $this->db->get('simpeg_master_lokasi_pelatihan')->result();
            $this->template->display('add_pelatihan', $data);
        }
    }

    function editpelatihan() {
        if (isset($_POST['submit'])) {
            $this->_rules_pelatihan();
            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('id_pegawai', TRUE);
                $data['pelatihan'] = $this->db->get_where('simpeg_data_pelatihan', array('id_data_pelatihan' => $id))->row_array();
                $data['master'] = $this->db->get('simpeg_master_pelatihan')->result();
                $data['tempat'] = $this->db->get('simpeg_master_lokasi_pelatihan')->result();
                $this->template->display('add_pelatihan', $data);
            } else {
                $id_pegawai = $this->input->post('id_pegawai', TRUE);
                $new_name = $id_pegawai . kode_tanggal();
                $config['upload_path'] = './upload/pelatihan';
                $config['allowed_types'] = 'jpg|png|pdf|doc|docx|xls|xlsx';
                $config['max_size'] = '5000';
                //$config['max_width'] = '3000';
                //$config['max_height'] = '3000';
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                $this->upload->do_upload('file_upload');
                $up_data = $this->upload->data();
                $data = array(
                    'id_pelatihan' => $this->input->post('pelatihan', TRUE),
                    'id_lokasi' => $this->input->post('tempat', TRUE),
                    'tanggal' => tgl_db($this->input->post('tanggal_pelatihan', TRUE)),
                    'penyelenggara' => $this->input->post('penyelenggara', TRUE),
                    'lama_pelatihan' => $this->input->post('waktu', TRUE),
                    'catatan' => $this->input->post('catatan', TRUE),
                    'file'=>$up_data['file_name'],
                );
                $id_pegawai = $this->input->post('id_pegawai', TRUE);
                $pegawai = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id_pegawai))->row_array();
                $nip = $pegawai['nip'];
                $this->db->where('id_data_pelatihan', $this->input->post('id_data_pelatihan', TRUE));
                $this->db->update('simpeg_data_pelatihan', $data);
                redirect('simpeg_data_pegawai/detail/' . $nip);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['pelatihan'] = $this->db->get_where('simpeg_data_pelatihan', array('id_data_pelatihan' => $id))->row_array();
            $data['master'] = $this->db->get('simpeg_master_pelatihan')->result();
            $data['tempat'] = $this->db->get('simpeg_master_lokasi_pelatihan')->result();
            $this->template->display('edit_pelatihan', $data);
        }
    }

    function addpendidikan() {
        if (isset($_POST['submit'])) {
            $this->_rules_pendidikan();
            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('id_pegawai', TRUE);
                $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
                $this->template->display('add_pendidikan', $data);
            } else {
                $data = array('id_pegawai' => $this->input->post('id_pegawai', TRUE),
                    'tingkat_pendidikan' => $this->input->post('tingkat', TRUE),
                    'nama_sekolah' => $this->input->post('nama_sekolah', TRUE),
                    'alamat_sekolah' => $this->input->post('alamat', TRUE),
                    'jurusan' => $this->input->post('jurusan', TRUE),
                    'tahun_masuk' => $this->input->post('tahun_masuk', TRUE),
                    'tahun_lulus' => $this->input->post('tahun_lulus', TRUE),
                    'nomor_ijasah' => $this->input->post('nomor_ijasah', TRUE)
                );
                $nip = $this->input->post('nip_pegawai', TRUE);
                $this->db->insert('simpeg_data_pendidikan', $data);
                redirect('simpeg_data_pegawai/detail/' . $nip);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
            $this->template->display('add_pendidikan', $data);
        }
    }

    function editpendidikan() {
        if (isset($_POST['submit'])) {
            $this->_rules_pendidikan();
            if ($this->form_validation->run() == FALSE) {
                $id = $this->input->post('id_pendidikan', TRUE);
                $data['pendidikan'] = $this->db->get_where('simpeg_data_pendidikan', array('id_pendidikan' => $id))->row_array();
                $this->template->display('edit_pendidikan', $data);
            } else {
                $data = array(
                    'tingkat_pendidikan' => $this->input->post('tingkat', TRUE),
                    'nama_sekolah' => $this->input->post('nama_sekolah', TRUE),
                    'alamat_sekolah' => $this->input->post('alamat', TRUE),
                    'jurusan' => $this->input->post('jurusan', TRUE),
                    'tahun_masuk' => $this->input->post('tahun_masuk', TRUE),
                    'tahun_lulus' => $this->input->post('tahun_lulus', TRUE),
                    'nomor_ijasah' => $this->input->post('nomor_ijasah', TRUE)
                );
                $id_pegawai = $this->input->post('id_pegawai', TRUE);
                $id = $this->input->post('id_pendidikan', TRUE);
                $pegawai = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id_pegawai))->row_array();
                $nip = $pegawai['nip'];
                $this->db->where('id_pendidikan', $id);
                $this->db->update('simpeg_data_pendidikan', $data);
                redirect('simpeg_data_pegawai/detail/' . $nip);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['pendidikan'] = $this->db->get_where('simpeg_data_pendidikan', array('id_pendidikan' => $id))->row_array();
            // $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
            $this->template->display('edit_pendidikan', $data);
        }
    }

    public function delete($id) {
        $row = $this->Data_pegawai_model->get_by_id($id);

        if ($row) {
            $this->Data_pegawai_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('simpeg_data_pegawai'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_data_pegawai'));
        }
    }

    public function _rules() {
        $this->form_validation->set_message('is_unique', '%s Sudah Ada');
        $this->form_validation->set_rules('nip', 'NIP', 'trim|required|is_unique[simpeg_data_pegawai.nip]');
        $this->form_validation->set_rules('nama_pegawai', 'nama pegawai', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('agama', 'agama', 'trim|required');
        $this->form_validation->set_rules('status', 'status pegawai', 'trim|required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('unitkerja', 'Unit Kerja', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_update() {
        $this->form_validation->set_rules('nama_pegawai', 'nama pegawai', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('agama', 'agama', 'trim|required');
        $this->form_validation->set_rules('status', 'status pegawai', 'trim|required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('unitkerja', 'Unit Kerja', 'trim|required');
        $this->form_validation->set_rules('nomor_sk', 'Nomor SK', 'trim|required');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_pendidikan() {
        $this->form_validation->set_rules('tingkat', 'Jenjang Pendidikan', 'trim|required');
        $this->form_validation->set_rules('nama_sekolah', 'Nama Sekolah', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat Sekolah', 'trim|required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required');
        $this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'trim|required|numeric');
        $this->form_validation->set_rules('tahun_lulus', 'Tahun Lulus', 'trim|required|numeric');
        $this->form_validation->set_rules('nomor_ijasah', 'Nomor Ijasah', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_pelatihan() {
        $this->form_validation->set_rules('pelatihan', 'Nama Pelatihan', 'trim|required');
        $this->form_validation->set_rules('tempat', 'Tempat Pelatihan', 'trim|required');
        $this->form_validation->set_rules('tanggal_pelatihan', 'Tanggal Pelatihan', 'trim|required');
        $this->form_validation->set_rules('penyelenggara', 'Penyelenggara', 'trim|required');
        $this->form_validation->set_rules('waktu', 'Lama Penyelenggara', 'trim|required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_penghargaan() {
        $this->form_validation->set_rules('penghargaan', 'Nama Penghargaan', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'Tanggal Penghargaan', 'trim|required');
        $this->form_validation->set_rules('no_penghargaan', 'Nomor Penghargaan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_jabatan() {
        $this->form_validation->set_rules('jabatan', 'Nama Jabatan', 'trim|required');
        $this->form_validation->set_rules('unitkerja', 'Nama Unit Kerja', 'trim|required');
        $this->form_validation->set_rules('nomor_sk', 'Nomor SK', 'trim|required');
        $this->form_validation->set_rules('tanggal_sk', 'Tanggal SK', 'trim|required');
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Pengankatan', 'trim|required');
        $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai Jabatan', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class = "text-danger">', '</span>');
    }

    public function _rules_keluarga() {
        $this->form_validation->set_rules('keluarga', 'Nama Keluarga', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('status', 'Status Keluarga', 'trim|required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class = "text-danger">', '</span>');
    }

}
