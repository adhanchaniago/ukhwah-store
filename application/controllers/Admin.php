<?php 

class Admin extends MY_Controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login" && $this->session->userdata('level') != "admin"){
			redirect(base_url("login"));
		}
		$this->load->model('m_admin');
		
		$msg= null;
		$html= null;
		$json= null;
	}

/* ==================== Start Beranda ==================== */
	function beranda(){
		$this->view= 'admin/beranda';
		$this->render_pages();
	}
/* ==================== End Beranda ==================== */

/* ==================== Start Transaksi: Pemesanan Produk ==================== */
	function data_pemesanan_produk()
	{
		$this->view= 'admin/pemesanan_produk';
		$this->render_pages();
	}
/* ==================== End Transaksi: Pemesanan Produk ==================== *
/
/* ==================== Start Transaksi: Konfirmasi Pembayaran ==================== */
	function data_konfirmasi_pembayaran()
	{
		$this->view= 'admin/konfirmasi_pembayaran';
		$this->render_pages();
	}
/* ==================== End Transaksi: Konfirmasi Pembayaran ==================== */

/* ==================== Start Master Data: Admin ==================== */
	function data_admin()
	{
		$this->view= 'admin/admin';
		$this->content['rows']= $this->m_admin->data_admin();
		$this->render_pages();
	}
	public function form_data_admin()
	{
		$this->html= '
        <form action="'.base_url().'admin/store-data-admin" role="form" id="add" method="post" enctype="multipart/form-data">
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
	public function form_data_admin_edit()
	{
		$this->m_admin->post['id_admin']= $this->uri->segment(3);
		$row= $this->m_admin->edit_data_admin();
		
		$this->html= '
        <form action="'.base_url().'admin/update-data-admin" role="form" id="edit" method="post" enctype="multipart/form-data">
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
	public function store_data_admin()
	{
		$this->m_admin->post= $this->input->post();
		if ( $this->m_admin->cek_user() > 0 ) {
			$this->msg= [
				"stats" => 0,
				"msg" 	=> 'Maaf User Sudah Digunakan'
			];
		} else {
			if ( $this->m_admin->store_data_admin() ) {
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
	public function update_data_admin()
	{
		$this->m_admin->post= $this->input->post();
		if ( $this->m_admin->cek_user_update() > 0 ) {
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
	public function delete_data_admin()
	{

	} 
/* ==================== End Master Data: Admin ==================== */

/* ==================== Start Master Data: Supplier ==================== */	
/* ==================== End Master Data: Supplier ==================== */	

	// data_supplier controller
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
		echo json_encode($this->msg);
	} 
	// data_supplier controller

	// data_kategori controller
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
		echo json_encode($this->msg);
		
	}
	// data_kategori controller

	// data_produk controller
	function data_produk()
	{
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
					<div class="input-group-append">
						<span class="input-group-text" id="">Per 1 Pcs</span>
					</div>
					<div class="custom-file">
						<input name="berat" type="number" min="1" class="form-control" placeholder="*) Ex: 100000" required="">
					</div>
					<div class="input-group-append">
						<span class="input-group-text" id="">Per 1 Pcs</span>
					</div>
				</div>
			</div>
			<div class="form-group">
                <label>Stok</label>
                <input name="stok" type="number" min="1" class="form-control" placeholder="*) Ex: 10" required="">
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
                <label>Keterangan</label>
                <textarea id="mytextarea" name="deskripsi" class="form-control">'.$row->deskripsi.'</textarea>
			</div>
			<div class="form-group">
                <label>Harga</label>
                <input value="'.$row->harga.'" name="harga" type="number" min="1" class="form-control" placeholder="*) Ex: 100000" required="">
            </div>
			<div class="form-group">
                <label>Stok</label>
                <input value="'.$row->stok.'" name="stok" type="number" min="1" class="form-control" placeholder="*) Ex: 10" required="">
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
	// data_produk controller

	// data_pelanggan controller
	function data_pelanggan()
	{
		
		$this->view= 'admin/pelanggan';
		$this->render_pages();
	}
	// data_pelanggan controller

	// data_ongkir controller
	function data_ongkir()
	{
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
				<input name="biaya" type="number" min="1" class="form-control" placeholder="*) masukan biaya" required="">
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
				<input value="'.$row->biaya.'" name="biaya" type="number" min="1" class="form-control" placeholder="*) masukan biaya" required="">
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
	// data_ongkir controller
	
}