<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devisi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['DevisiModel']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Data Devisi';
        $data['devisi'] = $this->DevisiModel->getAll()->result();

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
            $this->DevisiModel->save($data);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil ditambahkan', icon:'success'})</script>");
            redirect('admin/devisi');
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
            echo json_encode($data);
        } else {
            $data = array(
                'nm_devisi' => $this->input->post('nm_devisi')
            );
            $this->DevisiModel->edit($id_devisi, $data);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil diupdate', icon:'success'})</script>");
            echo json_encode(['status' => 'success']);
        }
    } 
    
    public function do_edit($id_devisi) {
        $this->form_validation->set_rules('nm_devisi', 'Nama Devisi', 'trim|required|is_unique[tb_devisi.nm_devisi]');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Nama devisi sudah ada!', icon:'warning'})</script>");
            redirect('admin/devisi');
        } else {
            $data = [
                'nm_devisi' => $this->input->post('nm_devisi')
            ];
            $this->DevisiModel->edit($id_devisi, $data);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data devisi berhasil diperbarui!', icon:'success'})</script>");
            redirect('admin/devisi');
        }
    }    

    public function delete($id_devisi) {
        $this->DevisiModel->delete($id_devisi);
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Data berhasil dihapus', icon:'success'})</script>");
        redirect('admin/devisi');
    }
}