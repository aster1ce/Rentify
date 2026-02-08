<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        // PANGGIL MODEL MEH TEU LIER
        $this->load->model('M_alat');
    }

    public function index($tab = 'alat')
    {
        // 1. Tentukan tab mana yang lagi aktif
        $data['tab_aktif'] = $tab;
        $data['nama'] = $this->session->userdata('nama_lengkap');

        // 2. Ambil data dari Model sesuai tab-nya
        if ($tab == 'kategori') {
            $data['isi_tabel'] = $this->M_alat->get_semua_kategori();
        } else {
            $data['isi_tabel'] = $this->M_alat->get_semua_alat();
        }

        // var_dump($data['isi_tabel']);
        // die();

        $this->load->view('layout/sidebar'); // Pake jalur standar biar aman, kata Gemini gaboleh pake Root path
        $this->load->view('admin/kelola_alat_v', $data);
    }

    // ================= Tambah Alat ================= //

    public function tambah_alat()
    {
        // Gak perlu load model lagi, kan udah aya di atas ey
        $data['kategori'] = $this->M_alat->get_kategori();
        $data['nama'] = $this->session->userdata('nama_lengkap');

        $this->load->view('layout/sidebar');
        $this->load->view('admin/tambah_alat_v', $data);
    }

    public function proses_tambah()
    {
        $data = [
            'nama_alat' => $this->input->post('nama_alat'),
            'id_kategori' => $this->input->post('id_kategori'),
            'stok' => $this->input->post('stok')
        ];
        $this->M_alat->insert_alat($data); // Aman karena udah di load di atas
        redirect('alat');
    }


    // ================ Tambah Kategori ================= //

    public function tambah_kategori()
    {
        $data['nama'] = $this->session->userdata('nama_lengkap');
        $data['tab_aktif'] = 'kategori';

        $this->load->view('layout/sidebar');
        $this->load->view('admin/tambah_kategori_v', $data);
    }

    public function proses_tambah_kategori()
    {
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori')
        ];
        // INI YANG TADI ERROR. Sekarang udah gak bakal error lagi
        $this->M_alat->insert_kategori($data);
        redirect('alat/index/kategori');
    }




    //-------------------- Aksi Kategori ------------------ //
    public function edit_kategori($id = NULL)
    {
        if ($id == NULL)
            redirect('alat/index/kategori');

        $data['nama'] = $this->session->userdata('nama_lengkap');
        $data['kategori'] = $this->M_alat->get_kategori_by_id($id);

        // Cek jika data tidak ditemukan agar tidak error saat load view
        if (!$data['kategori'])
            redirect('alat/index/kategori');

        $this->load->view('layout/sidebar');
        $this->load->view('admin/edit_kategori_v', $data);
    }

    public function hapus_kategori($id)
    {
        $this->M_alat->hapus_kategori($id);
        redirect('alat/index/kategori');
    }

    public function proses_edit_kategori()
    {
        $id = $this->input->post('id_kategori');
        $data = ['nama_kategori' => $this->input->post('nama_kategori')];

        $this->M_alat->update_kategori($id, $data);
        redirect('alat/index/kategori');
    }

    // -------------------- Aksi Alat ------------------ //
    public function edit_alat($id = NULL)
    {
        if ($id == NULL)
            redirect('alat/index/alat');

        $data['nama'] = $this->session->userdata('nama_lengkap');
        $data['alat'] = $this->M_alat->get_alat_by_id($id);
        $data['kategori'] = $this->M_alat->get_kategori();

        if (!$data['alat'])
            redirect('alat/index/alat');

        $this->load->view('layout/sidebar');
        $this->load->view('admin/edit_alat_v', $data);
    }

    public function hapus_alat($id)
    {
        $this->M_alat->hapus_alat($id);
        redirect('alat/index/alat');
    }

    public function proses_edit_alat()
    {
        $id = $this->input->post('id_alat');
        $data = [
            'nama_alat' => $this->input->post('nama_alat'),
            'id_kategori' => $this->input->post('id_kategori'),
            'stok' => $this->input->post('stok')
        ];

        $this->M_alat->update_alat($id, $data);
        redirect('alat/index/alat');
    }



}