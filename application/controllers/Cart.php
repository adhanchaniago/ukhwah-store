<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cart extends CI_Controller
{
	public $msg= null;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_website');
		$this->load->model('m_pelanggan');
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
				'weight' => $row->berat,
			],
		];
		if ( !empty($this->input->post('size')) ) {
			$data['options']['size']= $this->input->post('size');
		}

		# masukan ke cart
		$this->cart->insert($data);
		$this->weight();

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
			$row['weight']= ( ($row['qty']*$row['options']['weight']) );
			$row['total']= idr( $this->cart->total() );
		} else {
			# code...
			$row= [];
			$row['subtotal']= idr( 0 );
			$row['total']= idr( $this->cart->total() );
		}
		
		echo json_encode($row);
		$this->weight();
	}

	# remove satu item dalam cart
	public function remove()
	{
		$data= [
			'rowid' => $this->input->post('rowid'),
			'qty' => 0,
		];
		$this->cart->update($data);
		$this->weight();
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
						<td class="text-left"><a href="'.base_url( 'produk/detail/' .$value['id'] .'/' .$value['name'] ).'">'.$value['name'].'</a>'.(!empty($value['options']['size'])? '<br><span class="badge badge-info">Ukuran : ('.$value['options']['size'].')</span>' : null ).'</td>
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

	# payment weight
	public function weight()
	{
		if ( ! empty( $this->cart->contents() ) ) {
			$weight= 0;
			foreach ($this->cart->contents() as $key => $value) {
				$weight += $value['qty'] * $value['options']['weight'];
			}
			$this->session->set_userdata('weight' ,$weight );
		}
	}

	# option provinsi
	public function provinsi()
	{
		$rows=[];
		if ( empty($this->input->get('provinsi')) ) {
			# code...
			$rows['html']= '<option value="" selected disabled> -- Pilih Provinsi -- </option>';
			foreach ($this->m_website->provinsi() as $key => $value) {
				$rows['html'] .= '<option value="'.$value->provinsi.'">'.$value->provinsi.'</option>';
			}
		} else {
			# code...
			$rows['html']= '<option value="" disabled> -- Pilih Kabupaten -- </option>';
			foreach ($this->m_website->provinsi() as $key => $value) {
				$rows['html'] .= '<option value="'.$value->provinsi.'" '.($value->provinsi==$this->input->get('provinsi')? 'selected' : null ).'>'.$value->provinsi.'</option>';
			}
		}
		
		echo json_encode( $rows );
	}
	# option kabupaten
	public function kabupaten()
	{
		$this->m_website->get['provinsi']= $this->input->get('provinsi');
		$rows=[];
		if ( empty($this->input->get('kabupaten')) ) {
			# code...
			$rows['html']= '<option value="" selected disabled> -- Pilih Kabupaten -- </option>';
			foreach ($this->m_website->kabupaten() as $key => $value) {
				$rows['html'] .= '<option value="'.$value->kabupaten.'">'.$value->kabupaten.'</option>';
			}
		} else {
			# code...
			$rows['html']= '<option value="" disabled> -- Pilih Kabupaten -- </option>';
			foreach ($this->m_website->kabupaten() as $key => $value) {
				$rows['html'] .= '<option value="'.$value->kabupaten.'" '.($value->kabupaten==$this->input->get('kabupaten')? 'selected' : null ).'>'.$value->kabupaten.'</option>';
			}
		}
		
		echo json_encode( $rows );
	}
	# option kote
	public function kota()
	{
		$rows=[];
		if ( empty($this->input->get('kabupaten')) ) {
			# code...
			$rows['html']= '<option value="" selected disabled> -- Pilih Kota -- </option>';
			$rows['html'].= '<option value="" disabled> Maaf Anda Belum Memilih Kabupaten </option>';
			
		} else {
			# code...
			$this->m_website->get['kabupaten']= $this->input->get('kabupaten');
			if ( empty($this->input->get('kota')) ) {
				# code...
				$rows['html']= '<option value="" selected disabled> -- Pilih Kota -- </option>';
				foreach ($this->m_website->kota() as $key => $value) {
					$rows['html'] .= '<option value="'.$value->kota.'">'.$value->kota.'</option>';
				}
			} else {
				# code...
				$rows['html']= '<option value="" disabled> -- Pilih Kota -- </option>';
				foreach ($this->m_website->kota() as $key => $value) {
					if ( $value->kota==$this->input->get('kota') ) {
						# code...
						$rows['html'] .= '<option value="'.$value->kota.'" selected>'.$value->kota.'</option>';
						$rows['biaya'] = $value->biaya;
					} else {
						# code...
						$rows['html'] .= '<option value="'.$value->kota.'" >'.$value->kota.'</option>';
					}
					
				}
			}
		}
		
		
		echo json_encode( $rows );
	}

	# proses pemesanan
	public function checkout_process()
	{
		$this->m_pelanggan->post= $this->input->post();
		if ( empty($_FILES['fupload']['tmp_name']) ) {
            # code...without upload file
			$this->msg= [
				'stats'=>1,
				'msg'=> 'Maaf Anda Belum Memilih File'
			];
        } else {
            # code...with upload file
            $config['upload_path']          = './src/bukti_pembayaran/';
            $config['allowed_types']        = 'jpg|png';

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('fupload'))
            {
                $this->msg= [
                    'stats'=>0,
                    'msg'=> $this->upload->display_errors(),
                ];
            }
            else
            {
                $this->m_pelanggan->post['gambar']= $this->upload->data()['file_name'];

                /* start image resize */
                $this->load->helper('img');
                $this->load->library('image_lib');
                $sizes = [768,320,128];
                foreach ($sizes as $size) {
                    $this->image_lib->clear();
                    $this->image_lib->initialize( resize($size, $config['upload_path'], $this->m_pelanggan->post['gambar']) );
                    $this->image_lib->resize();
                }
                /* end image resize */

                
				# store tb pemesanan and return id pemesanan
				$this->m_pelanggan->post['id_pemesanan']= $this->m_pelanggan->store_pemesanan();
				# store tb konfirmasi
				$this->m_pelanggan->store_konfirmasi();
				# store tb detail p  emesanan
				$this->m_pelanggan->store_det_pemesanan();
				# update stok produk
				$this->m_pelanggan->update_stok_produk();
				# set empty cart
				$this->cart->destroy();
				$this->msg= [
					'stats'=>1,
					'msg'=> 'Terimakasih, Pemesanan Anda Segera Kami Proses',
				];
            }
        }
		echo json_encode($this->msg);

	}
}