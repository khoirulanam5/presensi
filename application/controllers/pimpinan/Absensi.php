<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['PresensiModel']);
        ispimpinan();
    }

    public function index() {
        $data['title'] = 'Data Presensi Pegawai';
        $data['absensi'] = $this->PresensiModel->getAll()->result();

        $this->load->view('template/topbar', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pimpinan/absensi', $data);
        $this->load->view('template/footer');
    }

    public function print() {
        $data['absensi'] = $this->PresensiModel->print()->result();
        $data['user'] = $this->PresensiModel->getPimpinan()->result();

        $this->load->view('print/print_absensi', $data);
    }    
}