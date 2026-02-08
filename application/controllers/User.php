<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct() {
    parent::__construct();
    // Kalau BELUM login, lempar ke login
    if (!$this->session->userdata('logged_in')) {
        redirect('auth');
    }
    // Kalau SUDAH login tapi role-nya bukan siswa, lempar ke admin
    if ($this->session->userdata('role') != 'siswa') {
        redirect('admin/dashboard');
    }
}

    public function dashboard() {
        // Ambl data dari session buat dipajang di view
        $data['nama'] = $this->session->userdata('nama_lengkap');
        $this->load->view('../views/layout/sidebar.php');
        $this->load->view('user/dashboard_v', $data);
    }
}

?>
