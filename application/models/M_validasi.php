<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_validasi extends CI_Model
{

    public function get_semua_transaksi()
    {
        
        $this->db->select('peminjaman.*, detail_peminjaman.*, alat.*, users.nama_lengkap');
        $this->db->from('peminjaman');
        $this->db->join('detail_peminjaman', 'peminjaman.id_pinjam = detail_peminjaman.id_pinjam');
        $this->db->join('alat', 'detail_peminjaman.id_alat = alat.id_alat');
        $this->db->join('users', 'peminjaman.id_user = users.id_user'); 

        $this->db->order_by('peminjaman.id_pinjam', 'DESC');
        return $this->db->get()->result();
    }
}

?>