<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cuti_model extends CI_Model {

    public $table = 'simpeg_data_absensi';
    public $id = 'id_absensi';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    // get all
    function get_all() {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_data() {
        $getdata = $thiss->db->query("SELECT* FROM simpeg_data_absensi as da,simpeg_master_izin as iz WHERE da.id_izin=iz.id_izin AND iz.jenis='CUTI' ORDER BY da.tanggal ASC");
        return $getdata->result();
    }

    // get data by id
    function get_by_id($id) {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_absensi', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->or_like('id_pegawai', $q);
        $this->db->or_like('kehadiran', $q);
        $this->db->or_like('id_izin', $q);
        $this->db->or_like('tgl_awal', $q);
        $this->db->or_like('tgl_akhir', $q);
        $this->db->or_like('file', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_absensi', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->or_like('id_pegawai', $q);
        $this->db->or_like('kehadiran', $q);
        $this->db->or_like('id_izin', $q);
        $this->db->or_like('tgl_awal', $q);
        $this->db->or_like('tgl_akhir', $q);
        $this->db->or_like('file', $q);
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

