<?php
class Petugas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Pakai nama model yang kamu mau tadi
        $this->load->model('M_validasi');
    }

    // Gunakan fungsi index sebagai Dashboard utama
    public function dashboard()
    {
        $data['total_pending'] = $this->db->get_where('peminjaman', ['status' => 'pending'])->num_rows();
        $data['total_alat'] = $this->db->get('alat')->num_rows();
        $data['total_pinjam'] = $this->db->get_where('peminjaman', ['status' => 'disetujui'])->num_rows();

        $this->load->view('layout/sidebar');
        $this->load->view('petugas/dashboard_v', $data);
    }

    // Fungsi validasi yang pakai TAB tadi
    public function validasi($tab = 'peminjaman')
    {
        $data['tab_aktif'] = $tab; // Buat nandain tombol mana yang ijo
        $data['transaksi'] = $this->M_validasi->get_semua_transaksi();

        $this->load->view('layout/sidebar');
        $this->load->view('petugas/validasi_v', $data);
    }

    public function kembali($id_pinjam)
    {
        // 1. Ambil detail buat tahu alat mana dan berapa jumlahnya
        $detail = $this->db->get_where('detail_peminjaman', ['id_pinjam' => $id_pinjam])->row();

        // 2. Kembalikan stok ke tabel alat
        $this->db->set('stok', 'stok + ' . $detail->jumlah_pinjam, FALSE);
        $this->db->where('id_alat', $detail->id_alat);
        $this->db->update('alat');

        // 3. Update status peminjaman jadi 'selesai'
        $this->db->where('id_pinjam', $id_pinjam);
        $this->db->update('peminjaman', ['status' => 'selesai', 'tgl_kembali' => date('Y-m-d')]);

        redirect('petugas/validasi');
    }


}