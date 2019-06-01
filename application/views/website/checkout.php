  <div class="row">
    <!--Middle Part Start-->
    <div id="content" class="col-sm-12">
      <h1 class="title">Pemesanan</h1>
      <div class="row message">
        <div class="col-sm-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"><i class="fa fa-user"></i> Informasi Pribadi</h4>
            </div>
              <div class="panel-body">
                    <fieldset id="account">
                      <div class="form-group required">
                        <label for="input-payment-firstname" class="control-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="input-payment-fullname" placeholder="Nama Lengkap" value="" name="firstname">
                      </div>
                      <div class="form-group required">
                        <label for="input-payment-email" class="control-label">E-Mail</label>
                        <input type="text" class="form-control" id="input-payment-email" placeholder="E-Mail" value="" name="email">
                      </div>
                      <div class="form-group required">
                        <label for="input-payment-telephone" class="control-label">Telepon</label>
                        <input type="text" class="form-control" id="input-payment-telephone" placeholder="Telepon" value="" name="telp">
                      </div>
                    </fieldset>
                  </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"><i class="fa fa-book"></i> Alamat</h4>
            </div>
              <div class="panel-body">
                    <fieldset id="address" class="required">
                      <div class="form-group required">
                        <label name="postcode" for="input-payment-postcode" class="control-label">Kode Pos</label>
                        <input type="text" class="form-control" id="input-payment-postcode" placeholder="Kode Pos" value="">
                      </div>
                      <div class="form-group required">
                        <label for="input-payment-alamat-lengkap" class="control-label">Alamat Lengkap</label>
                        <textarea id="input-payment-full-address" name="full_address" rows="5" class="form-control" placeholder="Alamat lengkap"></textarea>
                      </div><!-- 
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" checked="checked" value="1" name="shipping_address">
                          My delivery and billing addresses are the same.</label>
                      </div> -->
                    </fieldset>
                  </div>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Keranjang Belanja</h4>
                </div>
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <td class="text-center">Image</td>
                            <td class="text-left">Model</td>
                            <td class="text-left">Warna</td>
                            <td class="text-right">Ukuran</td>
                            <td class="text-right">Jumlah</td>
                            <td class="text-right">Harga</td>
                            <td class="text-right">Total</td>
                          </tr>
                        </thead>
                        <tbody>
                          
                          <tr>
                            <td class="text-center"><a href="http://localhost/kantor/hasbuna-mbs-master/katalog-produk/detail/31/medali-sj118"><img width="50px" src="http://localhost/kantor/hasbuna-mbs-master/assets/img/produk/thumb/sepatu_pria_hasbuna_medali_sj118_hitam.jpg" alt="Medali SJ118" title="Medali SJ118" class="img-thumbnail"></a></td>
                            <td class="text-left"><a href="http://localhost/kantor/hasbuna-mbs-master/katalog-produk/detail/31/medali-sj118">Medali SJ118</a></td>
                            <td class="text-center">Hitam</td>
                            <td class="text-center">40</td>
                            <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                                <input type="number" name="qty" value="1" size="1" class="form-control">
                                <span class="input-group-btn">
                                <button type="submit" data-id="61679f30c5be1a3b1d021b561e1e3b1b" data-toggle="tooltip" title="" class="btn btn-primary update-product" data-original-title="Update"><i class="fa fa-refresh"></i></button>
                                <button id="remove-product" type="button" data-id="61679f30c5be1a3b1d021b561e1e3b1b" data-toggle="tooltip" title="" class="btn btn-danger" onclick="" data-original-title="Remove"><i class="fa fa-times-circle"></i></button>
                                </span></div></td>
                            <td class="text-right">Rp. 175.000,00</td>
                            <td class="text-right">Rp. 175.000,00</td>
                          </tr>
                          
                        </tbody>
                        <tfoot>
                          <tr>
                            <td class="text-right" colspan="6"><strong>Sub-Total:</strong></td>
                            <td class="text-right">Rp. 175.000,00</td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-pencil"></i> Tambahkan Komentar Tentang Pemesanan</h4>
                </div>
                  <div class="panel-body">
                    <textarea rows="4" class="form-control" id="confirm_comment" name="comments"></textarea>
                    <br>
                    <label class="control-label" for="confirm_agree">
                      <!-- <input type="checkbox" checked="checked" value="1" required="" class="validate required" id="confirm_agree" name="confirm agree"> -->
                      <!-- <span>I have read and agree to the <a class="agree" href="#"><b>Terms &amp; Conditions</b></a></span> </label> -->
                    <div class="buttons">
                      <div class="pull-right">
                        <input type="button" class="btn btn-primary payment-confirm" id="button-confirm" value="Kirim Pemesanan">
                      </div>
                    </div>
                  </label></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Middle Part End -->
  </div>