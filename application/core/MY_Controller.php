<?php
class MY_Controller extends CI_Controller{
	function __construct(){
        parent::__construct();
        $this->load->library('cart');
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
    public function render_websites()
    {
        $this->load->model('m_website');
        $this->aside['kategori']= $this->m_website->kategori();
        $this->load->view('website/header');
        $this->load->view('website/nav', (empty($this->aside)? [] : $this->aside ));
        $this->load->view($this->view, (empty($this->content)? [] : $this->content ) );
        $this->load->view('website/footer');
    }
}
    