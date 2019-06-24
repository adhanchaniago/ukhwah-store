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

/* ==================== Start Data Admin ==================== */
	function admin()	
	{	
		$this->view= 'pemilik/admin';	
		$this->content['rows']= $this->m_pemilik->data_admin();	
		$this->render_pages();	
	}	
	public function form_edit_admin()
	{
		$this->m_pemilik->post['id_admin']= $this->uri->segment(3);
		$row= $this->m_pemilik->edit_data_admin();
		
		$this->html= '
		<form action="'.base_url().'pemilik/update-admin" role="form" id="edit" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama</label>
				<input value="'.$row->nama.'" name="nama" type="text" class="form-control" placeholder="*) masukan nama admin" required="">
			</div>
			<div class="form-group">
				<label>No Telpon</label>
				<input value="'.$row->no_handphone.'" name="no_handphone" type="telp" class="form-control" placeholder="*) ex : 08123456789" required="">
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<textarea name="alamat" class="form-control" rows="3" placeholder="masukan alamat disini ..." required="">'.$row->alamat.'</textarea>
			</div>
			<div class="form-group">
				<label>Username</label>
				<input value="'.$row->username.'" name="username" type="text" class="form-control" placeholder="Masukan Username" required="">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input name="password" type="password" class="form-control" placeholder="*******">
			</div>
			<input value="'.$row->id_admin.'" name="id_admin" type="hidden">
			<button type="submit" class="btn btn-primary">Publish</button>
		</form>
		';
		echo $this->html;
	}
	public function form_add_admin()	
	{	
		$this->html= '	
        <form action="'.base_url().'pemilik/store-admin" role="form" id="add" method="post" enctype="multipart/form-data">	
			<div class="form-group">	
				<label>Nama</label>	
				<input name="nama" type="text" class="form-control" placeholder="*) masukan nama admin" required="">	
			</div>	
			<div class="form-group">	
				<label>No Telpon</label>	
				<input name="no_handphone" type="telp" class="form-control" placeholder="*) ex : 08123456789" required="">	
			</div>	
			<div class="form-group">	
				<label>Alamat</label>	
				<textarea name="alamat" class="form-control" rows="3" placeholder="masukan alamat disini ..." required=""></textarea>	
			</div>	
			<div class="form-group">	
				<label>Username</label>	
				<input name="username" type="text" class="form-control" placeholder="Masukan Username" required="">	
			</div>	
			<div class="form-group">	
				<label>Password</label>	
				<input name="password" type="password" class="form-control" placeholder="*******" required="">	
			</div>	
            <button type="submit" class="btn btn-primary">Publish</button>	
        </form>	
        ';	
		echo $this->html;	
	}
	public function store_admin()	
	{	
		$this->m_pemilik->post= $this->input->post();	
		if ( $this->m_pemilik->cek_user() > 0 ) {	
			$this->msg= [	
				"stats" => 0,	
				"msg" 	=> 'Maaf User Sudah Digunakan'	
			];	
		} else {	
			if ( $this->m_pemilik->store_data_admin() ) {	
				$this->msg= [	
					"stats" => 1,	
					"msg" 	=> 'Data Berhasil Disimpan'	
				];	
			} else {	
				$this->msg= [	
					"stats" => 0,	
					"msg" 	=> 'Data Gagal Disimpan'	
				];	
			}	
				
		}	
		echo json_encode($this->msg);	
			
	}
	public function update_admin()
	{
		$this->m_pemilik->post= $this->input->post();
		if ( $this->m_pemilik->cek_user() > 0 ) {
			$this->msg= [
				"stats" => 0,
				"msg" 	=> 'Maaf User Sudah Digunakan'
			];
		} else {
			if ( $this->m_pemilik->update_data_admin() ) {
				$this->msg= [
					"stats" => 1,
					"msg" 	=> 'Data Berhasil Diupdate'
				];
			} else {
				$this->msg= [
					"stats" => 0,
					"msg" 	=> 'Data Gagal Diupdate'
				];
			}
			
		}
		echo json_encode($this->msg);
	}
    public function delete_data_admin()
	{	
		$this->m_pemilik->post['id_admin']= $this->uri->segment(3);	
		if ( $this->m_pemilik->delete_data_admin() ) {	
			$this->msg= [	
				"stats" => 1,	
				"msg" 	=> 'Data Berhasil Dihapus'	
			];	
		} else {	
			$this->msg= [	
				"stats" => 0,	
				"msg" 	=> 'Data Gagal Dihapus'	
			];	
		}	
		echo json_encode($this->msg);	
	} 
/* ==================== End Data Admin ==================== */
}
