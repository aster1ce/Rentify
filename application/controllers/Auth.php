<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index() {
        // Cek dulu udah login belum
        if($this->session->userdata('logged_in')) {
            // Kalau sudah login, arahkan sesuai role-nya masing-masing
            if ($this->session->userdata('role') == 'admin_staff') {
                redirect('admin/dashboard');
            } else {
                redirect('user/dashboard');
            }
        }
        $this->load->view('auth/login');
    }

    public function proses_login() {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        $cek = $this->db->get_where('users', ['username'=> $user])->row_array();

        if ($cek) {
            if ($pass == $cek['password']) {
                $data_session = [
                    'id_user'      => $cek['id_user'],
                    'nama_lengkap' => $cek['nama_lengkap'],
                    'role'         => $cek['role'],
                    'logged_in'    => TRUE
                ];
                $this->session->set_userdata($data_session);

                // Arahkan ke dashboard yang bener saat pertama kali login
                if ($cek['role'] == 'admin_staff') {
                    redirect('admin/dashboard');
                } else {
                    redirect('user/dashboard');
                }
            } else {
                echo "password salah";
            }
        } else {
            echo "username salah";
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}