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
            // 'alamat'=>$this->post['address'],
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
    # mendapatkan alamat user aktif
    public function alamat_user_aktif()
    {
        $this->db->select('*');
        $this->db->from('tb_alamat');
        $this->db->where([
            'id_pelanggan'=> $this->session->userdata('pelanggan')['id'],
            'status'=> 1 
        ]);
        return $this->db->get()->row();
    }
    # get satu alamat
    public function get_one_alamat($id)
    {
        return $this->db->get_where('tb_alamat',['id'=> $id ])->row();
    }
    # store tb alamat
    public function store_alamat()
    {
        $data=[
            'id_pelanggan'=>$this->session->userdata('pelanggan')["id"],
            'id_provinsi'=>$this->post['provinsi'],
            'nama_provinsi'=>$this->post['nama_provinsi'],
            'id_kota'=>$this->post['kota'],
            'nama_kota'=>$this->post['nama_kota'],
            'alamat_sebagai'=>$this->post['address_by'],
            'nama_penerima'=>$this->post['name'],
            'no_telepon'=>$this->post['phone'],
            'kode_pos'=>$this->post['postcode'],
            'alamat_lengkap'=>$this->post['fulladdress'],
            'status'=>0
        ];
        return $this->db->insert('tb_alamat',$data);
    }
    # update tb alamat
    public function update_alamat($id)
    {
        $data=[
            'id_provinsi'=>$this->post['provinsi'],
            'nama_provinsi'=>$this->post['nama_provinsi'],
            'id_kota'=>$this->post['kota'],
            'nama_kota'=>$this->post['nama_kota'],
            'alamat_sebagai'=>$this->post['address_by'],
            'nama_penerima'=>$this->post['name'],
            'no_telepon'=>$this->post['phone'],
            'kode_pos'=>$this->post['postcode'],
            'alamat_lengkap'=>$this->post['fulladdress'],
        ];
        return $this->db->update('tb_alamat',$data,['id'=>$id]);
    }

    # remove tb alamat
    public function remove_alamat($id)
    {
        return $this->db->delete('tb_alamat',['id'=>$id]);
    }

    # set tb alamat
    public function set_alamat($id)
    {
        $this->db->update('tb_alamat',['status'=>1],['id'=>$id]);

        $this->db->where('id !=', $id);
        $this->db->update('tb_alamat',['status'=>0]);
        return 1;
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
            'kurir'=> $this->post['kurir'],
            'alamat_pengiriman'=> $this->post['alamat_pengiriman'],
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
                'ukuran'=> (!empty($value['options']['size'])? $value['options']['size'] : NULL ),
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

    # mendapatkan transaksi user
    public function transaction()
    {
        if ( empty($this->post['id_pemesanan']) ) {
            # code...
            return $this->db->query("
                SELECT *,
                    tb_pemesanan.tanggal AS tanggal_pemesanan
                FROM tb_pemesanan
                    INNER JOIN tb_konfirmasi
                        ON tb_pemesanan.id_pemesanan=tb_konfirmasi.id_pemesanan
                WHERE 1=1
                    AND tb_pemesanan.id_pelanggan='".$this->session->userdata('pelanggan')['id']."'
                    ORDER BY tb_pemesanan.tanggal DESC
            ")->result_object();
        } else {
            return $this->db->query("
                SELECT *,
                    tb_pemesanan.tanggal AS tanggal_pemesanan
                FROM tb_pemesanan
                    INNER JOIN tb_konfirmasi
                        ON tb_pemesanan.id_pemesanan=tb_konfirmasi.id_pemesanan
                    INNER JOIN tb_pelanggan
                        ON tb_pemesanan.id_pelanggan=tb_pelanggan.id_pelanggan
                WHERE 1=1
                    AND tb_pemesanan.id_pelanggan='".$this->session->userdata('pelanggan')['id']."'
                    AND tb_pemesanan.id_pemesanan='{$this->post["id_pemesanan"]}'
                    ORDER BY tb_pemesanan.tanggal DESC
            ")->row();
            # code...
        }
        
    }
    public function detail_pemesanan()
	{
		if( empty($this->post['id_pemesanan']) ){
			return 'id_pemesanan tidak boleh kosong';
			
		}else {
			return $this->db->query("
			SELECT * FROM det_pemesanan
				LEFT JOIN tb_pemesanan
					ON det_pemesanan.id_pemesanan=tb_pemesanan.id_pemesanan
			WHERE tb_pemesanan.id_pemesanan ={$this->post["id_pemesanan"]}
			ORDER BY det_pemesanan.id_det_pemesanan DESC
			")->result_object();

		}
	}
}