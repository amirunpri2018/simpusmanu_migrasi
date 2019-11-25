<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_pegawai_model extends CI_Model {

    public $table = 'simpeg_data_pegawai';
    public $id = 'id_pegawai';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    // get all
    function get_all() {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id) {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_pegawai', $q);
        $this->db->or_like('nip', $q);
        $this->db->or_like('nip_lama', $q);
        $this->db->or_like('no_kartu_pegawai', $q);
        $this->db->or_like('nama_pegawai', $q);
        $this->db->or_like('tempat_lahir', $q);
        $this->db->or_like('tanggal_lahir', $q);
        $this->db->or_like('jenis_kelamin', $q);
        $this->db->or_like('agama', $q);
        $this->db->or_like('usia', $q);
        $this->db->or_like('status_pegawai', $q);
        $this->db->or_like('tanggal_pengangkatan_cpns', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('no_npwp', $q);
        $this->db->or_like('kartu_askes_pegawai', $q);
        $this->db->or_like('status_pegawai_pangkat', $q);
        $this->db->or_like('id_golongan', $q);
        $this->db->or_like('nomor_sk_pangkat', $q);
        $this->db->or_like('tanggal_sk_pangkat', $q);
        $this->db->or_like('tanggal_mulai_pangkat', $q);
        $this->db->or_like('tanggal_selesai_pangkat', $q);
        $this->db->or_like('id_status_jabatan', $q);
        $this->db->or_like('id_jabatan', $q);
        $this->db->or_like('id_unit_kerja', $q);
        $this->db->or_like('id_satuan_kerja', $q);
        $this->db->or_like('lokasi_kerja', $q);
        $this->db->or_like('nomor_sk_jabatan', $q);
        $this->db->or_like('tanggal_sk_jabatan', $q);
        $this->db->or_like('tanggal_mulai_jabatan', $q);
        $this->db->or_like('tanggal_selesai_jabatan', $q);
        $this->db->or_like('id_eselon', $q);
        $this->db->or_like('tmt_eselon', $q);
        $this->db->or_like('foto', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_pegawai', $q);
        $this->db->or_like('nip', $q);
        $this->db->or_like('nip_lama', $q);
        $this->db->or_like('no_kartu_pegawai', $q);
        $this->db->or_like('nama_pegawai', $q);
        $this->db->or_like('tempat_lahir', $q);
        $this->db->or_like('tanggal_lahir', $q);
        $this->db->or_like('jenis_kelamin', $q);
        $this->db->or_like('agama', $q);
        $this->db->or_like('usia', $q);
        $this->db->or_like('status_pegawai', $q);
        $this->db->or_like('tanggal_pengangkatan_cpns', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('no_npwp', $q);
        $this->db->or_like('kartu_askes_pegawai', $q);
        $this->db->or_like('status_pegawai_pangkat', $q);
        $this->db->or_like('id_golongan', $q);
        $this->db->or_like('nomor_sk_pangkat', $q);
        $this->db->or_like('tanggal_sk_pangkat', $q);
        $this->db->or_like('tanggal_mulai_pangkat', $q);
        $this->db->or_like('tanggal_selesai_pangkat', $q);
        $this->db->or_like('id_status_jabatan', $q);
        $this->db->or_like('id_jabatan', $q);
        $this->db->or_like('id_unit_kerja', $q);
        $this->db->or_like('id_satuan_kerja', $q);
        $this->db->or_like('lokasi_kerja', $q);
        $this->db->or_like('nomor_sk_jabatan', $q);
        $this->db->or_like('tanggal_sk_jabatan', $q);
        $this->db->or_like('tanggal_mulai_jabatan', $q);
        $this->db->or_like('tanggal_selesai_jabatan', $q);
        $this->db->or_like('id_eselon', $q);
        $this->db->or_like('tmt_eselon', $q);
        $this->db->or_like('foto', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data) {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data) {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id) {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}
