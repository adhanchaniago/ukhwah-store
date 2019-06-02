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
}