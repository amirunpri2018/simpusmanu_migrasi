<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_auth extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->library('bcrypt');
    }

    function login($username, $hash) {
        //$this->db->where('email', $username);
        $query = $this->db->get_where('tb_users', array('username' => $username));
        //$query2 = $this->db->get_where('tb_users', array('email' => $username, 'aktif' => 1));
        $query2=$this->db->query("SELECT * FROM tb_users,tb_groups WHERE tb_users.gid=tb_groups.gid AND tb_users.username='$username' AND tb_users.aktif='1'");
        if ($query2->num_rows() > 0) {
            $result = $query2->row_array();            
            $paswd = $result['password'];            
            if ($this->bcrypt->check_password($hash, $paswd)) {
                $data = array(
                    'email' => $result['email'],
                    'username' => $result['username'],
                    'gid' => $result['gid'],
                    'last_login' => $result['last_login'],
                    'status_login' => 'login_successful', 
                    'group_apps'=>$result['group_apps'],
                );
                $this->session->set_userdata($data);
                $user = $result['username'];
                $this->db->where('username', $user);
                $this->db->update('tb_users', array('last_login' => date('Y-m-d H:i:s')));
                redirect('dashboard', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Password salah, Silahkan coba lagi ');
                $this->load->view('login');
            }
        } else if ($query->num_rows() > 0) {
            $this->session->set_flashdata('error', 'Username Belum Aktif, Silahkan Hubungi Admin');
            $this->load->view('login');
        } else {
            $this->session->set_flashdata('error', 'Username tidak ditemukan,Silahkan Hubungi Admin ');
            $this->load->view('login');
        }
    }

}
