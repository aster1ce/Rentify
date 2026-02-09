<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index() {
        if($this->session->userdata('logged_in')) {
            // Pengalihan dashboard sesuai role baru
            $this->_redirect_by_role($this->session->userdata('role'));
        }
        $this->load->view('auth/login');
    }

    public function proses_login() {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        $cek = $this->db->get_where('users', ['username'=> $user])->row_array();

        if ($cek) {
 
            // 2. Cek Password (disarankan pakai password_hash nanti)
            if ($pass == $cek['password']) {
                $data_session = [
                    'id_user'      => $cek['id_user'],
                    'nama_lengkap' => $cek['nama_lengkap'],
                    'role'         => $cek['role'],
                    'logged_in'    => TRUE
                ];
                $this->session->set_userdata($data_session);

                // 3. Arahkan ke dashboard berdasarkan role baru: admin, petugas, peminjam
                $this->_redirect_by_role($cek['role']);
            } else {
                echo "Password salah!";
            }
        } else {
            echo "Username tidak ditemukan!";
        }
    }

    // Fungsi bantuan biar kodingan tidak duplikat
    private function _redirect_by_role($role) {
        if ($role == 'admin') {
            redirect('admin/dashboard');
        } elseif ($role == 'petugas') {
            redirect('petugas/dashboard');
        } else {
            // Role peminjam (pengganti guru/siswa)
            redirect('peminjam/dashboard');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}