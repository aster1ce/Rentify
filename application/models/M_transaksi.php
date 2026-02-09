<?php
class M_transaksi extends CI_Model
{

    // Ambil semua alat untuk katalog (Marketplace style)
    public function get_katalog()
    {
        $this->db->select('alat.*, kategori.nama_kategori');
        $this->db->from('alat');
        $this->db->join('kategori', 'alat.id_kategori = kategori.id_kategori', 'left');
        return $this->db->get()->result();
    }

    // Ambil detail satu alat
    public function get_detail_alat($id)
    {
        $this->db->select('alat.*, kategori.nama_kategori');
        $this->db->from('alat');
        $this->db->join('kategori', 'alat.id_kategori = kategori.id_kategori', 'left');
        $this->db->where('alat.id_alat', $id);
        return $this->db->get()->row();
    }

    // Simpan pengajuan pinjam ke 2 tabel (Transaction)
    public function simpan_pengajuan($data_pinjam, $data_detail)
    {
        $this->db->trans_start(); // Mulai transaksi biar aman

        // 1. Insert ke tabel peminjaman
        $this->db->insert('peminjaman', $data_pinjam);
        $id_peminjaman = $this->db->insert_id();

        // 2. Masukkan id_peminjaman ke data detail, lalu insert
        $data_detail['id_pinjam'] = $id_peminjaman;
        $this->db->insert('detail_peminjaman', $data_detail);

        $this->db->trans_complete(); 
        return $this->db->trans_status();
    }

    public function hapus_pengajuan($id_pinjam)
    {
        // Hapus si Fk (Future Knight bjir)
        $this->db->where('id_pinjam', $id_pinjam);
        $this->db->delete('detail_peminjaman');

        // Baru hapus si ini
        $this->db->where('id_pinjam', $id_pinjam);
        return $this->db->delete('peminjaman');
    }

    public function get_riwayat_peminjam($id_user)
    {
        $this->db->select('*');
        $this->db->from('peminjaman');
        // JOIN ke tabel detail_peminjaman (bukan id_detail!)
        $this->db->join('detail_peminjaman', 'peminjaman.id_pinjam = detail_peminjaman.id_pinjam');
        // JOIN ke tabel alat untuk ambil nama barangnya
        $this->db->join('alat', 'detail_peminjaman.id_alat = alat.id_alat');
        $this->db->where('peminjaman.id_user', $id_user);
        $this->db->order_by('peminjaman.id_pinjam', 'DESC');
        return $this->db->get()->result();
    }
}

?>