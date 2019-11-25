<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simpeg_unit_kerja extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Unit_kerja_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $simpeg_unit_kerja = $this->Unit_kerja_model->get_all();

        $data = array(
            'simpeg_unit_kerja_data' => $simpeg_unit_kerja
        );

        $this->template->display('simpeg_master_unit_kerja_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Unit_kerja_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_unitkerja' => $row->id_unitkerja,
		'nama_unitkerja' => $row->nama_unitkerja,		
	    );
            $this->template->display('simpeg_master_unit_kerja_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_unit_kerja'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('simpeg_unit_kerja/create_action'),
	    'id_unitkerja' => set_value('id_unitkerja'),
	    'nama_unitkerja' => set_value('nama_unitkerja'),	   
	);
        $this->template->display('simpeg_master_unit_kerja_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_unitkerja' => $this->input->post('nama_unitkerja',TRUE),
	    );

            $this->Unit_kerja_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('simpeg_unit_kerja'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Unit_kerja_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('simpeg_unit_kerja/update_action'),
		'id_unitkerja' => set_value('id_unitkerja', $row->id_unitkerja),
		'nama_unitkerja' => set_value('nama_unitkerja', $row->nama_unitkerja),		
	    );
            $this->template->display('simpeg_master_unit_kerja_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_unit_kerja'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_unitkerja', TRUE));
        } else {
            $data = array(
		'nama_unitkerja' => $this->input->post('nama_unitkerja',TRUE),
	    );

            $this->Unit_kerja_model->update($this->input->post('id_unitkerja', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('simpeg_unit_kerja'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Unit_kerja_model->get_by_id($id);

        if ($row) {
            $this->Unit_kerja_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('simpeg_unit_kerja'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simpeg_unit_kerja'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_unitkerja', 'nama unitkerja', 'trim|required');
	$this->form_validation->set_rules('id_unitkerja', 'id_unitkerja', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

