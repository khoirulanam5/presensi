<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
        parent::__construct();
    }

	public function index() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $cek = $this->db->get_where("tb_user", array("username" => $username, "password" => $password))->row();

                if(!empty($cek)) {
                    $ses = [
                        'id_user' => $cek->id_user,
                        'username' => $cek->username,
                        'password' => $cek->password,
                        'nm_pengguna' => $cek->nm_pengguna,
                        'level' => $cek->level
                    ];
                    $this->session->set_userdata($ses);

                    $pegawai = $this->db->get_where('tb_pegawai', ['id_user' => $cek->id_user])->row();

                    if ($pegawai) {
                        $peg = [
                            'id_pegawai' => $pegawai->id_pegawai,
                            'id_user'    => $pegawai->id_user,
                            'id_devisi'  => $pegawai->id_devisi,
                            'jk_pegawai' => $pegawai->jk_pegawai,
                            'no_pegawai' => $pegawai->no_pegawai,
                            'alamat'     => $pegawai->alamat,
                            'foto'       => $pegawai->foto
                        ];
                        $this->session->set_userdata($peg);
                    }

                    if ($cek->level == 'pimpinan') {
                        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Login Berhasil', icon:'success'})</script>");
                        redirect('dashboard');
                    } else if ($cek->level == 'admin') {
                        $this->session->set_flashdata("pesan","<script>Swal.fire({icon:'success', title:'Berhasil', text:'Login Berhasil!', confirmButtonText:'OK'})</script>");
                        redirect('dashboard');
                    } else {
                        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Login Berhasil', icon:'success'})</script>");
                        redirect('dashboard');
                    }
                } else {
                    $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Gagal', text:'username / password salah', icon:'error'})</script>");
                    redirect('auth');
                }
        }   
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
