<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class LocationModel extends CI_Model {

    private $_table = 'tb_location';

    public function getAll() {
        return $this->db->get($this->_table);
    }
}