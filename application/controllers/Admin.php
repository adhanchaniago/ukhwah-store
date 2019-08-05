<?php 

class Admin extends MY_Controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login" && $this->session->userdata('level') != "admin"){
			redirect(base_url("auth"));
		}
		$this->load->model('m_admin');
		
		$msg= null;
		$html= null;
		$json= null;
	}

/* ==================== Start Beranda ==================== */
	function beranda(){
		$this->content['total_konfirmasi_pembayaran']= count($this->m_admin->konfirmasi_pembayaran());
		$this->content['total_pelanggan']= count($this->m_admin->data_pelanggan());
		$this->view= 'admin/beranda';
		$this->render_pages();
	}
/* ==================== End Beranda ==================== */

/* ==================== Start Transaksi: Pembelian Produk ==================== */
	function data_pemesanan_produk()
	{
		$this->load->helper('dates');
		$this->content['rows']= $this->m_admin->pembelian_produk();
		$this->view= 'admin/pembelian_produk';
		$this->render_pages();
	}
	public function form_no_resi()
	{
		$this->html= '
        <form action="'.base_url().'admin/update-no-resi" role="form" id="updateNoResi" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>No Resi:</label>
				<input value="" name="no_resi" type="text" class="form-control" placeholder="*) Masukan no resi disini" required="">
			</div>
			<input value="'.$this->uri->segment(3).'" name="id_pemesanan" type="hidden">
            <button type="submit" class="btn btn-primary">Publish</button>
        </form>
        ';
        echo $this->html;
	}
	public function update_no_resi()
	{
		$this->m_admin->post= $this->input->post();
		if ( $this->m_admin->update_no_resi() ) {
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
		echo json_encode($this->msg);
	}
	
/* ==================== End Transaksi: Pemesanan Produk ==================== */

/* ==================== Start Transaksi: Pembelian Pending ==================== */
	function data_pembelian_pending()
	{
		$this->load->helper('dates');
		$this->content['rows']= $this->m_admin->pembelian_pending();
		$this->view= 'admin/pembelian_pending';
		$this->render_pages();
	}
/* ==================== End Transaksi: Pembelian Pending ==================== */

/* ==================== Start Transaksi: Konfirmasi Pembayaran ==================== */
	function data_konfirmasi_pembayaran()
	{
		$this->load->helper('dates');
		$this->content['rows']= $this->m_admin->konfirmasi_pembayaran();
		$this->view= 'admin/konfirmasi_pembayaran';
		$this->render_pages();
	}
	function detail_konfirmasi_pembayaran()
	{
		$this->load->helper(['currency','dates']);
		$this->m_admin->post['id_pemesanan']= $this->uri->segment(3);
		$this->m_admin->post['status']= $this->uri->segment(4);
		$pemesanan= $this->m_admin->konfirmasi_pembayaran();
		$this->html= '
		<div class="row">
			<div class="col-12">
				<h4>
					<i class="fa fa-globe"></i> Ukhwah Store.
					<small class="float-right">Tanggal: '.tgl_indo($pemesanan->tanggal).'</small>
				</h4>
			</div>
			<!-- /.col -->
		</div>
		<div class="row invoice-info">
			<div class="col-sm-4 invoice-col">
			Pelanggan :
			<address>
				<strong class="text-capitalize">Nama: '.$pemesanan->nama.'</strong><br>
				<strong class="text-capitalize">Telpon: '.$pemesanan->no_handphone.'</strong><br>

			</address>
			</div>
			<!-- /.col -->
			<div class="col-sm-4 invoice-col">
			Alamat Pengiriman :
			<address>
				<strong>'.$pemesanan->alamat_pengiriman.'</strong><br>
			</address>
			</div>
			<!-- /.col -->
			<div class="col-sm-4 invoice-col">
			<b>Invoice #US'.$pemesanan->id_pemesanan.'</b>
			<br>
			<br>
			Catatan :
			<address>
				<strong>'.($pemesanan->komentar_pesanan==''? 'Tidak Ada Catatan' : $pemesanan->komentar_pesanan ).'</strong><br>
			</address>
			</div>
			<!-- /.col -->
		</div>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Gambar</th>
						<th>Nama Produk</th>
						<th>Kategori</th>
						<th>Jumlah</th>
						<th>Berat(Gram)</th>
						<th>Harga</th>
						<th>Sub-Total</th>
					</tr>
				</thead>
				<tbody>';
				$total= 0;
				$total_berat= 0;
				foreach ($this->m_admin->detail_pemesanan() as $key => $value) {
					$this->html .= '
					<tr>
						<td><img class="img-size-64" src="'.base_url('src/produk/128/' .$value->gambar).'"></td>
						<td>'.$value->nama_produk.(empty($value->ukuran)? null : '<br><b>Ukuran : '.$value->ukuran.'<b>' ).'</td>
						<td>'.$value->kategori.'</td>
						<td>'.$value->jumlah.'</td>
						<td>'.( ($value->jumlah*$value->berat) ).'</td>
						<td>'.idr($value->harga).'</td>
						<td>'.idr( ($value->jumlah*$value->harga) ).'</td>
					</tr>
					';
					$total += ($value->jumlah*$value->harga);
					$total_berat += ceil( ($value->jumlah*$value->berat) /1000 );
				}
				
				$this->html .='
				</tbody>
				<tfoot>
					<tr>
						<td class="text-right" colspan="6"><strong>Total:</strong></td>
						<td class="text-right total">'.idr($total).'</td>
					</tr>
					<tr>
						<td class="text-right" colspan="6"><strong>Kode Unik:</strong></td>
						<td class="text-right kode-unik">'.$pemesanan->kode_unik.'</td>
					</tr>
					<tr>
						<td class="text-right" colspan="6"><strong>Biaya Kirim '.$pemesanan->kurir.':</strong></td>
						<td class="text-right biaya-kirim" data-biaya="0" data-weight="1210">'.idr($pemesanan->biaya_ongkir).'</td>
					</tr>
					<tr>
						<td class="text-right" colspan="6"><strong>Total Pembayaran:</strong></td>
						<td class="text-right total-pembayaran">'.idr( $total +$pemesanan->kode_unik +($pemesanan->biaya_ongkir) ).'</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="row">
			<div class="col-sm-12 text-center">
				<label>Bukti Pembayaran</label>
				<img class="img-thumbnail" src="'.base_url('src/bukti_pembayaran/768/' .$pemesanan->bukti_pembayaran).'">
			</div>
		</div>
		<hr>
		<div>
			<a id="konfirmasi" href="'.base_url('admin/konfirmasi-pemesanan/' .$pemesanan->id_pemesanan).'" class="btn btn-block btn-primary '.($this->uri->segment(4)=='true'? 'd-none' : null ).'">Konfirmasi Pembayaran</a>
			<hr>
			<a id="konfirmasi" href="'.base_url('admin/konfirmasi-pemesanan/' .$pemesanan->id_pemesanan .'/?q=2').'" class="btn btn-block btn-warning '.($this->uri->segment(4)=='true'? 'd-none' : null ).'">Pembayaran Tidak Sesuai</a>
		</div>
		';
		echo $this->html;
		
		// echo '<pre>';
		// print_r($this->m_admin->detail_pemesanan());
		// print_r($pemesanan);
		// print_r($this->m_admin);
		// echo '</pre>';
	}
	public function konfirmasi_pemesanan()
	{
		$this->m_admin->post['id_pemesanan']= $this->uri->segment(3);
		
		if( !empty($this->input->get('q')) )
			$this->m_admin->post['q']= $this->input->get('q');

		if ( $this->m_admin->konfirmasi_pemesanan() ) {
			# code...
			$this->msg= [
				"stats" => 1,
				"msg" 	=> 'Konfirmasi Pembayaran Berhasil'
			];
		} else {
			# code...
			$this->msg= [
				"stats" => 0,
				"msg" 	=> 'Konfirmasi Pembayaran Gagal'
			];
		}
		echo json_encode($this->msg);
	}
/* ==================== End Transaksi: Konfirmasi Pembayaran ==================== */

/* ==================== Start Data Admin ==================== */
	public function form_data_admin_edit()
	{
		$this->m_admin->post['id_admin']= $this->uri->segment(3);
		$row= $this->m_admin->edit_data_admin();
		
		$this->html= '
        <form action="'.base_url().'admin/update-data-admin" role="form" id="edit-admin" method="post" enctype="multipart/form-data">
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
	public function update_data_admin()
	{
		$this->m_admin->post= $this->input->post();
		if ( $this->m_admin->cek_user() > 0 ) {
			$this->msg= [
				"stats" => 0,
				"msg" 	=> 'Maaf User Sudah Digunakan'
			];
		} else {
			if ( $this->m_admin->update_data_admin() ) {
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
/* ==================== End Data Admin ==================== */

/* ==================== Start Master Data: Supplier ==================== */
	function data_supplier()
	{
		$this->content['rows']= $this->m_admin->data_supplier();
		$this->view= 'admin/supplier';
		$this->render_pages();
	}
	public function form_data_supplier()
	{
		$this->html= '
        <form action="'.base_url().'admin/store-data-supplier" role="form" id="add" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama</label>
				<input name="nama" type="text" class="form-control" placeholder="*) masukan nama supplier" required="">
			</div>
			<div class="form-group">
				<label>No Telpon</label>
				<input name="no_telp" type="telp" class="form-control" placeholder="*) ex : 08123456789" required="">
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<textarea name="alamat" class="form-control" rows="3" placeholder="masukan alamat disini ..." required=""></textarea>
			</div>
            <button type="submit" class="btn btn-primary">Publish</button>
        </form>
        ';
		echo $this->html;
	}
	public function edit_form_data_supplier()
	{
		$this->m_admin->post['id_supplier']= $this->uri->segment(3);
		$row= $this->m_admin->edit_data_supplier();
		
		$this->html= '
        <form action="'.base_url().'admin/update-data-supplier" role="form" id="edit" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama</label>
				<input value="'.$row->nama.'" name="nama" type="text" class="form-control" placeholder="*) masukan nama admin" required="">
			</div>
			<div class="form-group">
				<label>No Telpon</label>
				<input value="'.$row->no_telp.'" name="no_telp" type="telp" class="form-control" placeholder="*) ex : 08123456789" required="">
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<textarea name="alamat" class="form-control" rows="3" placeholder="masukan alamat disini ..." required="">'.$row->alamat.'</textarea>
			</div>
			<input value="'.$row->id_supplier.'" name="id_supplier" type="hidden">
            <button type="submit" class="btn btn-primary">Publish</button>
        </form>
        ';
        echo $this->html;
	}
	public function store_data_supplier()
	{
		$this->m_admin->post= $this->input->post();
		if ( $this->m_admin->store_data_supplier() ) {
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
		echo json_encode($this->msg);
		
	}
	public function update_data_supplier()
	{
		$this->m_admin->post= $this->input->post();
		if ( $this->m_admin->update_data_supplier() ) {
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
		echo json_encode($this->msg);
	}
	public function delete_data_supplier()
	{
		$this->m_admin->post['id_supplier']= $this->uri->segment(3);
		if ( $this->m_admin->cek_supplier() > 0 ) {
			$this->msg= [
				"stats" => 0,
				"msg" 	=> 'Maaf Nama Supplier Sedang Digunakan'
			];
		} else {
			if ( $this->m_admin->delete_data_supplier() ) {
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

		}
		echo json_encode($this->msg);
	} 
/* ==================== End Master Data: Supplier ==================== */

/* ==================== Start Master Data : Kategori Produk ==================== */
	function data_kategori()
	{
		$this->view= 'admin/kategori';
		$this->content['kategori']= $this->m_admin->data_kategori();
		$this->render_pages();
	}

	public function form_add_kategori()
	{
		$this->html= '
		<form action="'.base_url().'admin/add-data-kategori" role="form" id="add" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="inputKategoriProduk">Nama Kategori Produk</label>
				<input name="kategori" type="text" class="form-control" id="inputKategoriProduk" placeholder="*) Nama Kategori Produk Baru" required="">
			</div>
			<button type="submit" class="btn btn-primary">Publish</button>
		</form>
		';
		echo $this->html;
	}

	function add_data_kategori()
	{
		$this->m_admin->post= $this->input->post();
		if ( $this->m_admin->add_data_kategori() ) {
			$this->msg= [
				'stats'=>1,
				'msg'=> 'Data Berhasil Ditambahkan'
			];
		} else {
			$this->msg= [
				'stats'=>1,
				'msg'=> 'Data Gagal Ditambahkan'
			];
		}
		
		echo json_encode($this->msg);
	}

	function edit_data_kategori()
	{
		$this->m_admin->post['id_kategori']= $this->uri->segment(3);
		$row= $this->m_admin->edit_data_kategori()[0];
		echo '
			<form action="'.base_url().'admin/update-data-kategori" role="form" id="edit" method="post" enctype="multipart/form-data">
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
		$this->m_admin->post= $this->input->post();
		if ( $this->m_admin->update_data_kategori() ) {
			$this->msg= [
				'stats'=>1,
				'msg'=> 'Data Berhasil Diubah'
			];
		} else {
			$this->msg= [
				'stats'=>1,
				'msg'=> 'Data Gagal Diubah'
			];
		}
		echo json_encode($this->msg);
		
	}

	function delete_data_kategori()
	{
		$this->m_admin->post['id_kategori']= $this->uri->segment(3);
		if ( $this->m_admin->cek_data_kategori() > 0 ) {
			$this->msg= [
				"stats" => 0,
				"msg" 	=> 'Maaf Nama Kategori Sedang Digunakan'
			];
		} else {
			if ( $this->m_admin->delete_data_kategori() ) {
				$this->msg= [
					'stats'=>1,
					'msg'=> 'Data Berhasil Diubah'
				];
			} else {
				$this->msg= [
					'stats'=>1,
					'msg'=> 'Data Gagal Diubah'
				];
			}

		}
		echo json_encode($this->msg);
		
	}
/* ==================== End Master Data : Kategori Produk ==================== */

/* ==================== Start Master Data : Produk ==================== */
	function data_produk()
	{
		$this->load->helper('currency');
		$this->view= 'admin/produk';
		$this->content['rows']= $this->m_admin->produk();
		$this->render_pages();
	}
	public function add_produk()
	{
		$this->kategori= "";
		foreach ($this->m_admin->data_kategori() as $key => $value) {
			$this->kategori .= "<option value='{$value->id_kategori}'>{$value->kategori}</option>";
		}
		$this->supplier= "";
		foreach ($this->m_admin->data_supplier() as $key => $value) {
			$this->supplier .= "<option value='{$value->id_supplier}'>{$value->nama}</option>";
		}
		$this->ukuran= "";
		$ukuran= ['S','M','L','XL'];
		foreach ($ukuran as $key => $value) {
			$this->ukuran .= '
				<div class="form-check-inline">
					<label class="form-check-label">
						<input name="ukuran[]" type="checkbox" class="form-check-input" value="'.$value.'">'.$value.'
					</label>
				</div>
			'; 
		}
		$this->html= '
        <form action="'.base_url().'admin/store-produk" role="form" id="add" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Produk</label>
                <input name="nama_produk" type="text" class="form-control" placeholder="*) Masukan Nama" required="">
            </div>
            <div class="form-group">
                <label>Nama Kategori</label>
				<select name="id_kategori" class="form-control" required="">
					<option value="" selected disabled> -- Pilih Kategori Produk -- </option>
					'.$this->kategori.'
				</select>
            </div>
            <div class="form-group">
                <label>Nama Supplier</label>
				<select name="id_supplier" class="form-control" required="">
					<option value="" selected disabled> -- Pilih Supplier -- </option>
					'.$this->supplier.'
				</select>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea id="mytextarea" name="deskripsi" class="form-control"></textarea>
			</div>
			<div class="form-group">
                <label>Harga</label>
                <input name="harga" type="number" min="1" class="form-control" placeholder="*) Ex: 100000" required="">
			</div>
			<div class="form-group">
				<label>Berat Produk</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="">Per 1 Pcs</span>
					</div>
					<input name="berat" type="number" min="1" class="form-control" placeholder="*) Ex: 500" required="">
					<div class="input-group-append">
						<span class="input-group-text" id="">Gram</span>
					</div>
				</div>
			</div>
			<div class="form-group">
                <label>Stok</label>
                <input name="stok" type="number" min="1" class="form-control" placeholder="*) Ex: 10" required="">
            </div>
			<div class="form-group">
				<label>Pilih Ukuran</label><br>
				'.$this->ukuran.'				
			</div>
            <div class="form-group">
                <label>Upload Foto <small class="badge badge-info">*) type: JPG atau PNG</small></label>
                <input name="fupload" type="file" class="form-control"  required="">
            </div>
            <button type="submit" class="btn btn-primary">Publish</button>
        </form>
        ';
        echo $this->html;
	}
	public function edit_produk()
	{
		$this->m_admin->post['id_produk']= $this->uri->segment(3);
		$row= $this->m_admin->edit_produk();
		$this->kategori= "";
		foreach ($this->m_admin->data_kategori() as $key => $value) {
			$this->kategori .= "<option ".($row->id_kategori==$value->id_kategori? 'selected' : null)." value='{$value->id_kategori}'>{$value->kategori}</option>";
		}
		$this->supplier= "";
		foreach ($this->m_admin->data_supplier() as $key => $value) {
			$this->supplier .= "<option ".($row->id_supplier==$value->id_supplier? 'selected' : null)." value='{$value->id_supplier}'>{$value->nama}</option>";
		}
		$this->ukuran= "";
		$ukuran= ['S','M','L','XL'];
		$ukuran_berbeda= []; #default
		if ( isset($row->ukuran) ) { # if column not null 
			$ukuran_berbeda= json_decode($row->ukuran);	
		}
		
		foreach ($ukuran as $key => $value) {
			if ( in_array($value ,$ukuran_berbeda) ) {
				$this->ukuran .= '
					<div class="form-check-inline">
						<label class="form-check-label">
							<input checked name="ukuran[]" type="checkbox" class="form-check-input" value="'.$value.'">'.$value.'
						</label>
					</div>
				'; 
			}else{
				$this->ukuran .= '
					<div class="form-check-inline">
						<label class="form-check-label">
							<input name="ukuran[]" type="checkbox" class="form-check-input" value="'.$value.'">'.$value.'
						</label>
					</div>
				'; 
			}		
			
		}
		$this->html= '
        <form action="'.base_url().'admin/update-produk" role="form" id="add" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Produk</label>
                <input value="'.$row->nama_produk.'" name="nama_produk" type="text" class="form-control" placeholder="*) Masukan Nama" required="">
            </div>
            <div class="form-group">
                <label>Nama Kategori</label>
				<select name="id_kategori" class="form-control" required="">
					<option value="" disabled> -- Pilih Kategori Produk -- </option>
					'.$this->kategori.'
				</select>
            </div>
            <div class="form-group">
                <label>Nama Supplier</label>
				<select name="id_supplier" class="form-control" required="">
					<option value="" disabled> -- Pilih Nama Suppplier -- </option>
					'.$this->supplier.'
				</select>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea id="mytextarea" name="deskripsi" class="form-control">'.$row->deskripsi.'</textarea>
			</div>
			<div class="form-group">
                <label>Harga</label>
                <input value="'.$row->harga.'" name="harga" type="number" min="1" class="form-control" placeholder="*) Ex: 100000" required="">
			</div>
			<div class="form-group">
				<label>Berat Produk</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="">Per 1 Pcs</span>
					</div>
					<input value="'.$row->berat.'" name="berat" type="number" min="1" class="form-control" placeholder="*) Ex: 500" required="">
					<div class="input-group-append">
						<span class="input-group-text" id="">Gram</span>
					</div>
				</div>
			</div>
			<div class="form-group">
                <label>Stok</label>
                <input value="'.$row->stok.'" name="stok" type="number" min="1" class="form-control" placeholder="*) Ex: 10" required="">
			</div>
			<div class="form-group">
				<label>Pilih Ukuran</label><br>
				'.$this->ukuran.'				
			</div>
            <div class="form-group">
                <label>Foto</label>
                <img class="d-block img-thumbnail" src="'.base_url('./src/produk/320/'.$row->gambar).'">
            </div>
            <div class="form-group">
                <label>Ganti Foto <small class="badge badge-info">*) type: JPG atau PNG</small></label>
                <input name="fupload" type="file" class="form-control">
            </div>
			<input value="'.$row->id_produk.'" name="id_produk" type="hidden">
            <button type="submit" class="btn btn-primary">Publish</button>
        </form>
        ';
        echo $this->html;
	}
	public function store_produk()
	{
		$this->m_admin->post= $this->input->post();
		$this->m_admin->post['ukuran_json']= empty($this->input->post('ukuran')) ? null : json_encode($this->input->post('ukuran'));
        if ( empty($_FILES['fupload']['tmp_name']) ) {
            # code...without upload file
            if ( $this->m_admin->store_produk() ) {
                $this->msg= [
                    'stats'=>1,
                    'msg'=> 'Data Berhasil Ditambahkan'
                ];
            } else {
                $this->msg= [
                    'stats'=>1,
                    'msg'=> 'Data Gagal Ditambahkan'
                ];
            }
        } else {
            # code...with upload file
            $config['upload_path']          = './src/produk/';
            $config['allowed_types']        = 'jpg|png';

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('fupload'))
            {
                $this->msg= [
                    'stats'=>0,
                    'msg'=> $this->upload->display_errors(),
                ];
            }
            else
            {
                $this->m_admin->post['gambar']= $this->upload->data()['file_name'];

                /* start image resize */
                $this->load->helper('img');
                $this->load->library('image_lib');
                $sizes = [768,320,128];
                foreach ($sizes as $size) {
                    $this->image_lib->clear();
                    $this->image_lib->initialize( resize($size, $config['upload_path'], $this->m_admin->post['gambar']) );
                    $this->image_lib->resize();
                }
                /* end image resize */

                if ( $this->m_admin->store_produk() ) {
                    $this->msg= [
                        'stats'=>1,
                        'msg'=> 'Data Berhasil Ditambahkan',
                    ];
                    
                } else {
                    $this->msg= [
                        'stats'=>0,
                        'msg'=> 'Maaf Data Gagal Ditambahkan',
                    ];
                }
                
            }
        }
        echo json_encode($this->msg);
	}
	public function update_produk()
	{
		$this->m_admin->post= $this->input->post();
		$this->m_admin->post['ukuran_json']= empty($this->input->post('ukuran')) ? null : json_encode($this->input->post('ukuran'));
        if ( empty($_FILES['fupload']['tmp_name']) ) {
            # code...without upload file
            if ( $this->m_admin->update_produk() ) {
                $this->msg= [
                    'stats'=>1,
                    'msg'=> 'Data Berhasil Diubah'
                ];
            } else {
                $this->msg= [
                    'stats'=>1,
                    'msg'=> 'Data Gagal Diubah'
                ];
            }
        } else {
            # code...with upload file
            $row= $this->m_admin->edit_produk();
            $config['upload_path']          = './src/produk/';
            $config['allowed_types']        = 'jpg|png';

            /* start unlink file */
            if ( file_exists($config['upload_path'].$row->gambar) )
                unlink($config['upload_path'].$row->gambar);
            
            $sizes= [768,320,128];
            foreach ($sizes as $size) {
                if ( file_exists($config['upload_path'] .$size .'/' .$row->gambar) )
                    unlink($config['upload_path'] .$size .'/' .$row->gambar);
            }
            /* end unlink file */

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('fupload'))
            {
                $this->msg= [
                    'stats'=>0,
                    'msg'=> $this->upload->display_errors(),
                ];
            }
            else
            {
                $this->m_admin->post['gambar']= $this->upload->data()['file_name'];

                /* start image resize */
                $this->load->helper('img');
                $this->load->library('image_lib');
                foreach ($sizes as $size) {
                    $this->image_lib->clear();
                    $this->image_lib->initialize( resize($size, $config['upload_path'], $this->m_admin->post['gambar']) );
                    $this->image_lib->resize();
                }
                /* end image resize */

                if ( $this->m_admin->update_produk() ) {
                    $this->msg= [
                        'stats'=>1,
                        'msg'=> 'Data Berhasil Diubah',
                    ];
                    
                } else {
                    $this->msg= [
                        'stats'=>0,
                        'msg'=> 'Maaf Data Gagal Diubah',
                    ];
                }
                
            }
        }
        echo json_encode($this->msg);   
	}
	public function delete_produk()
	{
		$this->m_admin->post['id_produk']= $this->uri->segment(3);
        $row= $this->m_admin->edit_produk();
        $config['upload_path']          = './src/produk/';

        /* start unlink file */
        if ( file_exists($config['upload_path'].$row->gambar) )
            unlink($config['upload_path'].$row->gambar);
    
        $sizes= [1024,768,320,128];
        foreach ($sizes as $size) {
            if ( file_exists($config['upload_path'] .$size .'/' .$row->gambar) )
                unlink($config['upload_path'] .$size .'/' .$row->gambar);
        }
        /* end unlink file */
        
        if ( $this->m_admin->delete_produk() ) {
            $this->msg= [
                'stats'=>1,
                'msg'=> 'Data Berhasil Dihapus',
            ];
        } else {
            $this->msg= [
                'stats'=>0,
                'msg'=> 'Data Gagal Dihapus',
            ];
        }
        echo json_encode($this->msg);
	}
/* ==================== End Master Data : Produk ==================== */

/* ==================== Start Master Data : Ongkir ==================== */
	function data_ongkir()
	{
		$this->load->helper('currency');
		$this->content['rows']= $this->m_admin->data_ongkir();
		$this->view= 'admin/ongkir';
		$this->render_pages();
	}
	public function form_data_ongkir()
	{
		$this->html= '
        <form action="'.base_url().'admin/store-data-ongkir" role="form" id="add" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Provinsi</label>
				<input name="provinsi" type="text" class="form-control" placeholder="*) masukan provinsi" required="">
			</div>
			<div class="form-group">
				<label>Kabupaten</label>
				<input name="kabupaten" type="text" class="form-control" placeholder="*) masukan kabupaten" required="">
			</div>
			<div class="form-group">
				<label>Kota</label>
				<input name="kota" type="text" class="form-control" placeholder="*) masukan kota" required="">
			</div>
			<div class="form-group">
				<label>Biaya</label>
				<div class="input-group mb-3">
					<input name="biaya" type="number" min="10000" class="form-control" placeholder="*) masukan biaya" required="">
					<div class="input-group-append">
						<span class="input-group-text">Per Kilo Gram</span>
					</div>
				</div>
			</div>
            <button type="submit" class="btn btn-primary">Publish</button>
        </form>
        ';
		echo $this->html;
	}
	public function form_data_ongkir_edit()
	{
		$this->m_admin->post['id_ongkir']= $this->uri->segment(3);
		$row= $this->m_admin->edit_data_ongkir();
		$this->html= '
        <form action="'.base_url().'admin/update-data-ongkir" role="form" id="edit" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Provinsi</label>
				<input value="'.$row->provinsi.'" name="provinsi" type="text" class="form-control" placeholder="*) masukan provinsi" required="">
			</div>
			<div class="form-group">
				<label>Kabupaten</label>
				<input value="'.$row->kabupaten.'" name="kabupaten" type="text" class="form-control" placeholder="*) masukan kabupaten" required="">
			</div>
			<div class="form-group">
				<label>Kota</label>
				<input value="'.$row->kota.'" name="kota" type="text" class="form-control" placeholder="*) masukan kota" required="">
			</div>
			<div class="form-group">
				<label>Biaya</label>
				<div class="input-group mb-3">
					<input value="'.$row->biaya.'" name="biaya" type="number" min="10000" class="form-control" placeholder="*) masukan biaya" required="">
					<div class="input-group-append">
						<span class="input-group-text">Per Kilo Gram</span>
					</div>
				</div>
			</div>
			<input value="'.$row->id_ongkir.'" name="id_ongkir" type="hidden">
            <button type="submit" class="btn btn-primary">Publish</button>
        </form>
        ';
		echo $this->html;
	}
	public function store_data_ongkir()
	{
		$this->m_admin->post= $this->input->post();
		if ( $this->m_admin->store_data_ongkir() ) {
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
		echo json_encode($this->msg);
		
	}
	public function update_data_ongkir()
	{
		$this->m_admin->post= $this->input->post();
		if ( $this->m_admin->update_data_ongkir() ) {
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
		echo json_encode($this->msg);
	}
	public function delete_data_ongkir()
	{
		$this->m_admin->post['id_ongkir']= $this->uri->segment(3);
		if ( $this->m_admin->delete_data_ongkir() ) {
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
/* ==================== End Master Data : Ongkir ==================== */

/* ==================== Start Master Data : Pelanggan ==================== */
	function data_pelanggan()
	{
		$this->content['rows']= $this->m_admin->data_pelanggan();
		$this->view= 'admin/pelanggan';
		$this->render_pages();
	}
/* ==================== End Master Data : Pelanggan ==================== */	
}