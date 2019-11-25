<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siak_matakuliah_model extends CI_Model
{

    public $table = 'siak_matakuliah';
    public $id = 'id_makul';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_makul', $q);
	$this->db->or_like('kode_makul', $q);
	$this->db->or_like('kode_prodi', $q);
	$this->db->or_like('nama_makul', $q);
	$this->db->or_like('kode_kurikulum', $q);
	$this->db->or_like('sks_makul', $q);
	$this->db->or_like('sks_teori', $q);
	$this->db->or_like('sks_praktek', $q);
	$this->db->or_like('sks_lapangan', $q);
	$this->db->or_like('sks_simulasi', $q);
	$this->db->or_like('metode_kuliah', $q);
	$this->db->or_like('jenis_makul', $q);
	$this->db->or_like('silabus', $q);
	$this->db->or_like('sap', $q);
	$this->db->or_like('bahan_ajar', $q);
	$this->db->or_like('diklat', $q);
	$this->db->or_like('praktek', $q);
	$this->db->or_like('tanggal_mulai', $q);
	$this->db->or_like('tanggal_akhir', $q);
	$this->db->or_like('status_makul', $q);
	$this->db->or_like('dosen_pengampu', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_makul', $q);
	$this->db->or_like('kode_makul', $q);
	$this->db->or_like('kode_prodi', $q);
	$this->db->or_like('nama_makul', $q);
	$this->db->or_like('kode_kurikulum', $q);
	$this->db->or_like('sks_makul', $q);
	$this->db->or_like('sks_teori', $q);
	$this->db->or_like('sks_praktek', $q);
	$this->db->or_like('sks_lapangan', $q);
	$this->db->or_like('sks_simulasi', $q);
	$this->db->or_like('metode_kuliah', $q);
	$this->db->or_like('jenis_makul', $q);
	$this->db->or_like('silabus', $q);
	$this->db->or_like('sap', $q);
	$this->db->or_like('bahan_ajar', $q);
	$this->db->or_like('diklat', $q);
	$this->db->or_like('praktek', $q);
	$this->db->or_like('tanggal_mulai', $q);
	$this->db->or_like('tanggal_akhir', $q);
	$this->db->or_like('status_makul', $q);
	$this->db->or_like('dosen_pengampu', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Siak_matakuliah_model.php */
/* Location: ./application/models/Siak_matakuliah_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-24 10:24:49 */
/* http://harviacode.com */