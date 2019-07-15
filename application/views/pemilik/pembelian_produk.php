  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datatables/dataTables.bootstrap4.css">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Transaksi Pembelian Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Informasi Pembelian Produk</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="alert alert-info fade in alert-dismissible show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true" style="font-size:20px">×</span>
                </button>    <strong>Info!</strong> Pilih Menu Action ->Detail Pembelian, Untuk Melihat Detail Pembelian.
              </div>
            </div>
            <div class="card-header">
              <form method="POST" class="form-inline" action="<?php echo base_url() ?>pemilik/print-laporan-pembelian-produk" class="floar-right" target="_blank">
                <label for="" class="mb-2 mr-sm-2">Periode</label> <input type="date" class="form-control mb-2 mr-sm-2" name="start" required="">
                <label for="" class="mb-2 mr-sm-2">s.d</label> <input type="date" class="form-control mb-2 mr-sm-2" name="end" required="">
                <button type="submit" class="btn btn-default mb-2 mr-sm-2"><i class="fa fa-plus"></i> Print Laporan</button>
              </form>
              <!-- <a target="_blank" href="<?php echo base_url() ?>pemilik/print-laporan-pembelian-produk" class="btn btn-default float-right form-add-new"><i class="fa fa-plus"></i> Print Laporan</a> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Invoice</th>
                  <th>Nama Pelanggan</th>
                  <th>Tanggal Pemesanan</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach ($rows as $key => $value) {
                    echo "
                      <tr>
                        <td>#US{$value->id_pemesanan}</td>
                        <td>{$value->nama}</td>
                        <td>".tgl_indo($value->tanggal)."</td>
                        <td>
                          <div class='btn-group'>
                            <button type='button' class='btn btn-default'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                              <span class='caret'></span>
                              <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu' x-placement='top-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(67px, -165px, 0px);'>
                              <a title='Informasi Detail Pembelian' data-id='".$value->id_pemesanan."' data-status='true' class='dropdown-item detail-pembelian' href='".base_url('pemilik/detail-pembelian/' .$value->id_pemesanan .'/true')."'>Detail Pembelian</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    ";
                  }
                ?>
                
                </tbody>
                <!-- <tfoot>
                <tr>
                  <th>Nama Materi</th>
                  <th>Tanggal Upload</th>
                  <th>Tipe File</th>
                  <th>Action</th>
                </tr>
                </tfoot> -->
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Modal body..
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- /.modal -->

<!-- DataTables -->
<script src="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
