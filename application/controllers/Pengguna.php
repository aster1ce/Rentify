<?php
class Pengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in') || $this->session->userdata('is_admin') != '1 ') {
            redirect('auth');
        }
        $this->load->model('M_user');
    }

    public function index($role = 'semua'){

        $data['tab_aktif'] = $role;
        $data['nama'] = $this->session->userdata('nama_lengkap');
        $data['users'] = $this->M_user->get_users_by_role($role);

    }


}


?>