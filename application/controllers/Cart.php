<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cart extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_website');
		$this->load->library('cart');
	}

	# masukan satu item ke cart
	public function add()
	{
		# get produk from database
		$this->m_website->get['id_produk']= $this->input->post('id');
		$row= $this->m_website->produk_detail();

		#tampung data yang akan dimasukan ke dalam cart
		$data= [
			'id' => $row->id_produk,
			'name' => $row->nama_produk,
			'qty' => $this->input->post('quantity'),
			'price' => $row->harga,
			'options' => [
				'image' => $row->gambar,
				'category' => $row->kategori,
				'stock' => $row->stok,
			],
		];

		# masukan ke cart
		$this->cart->insert($data);

		echo 'Produk Berhasil Ditambahkan';
	}

	# update satu item dalam cart
	public function update()
	{
		$this->load->helper('currency');
		$data= [
			'rowid' => $this->input->post('rowid'),
			'qty' => $this->input->post('qty'),
		];
		$this->cart->update($data);
		if ( ! empty( $this->cart->contents()[ $this->input->post('rowid') ] ) ) {
			# code...
			$row= $this->cart->contents()[ $this->input->post('rowid') ];
			$row['subtotal']= idr($row['subtotal']);
			$row['total']= idr( $this->cart->total() );
		} else {
			# code...
			$row= [];
			$row['subtotal']= idr( 0 );
			$row['total']= idr( $this->cart->total() );
		}
		
		echo json_encode($row);
	}

	# remove satu item dalam cart
	public function remove()
	{
		$data= [
			'rowid' => $this->input->post('rowid'),
			'qty' => 0,
		];
		$this->cart->update($data);
		print_r($data);
	}

	# items navbar
	public function items_nav()
	{
		$this->load->helper('currency');
		$rows= [
			'items_total'=> count( $this->cart->contents() ) .' item(s)',
			'items'=>'',
		];
		if ( count( $this->cart->contents() ) > 0 ) {
			$rows['items'] .= '
			<li>
				<table class="table">
					<tbody>
						<tr>
						<td>Thumbnail</td>
						<td>Produk</td>
						<td>Jumlah</td>
						<td>Sub-Total</td>
						</tr>
			';
			foreach ( $this->cart->contents() as $key => $value ) {
				$rows['items'] .= '
					<tr>
						<td class="text-center"><a href="'.base_url( 'produk/detail/' .$value['id'] .'/' .$value['name'] ).'"><img width="50px" class="img-thumbnail" title="Medali SJ118" alt="Medali SJ118" src="'.base_url('src/produk/128/' .$value['options']['image']).'"></a></td>
						<td class="text-left"><a href="'.base_url( 'produk/detail/' .$value['id'] .'/' .$value['name'] ).'">'.$value['name'].'</a></td>
						<td class="text-right">x '.$value['qty'].'</td>
						<td class="text-right">'.idr($value['subtotal']).'</td>
						<td class="text-center"><button rowid="'.$value['rowid'].'" class="btn btn-danger btn-xs removeItemNav" title="Hapus Produk '.$value['name'].'" type="button"><i class="fa fa-times"></i></button></td>
					</tr>
				';
			}
			$rows['items'] .= '
						</tbody>
					</table>
					<p class="checkout">
						<a href="'.base_url('view-cart').'" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> View Cart </a>&nbsp;&nbsp;&nbsp;
						<a href="'.base_url('checkout').'" class="btn btn-primary btnCheckout"><i class="fa fa-share"></i> Checkout</a>
					</p>
				</li>
			';
		} else {
			$rows['items'] .='<li><span> Keranjang Belanja Masih Kosong</span></li>';
		}
		
		
		echo json_encode($rows);
	} 

	# tampilkan cart
	public function show()
	{
		// $data= array(
		// 	'rowid' => '61679f30c5be1a3b1d021b561e1e3b1b',
		// 	// 'rowid' => $_POST['id'],
		// 	'qty' => 0,
		// );
		// $this->cart->update($data);
		$cart = $this->cart->contents();
		$total_items= $this->cart->total_items();
		echo "<pre>";
		print_r($cart);
	}
	

	# payment confirm
	public function confirm(){


		$this->cart->destroy();
	}
}