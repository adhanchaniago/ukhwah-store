
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
    @page { margin: 0px 0px 0px 0px; }
  </style>
  <script src="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/jquery/jquery.min.js"></script>
</head>
<body>
<?php
  // echo '<pre>';
  // print_r($rows);
  // echo '</pre>';
  $tbody= '';
  foreach ($rows as $key => $value) {
    $row_0='';
    $row_not_0='';
    $total= 0;
    foreach ($value->items as $key_sub => $value_sub) {
      if ( $key_sub==0 ) {
        # code...
        $row_0 .= "
          <tr>
            <td rowspan='{$value->items_count}'>{$value->no}</td>   
            <td rowspan='{$value->items_count}'>#US{$value->id_pemesanan}</td>   
            <td rowspan='{$value->items_count}'>".tgl_indo($value->tanggal_pemesanan)."</td>   
            <td rowspan='{$value->items_count}'>{$value->nama}</td>
            <td>{$value_sub->nama_produk}".(empty($value_sub->ukuran) ? null : '<br><b>Ukuran : ' .$value_sub->ukuran .'</b>')."</td>   
            <td>{$value_sub->kategori}</td>   
            <td>{$value_sub->jumlah}</td>   
            <td>".idr($value_sub->harga)."</td>
						<td>".idr( ($value_sub->jumlah*$value_sub->harga) )."</td>    
        ";
      } else {
        # code...
        $row_not_0 .= "
          <tr>
            <td>{$value_sub->nama_produk}".(empty($value_sub->ukuran) ? null : '<br><b>Ukuran : ' .$value_sub->ukuran .'</b>')."</td>   
            <td>{$value_sub->kategori}</td>   
            <td>{$value_sub->jumlah}</td>   
            <td>".idr($value_sub->harga)."</td>
						<td>".idr( ($value_sub->jumlah*$value_sub->harga) )."</td> 
          </tr>
        ";
      }
      $total +=  ($value_sub->jumlah*$value_sub->harga);
      
    }
    $row_0 .= '<td rowspan="'.$value->items_count.'">'.idr($total).'</td></tr>';
    $tbody .=$row_0 .=$row_not_0; 
  }
  echo '
  <div id="DivIdToPrint" class="container border p-3 mt-3">
    <div class="row">
      <div class="col-sm-12">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
              <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 168px;">No</th>
              <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 168px;">Invoice</th>
              <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 168px;">Tanggal</th>
              <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 168px;">Nama Pelanggan</th>
              <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 168px;">Nama Produk</th>
              <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 168px;">Kategori</th>
              <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 168px;">Jumlah</th>
              <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 168px;">Harga</th>
              <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 168px;">Subtotal</th>
              <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 168px;">Total</th>
            </tr>
          </thead>
          <tbody>
            '.$tbody.'
          </tbody>
        </table>
      </div>
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