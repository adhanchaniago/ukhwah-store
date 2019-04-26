<?php 

class Admin extends MY_Controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->model('M_admin');
	}

	// beranda controller
	function beranda(){
		switch ($_SESSION['level']) {
			case 'admin':
				# beranda admin
				$this->view= 'admin/beranda';
				$this->render_pages();
				break;
			
			case 'guru':
				# beranda guru
				$this->view= 'admin_guru_beranda';
				$this->render_pages();
				break;

			case 'siswa':
				# beranda siswa
				$this->view= 'admin_siswa_beranda';
				$this->render_pages();
				break;
			
			default:
				# code...
				break;
		}
	}
	// beranda controller

	// profil:administrator,guru,siswa controller
	function profil(){
		switch ($_SESSION['level']) {
			case 'admin':
				# profil admin
				$this->view= 'admin_profil';
				$this->render_pages();
				break;
			
			case 'guru':
				# profil guru
				$this->view= 'admin_guru_profil';
				$this->render_pages();
				break;

			case 'siswa':
				# profil siswa
				$this->view= 'admin_siswa_profil';
				$this->render_pages();
				break;
			
			default:
				# code...
				break;
		}
	}
	// profil:administrator,guru,siswa controller

	// data_pemesanan_produk controller
	function data_pemesanan_produk()
	{
		switch ($_SESSION['level']) {
			case 'admin':
				# code...
				$this->view= 'admin/pemesanan_produk';
				$this->render_pages();
				break;
			
			default:
				# code...
				break;
		}
	}
	// data_pemesanan_produk controller

	// data_konfirmasi_pembayaran controller
	function data_konfirmasi_pembayaran()
	{
		switch ($_SESSION['level']) {
			case 'admin':
				# code...
				$this->view= 'admin/konfirmasi_pembayaran';
				$this->render_pages();
				break;
			
			default:
				# code...
				break;
		}
	}
	// data_konfirmasi_pembayaran controller

	// data_admin controller
	function data_admin()
	{
		switch ($_SESSION['level']) {
			case 'admin':
				# code...
				$this->view= 'admin/admin';
				$this->render_pages();
				break;
			
			default:
				# code...
				break;
		}
	}
	// data_admin controller

	// data_supplier controller
	function data_supplier()
	{
		switch ($_SESSION['level']) {
			case 'admin':
				# code...
				$this->view= 'admin/supplier';
				$this->render_pages();
				break;
			
			default:
				# code...
				break;
		}
	}
	// data_supplier controller

	// data_kategori controller
	function data_kategori()
	{
		switch ($_SESSION['level']) {
			case 'admin':
				# code...
				$this->view= 'admin/kategori';
				$this->content['kategori']= $this->M_admin->data_kategori();
				$this->render_pages();
				break;
			
			default:
				# code...
				break;
		}
	}

	function add_data_kategori()
	{
		$msg= "";
		$this->M_admin->post= $_POST;
		if ( $this->M_admin->add_data_kategori() ) {
			$msg= "1";
		} else {
			$msg= "0";
		}
		
		echo json_encode($msg);
	}

	function edit_data_kategori()
	{
		$this->M_admin->id_kategori= $this->uri->segment(3);
		$row= $this->M_admin->edit_data_kategori()[0];
		echo '
			<form action="'.base_url().'admin/update-data-kategori" role="form" id="editKategori" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id_kategori" value="'.$row->id_kategori.'">	
				<div class="form-group">
					<label for="inputKategoriProduk">Nama Kategori Produk</label>
					<input value="'.$row->kategori.'" name="kategori" type="text" class="form-control" id="inputKategoriProduk" placeholder="*) Nama Kategori Produk Baru" required="">
				</div>
				<button type="submit" class="btn btn-primary">Publish</button>
			</form>
		';

	}

	function update_data_kategori(){
		$msg= "";
		$this->M_admin->post= $this->input->post();
		if ( $this->M_admin->update_data_kategori() ) {
			$msg= "1";
		} else {
			$msg= "0";
		}
		echo json_encode($msg);
		
	}

	function delete_data_kategori()
	{
		$msg= "";
		$this->M_admin->id_kategori= $this->uri->segment(3);
		if ( $this->M_admin->delete_data_kategori() ) {
			$msg= "1";
		} else {
			$msg= "0";
		}
		
		echo json_encode($msg);
		
	}
	// data_kategori controller

	// data_produk controller
	function data_produk()
	{
		switch ($_SESSION['level']) {
			case 'admin':
				# code...
				$this->view= 'admin/produk';
				$this->render_pages();
				break;
			
			default:
				# code...
				break;
		}
	}
	// data_produk controller

	// data_pelanggan controller
	function data_pelanggan()
	{
		switch ($_SESSION['level']) {
			case 'admin':
				# code...
				$this->view= 'admin/pelanggan';
				$this->render_pages();
				break;
			
			default:
				# code...
				break;
		}
	}
	// data_pelanggan controller

	// data_ongkir controller
	function data_ongkir()
	{
		switch ($_SESSION['level']) {
			case 'admin':
				# code...
				$this->view= 'admin/ongkir';
				$this->render_pages();
				break;
			
			default:
				# code...
				break;
		}
	}
	// data_ongkir controller
	
}