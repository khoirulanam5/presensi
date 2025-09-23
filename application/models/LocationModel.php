<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class LocationModel extends CI_Model {

    private $_table = 'tb_location';

    public function save($lokasi) {
        return $this->db->insert($this->_table, $lokasi);
    }

    public function edit($id_presensi) {
        $this->db->set('lokasi_keluar', 'Jl. Lkr. Utara, Kayuapu Kulon, Gondangmanis, Kec. Bae, Kabupaten Kudus, Jawa Tengah 59327');
        $this->db->where('id_presensi', $id_presensi);
        return $this->db->update($this->_table);
    }
}