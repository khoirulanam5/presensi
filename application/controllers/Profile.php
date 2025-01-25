<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        // Ambil data user dari session langsung
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
        $id_user = $this->input->post('id_user');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $nm_pengguna = $this->input->post('nm_pengguna');
        $level = $this->input->post('level');
        $id_pegawai = $this->input->post('id_pegawai');
        $id_devisi = $this->input->post('id_devisi');
        $jk_pegawai = $this->input->post('jk_pegawai');
        $no_pegawai = $this->input->post('no_pegawai');
        $alamat = $this->input->post('alamat');

        // Konfigurasi upload foto
        $config['upload_path'] = './assets/img/user/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['file_name'] = $_FILES['foto']['name']; // Gunakan nama file asli jika ingin mengganti

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            // Jika upload berhasil, ambil nama file yang diupload
            $upload_data = $this->upload->data();
            //buat variabel dan masukan ke array
            $foto = $upload_data['file_name'];
        } else {
            // Jika tidak ada file yang diupload, gunakan file foto lama
            $foto = $this->session->userdata('foto');
        }

        $user = [
            'id_user' => $id_user,
            'username' => $username,
            'password' => $password,
            'nm_pengguna' => $nm_pengguna,
            'level' => $level
        ];
        
        $update_user = $this->db->where('id_user', $id_user);
                       $this->db->update('tb_user', $user);

        $pegawai = array(
            'id_pegawai' => $id_pegawai,
            'id_user' => $id_user,
            'id_devisi' => $id_devisi,
            'jk_pegawai' => $jk_pegawai,
            'no_pegawai' => $no_pegawai,
            'alamat' => $alamat,
            'foto' => $foto
        );

        $update_pegawai = $this->db->where('id_pegawai', $id_pegawai);
                          $this->db->update('tb_pegawai', $pegawai);

        if($update_user && $update_pegawai) {
            // Jika update berhasil, perbarui session dengan data yang baru
            $this->session->set_userdata([
                'username' => $username,
                'password' => $password,
                'nm_pengguna' => $nm_pengguna,
                'level' => $level,
                'id_devisi' => $id_devisi,
                'jk_pegawai' => $jk_pegawai,
                'no_pegawai' => $no_pegawai,
                'alamat' => $alamat,
                'foto' => $foto
            ]);
            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Update data berhasil', icon:'success'})</script>");
        } else {
            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Gagal', text:'Update data gagal', icon:'error'})</script>");
        }
        redirect('profile');
    }
}