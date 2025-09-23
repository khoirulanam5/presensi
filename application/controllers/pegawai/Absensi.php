<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['PresensiModel', 'LocationModel']);
        ispegawai();
    }

    public function index() {
        $data['title'] = 'Presensi Pegawai';
        
        // Cek apakah pengguna sudah melakukan absensi hari ini
        $absen_masuk = $this->PresensiModel->cekMasuk()->row();

        // Cek apakah pengguna sudah melakukan absensi keluar hari ini
        $absen_keluar = $this->PresensiModel->cekKeluar()->row();
        
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
        $current_time = date('Y-m-d H:i:s');
        
        // Ambil data selfie base64
        $selfie = $this->input->post('selfie_data');
        
        // Cek apakah gambar sudah diambil
        if (empty($selfie)) {
            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Maaf', text:'Silakan ambil gambar selfie terlebih dahulu sebelum melakukan absensi.', icon:'warning'})</script>");
            redirect('pegawai/absensi');
            return;
        }
        
        // Jika tipe absensi adalah "keluar", cek apakah absensi masuk sudah dilakukan pada tanggal yang sama
        if ($absensi_type === 'keluar') {
            $check_masuk = $this->db->get_where('tb_presensi', [
                'id_user' => $this->session->userdata('id_user'),
                'DATE(jam_masuk)' => date('Y-m-d')
            ])->row();

            if (!$check_masuk) {
                $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Maaf', text:'Anda belum melakukan absensi masuk pada hari ini', icon:'warning'})</script>");
                redirect('pegawai/absensi');
                return;
            }
        }

        if ($absensi_type === 'masuk') {
            $file_name = 'foto_' . time() . '.png';
            $file_path = './assets/img/absensi/' . $file_name;
        
            // Simpan gambar dari data base64
            $image = base64_decode(str_replace(' ', '+', str_replace('data:image/png;base64,', '', $selfie)));
            file_put_contents($file_path, $image);

            // Simpan data absensi masuk
            $data = array(
                'id_user' => $this->session->userdata('id_user'),
                'selfie' => $file_name,
                'jam_masuk' => $current_time
            );
            $this->PresensiModel->save($data);
            $id_presensi = $this->db->insert_id();
        
            // Masukkan lokasi masuk ke tabel tb_location
            $lokasi = array(
                'id_presensi' => $id_presensi,
                'lokasi_masuk' => 'Jl. Lkr. Utara, Kayuapu Kulon, Gondangmanis, Kec. Bae, Kabupaten Kudus, Jawa Tengah 59327'
            );
            $this->LocationModel->save($lokasi);

            $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Berhasil', text:'Absensi Masuk Berhasil', icon:'success'})</script>");
        
        } elseif ($absensi_type === 'keluar') {
            $file_name = 'foto_' . time() . '.png';
            $file_path = './assets/img/absensi/' . $file_name;
        
            // Simpan gambar dari data base64
            $image = base64_decode(str_replace(' ', '+', str_replace('data:image/png;base64,', '', $selfie)));
            file_put_contents($file_path, $image);

            // Cari ID presensi berdasarkan id_user dan tanggal
            $query = $this->PresensiModel->getById();

            if ($query->num_rows() > 0) {
                $id_presensi = $query->row()->id_presensi;
        
                // Update data absensi keluar di tb_presensi
                $this->PresensiModel->edit($current_time, $file_name, $id_presensi);
        
                // Update lokasi keluar di tb_location
                $this->LocationModel->edit($id_presensi);
        
                $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Berhasil', text:'Absensi Keluar Berhasil', icon:'success'})</script>");
            } else {
                $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Gagal', text:'Absensi Masuk Tidak Ditemukan', icon:'error'})</script>");
            }
        }        
        redirect('pegawai/data_absensi');
    }    
    
}
