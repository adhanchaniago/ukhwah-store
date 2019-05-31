      <!--Middle Part Start-->
      <div id="content" class="col-sm-9">
        <div class="slideshow single-slider owl-carousel">
          <div class="item"> <a href="#"><img class="img-responsive" src="<?php echo base_url() ?>src/slide/slide1.png" alt="Slide 3" /></a> </div>
          <div class="item"> <a href="#"><img class="img-responsive" src="<?php echo base_url() ?>src/slide/slide2.png" alt="slide 2" /></a> </div>
          <div class="item"> <a href="#"><img class="img-responsive" src="<?php echo base_url() ?>src/slide/slide.png" alt="new" /></a> </div>
        </div>
        <!-- /.Slideshow End-->
        
        <!-- Product Start -->
        <h3 class="subtitle">Produk Kami - <a class="viewall" href="<?php echo base_url() ?>produk">Lihat Semua</a></h3>
        <div class="row products-category">
          <?php
            foreach ($produk as $key => $value) {
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
          ?>
        </div>
        <!-- Product End -->
        
      </div>
      <!--Middle Part End-->

