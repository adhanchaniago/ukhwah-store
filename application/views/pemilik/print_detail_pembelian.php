
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Print Detail Pembelian</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>/themes/adminlte/code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
  <style>
    @page { margin: 0; }
  </style>
  <script src="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/jquery/jquery.min.js"></script>
</head>
<body>
<?php
    echo '
    <div id="DivIdToPrint" class="container border p-3 mt-3">
		<div class="row">
			<div class="col-12">
				<h4>
					<i class="fa fa-globe"></i> Ukhwah Store.
					<small class="float-right">Tanggal: '.tgl_indo($pemesanan->tanggal).'</small>
				</h4>
			</div>
			<!-- /.col -->
		</div>
		<div class="row invoice-info">
			<div class="col-sm-4 invoice-col">
			Pelanggan :
			<address>
				<strong class="text-capitalize">Nama: '.$pemesanan->nama.'</strong><br>
				<strong class="text-capitalize">Telpon: '.$pemesanan->no_handphone.'</strong><br>

			</address>
			</div>
			<!-- /.col -->
			<div class="col-sm-4 invoice-col">
			Alamat Pengiriman :
			<address>
				<strong>'.$pemesanan->alamat_pengiriman.'</strong><br>
			</address>
			</div>
			<!-- /.col -->
			<div class="col-sm-4 invoice-col">
			Catatan :
			<address>
				<strong>'.($pemesanan->komentar_pesanan==''? 'Tidak Ada Catatan' : $pemesanan->komentar_pesanan ).'</strong><br>
			</address>
			</div>
			<!-- /.col -->
		</div>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Nama Produk</th>
						<th>Kategori</th>
						<th>Jumlah</th>
						<th>Berat(Kg)</th>
						<th>Harga</th>
						<th>Sub-Total</th>
					</tr>
				</thead>
				<tbody>';
				$total= 0;
				$total_berat= 0;
				foreach ($this->m_pemilik->detail_pemesanan() as $key => $value) {
					echo '
					<tr>
						<td>'.$value->nama_produk.'</td>
						<td>'.$value->kategori.'</td>
						<td>'.$value->jumlah.'</td>
						<td>'.( ($value->jumlah*$value->berat) /1000 ).'</td>
						<td>'.idr($value->harga).'</td>
						<td>'.idr( ($value->jumlah*$value->harga) ).'</td>
					</tr>
					';
					$total += ($value->jumlah*$value->harga);
					$total_berat += ceil( ($value->jumlah*$value->berat) /1000 );
				}
				
				echo '
				</tbody>
				<tfoot>
					<tr>
						<td class="text-right" colspan="5"><strong>Total:</strong></td>
						<td class="text-right total">'.idr($total).'</td>
					</tr>
					<tr>
						<td class="text-right" colspan="5"><strong>Kode Unik:</strong></td>
						<td class="text-right kode-unik">'.$pemesanan->kode_unik.'</td>
					</tr>
					<tr>
						<td class="text-right" colspan="5"><strong>Biaya Kirim ('.($total_berat).' Kg):</strong></td>
						<td class="text-right biaya-kirim" data-biaya="0" data-weight="1210">'.idr($total_berat*$pemesanan->biaya_ongkir).'</td>
					</tr>
					<tr>
						<td class="text-right" colspan="5"><strong>Total Pembayaran:</strong></td>
						<td class="text-right total-pembayaran">'.idr( $total +$pemesanan->kode_unik +($total_berat*$pemesanan->biaya_ongkir) ).'</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
    ';
?>
<script>
    var printContents = document.getElementById('DivIdToPrint').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
    setTimeout(function(){window.close();},10);
</script>
</body>
</html>