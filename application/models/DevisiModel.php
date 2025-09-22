<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class DevisiModel extends CI_Model {

    private $_table = 'tb_devisi';

    public function getAll() {
        return $this->db->get($this->_table);
    }

    public function save($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function edit($id_devisi, $data) {
        $this->db->where('id_devisi', $id_devisi);
        return $this->db->update($this->_table, $data);
    }

    public function delete($id_devisi) {
        $this->db->where('id_devisi', $id_devisi);
        return $this->db->delete($this->_table);
    }
}