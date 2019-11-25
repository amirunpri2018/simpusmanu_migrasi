<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends MX_Controller {

    function __construct() {
        parent::__construct();
        //chek_session();
    }

    function index() {
        $data['record'] = $this->db->get('tb_menu')->result();
        $this->template->display('menu/view', $data);
    }

    function add() {
        if (isset($_POST['submit'])) {
            $parent = $_POST['kat_menu'];
            $maxchild = $this->db->query('SELECT max(child) as maxID FROM tb_menu')->row_array();
            $maxno = $maxchild['maxID'];
            if ($parent == 0) {
                $noUrut = $maxno + 1;
            } else {
                $noUrut = $parent;
            }
            $data = array('nama_menu' => $_POST['nama'],
                'link' => $_POST['link'],
                'icon' => $_POST['icon'],
                'parent' => $parent,
                'child' => $noUrut);
            $this->db->insert('tb_menu', $data);
            $cekgid = $this->db->query('SELECT tb_menu_access.gid FROM tb_menu_access GROUP BY tb_menu_access.gid ')->result();
            foreach ($cekgid as $gid) {                
                $data2 = array('gid' => $gid->gid,
                    'nama_menu' => $_POST['nama'],
                    'link' => $_POST['link'],
                    'icon' => $_POST['icon'],
                    'parent' => $parent,
                    'child' => $noUrut);
                $this->db->insert('tb_menu_access', $data2);
            }
            redirect('menu');
        } else {
            $data['record'] = $this->db->get_where('tb_menu', array('parent' => 0))->result();
            $this->template->display('menu/tambah', $data);
        }
    }

    function edit() {
        if (isset($_POST['submit'])) {
            $nama_old=$_POST['nama_old'];
            $nama_menu=$_POST['nama'];
            $link=$_POST['link'];
            $icon=$_POST['icon'];
            $parent=$_POST['kat_menu'];
            $data = array('nama_menu' => $_POST['nama'],
                'link' => $_POST['link'],
                'icon' => $_POST['icon'],
                'parent' => $_POST['kat_menu']);

            $this->db->where('id_menu', $_POST['id']);
            $this->db->update('tb_menu', $data);
            $this->db->query("UPDATE tb_menu_access SET nama_menu='$nama_menu',link='$link',icon='$icon',parent='$parent' WHERE nama_menu='$nama_old' ");
            redirect('menu');
        } else {
            $id = $this->uri->segment(3);
            $data['record'] = $this->db->get_where('tb_menu', array('id_menu' => $id))->row_array();
            $data['katmenu'] = $this->db->get_where('tb_menu', array('parent' => 0))->result();
            $this->template->display('menu/edit', $data);
        }
    }

    function delete($id) {        
        $this->db->where('id_menu', $id);
        $this->db->delete('tb_menu');
        //$this->db->query("DELETE FROM tb_menu_access WHERE nama_menu='$id'");
        redirect('menu');
    }

}
