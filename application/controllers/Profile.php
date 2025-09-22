<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['UserModel', 'PegawaiModel']);
    }

    public function index() {
        $data['title'] = 'Profile';
        $data['user'] = [
            'id_user' => $this->session->userdata('id_user'),
            'username' => $this->session->userdata('username'),
            'password' => $this->session->userdata('password'),
            'nm_pengguna' => $this->session->userdata('nm_pengguna'),
            'level' => $this->session->userdata('level'),
            'id_pegawai' => $this->session->userdata('id_pegawai'),
            'id_user' => $this->session->userdata('id_user'),
            'id_devisi' => $this->session->userdata('id_devisi'),
            'jk_pegawai' => $this->session->userdata('jk_pegawai'),
            'no_pegawai' => $this->session->userdata('no_pegawai'),
            'alamat' => $this->session->userdata('alamat'),
            'foto' => $this->session->userdata('foto')
        ];
        $data['devisi'] = $this->db->get('tb_devisi')->result();
    
        $this->load->view('template/topbar', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('profile', $data);
        $this->load->view('template/footer');
    }    

    public function edit() {
        $config['upload_path'] = './assets/img/user/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['file_name'] = $_FILES['foto']['name'];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $upload_data = $this->upload->data();
            $foto = $upload_data['file_name'];
        } else {
            $foto = $this->session->userdata('foto');
        }

        $data = [
            'id_user' => $this->input->post('id_user'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'nm_pengguna' => $this->input->post('nm_pengguna'),
            'level' => $this->input->post('level')
        ];
        $editUser = $this->UserModel->edit($data['id_user'], $data);

        $pegawai = array(
            'id_pegawai' => $this->input->post('id_pegawai'),
            'id_user' => $this->input->post('id_user'),
            'id_devisi' => $this->input->post('id_devisi'),
            'jk_pegawai' => $this->input->post('jk_pegawai'),
            'no_pegawai' => $this->input->post('no_pegawai'),
            'alamat' => $this->input->post('alamat'),
            'foto' => $foto
        );
        $editPegawai = $this->PegawaiModel->edit($pegawai['id_pegawai'], $pegawai);

        if($editUser && $editPegawai) {
            $this->session->set_userdata([
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'level' => $this->input->post('level'),
                'id_devisi' => $this->input->post('id_devisi'),
                'jk_pegawai' => $this->input->post('jk_pegawai'),
                'no_pegawai' => $this->input->post('no_pegawai'),
                'alamat' => $this->input->post('alamat'),
                'foto' => $foto
            ]);
            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Update data berhasil', icon:'success'})</script>");
        } else {
            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Gagal', text:'Update data gagal', icon:'error'})</script>");
        }
        redirect('profile');
    }
}