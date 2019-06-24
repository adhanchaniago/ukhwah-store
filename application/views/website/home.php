      <!--Middle Part Start-->
      <div id="content" class="col-sm-9">
        <div class="slideshow single-slider owl-carousel">
          <div class="item"> <a href="#"><img class="img-responsive" src="<?php echo base_url() ?>src/slide/slide1.png" alt="Slide 3" /></a> </div>
          <div class="item"> <a href="#"><img class="img-responsive" src="<?php echo base_url() ?>src/slide/slide2.png" alt="slide 2" /></a> </div>
          <div class="item"> <a href="#"><img class="img-responsive" src="<?php echo base_url() ?>src/slide/slide.png" alt="new" /></a> </div>
        </div>
        <!-- /.Slideshow End-->
        
        <!-- Product Start -->
        <?php
          foreach ($kategori as $key_k => $value_k) {
            if ( $value_k->id_kategori==3 || $value_k->id_kategori==4 ) {
              echo '
                <h3 class="subtitle">'.$value_k->kategori.' - <a class="viewall" href="'.base_url('produk/kategori/' .$value_k->kategori .'/?q=' .$value_k->id_kategori).'">Lihat Semua</a></h3>
                <div class="row products-category">
              ';
              foreach ($produk as $key => $value) {
                if ( $value->id_kategori== $value_k->id_kategori ) {
                  echo '
                    <div class="product-layout product-grid col-lg-5ths col-md-5ths col-sm-3 col-xs-6">
                      <div class="product-thumb">
                        <div class="image"><a href="'.base_url('produk/detail/' .$value->id_produk .'/' .$value->nama_produk).'"><img max-width="150px" src="'.base_url('src/produk/' .$value->gambar).'" alt="'.$value->nama_produk.'" title="'.$value->nama_produk.'" class="Ximg-responsive"></a></div>
                        <div>
                          <div class="caption">
                            <h4><a href="'.base_url('produk/detail/' .$value->id_produk .'/' .$value->nama_produk).'"><strong>'.$value->nama_produk.'</strong></a></h4>
                            <p class="price"> '.idr($value->harga).' </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  ';
                }
              }
              echo '</div>';
            }
          }
        ?>        
        <!-- Product End -->
        
      </div>
      <!--Middle Part End-->

