<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_user'));
        $this->load->library('bcrypt');
        //chek_administrator();
    }

    function index() {
        $data['record'] = $this->db->get('tb_users')->result();
        $this->template->display('view', $data);
    }

    function add() {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_message('is_unique', '%s Sudah Ada');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[tb_users.username]');
            $this->form_validation->set_rules('passwd', 'Password', 'required');
            $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
            $this->form_validation->set_rules('email', 'Email Pengguna', 'required');
            $this->form_validation->set_rules('group', 'User Group', 'required');
            if ($this->form_validation->run() == true) {
                $paswd = $this->input->post('passwd');
                $hashpaswd = $this->bcrypt->hash_password($paswd);
                $data = array('username' => $_POST['username'],
                    'nama_pengguna' => $_POST['nama'],
                    'email' => $_POST['email'],
                    'password' => $hashpaswd,
                    'gid' => $_POST['group'],
                    'created_on' => date('Y-m-d h:i:s'));
                $this->db->insert('tb_users', $data);
                redirect('user');
            } else {
                $data['record'] = $this->db->get_where('tb_groups')->result();
                $this->template->display('user/tambah', $data);
            }
        } else {
            $data['record'] = $this->db->get_where('tb_groups')->result();
            $this->template->display('user/tambah', $data);
        }
    }

    function edit() {
        if (isset($_POST['submit'])) {
            //$this->form_validation->set_rules('passwd', 'Password', 'required');
            $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
            $this->form_validation->set_rules('email', 'Email Pengguna', 'required');
            $this->form_validation->set_rules('group', 'User Group', 'required');
            $id = $_POST['id'];
            if ($this->form_validation->run() == true) {
                $paswd = $this->input->post('passwd');
                $hashpaswd = $this->bcrypt->hash_password($paswd);
                if($paswd==""){
                    $data = array('nama_pengguna' => $_POST['nama'],
                    'email' => $_POST['email'],
                    'gid' => $_POST['group']);
                }else{
                  $data = array('nama_pengguna' => $_POST['nama'],
                    'email' => $_POST['email'],
                    'password' => $hashpaswd,
                    'gid' => $_POST['group']);  
                }                
                $this->db->where('id_user', $id);
                $this->db->update('tb_users', $data);
                redirect('user');
            } else {
                $data['record'] = $this->db->get_where('tb_users', array('id_user' => $id))->row_array();
                $data['group'] = $this->db->get('tb_groups')->result();
                $this->template->display('user/edit', $data);
            }
        } else {
            $id = $this->uri->segment(3);
            $data['record'] = $this->db->get_where('tb_users', array('id_user' => $id))->row_array();
            $data['group'] = $this->db->get('tb_groups')->result();
            $data['katmenu'] = $this->db->get_where('tb_menu_access', array('parent' => 0))->result();
            $this->template->display('user/edit', $data);
        }
    }

    function activate($id) {
        $this->db->where('id_user',$id);
        $this->db->update('tb_users',array('aktif'=>1));
        redirect('user');
    }
    
    function deactivate($id) {
        $this->db->where('id_user',$id);
        $this->db->update('tb_users',array('aktif'=>0));
        redirect('user');
    }

    function delete($id) {
        $this->db->where('id_user', $id);
        $this->db->delete('tb_users');
        redirect('user');
    }

}
