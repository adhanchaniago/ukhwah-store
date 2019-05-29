<?php 

class M_website extends CI_Model{
	public $get= null;	
	# kategori produk
	function kategori(){		
		return $this->db->query("SELECT * FROM tb_kategori")->result_object();
	}
	function produk_home(){		
		return $this->db->query("SELECT * FROM tb_produk ORDER BY id_produk DESC LIMIT 10")->result_object();
	}
	function produk_detail(){		
		return $this->db->query("
		SELECT * FROM tb_produk
			LEFT JOIN tb_kategori
				ON tb_produk.id_kategori=tb_kategori.id_kategori
		WHERE tb_produk.id_produk='{$this->get["id_produk"]}'
		")->row();
	}
}