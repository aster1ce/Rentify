<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjam extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Cek login dulu, kalau bukan peminjam tendang ke login
        if ($this->session->userdata('role') != 'peminjam') {
            redirect('auth');
        }
        // Load model transaksi pdidy
        $this->load->model('M_transaksi');
    }

    // Tambahkan ini biar nggak 404 lagi!
    public function dashboard()
    {
        $data['nama'] = $this->session->userdata('nama_lengkap');
        $this->load->view('layout/sidebar');
        $this->load->view('peminjam/dashboard_v', $data); //ROOT BAJIGUHBD
    }

    // Kataluk kukukuk kuk kuk
    public function katalog()
    {
        $data['alat'] = $this->M_transaksi->get_katalog();

        // Panggil view berurutan sesuai pola
        $this->load->view('layout/sidebar');
        $this->load->view('peminjam/katalog', $data);
    }

    // Fungsi nampilin Detail Alat
    public function detail($id)
    {
        $data['item'] = $this->M_transaksi->get_detail_alat($id);

        if (!$data['item']) {
            show_404();
        }

        $this->load->view('layout/sidebar');
        $this->load->view('peminjam/detail_alat', $data);
    }

    // Fungsi Proses Simpan Pinjaman (Yang dipanggil Form)
    public function ajukan_pinjam()
    {
        $data_pinjam = [
            'id_user' => $this->session->userdata('id_user'),
            'tgl_pinjam' => date('Y-m-d'),
            'tgl_kembali' => $this->input->post('tgl_kembali'),
            'status' => 'pending'
        ];

        $data_detail = [
            'id_alat' => $this->input->post('id_alat'),
            'jumlah_pinjam' => $this->input->post('jumlah'),
            'id_pinjam' => null // diisi oleh model'
        ];

        $simpan = $this->M_transaksi->simpan_pengajuan($data_pinjam, $data_detail);

        if ($simpan) {
            $this->session->set_flashdata('pesan', 'Cihuy! Pengajuan berhasil.');
            redirect('peminjam/riwayat');
        }
    }

    public function riwayat()
    {
        $id_user = $this->session->userdata('id_user');

        // Kita panggil data dari model M_transaksi
        $data['riwayat'] = $this->M_transaksi->get_riwayat_peminjam($id_user);

        // Load view-nya
        $this->load->view('layout/sidebar'); // Sidebar biar tetep ada
        $this->load->view('peminjam/riwayat_v', $data);
    }

    public function batal_pinjam($id_pinjam)
    {
        // Panggil model untuk hapus
        $this->M_transaksi->hapus_pengajuan($id_pinjam);

        // Set notifikasi sukses
        $this->session->set_flashdata('pesan', 'Pengajuan berhasil dibatalkan!');

        // Balikin ke halaman riwayat
        redirect('peminjam/riwayat');
    }
}