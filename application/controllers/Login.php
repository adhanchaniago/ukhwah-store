<?php
class Login extends CI_Controller{
 
    function __construct(){
        parent::__construct();		
        $this->load->model('m_login');

    }

    function index(){
        $this->load->view('log_in/admin');
    }

    function aksi_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $where_admin = array(
            'username' => $username,
            'password' => $password
        );

        $where_pelanggan = array(
            'username' => $username,
            'password' => $password
        );

        $where_supplier = array(
            'username' => $username,
            'password' => $password
        );

        $cek_admin      = $this->m_login->cek_login("tb_admin",$where_admin)->num_rows();
        $cek_pelanggan  = $this->m_login->cek_login("tb_pelanggan",$where_pelanggan)->num_rows();
        $cek_supplier   = $this->m_login->cek_login("tb_supplier",$where_supplier)->num_rows();

        if ( $cek_admin > 0 ) {
            # code...
            $data_session = array(
                'nama' => $username,
                'status' => "login",
                'level' => 'admin'
            );
        
            $this->session->set_userdata($data_session);
        
            redirect(base_url("admin/beranda"));
        }

        elseif ( $cek_guru > 0 ) {
            # code...
            $data_session = array(
                'nama' => $username,
                'status' => "login",
                'level' => 'guru'
            );
        
            $this->session->set_userdata($data_session);
        
            redirect(base_url("admin/beranda"));
        }

        elseif ( $cek_siswa > 0 ) {
            # code...
            $data_session = array(
                'nama' => $username,
                'status' => "login",
                'level' => 'siswa'
            );
        
            $this->session->set_userdata($data_session);
        
            redirect(base_url("admin/beranda"));
        }

        else{
            // login error
            // redirect(base_url("login-error"));
            $this->load->view('login_error');
        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}