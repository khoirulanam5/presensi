<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Data Presensi Pegawai';

        $this->db->select('tb_presensi.*, tb_location.*, tb_user.nm_pengguna');
        $this->db->from('tb_presensi');
        $this->db->join('tb_location', 'tb_presensi.id_presensi = tb_location.id_presensi');
        $this->db->join('tb_user', 'tb_presensi.id_user = tb_user.id_user');
        $data['absensi'] = $this->db->get()->result();

        $this->load->view('template/topbar', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pimpinan/absensi', $data);
        $this->load->view('template/footer');
    }

    public function print() {
        $this->db->select('tb_presensi.*, tb_location.*, tb_user.nm_pengguna');
        $this->db->from('tb_presensi');
        $this->db->join('tb_location', 'tb_presensi.id_presensi = tb_location.id_presensi');
        $this->db->join('tb_user', 'tb_presensi.id_user = tb_user.id_user');
        $data['absensi'] = $this->db->get()->result();
        $this->load->view('print/print_absensi', $data);
    }    
}