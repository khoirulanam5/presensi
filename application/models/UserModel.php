<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    private $_table = 'tb_user';

    public function save($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function edit($id_user, $data) {
        $this->db->where('id_user', $id_user);
        return $this->db->update($this->_table, $data);
    }

    public function delete($id_user) {
        $this->db->trans_start();
        $this->db->where('id_pegawai', $id_user);
        $this->db->delete('tb_pegawai');
        $this->db->where('id_user', $id_user);
        $this->db->delete($this->_table);
        return $this->db->trans_complete();
    }
}