<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_absensi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['PresensiModel']);
        ispegawai();
    }

    public function index() {
        $data['title'] = 'Data Presensi Pegawai';
        $data['absensi'] = $this->PresensiModel->getPegawei()->result();

        $this->load->view('template/topbar', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pegawai/data_absensi', $data);
        $this->load->view('template/footer');
    }
}