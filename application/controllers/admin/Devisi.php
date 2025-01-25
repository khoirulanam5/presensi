<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devisi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Data Devisi';
        $data['devisi'] = $this->db->get('tb_devisi')->result();

        $this->load->view('template/topbar', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/devisi', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $this->form_validation->set_rules('nm_devisi', 'Nama Devisi', 'trim|required|is_unique[tb_devisi.nm_devisi]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Nama devisi sudah ada', icon:'warning'})</script>");
            redirect('admin/devisi');
        } else {
            $data = array(
                'nm_devisi' => $this->input->post('nm_devisi')
            );

            $insert = $this->db->insert('tb_devisi', $data);

            if ($insert) {
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil ditambahkan', icon:'success'})</script>");
                redirect('admin/devisi');
            } else {
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Data gagal ditambahkan', icon:'error'})</script>");
                redirect('admin/devisi');
            }
        }
    }

    public function edit($id_devisi) {
        $this->form_validation->set_rules('nm_devisi', 'Nama Devisi', 'trim|required|is_unique[tb_devisi.nm_devisi]');
    
        if ($this->form_validation->run() == FALSE) {
            $devisi = $this->db->get_where('tb_devisi', ['id_devisi' => $id_devisi])->row();
            $data = [
                'data' => [
                    'nm_devisi' => $devisi->nm_devisi
                ]
            ];
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Data gagal diupdate', icon:'error'})</script>");
            echo json_encode($data);  // Kirim response JSON
        } else {
            $data = array(
                'nm_devisi' => $this->input->post('nm_devisi')
            );
            $this->db->where('id_devisi', $id_devisi);
            $update = $this->db->update('tb_devisi', $data);
    
            if ($update) {
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil diupdate', icon:'success'})</script>");
                echo json_encode(['status' => 'success']);  // Tanggapan JSON untuk AJAX
            } else {
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Data gagal diupdate', icon:'error'})</script>");
                echo json_encode(['status' => 'error']);
            }
        }
    } 
    
    public function do_edit($id_devisi) {
        // Validasi input form
        $this->form_validation->set_rules('nm_devisi', 'Nama Devisi', 'trim|required|is_unique[tb_devisi.nm_devisi]');
    
        // Cek validasi form
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kirim respons error
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Nama devisi sudah ada!', icon:'warning'})</script>");
            redirect('admin/devisi');
        } else {
            // Data yang akan diperbarui
            $data = [
                'nm_devisi' => $this->input->post('nm_devisi')
            ];
    
            // Update data di tabel 'tb_devisi'
            $this->db->where('id_devisi', $id_devisi);
            $update = $this->db->update('tb_devisi', $data);
    
            if ($update) {
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data devisi berhasil diperbarui!', icon:'success'})</script>");
            } else {
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Data devisi gagal diperbarui!', icon:'error'})</script>");
            }
            redirect('admin/devisi');
        }
    }    

    // hapus data dari satu tabel
    public function delete($id_devisi) {
        $this->db->where('id_devisi', $id_devisi);
        $this->db->delete('tb_devisi');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Data berhasil dihapus', icon:'success'})</script>");
        redirect('admin/devisi');
    }
}