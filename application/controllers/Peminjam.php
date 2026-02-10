<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjam extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 'peminjam') {
            redirect('auth');
        }
        // Load model transaksi pdidy
        $this->load->model('M_transaksi');
    }

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

    public function riwayat($tab = 'berlangsung')
    {
        $id_user = $this->session->userdata('id_user');
        $data['tab_aktif'] = $tab;

        $this->db->select('peminjaman.*, detail_peminjaman.*, alat.nama_alat');
        $this->db->from('peminjaman');
        $this->db->join('detail_peminjaman', 'peminjaman.id_pinjam = detail_peminjaman.id_pinjam');
        $this->db->join('alat', 'detail_peminjaman.id_alat = alat.id_alat');
        $this->db->where('peminjaman.id_user', $id_user); // Cuma filter berdasarkan User ID
        $this->db->order_by('peminjaman.id_pinjam', 'DESC');

        $data['riwayat'] = $this->db->get()->result();

        $this->load->view('layout/sidebar');
        $this->load->view('peminjam/riwayat_v', $data);
    }
    //proses pengembalian oleh peminjam
    public function kembalikan($id_pinjam)
    {
        // 1. Update status jadi 'pending_kembali' (Menunggu divalidasi Petugas)
        $this->db->where('id_pinjam', $id_pinjam);
        $this->db->update('peminjaman', ['status' => 'menunggu_validasi']);

        $this->session->set_flashdata('pesan', 'Status berhasil diperbarui, tunggu petugas ngecek barang ya!');

        redirect('peminjam/riwayat/berlangsung');
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