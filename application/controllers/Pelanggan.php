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

    public function users()
    {
        if ( ! empty($this->session->userdata('pelanggan')) ) {
            # code...
            $this->html=[
                'html'=> '
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> <i class="fa fa-user"></i> | '.$this->session->userdata('pelanggan')['username'].'</button>
                    <ul class="dropdown-menu users-dropdown" style="width:auto">
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
    public function logout(){
        $this->session->unset_userdata('pelanggan');
        redirect(base_url());
    }
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
}
