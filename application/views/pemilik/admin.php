  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datatables/dataTables.bootstrap4.css">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Informasi admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/beranda') ?>">Beranda</a></li>
              <li class="breadcrumb-item active">Informasi admin</li>
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
              <!-- <h3 class="card-title">Daftar Informasi Kelas</h3> -->
              <a href="<?php echo base_url() ?>pemilik/form-add-admin" class="btn btn-default float-right add" title="Tambah Informasi Admin"><i class="fa fa-plus"></i> Add New</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Username</th>
                  <th>Nama</th>
                  <th>No Telpon</th>
                  <th>Alamat</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach ($rows as $key => $value) {
                    echo "
                      <tr>
                        <td>{$value->username}</td>
                        <td>{$value->nama}</td>
                        <td>{$value->no_handphone}</td>
                        <td>{$value->alamat}</td>
                        <td>
                          <div class='btn-group'>
                            <button type='button' class='btn btn-default'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                              <span class='caret'></span>
                              <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu' x-placement='top-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(67px, -165px, 0px);'>
                              <a class='dropdown-item edit' href='".base_url('pemilik/form-edit-admin/' .$value->id_admin)."' title='Edit Informasi Admin'>Edit</a>
                              <a class='dropdown-item delete ".($this->session->userdata('id')==$value->id_admin? 'd-none' : null )."' href='".base_url('pemilik/delete-data-admin/' .$value->id_admin)."'>Delete</a>
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

<!-- DataTables -->
<script src="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>