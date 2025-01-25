<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
    	parent::__construct();
	}

    public function index() {
        $data['title'] = 'Dashboard';
        $data['pegawai'] = count($this->db->get('tb_pegawai')->result());

        $this->load->view('template/topbar', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }
}