<?php 

class M_admin extends CI_Model{	
	// model data_kategori
	function data_kategori(){		
		return $this->db->query("SELECT * FROM tb_kategori")->result_object();
	}
	
	function add_data_kategori()
	{
		return $this->db->insert('tb_kategori', ['kategori'=> $this->post['kategori'] ] );
	}
	
	function edit_data_kategori(){		
		return $this->db->query("SELECT * FROM tb_kategori WHERE id_kategori='{$this->id_kategori}' ")->result_object();
	}

	function update_data_kategori()
	{
		return $this->db->update('tb_kategori',['kategori'=>$this->post['kategori']], ['id_kategori'=>$this->post['id_kategori']]);
	}

	function delete_data_kategori()
	{
		return $this->db->delete('tb_kategori', [ 'id_kategori'=>$this->id_kategori ]);
	}
	// model data_kategori
}