<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

   public function __construct() {
    parent::__construct();
    if (!$this->session->userdata('logged_in')) {
        redirect('auth');
    }
    // Kalau SUDAH login tapi role-nya bukan admin, lempar ke user
    if ($this->session->userdata('role') != 'admin_staff') {
        redirect('user/dashboard');
    }
}

    public function dashboard() {
        // Data untuk ditampilkan di dashboard
        $data['nama'] = $this->session->userdata('nama_lengkap');
        $this->load->view('../views/layout/sidebar.php');
        $this->load->view('admin/dashboard_v', $data);
 
    }

    
}