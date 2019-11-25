<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    function __construct() {
        parent::__construct();
        
    }

    function index() {
        $data['title'] = "Home";
        $gid = $this->session->userdata('gid');
        $data['group'] = $this->db->get_where('tb_groups', array('gid' => $gid))->row_array();
        $this->template->display('dashboard/index2');
    }

    

    function _set_rules() {
        $this->form_validation->set_rules('user', 'username', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

}
