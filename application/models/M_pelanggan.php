<?php 

class M_pelanggan extends CI_Model{
    public $post= null;	
	public function check(){
        $where= [
            'username'=>$this->post['username'],
            'password'=>$this->post['password']
        ];		
		return $this->db->get_where('tb_pelanggan',$where);
    }
    public function register()
    {
        $data=[
            'username'=>$this->post['username'],
            'password'=>$this->post['password'],
            'nama'=>$this->post['name'],
            'alamat'=>$this->post['address'],
            'no_handphone'=>$this->post['phone'],
        ];
        return $this->db->insert('tb_pelanggan',$data);
    }
    # update tb pelanggan
    public function update_user()
    {
        $data=[
            'nama'=>$this->post['name'],
            'no_handphone'=>$this->post['phone'],
        ];
        if ( ! empty( $this->post['password'] ) ) {
            $data['password']= $this->post['password'];
        }
        return $this->db->update('tb_pelanggan',$data,['id_pelanggan'=> $this->session->userdata('pelanggan')['id'] ]);
    }
    public function row_user()
    {
        return $this->db->get_where('tb_pelanggan',['id_pelanggan'=> $this->session->userdata('pelanggan')['id'] ])->row();
    }
    public function alamat_user()
    {
        return $this->db->get_where('tb_alamat',['id_pelanggan'=> $this->session->userdata('pelanggan')['id'] ])->result_object();
    }

    # store tb alamat
    public function store_alamat()
    {
        $data=[
            'id_pelanggan'=>$this->session->userdata('pelanggan')["id"],
            'id_provinsi'=>$this->post['provinsi'],
            'id_kota'=>$this->post['kota'],
            'alamat_sebagai'=>$this->post['address_by'],
            'nama_penerima'=>$this->post['name'],
            'no_telepon'=>$this->post['phone'],
            'kode_pos'=>$this->post['postcode'],
            'alamat_lengkap'=>$this->post['fulladdress'],
        ];
        return $this->db->insert('tb_alamat',$data);
    }

    # store tb pemesanan
    public function store_pemesanan()
    {
        $data= [
            'tanggal'=> date('Y-m-d'),
            'id_pelanggan'=> $this->post['id_pelanggan'],
            'kode_unik'=> $this->post['kode_unik'],
            'biaya_ongkir'=> $this->post['biaya_ongkir'],
            'komentar_pesanan'=> $this->post['comments'],
            'alamat_pengiriman'=> "{$this->post['full_address']} ({$this->post['kota']},{$this->post['kabupaten']},{$this->post['provinsi']})",
        ];
        $this->db->insert('tb_pemesanan',$data);
        return $this->db->insert_id();
    }

    # store tb konfirmasi
    public function store_konfirmasi()
    {
        $data= [
            'id_pemesanan'=> $this->post['id_pemesanan'],
            'tanggal'=> date('Y-m-d'),
            'bukti_pembayaran'=> $this->post['gambar'],
            'status'=> '0',
        ];
        return $this->db->insert('tb_konfirmasi',$data);
    }

    # store tb det pemesanan
    public function store_det_pemesanan()
    {   
        $data= [];
        foreach ($this->cart->contents() as $key => $value) {
            $data[]= [
                'id_pemesanan'=> $this->post['id_pemesanan'],
                'nama_produk'=> $value['name'],
                'kategori'=> $value['options']['category'],
                'harga'=> $value['price'],
                'berat'=> $value['options']['weight'],
                'gambar'=> $value['options']['image'],
                'jumlah'=> $value['qty'],
            ];
        }
        return $this->db->insert_batch('det_pemesanan', $data);
        // return $data;
    }
    
    # update stok produk
    public function update_stok_produk()
    {
        $data=[];
        foreach ($this->cart->contents() as $key => $value) {
            $this->db->set('stok', 'stok -' .$value['qty'], FALSE);
            $this->db->where('id_produk', $value['id']);
            $data[]= [
                'id'=> $value['id'],
                'stats'=> $this->db->update('tb_produk'),
            ];
        }
        return $data;
    }
}