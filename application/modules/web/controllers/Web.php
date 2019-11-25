<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Web extends MX_Controller {
 
    public function index()
    {
        $this->load->view('web/index');
    }
}
