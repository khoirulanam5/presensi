<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['PresensiModel']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Data Absensi Pegawai';
        $data['absensi'] = $this->PresensiModel->getAll()->result();

        $this->load->view('template/topbar', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/absensi', $data);
        $this->load->view('template/footer');
    }

    public function print() {
        $data['absensi'] = $this->PresensiModel->getAll()->result();
        $data['user'] = $this->PresensiModel->getPimpinan()->result();

        $this->load->view('print/print_absensi', $data);
    } 
}