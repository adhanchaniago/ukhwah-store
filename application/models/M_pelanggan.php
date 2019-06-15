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