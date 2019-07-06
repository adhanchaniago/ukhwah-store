<div id="content" class="col-sm-9">
  <h3 class="subtitle"><i class="fa fa-shopping-cart"></i> Keranjang Belanja</h3>
  <div class="row">
    <!--Middle Part Start-->
    <div class="col-sm-12">
      <!-- shopping cart -->
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <td class="text-left">Thumbnail</td>
              <td class="text-left">Produk</td>
              <td class="text-left">Kategori</td>
              <td class="text-left">Jumlah</td>
              <td class="text-left">Berat(Kg)</td>
              <td class="text-right">Harga</td>
              <td class="text-right">Sub-Total</td>
              <td class="text-center"></td>
            </tr>
          </thead>
          <tbody>
            <?php
              // echo "<pre>";
              // print_r($this->session->userdata());
              // echo "</pre>";
              foreach ($rows as $key => $value) {
                echo '
                  <tr>
                    <td class="text-center"><a href="'.base_url('produk/detail/' .$value['id'] .'/' .$value['name']).'" ><img width="75px" src="'.base_url('src/produk/128/' .$value['options']['image']).'" alt="'.$value['name'].'" title="'.$value['name'].'" class="img-thumbnail"></a></td>
                    <td class="text-left"><a href="'.base_url('produk/detail/' .$value['id'] .'/' .$value['name']).'">'.$value['name'].'</a>'.(!empty($value['options']['size'])? '<br><span class="badge badge-info">Ukuran : ('.$value['options']['size'].')</span>' : null ).'</td>
                    <td class="text-left">'.$value['options']['category'].'</td>
                    <td class="text-left">
                      <div class="qty">
                        <input class="stock" type="hidden" value="'.$value['options']['stock'].'">
                        <input class="rowid" type="hidden" value="'.$value['rowid'].'">
                        <input readonly type="text" name="quantity" value="'.$value['qty'].'" size="2" id="input-quantity" class="form-control input-quantity">
                        <a class="qtyBtnViewCart plus" href="javascript:void(0);">+</a><br>
                        <a class="qtyBtnViewCart mines" href="javascript:void(0);">-</a>
                        <div class="clear"></div>
                      </div>
                    </td>
                    <td class="text-right weight">'.( ($value['qty']*$value['options']['weight']) / 1000  ).'</td>
                    <td class="text-right">'.idr($value['price']).'</td>
                    <td class="text-right subtotal">'.idr($value['subtotal']).'</td>
                    <td><button class="btn btn-danger btn-xs removeItemViewCart" title="Hapus '.$value['name'].'" type="button"><i class="fa fa-times"></i></button></td>
                  </tr>
                ';
              }
            ?>
            
          </tbody>
          <tfoot>
            <tr>
              <td class="text-right" colspan="6"><strong>Total:</strong></td>
              <td class="text-right total"><?php echo idr( $this->cart->total() ) ?></td>
              <td></td>
            </tr>
            <tr>
              <td class="text-right" colspan="6"><strong>Kode Unik:</strong></td>
              <td class="text-right kode-unik"><?php echo $this->session->userdata('kode_unik') ?></td>
              <td></td>
            </tr>
            <tr>
              <td class="text-right" colspan="6"><strong>Biaya Kirim:</strong></td>
              <td class="text-right biaya-kirim" data-biaya="0" data-weight="<?php echo $this->session->userdata('weight') ?>"> ? </td>
              <td></td>
            </tr>
            <tr>
              <td class="text-right" colspan="6"><strong>Total Pembayaran:</strong></td>
              <td class="text-right total-pembayaran"><?php echo idr( $this->cart->total()+$this->session->userdata('kode_unik') ) ?></td>
              <td></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- end shopping cart -->
    </div>
    <!--Middle Part End -->
  </div>

  <div class="row">
    <!-- start form -->
    <form id="formCheckout" action="<?php echo base_url('checkout-process') ?>" method="post" enctype="multipart/form-data">
    <div class="col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Detail Pembeli</h4>
          </div>
          <div class="panel-body">
            <div class="panel panel-default">
              <div class="panel-heading">
                dfsf
              </div>
              <div class="panel-body">
                Kost Pak Sapto
                Kos Pak Sapto, Pengok Kidul GK IV 1094A RT 026 rw 007 kel. Baciro ,Kota Yogyakarta
                Gondokusuman, Yogyakarta
                Daerah Istimewa Yogyakarta, 55225
                Indonesia
                628122530688
              </div>
            </div>
            <input type="hidden" name="kota" id="selKota" class="form-control" data-kota="" data-biaya="" required>
            <div class="form-group required">
              <label>Upload Bukti Pembayaran <small class="text-info">(Jumlah Harus Sesuai Total Pembayaran)</small></label>
              <input name="fupload" type="file" class="form-control" required>
            </div>
            <div class="form-group required">
              <label for="">Kurir</label>
              <select name="kurir" id="kurir" class="form-control">
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="row">
          <div class="col-sm-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">Tambahkan Komentar Tentang Pemesanan</h4>
              </div>
              <div class="panel-body">
                <textarea rows="4" class="form-control" id="confirm_comment" name="comments" placeholder="Isi tambahan informasi untuk pemesanan anda ..."></textarea>
                <br>
                <label class="control-label" for="confirm_agree">
                  <!-- <input type="checkbox" checked="checked" value="1" required="" class="validate required" id="confirm_agree" name="confirm agree"> -->
                  <!-- <span>I have read and agree to the <a class="agree" href="#"><b>Terms &amp; Conditions</b></a></span> </label> -->
                <div class="buttons">
                  <div class="pull-right">
                    <input type="hidden" name="id_pelanggan" value="<?php echo $this->session->userdata('pelanggan')['id'] ?>">
                    <input id="formKodeUnik" type="hidden" name="kode_unik" value="">
                    <input id="formBiayaOngkir" type="hidden" name="biaya_ongkir" value="">
                    <input type="submit" class="btn btn-primary payment-confirm" id="button-confirm" value="Kirim Pemesanan">
                  </div>
                </div>
              </label>
            </div>
            </div>
          </div>
        </div>
        <!-- ./ end row -->
      </div>
    </form>
    <!-- ./ end form -->    
  </div>
</div>