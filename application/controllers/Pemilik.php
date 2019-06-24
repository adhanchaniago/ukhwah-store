<?php 

class Pemilik extends MY_Controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login" && $this->session->userdata('level') != "pemilik"){
			redirect(base_url("login"));
		}
		$this->load->model('m_pemilik');
		
		$msg= null;
		$html= null;
		$json= null;
	}

/* ==================== Start Beranda ==================== */
	function beranda(){
		$this->content['total_konfirmasi_pembayaran']= count($this->m_pemilik->konfirmasi_pembayaran());
		$this->content['total_pelanggan']= count($this->m_pemilik->data_pelanggan());
		$this->view= 'pemilik/beranda';
		$this->render_pages();
	}
/* ==================== End Beranda ==================== */
}