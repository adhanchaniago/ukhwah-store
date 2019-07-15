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

/* ==================== Start Laporan: Pembelian Produk ==================== */
	public function pembelian_produk(){
		$this->load->helper('dates');
		$this->content['rows']= $this->m_pemilik->pembelian_produk();
		$this->view= 'pemilik/pembelian_produk';
		$this->render_pages();
	}
	public function detail_pembelian(){
		$this->load->helper(['currency','dates']);
		$this->m_pemilik->post['id_pemesanan']= $this->uri->segment(3);
		$this->m_pemilik->post['status']= $this->uri->segment(4);
		$pemesanan= $this->m_pemilik->konfirmasi_pembayaran();
		$this->html= '
	<div id="DivIdToPrint">
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
				foreach ($this->m_pemilik->detail_pemesanan() as $key => $value) {
					$this->html .= '
					<tr>
						<td><img class="img-size-64" src="'.base_url('src/produk/128/' .$value->gambar).'"></td>
						<td>'.$value->nama_produk.(empty($value->ukuran) ? null : '<br><b>Ukuran : ' .$value->ukuran .'</b>').'</td>
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
						<td class="text-right" colspan="6"><strong>Biaya Kirim '.($pemesanan->kurir).':</strong></td>
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
		</div>
	</div>
		';
		echo $this->html;
	}
	public function print_laporan_pembelian_produk()
	{
		$this->m_pemilik->post= $this->input->post();
		$data=[];
		$no= 1;
		foreach ($this->m_pemilik->print_pembelian() as $key => $value) {
			$items= $this->m_pemilik->print_pembelian_items($value->id_pemesanan);
			$value->no= $no;
			$value->items= $items;
			$value->items_count= count($items);
			$data[]= $value;
			$no++;
		}
		$this->load->helper(['currency','dates']);
		$this->load->view('pemilik/print_pembelian',[
			'rows'=> $data,
			'start'=> tgl_indo($this->input->post('start')),
			'end'=> tgl_indo($this->input->post('end')),
		]);
	}
	public function print_detail_pembelian()
	{
		$this->load->helper(['currency','dates']);
		$this->m_pemilik->post['id_pemesanan']= $this->uri->segment(3);
		$this->m_pemilik->post['status']= $this->uri->segment(4);
		$pemesanan= $this->m_pemilik->konfirmasi_pembayaran();
		$this->load->view('pemilik/print_detail_pembelian',['pemesanan'=>$pemesanan]);
	}
/* ==================== End Laporan: Pembelian Produk ==================== */
}
