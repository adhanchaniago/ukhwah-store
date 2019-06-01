<div id="content" class="col-sm-9">
  <h3 class="subtitle">Keranjang Belanja</h3>
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
              <td class="text-right">Harga</td>
              <td class="text-right">Sub-Total</td>
              <td class="text-center"></td>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($rows as $key => $value) {
                echo '
                  <tr>
                    <td class="text-center"><a href="'.base_url('produk/detail/' .$value['id'] .'/' .$value['name']).'" ><img width="75px" src="'.base_url('src/produk/128/' .$value['options']['image']).'" alt="'.$value['name'].'" title="'.$value['name'].'" class="img-thumbnail"></a></td>
                    <td class="text-left"><a href="'.base_url('produk/detail/' .$value['id'] .'/' .$value['name']).'">'.$value['name'].'</a></td>
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
              <td class="text-right" colspan="5"><strong>Total:</strong></td>
              <td class="text-right total"><?php echo idr( $this->cart->total() ) ?></td>
              <td></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- end shopping cart -->
      <!-- action -->
      <div class="buttons">
        <div class="pull-left"><a href="<?php echo base_url('produk') ?>" class="btn btn-default">Belanja Lagi</a></div>
        <div class="pull-right"><a href="<?php echo base_url('checkout') ?>" class="btn btn-primary">Pemesanan</a></div>
      </div>
      <!-- end action -->
    </div>
    <!--Middle Part End -->
  </div>
</div>