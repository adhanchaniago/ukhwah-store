<?php 

class Pelanggan extends MY_Controller{

	function __construct(){
		parent::__construct();
	
		// if($this->session->userdata('status') != "login" && $this->session->userdata('level') != "admin"){
		// 	redirect(base_url("login"));
		// }
		$this->load->model('m_pelanggan');
		
		$msg= null;
		$html= null;
		$json= null;
    }
    
    /* ==================== Start Formorm Login ==================== */
    public function login()
    {
        $this->html=[
            'title'=> 'Login',
            'form'=> '
                <form method="POST" action="'.base_url('login-check').'" id="formLogin">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input name="username" type="text" class="form-control" id="username" placeholder="Masukan Username Disini" required="">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input name="password" type="password" class="form-control" id="pwd" placeholder="********" required="">
                </div>
                <!--<div class="checkbox">
                    <label><input type="checkbox"> Remember me</label>
                </div>-->
                <button type="submit" class="btn btn-default">Submit</button>
                </form>
            '
        ];

        echo json_encode($this->html);
    }
    /* ==================== End Form Login ==================== */

    /* ==================== Start Form Daftar ==================== */
    public function daftar()
    {
        $this->html=[
            'title'=> 'Daftar',
            'form'=> '
                <form method="POST" action="'.base_url('register').'" id="formDaftar">
                <div class="form-group">
                    <label for="name">Nama Lengkap:</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Masukan Nama Disini" required="">
                </div>
                <div class="form-group">
                    <label for="address">Alamat:</label>
                    <textarea name="address" class="form-control" rows="5" id="address" placeholder="Masukan Alamat Disini ..." required=""></textarea>
                </div>
                <div class="form-group">
                    <label for="phone">No Telpon:</label>
                    <input name="phone" type="telp" class="form-control" id="phone" placeholder="+628123456789" required="">
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input name="username" type="text" class="form-control" id="username" placeholder="Masukan Username Disini" required="">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input name="password" type="password" class="form-control" id="pwd" placeholder="********" required="">
                </div>
                <!--<div class="checkbox">
                    <label><input type="checkbox"> Remember me</label>
                </div>-->
                <button type="submit" class="btn btn-default">Submit</button>
                </form>
            '
        ];

        echo json_encode($this->html);
    }
    /* ==================== End Form Daftar ==================== */

    /* ==================== Start Cek Login Pelanggan ==================== */
    public function check()
    {
        $this->m_pelanggan->post= $this->input->post();
        if ( $this->m_pelanggan->check()->num_rows() > 0 ) {
            $this->msg= [
                'stats'=>1,
                'msg'=>'Login Success'
            ];
            $row= $this->m_pelanggan->check()->row();
            $data_session = array(
                'id' => $row->id_pelanggan,
                'username' => $row->username,
                'password' => $row->password,
                'nama' => $row->nama,
                'alamat' => $row->alamat,
                'no_handphone' => $row->no_handphone,
                'status' => 1,
                'level' => 'pelanggan'
            );
        
            $this->session->set_userdata(['pelanggan'=>$data_session]);
        } else {
            $this->msg= [
                'stats'=>0,
                'msg'=>'Maaf Username dan Password tidak sesuai mohon periksa kembali'
            ];
            # code...
        }

        echo json_encode($this->msg);
    }
    /* ==================== End Cek Login Pelanggan ==================== */

    /* ==================== Start Navbar Pelanggan ==================== */
    public function users()
    {
        if ( ! empty($this->session->userdata('pelanggan')) ) {
            # code...
            $this->html=[
                'html'=> '
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> <i class="fa fa-user"></i> | '.$this->session->userdata('pelanggan')['username'].'</button>
                    <ul class="dropdown-menu users-dropdown" style="width:auto">
                        <li><a href="'.base_url('setting').'" id="setting" title="Informasi Pengaturan Akun">Pengaturan</a></li>
                        <li><a href="'.base_url('logout').'">Logout</a></li>
                    </ul>
                '
            ];
        } else {
            # code...
            $this->html=[
                'html'=> '
                    <button type="button" class="btn btn-primary btnLogin login" data-toggle="modal" data-target="#myModal">Login</button>
                    <button type="button" class="btn btn-default btnDaftar daftar" data-toggle="modal" data-target="#myModal">Daftar</button>
                '
            ];
        }
        

        echo json_encode($this->html);
    }
    /* ==================== End Navbar Pelanggan ==================== */

    /* ==================== Start Logout Pelanggan ==================== */
    public function logout(){
        $this->session->unset_userdata('pelanggan');
        redirect(base_url());
    }
    /* ==================== End Logout Pelanggan ==================== */

    /* ==================== Start Proses Simpan Pelanggan ==================== */
    public function register()
    {
        $this->m_pelanggan->post= $this->input->post();
        if ( $this->m_pelanggan->register() > 0 ) {
            $this->msg= [
                'stats'=>1,
                'msg'=>'Terimakasih, Pendaftaran Anda Berhasil'
            ];
            $row= $this->m_pelanggan->check()->row();
            $data_session = array(
                'id' => $row->id_pelanggan,
                'username' => $row->username,
                'password' => $row->password,
                'nama' => $row->nama,
                'alamat' => $row->alamat,
                'no_handphone' => $row->no_handphone,
                'status' => 1,
                'level' => 'pelanggan'
            );
        
            $this->session->set_userdata(['pelanggan'=>$data_session]);
        } else {
            $this->msg= [
                'stats'=>0,
                'msg'=>'Maaf Pendaftaran Anda Gagal, Silahkan Coba Lagi'
            ];
            # code...
        }

        echo json_encode($this->msg);

    }
    /* ==================== End Proses Simpan Pelanggan ==================== */

    /* ==================== Start Setting Pelanggan ==================== */
    public function setting()
    {
        // $data_session = array(
        //     'id' => $row->id_pelanggan,
        //     'username' => $row->username,
        //     'password' => $row->password,
        //     'nama' => $row->nama,
        //     'alamat' => $row->alamat,
        //     'no_handphone' => $row->no_handphone,
        //     'status' => 1,
        //     'level' => 'pelanggan'
        // );
        $row_user= $this->session->userdata('pelanggan');
        $alamat= '
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Alamat</th>
                        <th>Alamat</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                ';
                foreach ($this->m_pelanggan->alamat_user() as $key => $value) {
                    $alamat .= '
                        <tr>
                            <td><strong>'.$value->alamat_sebagai.'</strong></td>
                            <td>
                                <strong>'.$value->nama_penerima.'</strong><br>
                                '.$value->alamat_lengkap.'<br>
                                Kota/Kab. '.$value->nama_kota.' Provinsi. '.$value->nama_provinsi.', '.$value->kode_pos.'<br>
                                Indonesia<br>
                                Telepon/Handphone:&nbsp'.$value->no_telepon.' 
                            </td>
                            <td style="display: inline-flex;">
                                '.($value->status==0 ? '<a title="Set Alamat Utama" href="'.base_url('set-alamat/' .$value->id).'" class="btn btn-primary set-primary">Set Utama</a>' : '<a title="Tambah Alamat Baru" href="#" class="btn btn-warning">Alamat Utama</a>').'
                                <a title="Edit Informasi Alamat" href="'.base_url('form-edit-alamat/' .$value->id).'" class="btn btn-default edit">Edit</a>
                                '.($value->status==0 ? '<a title="Hapus Alamat" href="'.base_url('remove-alamat/' .$value->id).'" class="btn btn-default delete">Hapus</a>' : null).'
                            </td>
                        </tr>
                    ';
                }
        $alamat .= '
                </tbody>
            </table>
        </div>
        ';
        $this->html=[
            'html'=> '
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Profil</a></li>
                    <li><a data-toggle="tab" href="#menu1">Alamat</a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Nama Lengkap</td>
                                        <td>:</td>
                                        <td>'.$row_user["nama"].'</td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td>:</td>
                                        <td>'.$row_user["username"].'</td>
                                    </tr>
                                    <tr>
                                        <td>No Telpon</td>
                                        <td>:</td>
                                        <td>'.$row_user["no_handphone"].'</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="buttons">
                            <div class="pull-left"><a title="Ubah Informasi Profil" href="'.base_url('form-edit-user').'" id="formEditUser" class="btn btn-primary">Ubah Profil</a></div>
                        </div>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <div class="buttons">
                            <div class="pull-left"><a title="Tambah Alamat Baru" href="'.base_url('form-add-alamat').'" id="formAddAlamat" class="btn btn-primary">+ Tambah Alamat Baru</a></div>
                        </div>
                        '.$alamat.'
                    </div>
                </div>
            '
        ];   

        echo json_encode($this->html);
    }
    /* ==================== End Setting Pelanggan ==================== */
    
    /* ==================== Start Form Edit Informasi Profil ==================== */
    public function form_edit_user()
    {
        $row_user= $this->session->userdata('pelanggan');
        $this->html=[
            'html'=> '
            <form method="POST" action="'.base_url('update-user').'" id="formUpdateUser">
                <div class="form-group">
                    <label for="name">Nama Lengkap:</label>
                    <input value="'.$row_user["nama"].'" name="name" type="text" class="form-control" id="name" placeholder="Masukan Nama Disini" required="">
                </div>
                <div class="form-group">
                    <label for="phone">No Telpon:</label>
                    <input value="'.$row_user["no_handphone"].'" name="phone" type="telp" class="form-control" id="phone" placeholder="+628123456789" required="">
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input value="'.$row_user["username"].'" readonly name="username" type="text" class="form-control" id="username" placeholder="Masukan Username Disini">
                </div>
                <div class="form-group">
                    <label for="pwd">Password: <span class="badge">Jika Password Tidak Diganti Dikosongkan Saja</span></label>
                    <input name="password" type="password" class="form-control" id="pwd" placeholder="********">
                </div>
                <!--<div class="checkbox">
                    <label><input type="checkbox"> Remember me</label>
                </div>-->
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        '];

        echo json_encode($this->html);
    }
    /* ==================== End Form Edit Informasi Profil ==================== */

    /* ==================== Start Proses Update Informasi Profil ==================== */
    public function update_user()
    {
        $this->m_pelanggan->post= $this->input->post();
        if ( $this->m_pelanggan->update_user() ) {
            # code...
            $row= $this->m_pelanggan->row_user();
            $data_session = array(
                'id' => $row->id_pelanggan,
                'username' => $row->username,
                'password' => $row->password,
                'nama' => $row->nama,
                'alamat' => $row->alamat,
                'no_handphone' => $row->no_handphone,
                'status' => 1,
                'level' => 'pelanggan'
            );
        
            $this->session->set_userdata(['pelanggan'=>$data_session]);

            $this->msg= [
                'stats'=>1,
                'msg'=>'Informasi Profil Anda Telah Berhasil Diubah'
            ];
        } else {
            # code...
            $this->msg= [
                'stats'=>0,
                'msg'=>'Informasi Profil Anda Gagal Diubah'
            ];
        }
        
        echo json_encode($this->msg);
    }
    /* ==================== End Proses Update Informasi Profil ==================== */

    /* ==================== Start Form Add New Alamat ==================== */
    public function form_add_alamat()
    {
        $row_user= $this->session->userdata('pelanggan');
        $this->html=[
            'html'=> '
            <form method="POST" action="'.base_url('store-alamat').'" id="formStoreAlamat">
                <div class="form-group">
                    <label>Alamat Sebagai:</label>
                    <input name="address_by" type="text" class="form-control" placeholder="Contoh: Kantor, Kos, Rumah, dll" required="">
                </div>
                <div class="form-group">
                    <label>Nama Penerima:</label>
                    <input name="name" type="text" class="form-control" placeholder="Isi Nama Lengkap" required="">
                </div>
                <div class="form-group">
                    <label>No. Telepon:</label>
                    <input max="15" name="phone" type="telp" class="form-control" placeholder="Contoh : 08123456789" required="">
                </div>
                <div class="form-group">
                    <label>Pilih Provinsi</label>
                    <select name="provinsi" id="selProvinsi" class="form-control" data-provinsi="" required>
                        <option value="" selected disabled> -- Pilih Provinsi -- </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pilih Kota</label>
                    <select name="kota" id="selKota" class="form-control" data-kota="" data-biaya="" required>
                        <option value="" selected disabled> -- Pilih Kota -- </option>
                        <option value="" disabled> Maaf Anda Belum Memilih Provinsi </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kode Pos:</label>
                    <input name="postcode" type="number" class="form-control" placeholder="Isi Kode Pos" required="">
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap:</label>
                    <textarea name="fulladdress" class="form-control" rows="5" placeholder="Isi nama jalan, nomor rumah, nama gedung, dsb" required=""></textarea>
                </div>
                <!--<div class="checkbox">
                    <label><input type="checkbox"> Remember me</label>
                </div>-->
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        '];

        echo json_encode($this->html);
    }
    /* ==================== End Form Add New Alamat ==================== */

    /* ==================== Start Proses Simpan Alamat ==================== */
    public function store_alamat()
    {
        $this->m_pelanggan->post= $this->input->post();
        if ( $this->m_pelanggan->store_alamat() ) {
            # code...
            $this->msg= [
                'stats'=>1,
                'msg'=>'Alamat Baru Berhasil Ditambahkan'
            ];
        } else {
            # code...
            $this->msg= [
                'stats'=>0,
                'msg'=>'Alamat Baru Gagal Ditambahkan'
            ];
        }
        
        echo json_encode($this->msg);
    }
    /* ==================== End Proses Simpan Alamat ==================== */

    /* ==================== Start Proses Hapus Alamat ==================== */
    public function remove_alamat()
    {
        if ( $this->m_pelanggan->remove_alamat( $this->uri->segment(2) ) ) {
            # code...
            $this->msg= [
                'stats'=>1,
                'msg'=>'Alamat Berhasil Dihapus'
            ];
        } else {
            # code...
            $this->msg= [
                'stats'=>0,
                'msg'=>'Alamat Gagal Dihapus'
            ];
        }
        
        echo json_encode($this->msg);
    }
    /* ==================== End Proses Hapus Alamat ==================== */

    /* ==================== Start Proses Set Utama Alamat ==================== */
    public function set_alamat()
    {
        if ( $this->m_pelanggan->set_alamat( $this->uri->segment(2) ) ) {
            # code...
            $this->msg= [
                'stats'=>1,
                'msg'=>'Alamat Utama Berhasil Diubah'
            ];
        } else {
            # code...
            $this->msg= [
                'stats'=>0,
                'msg'=>'Alamat Utama Gagal Diubah'
            ];
        }
        
        echo json_encode($this->msg);
    }
    /* ==================== End Proses Set Utama Alamat ==================== */

    /* ==================== Start Form Add New Alamat ==================== */
    public function form_edit_alamat()
    {
        $row= $this->m_pelanggan->get_one_alamat( $this->uri->segment(2) );
        $this->html=[
            'html'=> '
            <form method="POST" action="'.base_url('update-alamat/' .$row->id).'" id="formUpdateAlamat">
                <div class="form-group">
                    <label>Alamat Sebagai:</label>
                    <input value="'.$row->alamat_sebagai.'" name="address_by" type="text" class="form-control" placeholder="Contoh: Kantor, Kos, Rumah, dll" required="">
                </div>
                <div class="form-group">
                    <label>Nama Penerima:</label>
                    <input value="'.$row->nama_penerima.'" name="name" type="text" class="form-control" placeholder="Isi Nama Lengkap" required="">
                </div>
                <div class="form-group">
                    <label>No. Telepon:</label>
                    <input value="'.$row->no_telepon.'" max="15" name="phone" type="telp" class="form-control" placeholder="Contoh : 08123456789" required="">
                </div>
                <div class="form-group">
                    <label>Pilih Provinsi</label>
                    <select name="provinsi" id="selProvinsi" class="form-control" data-provinsi="'.$row->id_provinsi.'" required>
                        <option value="" selected disabled> -- Pilih Provinsi -- </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pilih Kota</label>
                    <select name="kota" id="selKota" class="form-control" data-kota="'.$row->id_kota.'" required>
                        <option value="" selected disabled> -- Pilih Kota -- </option>
                        <option value="" disabled> Maaf Anda Belum Memilih Provinsi </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kode Pos:</label>
                    <input value="'.$row->kode_pos.'" name="postcode" type="number" class="form-control" placeholder="Isi Kode Pos" required="">
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap:</label>
                    <textarea name="fulladdress" class="form-control" rows="5" placeholder="Isi nama jalan, nomor rumah, nama gedung, dsb" required="">'.$row->alamat_lengkap.'</textarea>
                </div>
                <!--<div class="checkbox">
                    <label><input type="checkbox"> Remember me</label>
                </div>-->
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        '];

        echo json_encode($this->html);
    }
    /* ==================== End Form Add New Alamat ==================== */

    /* ==================== Start Proses Update Alamat ==================== */
    public function update_alamat()
    {
        $this->m_pelanggan->post= $this->input->post();
        if ( $this->m_pelanggan->update_alamat( $this->uri->segment(2) ) ) {
            # code...
            $this->msg= [
                'stats'=>1,
                'msg'=>'Alamat Baru Berhasil Diubah'
            ];
        } else {
            # code...
            $this->msg= [
                'stats'=>0,
                'msg'=>'Alamat Baru Gagal Diubah'
            ];
        }
        
        echo json_encode($this->msg);
    }
    /* ==================== End Proses Update Alamat ==================== */
}
