<?php 

class M_admin extends CI_Model{	
	function data_kategori(){		
		return $this->db->query("SELECT * FROM tb_kategori")->result_object();
	}	
}