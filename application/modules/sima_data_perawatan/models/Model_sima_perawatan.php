<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_sima_perawatan extends CI_Model {

    public $table = 'sima_perawatan_inv';
    public $id = 'id_perawatan';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }
    
    function kdotomatis() {
       // $group=$this->db->get_where('tb_group',array('gid'=>$this->session->userdata('gid')))->row_array();
        //$kode=$group['nama_alias'];
        $jenis = "M-HI-".date('m').".";
        $query = $this->db->query("SELECT max(no_transaksi) as maxID FROM sima_perawatan_inv WHERE no_transaksi LIKE '$jenis%'");
        $data = $query->row_array();
        $idMax = $data['maxID'];
        $noUrut = (int) substr($idMax, 10, 3);
        $noUrut++;
        $newID = $jenis . sprintf("%03s", $noUrut);
        return $newID;       
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
        $this->db->like('id_perawatan', $q);
        $this->db->or_like('no_transaksi', $q);
        $this->db->or_like('kode_inventaris', $q);
        $this->db->or_like('tgl_perawatan', $q);
        $this->db->or_like('tindakan_perawatan', $q);
        $this->db->or_like('biaya', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_perawatan', $q);
        $this->db->or_like('no_transaksi', $q);
        $this->db->or_like('kode_inventaris', $q);
        $this->db->or_like('tgl_perawatan', $q);
        $this->db->or_like('tindakan_perawatan', $q);
        $this->db->or_like('biaya', $q);
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

/* End of file Model_sima_perawatan.php */
/* Location: ./application/models/Model_sima_perawatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-06-01 06:59:06 */
/* http://harviacode.com */