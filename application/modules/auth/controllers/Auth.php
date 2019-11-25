<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('bcrypt');
        $this->load->model('M_auth');
    }

    function login($id) {
        $session = $this->session->set_userdata($id);
        if ($id == "simpeg") {
            $data = array('id' => "simpeg",
                'logo' => "human.png",
                'nama' => "SIMPEG");
            $this->session->set_userdata($data);
            $this->load->view('login');
        } else if ($id == "sip") {
            $data = array('id' => "ams",
                'logo' => "icon-surat.png",
                'nama' => "SIP");
            $this->session->set_userdata($data);
            $this->load->view('login');
        } else if ($id == "sima") {
            $data = array('id' => "asset",
                'logo' => "icon-aset.png",
                'nama' => "SIMA");
            $this->session->set_userdata($data);
            $this->load->view('login');
        } else {
            $data = array('id' => "siak",
                'logo' => "icon-sarjana.png",
                'nama' => "SIAKAD");
            $this->session->set_userdata($data);
            $this->load->view('login');
        }
    }

    function index() {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                //redirect('auth/login/'.$this->session->userdata('id'));
                $this->load->view('login');
            } else {
                $username = $this->input->post('username', true);
                $password = $this->input->post('password', true);
                $login = $this->M_auth->login($username, $password);
            }
        }else{
            redirect('web');
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('web');
    }

}
