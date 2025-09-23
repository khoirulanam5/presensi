<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PresensiModel extends CI_Model {

    private $_table = 'tb_presensi';

    public function cekMasuk() {
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->where('DATE(jam_masuk)', date('Y-m-d'));
        return $this->db->get($this->_table);
    }

    public function cekKeluar() {
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->where('DATE(jam_keluar)', date('Y-m-d'));
        return $this->db->get($this->_table);
    }

    public function save($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function edit($current_time, $file_name, $id_presensi) {
        $this->db->set('jam_keluar', $current_time);
        $this->db->set('selfie_keluar', $file_name);
        $this->db->where('id_presensi', $id_presensi);
        return $this->db->update($this->_table);
    }

    public function getById() {
        $this->db->select('id_presensi');
        $this->db->from('tb_presensi');
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->where('DATE(jam_masuk)', date('Y-m-d'));
        return $this->db->get();
    }

    public function getAll() {
        $this->db->select('tb_presensi.*, tb_location.*, tb_user.nm_pengguna');
        $this->db->from('tb_presensi');
        $this->db->join('tb_location', 'tb_presensi.id_presensi = tb_location.id_presensi');
        $this->db->join('tb_user', 'tb_presensi.id_user = tb_user.id_user');
        return $this->db->get();
    }

    public function getPegawei() {
        $this->db->select('tb_presensi.*, tb_location.*, tb_user.nm_pengguna');
        $this->db->from('tb_presensi');
        $this->db->join('tb_location', 'tb_presensi.id_presensi = tb_location.id_presensi');
        $this->db->join('tb_user', 'tb_presensi.id_user = tb_user.id_user');
        $this->db->where('tb_user.id_user', $this->session->userdata('id_user'));
        return $this->db->get();
    }

    public function getPimpinan() {
        $this->db->select('tb_user.*');
        $this->db->from('tb_user');
        $this->db->where('level', 'pimpinan');
        return $this->db->get();
    }

    public function print() {
        $this->db->select('tb_presensi.*, tb_location.*, tb_user.nm_pengguna');
        $this->db->from('tb_presensi');
        $this->db->join('tb_location', 'tb_presensi.id_presensi = tb_location.id_presensi');
        $this->db->join('tb_user', 'tb_presensi.id_user = tb_user.id_user');
        return $this->db->get();
    }

}