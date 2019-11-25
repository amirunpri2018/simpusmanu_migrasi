<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_auth extends CI_Model {

    public function __construct() {
      parent::__construct();

      $this->load->library('bcrypt');
   }


    function login($username, $hash) {
        $this->db->where('username', $username);
        $query = $this->db->get('tb_user'); 
        if ($query->num_rows() > 0) {
           $result = $query->row_array();
           $paswd = $result['password'];
           if ($this->bcrypt->check_password($hash,$paswd)) {  
            $group=$this->db->get_where('tb_group',array('gid'=>$result['gid']))->row_array();       
              $data = array('nama' =>$result['nama_user'] ,
                            'username'=>$result['username'] ,
                            'gid'=>$result['gid'],
                            'role'=>$result['role'],
                            'last_login'=>$result['last_login'],
                            'group'=>$group['nama_group'],
                            'status_login'=>'login_diterima',
                            );
                $this->session->set_userdata($data);
                redirect('dashboard', 'refresh');
             } else {
              $this->session->set_flashdata('error', 'Password salah, Silahkan coba lagi ');
              redirect('auth');                
             }
          }else{
            $this->session->set_flashdata('error', 'Email tidak terdaftar, Daftarkan email anda');
            redirect('auth');
          }   
        }
   
}
