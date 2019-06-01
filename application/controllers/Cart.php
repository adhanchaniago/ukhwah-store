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
						<a href="'.base_url('checkout').'" class="btn btn-primary"><i class="fa fa-share"></i> Checkout</a>
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

	#view cart
	public function view_cart(){
		$this->load->model(['Header_model','Home_model','Footer_model']);

		$data=array();
		# if cart not empty
		if ($this->cart->total_items()!=0)
		{	
			$product= $this->cart->contents();
			// generate content
			$content= "";
			$content .= '<table class="table"><tbody><tr><td>Thumbnail</td><td>Model</td><td>Warna</td><td>Ukuran</td><td>Jumlah</td><td>Total</td></tr>';
			$this->load->helper('string');
			foreach ($product as $key => $value_temp) {
				$content .= '
				<tr>
	              <td class="text-center"><a href="#"><img width="50px" class="img-thumbnail" title="'.$value_temp['name'].'" alt="'.$value_temp['name'].'" src="'.base_url().'assets/img/produk/thumb/'.$value_temp['options']['image'].'"></a></td>
	              <td class="text-left"><a href="product.html">'.$value_temp['name'].'</a></td>
	              <td class="text-left"><a>'.$value_temp['options']['color'].'</a></td>
	              <td class="text-left"><a>'.$value_temp['options']['size'].'</a></td>
	              <td class="text-right">x '.$value_temp['qty'].'</td>
	              <td class="text-right">Rp. '.rupiah($value_temp['subtotal']).'</td>
	              <td class="text-center"><button data-id="'.$value_temp['rowid'].'" id="remove-product" class="btn btn-danger btn-xs remove" title="Remove" type="button"><i class="fa fa-times"></i></button></td>
	            </tr>';
			}
			$content .= '</tbody></table>
						<p class="checkout">
							<a href="cart" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> View Cart </a>&nbsp;&nbsp;&nbsp;
							<a href="checkout" class="btn btn-primary"><i class="fa fa-share"></i> Checkout</a>
						</p>';
			// generate content
			$data['cart']= array(
				'items'=> count($product),
				'content' => $content,
			);
		}else{ # empthy cart
			$data['cart']= array(
				'items' => 0,
				'content' => '<span> Keranjang Belanja Masih Kosong</span>',
			);
		}

		$data['header']= array(
			'title'=>$this->Header_model->select_title()->result(),
			'keyword'=>$this->Header_model->select_keyword()->result(),
			'description'=>$this->Header_model->select_description()->result(),
		);
		$data['footer']=array(
			'statistik' => $this->Footer_model->data_footer(),
			'jasa_pengiriman'=>$this->Footer_model->select_jasa_pengiriman()->result(),
			'bank'=>$this->Footer_model->select_bank()->result(),
			'sosial_media'=>$this->Footer_model->select_sosial_media()->result(),
		);
		// generate content view cart
		$this->load->helper('string');
		$view_cart_in_array = array();
		foreach ($product as $key => $valuep) {
			$product_in_db = $this->Header_model->select_where_limit('produk',array('id_produk'=>$valuep['id']),array('produk_seo'))->result_object();
			$view_cart_in_array[] = array(
				'product_id' => $valuep['id'],
				'product_seo' => $product_in_db[0]->produk_seo,
				'product_img_single' => $valuep['options']['image'],
				'product_model' => $valuep['name'],
				'product_colour' => $valuep['options']['color'],
				'product_size' => $valuep['options']['size'],
				'product_qty' => $valuep['qty'],
				'product_price_idr' => rupiah($valuep['price']),
				'product_subtotal_idr' => rupiah($valuep['subtotal']),
				'product_rowid' => $valuep['rowid'],
			);
		}
		// end generate content view cart
		$data['content'] = array(
			'view-cart' => $view_cart_in_array,
		);
		$this->parser->parse('header',$data['header']);
		$this->parser->parse('navigation',$data['cart']);
		$this->parser->parse('cart/view_cart',$data['content']);
		$this->parser->parse('footer',$data['footer']);

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	#checkout
	public function checkout(){
		$this->load->model('Header_model');
		$this->load->model('Home_model');
		$this->load->model('Footer_model');

		$data=array();
		# if cart not empty
		if ($this->cart->total_items()!=0)
		{	
			$product= $this->cart->contents();
			// generate content
			$content= "";
			$content .= '<table class="table"><tbody><tr><td>Thumbnail</td><td>Model</td><td>Warna</td><td>Ukuran</td><td>Jumlah</td><td>Total</td></tr>';
			$this->load->helper('string');
			foreach ($product as $key => $value_temp) {
				$content .= '
				<tr>
	              <td class="text-center"><a href="#"><img width="50px" class="img-thumbnail" title="'.$value_temp['name'].'" alt="'.$value_temp['name'].'" src="'.base_url().'assets/img/produk/thumb/'.$value_temp['options']['image'].'"></a></td>
	              <td class="text-left"><a href="product.html">'.$value_temp['name'].'</a></td>
	              <td class="text-left"><a>'.$value_temp['options']['color'].'</a></td>
	              <td class="text-left"><a>'.$value_temp['options']['size'].'</a></td>
	              <td class="text-right">x '.$value_temp['qty'].'</td>
	              <td class="text-right">Rp. '.rupiah($value_temp['subtotal']).'</td>
	              <td class="text-center"><button data-id="'.$value_temp['rowid'].'" id="remove-product" class="btn btn-danger btn-xs remove" title="Remove" type="button"><i class="fa fa-times"></i></button></td>
	            </tr>';
			}
			$content .= '</tbody></table>
						<p class="checkout">
							<a href="cart" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> View Cart </a>&nbsp;&nbsp;&nbsp;
							<a href="checkout" class="btn btn-primary"><i class="fa fa-share"></i> Checkout</a>
						</p>';
			// generate content
			$data['cart']= array(
				'items'=> count($product),
				'content' => $content,
			);
		}else{ # empthy cart
			$data['cart']= array(
				'items' => 0,
				'content' => '<span> Keranjang Belanja Masih Kosong</span>',
			);
		}

		$data['header']= array(
			'title'=>$this->Header_model->select_title()->result(),
			'keyword'=>$this->Header_model->select_keyword()->result(),
			'description'=>$this->Header_model->select_description()->result(),
		);
		$data['footer']=array(
			'statistik' => $this->Footer_model->data_footer(),
			'jasa_pengiriman'=>$this->Footer_model->select_jasa_pengiriman()->result(),
			'bank'=>$this->Footer_model->select_bank()->result(),
			'sosial_media'=>$this->Footer_model->select_sosial_media()->result(),
		);
		// generate content view cart
		$this->load->helper('string');
		$view_cart_in_array = array();
		$subtotal='';
		foreach ($product as $key => $valuep) {
			$product_in_db = $this->Header_model->select_where_limit('produk',array('id_produk'=>$valuep['id']),array('produk_seo'))->result_object();
			$view_cart_in_array[] = array(
				'product_id' => $valuep['id'],
				'product_seo' => $product_in_db[0]->produk_seo,
				'product_img_single' => $valuep['options']['image'],
				'product_model' => $valuep['name'],
				'product_colour' => $valuep['options']['color'],
				'product_size' => $valuep['options']['size'],
				'product_qty' => $valuep['qty'],
				'product_price_idr' => rupiah($valuep['price']),
				'product_subtotal_idr' => rupiah($valuep['subtotal']),
				'product_rowid' => $valuep['rowid'],
			);
			$subtotal += $valuep['subtotal'];
		}
		// end generate content view cart
		$data['content'] = array(
			'view-cart' => $view_cart_in_array,
			'subtotal_all' => rupiah($subtotal),
		);
		$this->parser->parse('header',$data['header']);
		$this->parser->parse('navigation',$data['cart']);
		$this->parser->parse('cart/checkout',$data['content']);
		$this->parser->parse('footer',$data['footer']);

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}

	# payment confirm
	public function confirm(){
		$this->load->model('Invoice_model');
		$data = array();
		$data['invoice'] 	= $this->Invoice_model->get_no_invoice();
		$data['total'] 		= $this->cart->total(); 
		$data['totalunix'] 	= $this->cart->total()+substr($data['invoice'], -4); 
		$data['product'] 	= $this->cart->contents();
		$payment_item = array();
		foreach ($data['product'] as $key => $value_payment) {
		 	$payment_item[] = array(
			 	'payment_id' 			=> $data['invoice'],
			 	'product_id' 			=> $value_payment['id'],
			 	'payment_item_qty' 		=> $value_payment['qty'],	
			 	'payment_item_colour' 	=> $value_payment['options']['color'],	
			 	'payment_item_size' 	=> $value_payment['options']['size'],	
			 	'payment_item_price' 	=> $value_payment['price'],	
			 	'payment_item_subtotal'	=> $value_payment['subtotal'],	
		 	);
		}
		$data['payment_items'] = $payment_item;
		$data['payment'] = array(
			'payment_id' 			=> $data['invoice'],
			'payment_fullname' 		=> $this->input->post('payment_fullname') ,
			'payment_email' 		=> $this->input->post('payment_email') ,
			'payment_telephone' 	=> $this->input->post('payment_telephone') ,
			'payment_postcode' 		=> $this->input->post('payment_postcode') ,
			'payment_fulladdress' 	=> $this->input->post('payment_fulladdress') ,
			'payment_comment' 		=> $this->input->post('payment_comment') ,
			'payment_total' 		=> $data['total'] ,
			'payment_totalunix' 	=> $data['totalunix'] ,
			'payment_date' 			=> date("Y-m-d"),
			'payment_hour' 			=> date("h:i:s"),
		);

		$data['insert_payment'] = $this->Invoice_model->invoice_insert('payment',$data['payment']);
		$data['insert_payment_items'] = $this->Invoice_model->invoice_insert_batch('payment_item',$data['payment_items']);
		

		// $this->load->library('email');

		// $this->email->from('info@hasbunagroup.com', 'Hasbuna Group');
		// $this->email->to($this->input->post('payment_email'));
		// $this->email->cc('another@another-example.com');
		// $this->email->bcc('them@their-example.com');

		// $this->email->subject('Email Test');
		// $this->email->message('Testing the email class.');

		// $this->email->send();
		// echo "<pre>";
		// print_r($data);


		$this->cart->destroy();
	}
}