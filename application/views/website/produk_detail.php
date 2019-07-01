<div id="content" class="col-sm-9">
  <h3 class="subtitle">Produk <small><span class="glyphicon glyphicon-menu-right"></span></small> Detail <small><span class="glyphicon glyphicon-menu-right"></span></small> <?php echo $row->nama_produk ?> </h3>
  <!--   <h4 class="title"></h4> -->
    <div class="row product-info">
      <div class="col-sm-6">
        <div class="image" style="border: 1px solid #e5e1e1;"><div style="height:381px;width:381px;" class="zoomWrapper"><img class="img-responsive" itemprop="image" id="zoom_01" src="<?php echo base_url('src/produk/' .$row->gambar) ?>" title="{image_name}" alt="{image_name}" data-zoom-image="<?php echo base_url('src/produk/' .$row->gambar) ?>" style="position: absolute;"></div> </div>
        <div class="image-additional" id="gallery_01">
            
          <a class="thumbnail" href="#" data-zoom-image="<?php echo base_url('src/produk/' .$row->gambar) ?>" data-image="<?php echo base_url('src/produk/' .$row->gambar) ?>" title="{image_single}gamis_arab_hitam.jpg{/image_single}"> 
            <img src="<?php echo base_url('src/produk/128/' .$row->gambar) ?>" title="gamis_arab_hitam.jpg" alt="gamis_arab_hitam.jpg">
          </a>
            
        </div>
      </div>
    
      <div class="col-sm-6">
          <!-- <h4 class="title" style="margin: 0px 0px 10px 0px;">{model}</h4> -->
        <form method="post" class="addtocart">
          <input type="hidden" name="id_produk" id="id_produk" value="<?php echo $row->id_produk ?>">
          <ul class="list-unstyled description">
            <li><b>Kategori :</b> <span itemprop="mpn"><?php echo $row->kategori ?></span></li>
            <li><b>Stok :</b> <span class="instock"> <?php echo $row->stok ?></span></li>
          </ul>
          <ul class="price-box">
            <li class="price"><span itemprop="price"><?php echo idr($row->harga)?></span></li>
          </ul>
          <div id="product">
            <h3 class="subtitle">Produk Tersedia</h3>
            <div class="form-group">
              <label class="control-label">Pilih Warna</label> <br>
              
                
                  <div class="pretty p-icon p-smooth">
                      <input type="radio" value="Hitam" name="color">
                      <div class="state p-success">
                          <i class="icon fa fa-check"></i>
                          <label> Hitam</label>
                      </div>
                  </div>
                
              
            </div>
            <div class="form-group">
              <label class="control-label">Pilih Ukuran</label><br>
                
                
                  <div class="pretty p-icon p-smooth">
                      <input type="radio" value="40" name="size">
                      <div class="state p-success">
                          <i class="icon fa fa-check"></i>
                          <label> 40</label>
                      </div>
                  </div>
                
                
            </div>          
            <div class="cart">
              <div>
                <div class="qty">
                  <label class="control-label" for="input-quantity">Qty</label>
                  <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control">
                  <a class="qtyBtn plus" href="javascript:void(0);">+</a><br>
                  <a class="qtyBtn mines" href="javascript:void(0);">-</a>
                  <div class="clear"></div>
                </div>
                <button class="btn btn-primary btn-lg" id="btn-cart"><i class="fa fa-shopping-cart"></i> Beli</button>
                <button class="btn btn-primary btn-sm" id="btn-loading-cart"><img src="image/progress.gif"></button>
              </div>
            
            </div>
          </div>
          <div class="notification-cart pull-left">Berhasil dimasukan kedalam keranjang ..</div>
          <div class="social pull-right flip share"> 
              <span>Share :</span>
              <a href="#" target="_blank" title="" data-toggle="tooltip" data-original-title="Facebook"> <i class="fa fa-facebook-square"></i>
              </a> 
              <a href="#" target="_blank" title="" data-toggle="tooltip" data-original-title="Twitter"> <i class="fa fa-twitter-square"></i>
              </a> 
              <a href="#" target="_blank" title="" data-toggle="tooltip" data-original-title="Google Plus"> <i class="fa fa-google-plus-square"></i>
              </a> 
              <a href="#" target="_blank" title="" data-toggle="tooltip" data-original-title="Whatsapp"> <i class="fa fa-whatsapp"></i>
              </a> 
          </div>

        </form></div>
      </div>
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
      <!-- <li><a href="#tab-specification" data-toggle="tab">Specification</a></li> -->
    </ul>
    <div class="tab-content">
      <div itemprop="description" id="tab-description" class="tab-pane active">
        <div>
          <?php echo $row->deskripsi ?>
        </div>
      </div>
      <div id="tab-specification" class="tab-pane">
        <table class="table table-bordered">
          <thead>
            <tr>
              <td colspan="2"><strong>Memory</strong></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>test 1</td>
              <td>8gb</td>
            </tr>
          </tbody>
          </table>
        <table class="table table-bordered">
        <thead>
            <tr>
              <td colspan="2"><strong>Processor</strong></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>No. of Cores</td>
              <td>1</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>