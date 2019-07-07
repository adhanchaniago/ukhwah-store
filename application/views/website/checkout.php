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
              <td class="text-left">Berat(Gram)</td>
              <td class="text-right">Harga</td>
              <td class="text-right">Sub-Total</td>
              <td class="text-center"></td>
            </tr>
          </thead>
          <tbody>
            <?php
              // echo "<pre>";
              // print_r($this->session->userdata());
              // print_r($rows_address);
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
                    <td class="text-right weight">'.( ($value['qty']*$value['options']['weight']) ).'</td>
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
                <div style="display:flow-root">
                  <div style="float:left">
                    <h5><strong id="formFullName"><?php echo $address->nama_penerima ?></strong></h5>
                  </div>
                  <div style="float:right">
                    <div class="dropdown">
                      <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown">Kirim ke alamat lain
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu dropdown-menu-right">
                        <?php
                          foreach ($rows_address as $key => $value) {
                            echo ($key==0? null : "<li class='divider'></li>" )
                            ."<li>
                              <a href='' class='address-mod' data-nama='{$value->nama_penerima}' data-idkota='{$value->id_kota}'>
                                <strong>{$value->nama_penerima} ({$value->alamat_sebagai})</strong>
                                <p>
                                {$value->alamat_lengkap}<br>
                                Kota/Kab. {$value->nama_kota} Provinsi. {$value->nama_provinsi}, {$value->kode_pos}<br>
                                Indonesia<br>
                                Telepon/Handphone:&nbsp{$value->no_telepon}
                                </p>
                              </a>
                            </li>";
                          }
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <p id="formFullAddress">
                  <?php
                    echo "
                      {$address->alamat_lengkap}<br>
                      Kota/Kab. {$address->nama_kota} Provinsi. {$address->nama_provinsi}, {$address->kode_pos}<br>
                      Indonesia<br>
                      Telepon/Handphone:&nbsp{$address->no_telepon}
                    ";
                  ?>
                </p>
              </div>
            </div>
            <div class="form-group required">
              <label>Upload Bukti Pembayaran <small class="text-info">(Jumlah Harus Sesuai Total Pembayaran)</small></label>
              <input name="fupload" type="file" class="form-control" required>
            </div>
            <div class="form-group required">
              <label for="">Kurir</label>
              <select id="kurir" class="form-control" required="">
                <option value="0">?</option>
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
                <textarea rows="4" class="form-control" id="confirm_comment" name="comments" placeholder="Tambahan informasi untuk pemesanan anda ..."></textarea>
                <br>
                <label class="control-label" for="confirm_agree">
                <div class="buttons">
                  <div class="pull-right">
                    <input type="hidden" name="id_pelanggan" value="<?php echo $this->session->userdata('pelanggan')['id'] ?>">
                    <input id="formIdKota" type="hidden" name="id_kota" value="<?php echo $address->id_kota ?>">
                    <input id="formKodeUnik" type="hidden" name="kode_unik" value="<?php echo $this->session->userdata('kode_unik') ?>">
                    <input id="formBiayaOngkir" type="hidden" name="biaya_ongkir" value="">
                    <input id="formJasaPengiriman" type="hidden" name="kurir" value="">
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