<?php
class Petugas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // panggil model
        $this->load->model('M_validasi');
        $this->load->model('M_riwayat');
    }

    // Lier pake index jadinya ke root dashboard wehla
    public function dashboard()
    {
        $data['total_pending'] = $this->db->get_where('peminjaman', ['status' => 'pending'])->num_rows();
        $data['total_alat'] = $this->db->get('alat')->num_rows();
        $data['total_pinjam'] = $this->db->get_where('peminjaman', ['status' => 'disetujui'])->num_rows();

        $this->load->view('layout/sidebar');
        $this->load->view('petugas/dashboard_v', $data);
    }

    public function validasi($tab = 'peminjaman')
    {
        $data['tab_aktif'] = $tab;
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

        // Update status peminjaman jadi 'selesai'
        $this->db->where('id_pinjam', $id_pinjam);
        $this->db->update('peminjaman', ['status' => 'selesai', 'tgl_kembali' => date('Y-m-d')]);

        redirect('petugas/validasi');
    }

    public function setujui($id_pinjam)
    {

        // update status 
        $this->db->where('id_pinjam', $id_pinjam);
        $this->db->update('peminjaman', ['status' => 'approved']);

        // get detail alat dulu bosqu
        $detail = $this->db->get_where('detail_peminjaman', ['id_pinjam' => $id_pinjam])->row();

        // kurangin stoknya
        $this->db->set('stok', 'stok - ' . $detail->jumlah_pinjam, false);
        $this->db->where('id_alat', $detail->id_alat);
        $this->db->update('alat');

        // redirect balik
        redirect('petugas/validasi');
    }

    public function tolak($id_pinjam)
    {
        $this->db->where('id_pinjam', $id_pinjam);
        $this->db->update('peminjaman', ['status' => 'rejected']);
        redirect('petugas/validasi');
    }

    public function riwayat($tab = 'berjalan')
    {

        $data['tab_aktif'] = $tab;
        $data['riwayat'] = $this->M_riwayat->get_semua_riwayat();

        $this->load->view('layout/sidebar');
        $this->load->view('petugas/riwayat_v', $data);

    }


}