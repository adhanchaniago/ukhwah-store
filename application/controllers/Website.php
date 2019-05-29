<?php 

class Website extends MY_Controller{

	function __construct(){
		parent::__construct();
	
		$this->load->model('m_website');
    }
    
    public function index()
    {
        $this->view= 'website/home';
        $this->content['produk']= $this->m_website->produk_home();
        $this->render_websites();
    }

    public function profil()
    {
        $this->view= 'website/profil';
        $this->render_websites();
    }
    
    public function kategori()
    {
        $this->content['kategori']= $this->uri->segment(4);
        $this->view= 'website/kategori';
        $this->render_websites();
    }
    
    public function produk()
    {
        $this->view= 'website/produk';
        $this->render_websites();
        
    }
    
    public function produk_detail()
    {
        $this->m_website->get['id_produk']= $this->uri->segment(3);
        $this->content['row']= $this->m_website->produk_detail();
        $this->view= 'website/produk_detail';
        $this->render_websites();
        
    }
    
    public function cara_pemesanan()
    {
        $this->view= 'website/cara_pemesanan';
        $this->render_websites();
    } 
    
    public function kontak_kami()
    {
        $this->view= 'website/kontak_kami';
        $this->render_websites();
    }
}