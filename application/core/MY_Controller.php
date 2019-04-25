<?php
class MY_Controller extends CI_Controller{
	function __construct(){
		parent::__construct();
    }
    function render_pages()
    {
        switch ($_SESSION['level']) {
            case 'admin':
                $this->load->view('admin/header');
                $this->load->view('admin/nav');
                $this->load->view($this->view, (empty($this->content)? [] : $this->content ) );
                $this->load->view('admin/footer');
                break;
            case 'guru':
                $this->load->view('admin_guru_nav');
                break;
            case 'siswa':
                $this->load->view('admin_siswa_nav');
                break;
                
            default:
                # code...
                break;
        }
    }
}
    