<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pegawai extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Data Pegawai';
        $this->db->select('tb_user.*, tb_pegawai.*');
        $this->db->from('tb_user');
        $this->db->join('tb_pegawai', 'tb_user.id_user = tb_pegawai.id_user');
        $query = $this->db->get();
        $data['pegawai'] = $query->result();
        $data['devisi'] = $this->db->get('tb_devisi')->result();

        $this->load->view('template/topbar', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pimpinan/data_pegawai', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        // Validasi Input
        $this->form_validation->set_rules('nm_pengguna', 'Nama Pengguna', 'trim|required');
        $this->form_validation->set_rules('jk_pegawai', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('no_pegawai', 'Nomor Pegawai', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
    
        // Cek Validasi
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            // Cek jika ada file foto yang di-upload
            if (!empty($_FILES['foto']['name'])) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/user/';
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('foto')) {
                    $image = $this->upload->data('file_name');
    
                    // Data User
                    $user = [
                        'username' => $this->input->post('username'),
                        'password' => $this->input->post('password'),
                        'nm_pengguna' => $this->input->post('nm_pengguna'),
                        'level' => $this->input->post('level')
                    ];
                    $this->db->insert('tb_user', $user);
    
                    // Ambil id_user yang baru saja diinsert
                    $id_user = $this->db->insert_id();
    
                    // Data Pegawai dengan id_user dari insert_id()
                    $pegawai = [
                        'id_user' => $id_user,
                        'id_devisi' => $this->input->post('id_devisi'),
                        'jk_pegawai' => $this->input->post('jk_pegawai'),
                        'no_pegawai' => $this->input->post('no_pegawai'),
                        'alamat' => $this->input->post('alamat'),
                        'foto' => $image
                    ];
                    $this->db->insert('tb_pegawai', $pegawai);
    
                    // Pesan Sukses
                    $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil ditambahkan', icon:'success'})</script>");
                    redirect('pimpinan/data_pegawai');
                } else {
                    // Gagal Upload Foto
                    $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Ukuran file harus di bawah 2 MB dan ekstensi gif, jpg, png, atau jpeg!', icon:'warning'})</script>");
                    redirect('pimpinan/data_pegawai');
                }
            } else {
                // Jika Foto Tidak Diunggah
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Foto tidak boleh kosong!', icon:'warning'})</script>");
                redirect('pimpinan/data_pegawai');
            }
        }
    }

    public function edit($id_user) {
        $this->form_validation->set_rules('nm_pengguna', 'Nama Pengguna', 'trim|required');
        $this->form_validation->set_rules('jk_pegawai', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('no_pegawai', 'Nomor Pegawai', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Validasi gagal', icon:'warning'})</script>");
            redirect('pimpinan/data_pegawai');
        } else {
            $id = $this->input->post('id_user');

            $data_user = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'level' => $this->input->post('level')
            ];
            $this->db->where('id_user', $id);
            $this->db->update('tb_user', $data_user);
    
            $data_pegawai = [
                'id_user' => $id,
                'id_devisi' => $this->input->post('id_devisi'),
                'jk_pegawai' => $this->input->post('jk_pegawai'),
                'no_pegawai' => $this->input->post('no_pegawai'),
                'alamat' => $this->input->post('alamat')
            ];
    
            if (!empty($_FILES['foto']['name'])) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/user/';
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('foto')) {
                    $data_pegawai['foto'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Ukuran file harus di bawah 2 MB dan ekstensi gif, jpg, png, atau jpeg!', icon:'warning'})</script>");
                    redirect('pimpinan/data_pegawai');
                    return;
                }
            }
    
            $this->db->where('id_user', $id);
            $this->db->update('tb_pegawai', $data_pegawai);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil diupdate', icon:'success'})</script>");
            redirect('pimpinan/data_pegawai');
        }
    }
    
    // hapus data dari 2 tabel
    public function delete($id_user) {
        // Memulai transaksi
        $this->db->trans_start();
    
        // Hapus dari tabel tb_pegawai berdasarkan id_user
        $this->db->where('id_pegawai', $id_user);
        $this->db->delete('tb_pegawai');
    
        // Hapus dari tabel tb_user berdasarkan id_user
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');
    
        // Selesaikan transaksi
        $this->db->trans_complete();
    
        // Cek apakah transaksi berhasil
        if ($this->db->trans_status() === FALSE) {
            // Jika gagal, tampilkan pesan error
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Data gagal dihapus', icon:'error'})</script>");
        } else {
            // Jika berhasil, tampilkan pesan sukses
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil dihapus', icon:'success'})</script>");
        }
    
        // Redirect kembali ke halaman data pegawai
        redirect('pimpinan/data_pegawai');
    }    
}