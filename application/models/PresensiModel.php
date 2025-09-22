<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PresensiModel extends CI_Model {

    private $_table = 'tb_presensi';

    public function getAll() {
        $this->db->select('tb_presensi.*, tb_location.*, tb_user.nm_pengguna');
        $this->db->from('tb_presensi');
        $this->db->join('tb_location', 'tb_presensi.id_presensi = tb_location.id_presensi');
        $this->db->join('tb_user', 'tb_presensi.id_user = tb_user.id_user');
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