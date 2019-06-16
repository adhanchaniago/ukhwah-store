<?php
/* echo '<pre>';
print_r($this->session->userdata('pelanggan'));
echo '</pre>'; */
?>
<div class="wrapper-wide" style="background-image:url('<?php echo base_url() ?>src/bg/star8-0.png') !important;background-repeat: repeat !important;"><!-- navigation -->
<div id="header">
  <header class="header-row">
    <div class="container">
      <div class="table-container">
        <div class="col-table-cell col-lg-4 col-md-4 col-sm-3 col-xs-6">
          <div id="logo"><a href=""><img class="img-responsive" src="<?php echo base_url() ?>themes/marketshop/image/ukhuwah-store-logo.png" title="" alt="" /></a></div>
        </div> 

        <div class="col-table-cell pull-right">
          <div id="cart" class="pull-right">
            <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="heading dropdown-toggle">
              <span class="cart-icon pull-left flip"></span>
              <span id="cartTotal">0 item(s)</span>
            </button>
            <ul class="dropdown-menu" id="itemsNav" style="text-align: center;">
              <li><span> Keranjang Belanja Masih Kosong</span></li>
            </ul>
            <span class="users" stats="<?php echo ( ! empty($this->session->userdata('pelanggan')) ) ? '1' : '0' ?>">

            </span>
          </div>
        </div>

         <div class="col-table-cell col-lg-4 col-md-4 col-sm-5 col-xs-12  pull-right">
          <div id="search" class="input-group">
            <form method="get" action="<?php echo base_url() ?>produk">
              <input id="filter_name" type="text" name="q" value="" placeholder="Search" class="form-control input-lg" required="" />
              <button type="submit" class="button-search"><i class="fa fa-search"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <nav id="menu" class="navbar">
      <div class="navbar-header"> <span class="visible-xs visible-sm"> Menu <b></b></span></div>
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
          <li class="<?php echo ($this->uri->segment(1)==null || $this->uri->segment(1)=='ukhwah-store') ? 'active' : null ?>">
            <a href="<?php echo base_url() ?>ukhwah-store" title="Home"><span>Home</span></a>
          </li>
          <li class="<?php echo ($this->uri->segment(1)=='profil') ? 'active' : null ?>">
            <a href="<?php echo base_url() ?>profil" title="Profil">Profil</a>
          </li>
          <li class="<?php echo ($this->uri->segment(1)=='produk') ? 'active' : null ?>">
            <a href="<?php echo base_url() ?>produk" title="Produk">Produk</a>
          </li>
          <li class="<?php echo ($this->uri->segment(1)=='cara-pemesanan') ? 'active' : null ?>">
            <a href="<?php echo base_url() ?>cara-pemesanan" title="Cara Pemesanan">Cara Pemesanan</a>
          </li>
          <li class="<?php echo ($this->uri->segment(1)=='kontak-kami') ? 'active' : null ?>">
            <a href="<?php echo base_url() ?>kontak-kami" title="Kontak Kami">Kontak Kami</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <!-- Main Menu End-->
</div>
<!-- end navigation -->

<!--content -->
<div id="container">
  <div class="container">
    <div class="row">
      <aside id="column-left" class="col-sm-3 hidden-xs">
        <h3 class="subtitle">Kategori Produk</h3>
        <div class="box-category">
          <ul id="cat_accordion">
            <?php
              foreach ($kategori as $key => $value) {
                echo "<li><a href='".base_url()."produk/kategori/{$value->kategori}/?q={$value->id_kategori}'>{$value->kategori}</a></span><li>";
              }
            ?>
          </ul>
        </div>

        <h3 class="subtitle">Pembayaran Melalui</h3>
        <div class="side-item">
          <div class="product-thumb clearfix flex">
            <div class="image-bank"><img src="<?php echo base_url() ?>src/bank/Logo_Bank_Mandiri_Syariah_kecil.png" alt="MANDIRI SYARIAH" title="MANDIRI SYARIAH" class="img-responsive" /></div>
            <div class="caption">
              <p class="price">No. Rek : 711 488 1141 </p>
              <div class="rating"> A/N : Ukhwah Store</div>
            </div>
          </div>
        </div>
      </aside>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>