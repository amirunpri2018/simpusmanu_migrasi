<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_surat_masuk extends CI_Model
{

    public $table = 'sip_data_surat';
    public $id = 'id_surat';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function getSuratMasuk($tahun)
    {
        $this->db->where('kategori_surat','Surat Masuk')
                ->where('year(tanggal_surat)',$tahun);
        $this->db->order_by('kode_surat', 'DESC');
        return $this->db->get('sip_data_surat')->result();
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
        $this->db->like('id_surat', $q);
	$this->db->or_like('nomor_surat', $q);
	$this->db->or_like('kategori_surat', $q);
	$this->db->or_like('sifat_surat', $q);
	$this->db->or_like('prioritas_surat', $q);
	$this->db->or_like('jenis_surat', $q);
	$this->db->or_like('tipe_surat', $q);
	$this->db->or_like('asal_surat', $q);
	$this->db->or_like('tujuan_surat', $q);
	$this->db->or_like('tanggal_surat', $q);
	$this->db->or_like('tanggal_pencatatan', $q);
	$this->db->or_like('nama_pengirim', $q);
	$this->db->or_like('perihal_surat', $q);
	$this->db->or_like('isi_surat', $q);
	$this->db->or_like('id_lokasi', $q);
	$this->db->or_like('lampiran', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_surat', $q);
	$this->db->or_like('nomor_surat', $q);
	$this->db->or_like('kategori_surat', $q);
	$this->db->or_like('sifat_surat', $q);
	$this->db->or_like('prioritas_surat', $q);
	$this->db->or_like('jenis_surat', $q);
	$this->db->or_like('tipe_surat', $q);
	$this->db->or_like('asal_surat', $q);
	$this->db->or_like('tujuan_surat', $q);
	$this->db->or_like('tanggal_surat', $q);
	$this->db->or_like('tanggal_pencatatan', $q);
	$this->db->or_like('nama_pengirim', $q);
	$this->db->or_like('perihal_surat', $q);
	$this->db->or_like('isi_surat', $q);
	$this->db->or_like('id_lokasi', $q);
	$this->db->or_like('lampiran', $q);
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
