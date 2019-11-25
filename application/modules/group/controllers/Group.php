<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Group extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Group_model');
        chek_session();
        cek_menu();
    }

    public function index() {
        $group = $this->Group_model->get_all();

        $data = array(
            'group_data' => $group
        );

        $this->template->display('tb_groups_list', $data);
    }

    function menu($id) {
        $data['record'] = $this->db->get_where('tb_menu_access', array('gid' => $id))->result();
        $data['idmenu'] = $id;
        $this->template->display('view', $data);
    }

    function menu_add($id) {
        if (isset($_POST['submit'])) {
            $jenis="$id.";
            $parent = $_POST['kat_menu'];
            $maxchild = $this->db->query("SELECT max(child) as maxID FROM tb_menu_access WHERE gid='$id' AND child LIKE '$jenis%' ")->row_array();
            $maxno = $maxchild['maxID'];
            $noUrut = (int) substr($maxno, 2, 2);
            $noUrut++;
            $newID = $jenis . sprintf("%02s", $noUrut);
            if ($parent == 0) {
                //$noUrut = $maxno + 1;
                $noUrut=$newID;
            } else {
                $noUrut = $parent;
            }
            $data = array('gid' => $id,
                'nama_menu' => $_POST['nama'],
                'link' => $_POST['link'],
                'icon' => $_POST['icon'],
                'parent' => $parent,
                'child' => $noUrut);
            $this->db->insert('tb_menu_access', $data);
            redirect('group/menu/' . $id);
            //echo $maxno;
        } else {
            $data['record'] = $this->db->get_where('tb_menu_access', array('parent' => 0, 'gid' => $id))->result();
            $data['idmenu'] = $id;
            $this->template->display('menu_tambah', $data);
        }
    }

    function menu_edit($id) {
        if (isset($_POST['submit'])) {
            $group = $this->db->get_where('tb_menu_access', array('id_menu' => $_POST['id']))->row_array();
            $gid = $group['gid'];
            $nama_menu = $_POST['nama'];
            $data = array('nama_menu' => $_POST['nama'],
                'link' => $_POST['link'],
                'icon' => $_POST['icon'],
                'parent' => $_POST['kat_menu']);
            $this->db->where('id_menu', $_POST['id']);
            $this->db->update('tb_menu_access', $data);
            redirect('group/menu/' . $gid);
        } else {
            $group = $this->db->get_where('tb_menu_access', array('id_menu' => $id))->row_array();
            $gid = $group['gid'];
            $data['record'] = $this->db->get_where('tb_menu_access', array('id_menu' => $id))->row_array();
            $data['katmenu'] = $this->db->get_where('tb_menu_access', array('parent' => 0, 'gid' => $gid))->result();
            $this->template->display('group/menu_edit', $data);
        }
    }
    
    function menu_edit_action()
    {
        $group = $this->db->get_where('tb_menu_access', array('id_menu' => $_POST['id']))->row_array();
        $gid = $group['gid'];
        $nama_menu = $_POST['nama'];
        $data = array('nama_menu' => $_POST['nama'],
            'link' => $_POST['link'],
            'icon' => $_POST['icon'],
            'parent' => $_POST['kat_menu']);
        $this->db->where('id_menu', $_POST['id']);
        $this->db->update('tb_menu_access', $data);
        redirect('group/menu/' . $gid);
    }

    function menu_delete($id) {
        $group = $this->db->get_where('tb_menu_access', array('id_menu' => $id))->row_array();
        $gid = $group['gid'];
        $this->db->where('id_menu', $id);
        $this->db->delete('tb_menu_access');
        redirect('group/menu/' . $gid);
    }

    public function read($id) {
        $row = $this->Group_model->get_by_id($id);
        if ($row) {
            $data = array(
                'gid' => $row->gid,
                'usergroup' => $row->usergroup,
                'description' => $row->description,
            );
            $this->template->display('tb_groups_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('group'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('group/create_action'),
            'gid' => set_value('gid'),
            'usergroup' => set_value('usergroup'),
            'description' => set_value('description'),
        );
        $this->template->display('tb_groups_form', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $gid = $this->db->query("SELECT max(gid) as maxID FROM tb_groups")->row_array();
            $no = $gid['maxID'] + 1;
            $data = array(
                'gid' => $no,
                'usergroup' => $this->input->post('usergroup', TRUE),
                'description' => $this->input->post('description', TRUE),
                'group_apps' => $this->input->post('apps', TRUE),
            );

            $this->db->insert('tb_groups', $data);
            //$this->db->query("INSERT INTO tb_menu_access(nama_menu,icon,link,parent,child,allow)SELECT nama_menu,icon,link,parent,child,allow FROM tb_menu_access WHERE gid = 1 ");
            //$this->db->query("UPDATE tb_menu_access SET gid=$no WHERE gid=0");
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('group'));
        }
    }

    public function update($id) {
        $row = $this->Group_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('group/update_action'),
                'gid' => set_value('gid', $row->gid),
                'usergroup' => set_value('usergroup', $row->usergroup),
                'description' => set_value('description', $row->description),
                'group_apps'=>set_value('group_apps', $row->group_apps),
            );
            $this->template->display('tb_groups_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('group'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('gid', TRUE));
        } else {
            $data = array(
                'usergroup' => $this->input->post('usergroup', TRUE),
                'description' => $this->input->post('description', TRUE),
                'group_apps' => $this->input->post('apps', TRUE),
            );

            $this->Group_model->update($this->input->post('gid', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('group'));
        }
    }

    public function delete($id) {
        $row = $this->Group_model->get_by_id($id);

        if ($row) {
            $this->Group_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('group'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('group'));
        }
    }

    function allow($id) {
        $group = $this->db->get_where('tb_menu_access', array('id_menu' => $id))->row_array();
        $gid = $group['gid'];
        $this->db->where('id_menu', $id);
        $this->db->update('tb_menu_access', array('allow' => 1));
        redirect('group/menu/' . $gid);
    }

    function deny($id) {
        $group = $this->db->get_where('tb_menu_access', array('id_menu' => $id))->row_array();
        $gid = $group['gid'];
        $this->db->where('id_menu', $id);
        $this->db->update('tb_menu_access', array('allow' => 0));
        redirect('group/menu/' . $gid);
    }

    public function _rules() {
        $this->form_validation->set_rules('usergroup', 'usergroup', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');

        $this->form_validation->set_rules('gid', 'gid', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
