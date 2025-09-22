<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_absensi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        ispegawai();
    }

    public function index() {
        $data['title'] = 'Data Presensi Pegawai';

        $id_user = $this->session->userdata('id_user');

        $this->db->select('tb_presensi.*, tb_location.*, tb_user.nm_pengguna');
        $this->db->from('tb_presensi');
        $this->db->join('tb_location', 'tb_presensi.id_presensi = tb_location.id_presensi');
        $this->db->join('tb_user', 'tb_presensi.id_user = tb_user.id_user');
        $this->db->where('tb_user.id_user', $id_user);
        $data['absensi'] = $this->db->get()->result();

        $this->load->view('template/topbar', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pegawai/data_absensi', $data);
        $this->load->view('template/footer');
    }
}