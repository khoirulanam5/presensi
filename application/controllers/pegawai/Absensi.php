<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();  // Memuat library database

        // Pastikan user sudah login
        if (!$this->session->userdata('id_user')) {
            redirect('auth');  // Ganti dengan rute login yang sesuai
        }
    }

    public function index() {
        $data['title'] = 'Presensi Pegawai';
        
        // Ambil id_user dari session
        $id_user = $this->session->userdata('id_user');
        
        // Cek apakah pengguna sudah melakukan absensi hari ini
        $this->db->where('id_user', $id_user);
        $this->db->where('DATE(jam_masuk)', date('Y-m-d')); // Cek absensi masuk pada hari ini
        $absen_masuk = $this->db->get('tb_presensi')->row();

        // Cek apakah pengguna sudah melakukan absensi keluar hari ini
        $this->db->where('id_user', $id_user);
        $this->db->where('DATE(jam_keluar)', date('Y-m-d')); // Cek absensi keluar pada hari ini
        $absen_keluar = $this->db->get('tb_presensi')->row();
        
        // Menambahkan variabel untuk menonaktifkan tombol
        $data['is_absent_today'] = $absen_masuk ? true : false;
        $data['has_checked_out_today'] = $absen_keluar ? true : false;
    
        $this->load->view('template/topbar', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pegawai/absensi', $data);
        $this->load->view('template/footer');
    }    

    public function absensi() {
        // Cek tipe absensi (masuk atau keluar)
        $absensi_type = $this->input->post('absensi_type');
        
        $id_user = $this->session->userdata('id_user');
        $current_time = date('Y-m-d H:i:s');
        
        // Ambil data selfie base64
        $selfie_data = $this->input->post('selfie_data');
        
        // Cek apakah gambar sudah diambil
        if (empty($selfie_data)) {
            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Maaf', text:'Silakan ambil gambar selfie terlebih dahulu sebelum melakukan absensi.', icon:'warning'})</script>");
            redirect('pegawai/absensi');
            return;
        }
        
        // Jika tipe absensi adalah "keluar", cek apakah absensi masuk sudah dilakukan pada tanggal yang sama
        if ($absensi_type === 'keluar') {
            $check_absensi_masuk = $this->db->get_where('tb_presensi', [
                'id_user' => $id_user,
                'DATE(jam_masuk)' => date('Y-m-d')
            ])->row();
    
            if (!$check_absensi_masuk) {
                $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Maaf', text:'Anda belum melakukan absensi masuk pada hari ini', icon:'warning'})</script>");
                redirect('pegawai/absensi');
                return;
            }
        }

        if ($absensi_type === 'masuk') {
            $file_name = 'foto_' . time() . '.png';
            $file_path = './assets/img/absensi/' . $file_name;
        
            // Simpan gambar dari data base64
            $image_data = base64_decode(str_replace(' ', '+', str_replace('data:image/png;base64,', '', $selfie_data)));
            file_put_contents($file_path, $image_data);
        
            // Simpan data absensi masuk
            $absensi_data = array(
                'id_user' => $id_user,
                'selfie' => $file_name,
                'jam_masuk' => $current_time
            );
            $this->db->insert('tb_presensi', $absensi_data);
        
            $id_presensi = $this->db->insert_id();
        
            // Masukkan lokasi masuk ke tabel tb_location
            $lokasi_data = array(
                'id_presensi' => $id_presensi,
                'lokasi_masuk' => 'Jl. Lkr. Utara, Kayuapu Kulon, Gondangmanis, Kec. Bae, Kabupaten Kudus, Jawa Tengah 59327'
            );
            $this->db->insert('tb_location', $lokasi_data);
        
            $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Berhasil', text:'Absensi Masuk Berhasil', icon:'success'})</script>");
        
        } elseif ($absensi_type === 'keluar') {
            $file_name = 'foto_' . time() . '.png';
            $file_path = './assets/img/absensi/' . $file_name;
        
            // Simpan gambar dari data base64
            $image_data = base64_decode(str_replace(' ', '+', str_replace('data:image/png;base64,', '', $selfie_data)));
            file_put_contents($file_path, $image_data);
        
            // Cari ID presensi berdasarkan id_user dan tanggal
            $this->db->select('id_presensi');
            $this->db->from('tb_presensi');
            $this->db->where('id_user', $id_user);
            $this->db->where('DATE(jam_masuk)', date('Y-m-d'));
            $query = $this->db->get();
        
            if ($query->num_rows() > 0) {
                $id_presensi = $query->row()->id_presensi;
        
                // Update data absensi keluar di tb_presensi
                $this->db->set('jam_keluar', $current_time);
                $this->db->set('selfie_keluar', $file_name);
                $this->db->where('id_presensi', $id_presensi);
                $this->db->update('tb_presensi');
        
                // Update lokasi keluar di tb_location
                $this->db->set('lokasi_keluar', 'Jl. Lkr. Utara, Kayuapu Kulon, Gondangmanis, Kec. Bae, Kabupaten Kudus, Jawa Tengah 59327');
                $this->db->where('id_presensi', $id_presensi);
                $this->db->update('tb_location');
        
                $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Berhasil', text:'Absensi Keluar Berhasil', icon:'success'})</script>");
            } else {
                // Jika absensi masuk tidak ditemukan
                $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Gagal', text:'Absensi Masuk Tidak Ditemukan', icon:'error'})</script>");
            }
        }        
        redirect('pegawai/data_absensi');
    }    
    
}
