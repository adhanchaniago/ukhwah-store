<?php 

class M_website extends CI_Model{
	public $get= null;
	
/* ==================== Start Home : Kolom Produk ==================== */
	function produk_home(){		
		return $this->db->query("SELECT * FROM tb_produk ORDER BY id_produk DESC LIMIT 10")->result_object();
	}
/* ==================== End Home : Kolom Produk ==================== */

/* ==================== Start Kategori Produk ==================== */
	public function kategori(){
		return $this->db->query("SELECT * FROM tb_kategori")->result_object();
				
	}
	public function nama_kategori()
	{
		return $this->db->query("SELECT * FROM tb_kategori WHERE id_kategori='{$this->get["id_kategori"]}' ")->row()->kategori;
	}
	public function produk_by_kategori()
	{
		switch ( empty( $this->get['short'] ) || $this->get['short']=='default' || $this->get['short']=='terbaru' ? null : $this->get['short']) {
			case 'harga-terendah':
				# code...
				$this->db->order_by('harga', 'ASC');
				break;
			case 'harga-tertinggi':
				# code...
				$this->db->order_by('harga', 'DESC');
				break;
			
			default:
				$this->db->order_by('id_produk', 'DESC');
				break;
		}	
		$this->db->where('id_kategori', $this->get["id_kategori"]);
		return $this->db->get("tb_produk")->result_object();
	}
/* ==================== Start Kategori Produk ==================== */

/* ==================== Start Produk ==================== */
	public function produk(){
		switch ( empty( $this->get['short'] ) || $this->get['short']=='default' || $this->get['short']=='terbaru' ? null : $this->get['short']) {
			case 'harga-terendah':
				# code...
				$this->db->order_by('harga', 'ASC');
				break;
			case 'harga-tertinggi':
				# code...
				$this->db->order_by('harga', 'DESC');
				break;
			
			default:
				$this->db->order_by('id_produk', 'DESC');
				break;
		}	
		return $this->db->get("tb_produk ")->result_object();
	}
	public function produk_detail(){		
		return $this->db->query("
		SELECT * FROM tb_produk
			LEFT JOIN tb_kategori
				ON tb_produk.id_kategori=tb_kategori.id_kategori
		WHERE tb_produk.id_produk='{$this->get["id_produk"]}'
		")->row();
	}
/* ==================== End Produk ==================== */
}