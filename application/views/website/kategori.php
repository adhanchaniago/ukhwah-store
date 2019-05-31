<div id="content" class="col-sm-9">
          <h3 class="subtitle">Produk <small><span class="glyphicon glyphicon-menu-right"></span></small> Kategori <small><span class="glyphicon glyphicon-menu-right"></span></small> <?php echo $kategori ?></h3>
          <div class="product-filter">
            <div class="row">
              <div class="col-sm-1 hidden-xs">
                <label class="control-label">View : </label>
              </div>
              <div class="col-sm-5 col-xs-4 text-left">
                <div class="btn-group">
                  <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="" data-original-title="List"><i class="fa fa-th-list"></i></button>
                  <button type="button" id="grid-view" class="btn btn-default selected" data-toggle="tooltip" title="" data-original-title="Grid"><i class="fa fa-th"></i></button>
                </div>
               </div>
              <div class="col-sm-2 col-xs-3 text-right">
                <label class="control-label">Urutkan:</label>
              </div>
              <div class=" col-sm-4 col-xs-5 text-right">
                <form method="GET" action="<?php echo base_url("produk/kategori/{$kategori}") ?>">
                  <input type="hidden" name="q" value="<?php echo $id_kategori ?>">
                  <select id="input-sort" class="form-control col-sm-5" onchange="return this.form.submit()" name="short">
                    <option value="default" selected="">Default</option>
                    <option value="terbaru">Terbaru</option>
                    <option value="harga-terendah">Harga Terendah </option>
                    <option value="harga-tertinggi">Harga Tertinggi</option>
                  </select>
                </form>
              </div>
            </div>
          </div>
          <br>
          <div class="row products-category">
            <?php
              if ( count($rows) > 0 ) {
                
                foreach ($rows as $key => $value) {
                  echo '
                  <div class="product-layout product-grid col-lg-5ths col-md-5ths col-sm-3 col-xs-6">
                    <div class="product-thumb">
                      <div class="image"><a href="'.base_url('produk/detail/' .$value->id_produk .'/' .$value->nama_produk).'"><img max-width="150px" src="'.base_url('src/produk/' .$value->gambar).'" alt="Hp Pavilion G6 2314ax Notebok Laptop" title="Hp Pavilion G6 2314ax Notebok Laptop" class="Ximg-responsive"></a></div>
                      <div>
                        <div class="caption">
                          <h4><a href="'.base_url('produk/detail/' .$value->id_produk .'/' .$value->nama_produk).'"><strong>'.$value->nama_produk.'</strong></a></h4>
                          <p class="description">'.character_limiter(strip_tags($value->deskripsi), 250).'</p>
                          <p class="price"> '.idr($value->harga).'</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <span class="clearfix visible-lg-block"></span>
                  ';
                }
              } else {
                echo '<h2 class="text-center text-info">Maaf Produk Belum Tersedia</h2>';
              }
            ?>
          </div>
          <div class="row">
            <div class="col-sm-6 text-left">
            
            </div>
            <!-- <div class="col-sm-6 text-right">Showing 1 to 12 of 15 (2 Pages)</div> -->
          </div>
        </div>