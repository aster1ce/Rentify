<?php
class M_alat extends CI_Model
{

    // Fungsi buat ngambil semua data kategori pas nambah alat
    public function get_kategori()
    {
        return $this->db->get('kategori')->result_array();
    }
    
    // buat simpan data alat ke database
    public function insert_alat($data)
    {
        return $this->db->insert('alat', $data);
    }

    public function insert_kategori($data)
    {
        return $this->db->insert('kategori', $data);
    }


// Amvil data
    public function get_semua_kategori()
    {
        return $this->db->get('kategori')->result_array();
    }

    public function get_semua_alat()
    {
        // JOINN
        $this->db->select('alat.*, kategori.nama_kategori');
        $this->db->from('alat');
        $this->db->join('kategori', 'kategori.id_kategori = alat.id_kategori');
        return $this->db->get()->result_array();
    }

    // ========== Update, Delete Kategori ========== //
    public function get_kategori_by_id($id) {
        return $this->db->get_where('kategori', ['id_kategori' => $id])->row_array();
    }

    public function update_kategori($id, $data) {
        $this->db->where('id_kategori', $id);
        return $this->db->update('kategori', $data);
    }

    public function hapus_kategori($id) {
        $this->db->where('id_kategori', $id);
        return $this->db->delete('kategori');
    }

    // ========== Update, Delete Alat ========== //
    public function get_alat_by_id($id) {
        return $this->db->get_where('alat', ['id_alat' => $id])->row_array();
    }

    public function update_alat($id, $data) {
        $this->db->where('id_alat', $id);
        return $this->db->update('alat', $data);
    }

    public function hapus_alat($id) {
        $this->db->where('id_alat', $id);
        return $this->db->delete('alat');
    }
}
?>