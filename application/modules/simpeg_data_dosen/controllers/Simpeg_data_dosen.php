<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpeg_data_dosen extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('Data_pegawai_model', 'M_image'));
        $this->db2=$this->load->database('database2',TRUE);
        chek_session();
        cek_menu();
    }

    public function index() {
        $this->template->display('siak_data_dosen_list');
    }

    function view_data() {
        $no = 1;
        $this->db->ORDER_BY('id_pegawai','DESC');
        $getdata = $this->db->get_where('simpeg_data_pegawai', array('jenis_pegawai' => 'Dosen'))->result();
        foreach ($getdata as $q) {
            $status = $this->db->get_where('simpeg_master_status_pegawai', array('id_status' => $q->status_pegawai))->row();
            if ($q->jenis_kelamin == 'Laki-Laki') {
                $gender = 'L';
            } else {
                $gender = 'P';
            }
            $query[] = array(
                'no' => $no++,
                'nidn' => $q->nidn,
                'nip' => $q->nip,
                'nama_pegawai' => $q->gelar_depan . ' ' . $q->nama_pegawai . ' ' . $q->gelar_belakang,
                'jenis_kelamin' => $gender,
                'alamat' => $q->alamat,
                'status_pegawai' => $status->nama_status,
                'detail' => anchor('simpeg_data_dosen/detail/' . $q->nip, '<i class="btn btn-info btn-sm fa fa-eye" data-toggle="tooltip" title="View Detail"></i>')
            );
        }
        $result = array('data' => $query);
        echo json_encode($result);
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'nip' => set_value('nip'),
            'nidn' => set_value('nidn'),
            'gelar_depan' => set_value('gelar_depan'),
            'gelar_belakang' => set_value('gelar_belakang'),
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
                'jenis_pegawai' => "Dosen",
                'nidn' => $this->input->post('nidn', TRUE),
                'nip' => $this->input->post('nip', TRUE),
                'nama_pegawai' => $this->input->post('nama_pegawai', TRUE),
                'gelar_depan' => $this->input->post('gelar_depan', TRUE),
                'gelar_belakang' => $this->input->post('gelar_belakang', TRUE),
                'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                'tanggal_lahir' => tgl_db($tanggal),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'agama' => $this->input->post('agama', TRUE),
                'id_jabatan' => $this->input->post('jabatan', TRUE),
                'id_status' => $this->input->post('status', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'id_unitkerja' => $this->input->post('unitkerja', TRUE),
                'foto' => 'avataruser.jpg',
            );

            $this->Data_pegawai_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('simpeg_data_dosen'));
        }
    }

    function detail($id) {
        $pegawai = $this->db->get_where('simpeg_data_pegawai', array('nip' => $id))->row();
        $id_pegawai = $pegawai->id_pegawai;
        $data['riwayatjab'] = $this->db->query("SELECT* FROM simpeg_data_riwayat_jabatan as rj,simpeg_master_jabatan as mj,simpeg_master_unit_kerja as uk "
                        . "WHERE rj.id_pegawai='$id_pegawai' AND rj.id_jabatan=mj.id AND rj.id_unit_kerja=uk.id_unitkerja ORDER BY rj.id_riwayat_jabatan ASC")->result();
        $data['penghargaan'] = $this->db->query("SELECT* FROM simpeg_data_penghargaan as dp,simpeg_master_penghargaan as mp WHERE dp.id_pegawai='$id_pegawai' AND dp.id_master_penghargaan=mp.id_master_penghargaan")->result();
        $data['pelatihan'] = $this->db->query("SELECT* FROM simpeg_data_pelatihan as dp,simpeg_master_pelatihan as mp,simpeg_master_lokasi_pelatihan as lp WHERE dp.id_pegawai='$id_pegawai' AND dp.id_pelatihan=mp.id_pelatihan AND dp.id_lokasi=lp.id_lokasi ORDER BY dp.tanggal ASC")->result();
        $data['pendidikan'] = $this->db->get_where('simpeg_data_pendidikan', array('id_pegawai' => $id_pegawai))->result();
        $data['keluarga'] = $this->db->get_where('simpeg_data_keluarga', array('id_pegawai' => $id_pegawai))->result();
        $data['unitkerja'] = $this->db->get_where('simpeg_master_unit_kerja', array('id_unitkerja' => $pegawai->id_unitkerja))->row_array();
        $data['status'] = $this->db->get_where('simpeg_master_status_pegawai', array('id_status' => $pegawai->id_status))->row_array();
        $data['jabatan'] = $this->db->get_where('simpeg_master_jabatan', array('id' => $pegawai->id_jabatan))->row_array();
        $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('nip' => $id))->row_array();
        $data['agama'] = $this->db->get_where('simpeg_master_agama', array('id' => $pegawai->agama))->row_array();
        $data['penilaian'] = $this->db->get_where('simpeg_penilaian', array('id_pegawai' => $id_pegawai))->result();
        $data['penugasan'] = $this->db2->get_where('siak_data_penugasan', array('nip' => $pegawai->nip))->result();
        $data['mengajar'] = $this->db2->get_where('siak_aktivitas_mengajar', array('nip' => $pegawai->nip))->result();
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
                    'nidn' => $this->input->post('nidn', TRUE),
                    'gelar_depan' => $this->input->post('gelar_depan', TRUE),
                    'gelar_belakang' => $this->input->post('gelar_belakang', TRUE),
                    'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                    'tanggal_lahir' => tgl_db($this->input->post('tanggal_lahir', TRUE)),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                    'alamat' => $this->input->post('alamat', TRUE),
                    'agama' => $this->input->post('agama', TRUE),
                    'id_unitkerja' => $this->input->post('unitkerja', TRUE),
                    'id_jabatan' => $this->input->post('jabatan', TRUE),
                    'status_pegawai' => $this->input->post('status', TRUE),
                    'nomor_sk_jabatan' => $this->input->post('nomor_sk', TRUE),
                    'tanggal_masuk' => tgl_db($this->input->post('tanggal_masuk', TRUE)),
                    'no_npwp' => $this->input->post('npwp', TRUE),
                    'keahlian' => $this->input->post('keahlian', TRUE),
                    'catatan' => $this->input->post('catatan', TRUE),
                    'foto' => $gambar
                );
                $data2 = array('nama_pegawai' => $this->input->post('nama_pegawai', TRUE),
                    'nidn' => $this->input->post('nidn', TRUE),
                    'gelar_depan' => $this->input->post('gelar_depan', TRUE),
                    'gelar_belakang' => $this->input->post('gelar_belakang', TRUE),
                    'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                    'tanggal_lahir' => tgl_db($this->input->post('tanggal_lahir', TRUE)),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                    'alamat' => $this->input->post('alamat', TRUE),
                    'agama' => $this->input->post('agama', TRUE),
                    'id_unitkerja' => $this->input->post('unitkerja', TRUE),
                    'id_jabatan' => $this->input->post('jabatan', TRUE),
                    'status_pegawai' => $this->input->post('status', TRUE),
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
                redirect('simpeg_data_dosen/detail/' . $nip);
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
                redirect('siak_data_dosen/detail/' . $nip);
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
                redirect('siak_data_dosen/detail/' . $nip);
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
                redirect('siak_data_dosen/detail/' . $nip);
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
                redirect('siak_data_dosen/detail/' . $nip);
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
                redirect('siak_data_dosen/detail/' . $nip);
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
                redirect('siak_data_dosen/detail/' . $nip);
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
                redirect('siak_data_dosen/detail/' . $nip);
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
                redirect('siak_data_dosen/detail/' . $nip);
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
                    'file' => $up_data['file_name'],
                );
                $nip = $this->input->post('nip_pegawai', TRUE);
                $this->db->insert('simpeg_data_pelatihan', $data);
                redirect('siak_data_dosen/detail/' . $nip);
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
                    'file' => $up_data['file_name'],
                );
                $id_pegawai = $this->input->post('id_pegawai', TRUE);
                $pegawai = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id_pegawai))->row_array();
                $nip = $pegawai['nip'];
                $this->db->where('id_data_pelatihan', $this->input->post('id_data_pelatihan', TRUE));
                $this->db->update('simpeg_data_pelatihan', $data);
                redirect('siak_data_dosen/detail/' . $nip);
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
                redirect('siak_data_dosen/detail/' . $nip);
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
                redirect('siak_data_dosen/detail/' . $nip);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['pendidikan'] = $this->db->get_where('simpeg_data_pendidikan', array('id_pendidikan' => $id))->row_array();
            // $data['pegawai'] = $this->db->get_where('simpeg_data_pegawai', array('id_pegawai' => $id))->row_array();
            $this->template->display('edit_pendidikan', $data);
        }
    }

    function create_penugasan($nip) {
        $data = array(
            'button' => 'Create',
            'action' => site_url('simpeg_data_dosen/create_action_penugasan'),
            'id_penugasan' => set_value('id_penugasan'),
            'nip' => set_value('nip', $nip),
            'tahun_ajaran' => set_value('tahun_ajaran'),
            'nama_pt' => set_value('nama_pt'),
            'program_studi' => set_value('program_studi'),
            'no_surat_tugas' => set_value('no_surat_tugas'),
            'tgl_surat_tugas' => set_value('tgl_surat_tugas'),
            'tmt_surat_tugas' => set_value('tmt_surat_tugas'),
        );
        $data['prodi'] = $this->db2->get('siak_prodi')->result();
        $data['pt'] = $this->db2->get('siak_pt')->result();
        $this->template->display('siak_data_penugasan_form', $data);
    }

    function create_action_penugasan() {
        $this->_rules_penugasan();

        if ($this->form_validation->run() == FALSE) {
            $nip=$this->input->post('nip', TRUE);
            $this->create_penugasan($nip);
        } else {
            $data = array(
                'nip' => $this->input->post('nip', TRUE),
                'tahun_ajaran' => $this->input->post('tahun_ajaran', TRUE),
                'nama_pt' => $this->input->post('nama_pt', TRUE),
                'program_studi' => $this->input->post('program_studi', TRUE),
                'no_surat_tugas' => $this->input->post('no_surat_tugas', TRUE),
                'tgl_surat_tugas' => tgl_db($this->input->post('tgl_surat_tugas', TRUE)),
                'tmt_surat_tugas' => tgl_db($this->input->post('tmt_surat_tugas', TRUE)),
            );

            $this->db2->insert('siak_data_penugasan', $data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('simpeg_data_dosen/detail/' . $this->input->post('nip', TRUE)));
        }
    }

    function update_penugasan($id) {
        $row = $this->db2->get_where('siak_data_penugasan', array('id_penugasan' => $id))->row();
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('simpeg_data_dosen/update_action_penugasan'),
                'id_penugasan' => set_value('id_penugasan', $row->id_penugasan),
                'nip' => set_value('nip', $row->nip),
                'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),
                'nama_pt' => set_value('nama_pt', $row->nama_pt),
                'program_studi' => set_value('program_studi', $row->program_studi),
                'no_surat_tugas' => set_value('no_surat_tugas', $row->no_surat_tugas),
                'tgl_surat_tugas' => set_value('tgl_surat_tugas', tgl_balik($row->tgl_surat_tugas)),
                'tmt_surat_tugas' => set_value('tmt_surat_tugas', tgl_balik($row->tmt_surat_tugas)),
            );
            $data['prodi'] = $this->db2->get('siak_prodi')->result();
            $data['pt'] = $this->db2->get('siak_pt')->result();
            $this->template->display('siak_data_penugasan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_data_dosen/detail/' . $row->nip));
        }
    }

    function update_action_penugasan() {
        $this->_rules_penugasan();

        if ($this->form_validation->run() == FALSE) {
            $this->update_penugasan($this->input->post('id_penugasan', TRUE));
        } else {
            $data = array(
                'nip' => $this->input->post('nip', TRUE),
                'tahun_ajaran' => $this->input->post('tahun_ajaran', TRUE),
                'nama_pt' => $this->input->post('nama_pt', TRUE),
                'program_studi' => $this->input->post('program_studi', TRUE),
                'no_surat_tugas' => $this->input->post('no_surat_tugas', TRUE),
                'tgl_surat_tugas' => tgl_db($this->input->post('tgl_surat_tugas', TRUE)),
                'tmt_surat_tugas' => tgl_db($this->input->post('tmt_surat_tugas', TRUE)),
            );
            $this->db2->where('id_penugasan', $this->input->post('id_penugasan', TRUE));
            $this->db2->update('siak_data_penugasan', $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('simpeg_data_dosen/detail/' . $this->input->post('nip', TRUE)));
        }
    }

    public function create_mengajar() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('simpeg_data_dosen/create_action_mengajar'),
            'id_mengajar' => set_value('id_mengajar'),
            'nip' => set_value('nip'),
            'periode' => set_value('periode'),
            'progam_studi' => set_value('progam_studi'),
            'matakuliah' => set_value('matakuliah'),
            'kelas' => set_value('kelas'),
            'rencana' => set_value('rencana'),
            'realisasi' => set_value('realisasi'),
        );
        $data['prodi'] = $this->db2->get('siak_prodi')->result();
        $data['makul'] = $this->db2->get('siak_matakuliah')->result();
        $this->template->display('siak_aktivitas_mengajar_form', $data);
    }

    public function create_action_mengajar() {
        $this->_rules_mengajar();

        if ($this->form_validation->run() == FALSE) {
            $this->create_mengajar();
        } else {
            $data = array(
                'nip' => $this->input->post('nip', TRUE),
                'periode' => $this->input->post('periode', TRUE),
                'progam_studi' => $this->input->post('progam_studi', TRUE),
                'matakuliah' => $this->input->post('matakuliah', TRUE),
                'kelas' => $this->input->post('kelas', TRUE),
                'rencana' => $this->input->post('rencana', TRUE),
                'realisasi' => $this->input->post('realisasi', TRUE),
            );

            $this->Siak_mengajar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('simpeg_data_dosen'));
        }
    }

    function update_mengajar($id) {
        $row = $this->Siak_mengajar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('simpeg_aktivitas_mengajar/update_action'),
                'id_mengajar' => set_value('id_mengajar', $row->id_mengajar),
                'nip' => set_value('nip', $row->nip),
                'periode' => set_value('periode', $row->periode),
                'progam_studi' => set_value('progam_studi', $row->progam_studi),
                'matakuliah' => set_value('matakuliah', $row->matakuliah),
                'kelas' => set_value('kelas', $row->kelas),
                'rencana' => set_value('rencana', $row->rencana),
                'realisasi' => set_value('realisasi', $row->realisasi),
            );
            $this->template->display('siak_aktivitas_mengajar_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_data_dosen'));
        }
    }

    function update_action_mengajar() {
        $this->_rules_mengajar();

        if ($this->form_validation->run() == FALSE) {
            $this->update_mengajar($this->input->post('id_mengajar', TRUE));
        } else {
            $data = array(
                'nip' => $this->input->post('nip', TRUE),
                'periode' => $this->input->post('periode', TRUE),
                'progam_studi' => $this->input->post('progam_studi', TRUE),
                'matakuliah' => $this->input->post('matakuliah', TRUE),
                'kelas' => $this->input->post('kelas', TRUE),
                'rencana' => $this->input->post('rencana', TRUE),
                'realisasi' => $this->input->post('realisasi', TRUE),
            );

            $this->Siak_mengajar_model->update($this->input->post('id_mengajar', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('simpeg_data_dosen'));
        }
    }

    function view_matakuliah() {
        $id = $this->input->post('id');
        $data = $this->db2->get_where('siak_matakuliah', array('kode_prodi' => $id))->result();
        foreach ($data as $row) {
            echo "<option value='$row->kode_makul'>$row->kode_makul | $row->nama_makul</option>";
        }
    }

    function view_matakuliah2() {
        $id = $this->input->get('id');
        $query = $this->db2->get_where('siak_matakuliah', array('kode_prodi' => $id))->result();
        echo '<div class="form-group >
                        <label >Mata Kuliah</label>
                        <select id="matakuliah" name="matakuliah" class="form-control">
                            <option value="0">-Select-</option>
                           ';
        foreach ($query as $row) {
            echo "<option value='$row->kode_makul'>$row->kode_makul | $row->nama_makul</option>";
        };
        echo ' </select>
                    </div>  ';
    }

    public function delete($id) {
        $row = $this->Data_pegawai_model->get_by_id($id);

        if ($row) {
            $this->Data_pegawai_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('simpeg_data_dosen'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_data_dosen'));
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

    function _rules_penugasan() {
        $this->form_validation->set_rules('nip', 'nip', 'trim|required');
        $this->form_validation->set_rules('tahun_ajaran', 'tahun ajaran', 'trim|required');
        $this->form_validation->set_rules('nama_pt', 'nama pt', 'trim|required');
        $this->form_validation->set_rules('program_studi', 'program studi', 'trim|required');
        $this->form_validation->set_rules('no_surat_tugas', 'no surat tugas', 'trim|required');
        $this->form_validation->set_rules('tgl_surat_tugas', 'tgl surat tugas', 'trim|required');
        $this->form_validation->set_rules('tmt_surat_tugas', 'tmt surat tugas', 'trim|required');
        $this->form_validation->set_rules('id_penugasan', 'id_penugasan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    function _rules_mengajar(){
        
    }
}
