<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai_model extends CI_Model {

    public $table = 'simpeg_data_pegawai';
    public $id = 'nama_pegawai';
    public $order = 'ASC';

    function __construct() {
        parent::__construct();
    }

    // get all
    function get_all() {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_data() {
        //$this->db->order_by($this->id, $this->order);
        $query = $this->db->query("SELECT* FROM simpeg_data_pegawai as dp,simpeg_master_jabatan as mj, simpeg_master_unit_kerja as uj,"
                        . "simpeg_master_status_pegawai as sp WHERE dp.id_status=sp.id_status AND dp.id_jabatan=mj.id AND dp.id_unitkerja=uj.id_unitkerja ORDER BY dp.nama_pegawai ASC");
        //return $this->db->get($this->table)->result();
        return $query->result();
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
        $this->db->or_like('alamat', $q);
        $this->db->or_like('tanggal_masuk', $q);
        $this->db->or_like('no_npwp', $q);
        $this->db->or_like('kartu_askes_pegawai', $q);
        $this->db->or_like('id_status', $q);
        $this->db->or_like('id_unitkerja', $q);
        $this->db->or_like('id_jabatan', $q);
        $this->db->or_like('nomor_sk_jabatan', $q);
        $this->db->or_like('tanggal_sk_jabatan', $q);
        $this->db->or_like('tanggal_mulai_jabatan', $q);
        $this->db->or_like('tanggal_selesai_jabatan', $q);
        $this->db->or_like('foto', $q);
        $this->db->or_like('keahlian', $q);
        $this->db->or_like('catatan', $q);
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
        $this->db->or_like('alamat', $q);
        $this->db->or_like('tanggal_masuk', $q);
        $this->db->or_like('no_npwp', $q);
        $this->db->or_like('kartu_askes_pegawai', $q);
        $this->db->or_like('id_status', $q);
        $this->db->or_like('id_unitkerja', $q);
        $this->db->or_like('id_jabatan', $q);
        $this->db->or_like('nomor_sk_jabatan', $q);
        $this->db->or_like('tanggal_sk_jabatan', $q);
        $this->db->or_like('tanggal_mulai_jabatan', $q);
        $this->db->or_like('tanggal_selesai_jabatan', $q);
        $this->db->or_like('foto', $q);
        $this->db->or_like('keahlian', $q);
        $this->db->or_like('catatan', $q);
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
