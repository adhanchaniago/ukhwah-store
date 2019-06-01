<?php 

class Website extends MY_Controller{

	function __construct(){
		parent::__construct();
	
		$this->load->model('m_website');
    }
    
    public function index()
    {
        $this->load->helper('currency');
        $this->view= 'website/home';
        $this->content['produk']= $this->m_website->produk_home();
        $this->render_websites();
    }

    public function profil()
    {
        $this->view= 'website/profil';
        $this->render_websites();
    }
/* ==================== Start Kategori Produk ==================== */
    public function kategori()
    {
        if ( ! empty( $this->input->get('short') ) ) {
            $this->m_website->get['short']= $this->input->get('short');
        }
        $this->load->helper(['currency','text']);
        $this->m_website->get['id_kategori']= $this->input->get('q');
        $this->content['kategori']= $this->m_website->nama_kategori();
        $this->content['id_kategori']= $this->input->get('q');
        $this->content['rows']= $this->m_website->produk_by_kategori();
        $this->view= 'website/kategori';
        $this->render_websites();
    }
/* ==================== End Kategori Produk ==================== */
    
/* ==================== End Produk ==================== */
    public function produk()
    {
        if ( ! empty( $this->input->get('short') ) ) {
            $this->m_website->get['short']= $this->input->get('short');
        }
        $this->load->helper(['currency','text']);
        $this->content['rows']= $this->m_website->produk();
        $this->view= 'website/produk';
        $this->render_websites();
        
    }
    public function produk_detail()
    {
        $this->load->helper(['currency']);
        $this->m_website->get['id_produk']= $this->uri->segment(3);
        $this->content['row']= $this->m_website->produk_detail();
        $this->view= 'website/produk_detail';
        $this->render_websites();
        
    }
/* ==================== End Produk ==================== */
    
    
    
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

/* ==================== Start Cart / Keranjang Belanja ==================== */
    public function view_cart()
    {
        $this->load->helper('currency');
        $this->load->library('cart');
        $this->content['rows']= $this->cart->contents();
        $this->view= 'website/view_cart';
        $this->render_websites();
    }
    public function checkout()
    {
        $this->view= 'website/checkout';
        $this->render_websites();
    }
/* ==================== End Cart / Keranjang Belanja ==================== */
}