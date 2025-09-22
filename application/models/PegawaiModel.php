<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PegawaiModel extends CI_Model {

    private $_table = 'tb_pegawai';

    public function getAll() {
        $this->db->select('tb_user.*, tb_pegawai.*');
        $this->db->from('tb_user');
        $this->db->join('tb_pegawai', 'tb_user.id_user = tb_pegawai.id_user');
        return $this->db->get();
    }

    public function save($pegawai) {
        return $this->db->insert($this->_table, $pegawai);
    }

    public function edit($id_pegawai, $pegawai) {
        $this->db->where('id_pegawai', $id_pegawai);
        return $this->db->update($this->_table, $pegawai);
    }

    public function doEdit($id_user, $pegawai) {
        $this->db->where('id_user', $id_user);
        return $this->db->update($this->_table, $pegawai);
    }
}