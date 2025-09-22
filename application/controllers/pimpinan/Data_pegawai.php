<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pegawai extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['PegawaiModel', 'UserModel']);
        ispimpinan();
    }

    public function index() {
        $data['title'] = 'Data Pegawai';
        $data['pegawai'] = $this->PegawaiModel->getAll()->result();
        $data['devisi'] = $this->db->get('tb_devisi')->result();

        $this->load->view('template/topbar', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pimpinan/data_pegawai', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $this->form_validation->set_rules('nm_pengguna', 'Nama Pengguna', 'trim|required');
        $this->form_validation->set_rules('jk_pegawai', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('no_pegawai', 'Nomor Pegawai', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Validasi gagal atau username sudah ada', icon:'warning'})</script>");
            redirect('pimpinan/data_pegawai');
        } else {
            if (!empty($_FILES['foto']['name'])) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/user/';
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('foto')) {
                    $image = $this->upload->data('file_name');
    
                    $data = [
                        'username' => $this->input->post('username'),
                        'password' => $this->input->post('password'),
                        'nm_pengguna' => $this->input->post('nm_pengguna'),
                        'level' => $this->input->post('level')
                    ];
                    $this->UserModel->save($data);
                    $id_user = $this->db->insert_id();
    
                    $pegawai = [
                        'id_user' => $id_user,
                        'id_devisi' => $this->input->post('id_devisi'),
                        'jk_pegawai' => $this->input->post('jk_pegawai'),
                        'no_pegawai' => $this->input->post('no_pegawai'),
                        'alamat' => $this->input->post('alamat'),
                        'foto' => $image
                    ];
                    $this->PegawaiModel->save($pegawai);
    
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
            $data = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'level' => $this->input->post('level')
            ];
            $this->UserModel->edit($id_user, $data);
    
            $pegawai = [
                'id_user' => $id_user,
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
            $this->PegawaiModel->doEdit($id_user, $pegawai);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil diupdate', icon:'success'})</script>");
            redirect('pimpinan/data_pegawai');
        }
    }
    
    public function delete($id_user) {
        $this->UserModel->delete($id_user);
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil dihapus', icon:'success'})</script>");
        redirect('pimpinan/data_pegawai');
    }    
}