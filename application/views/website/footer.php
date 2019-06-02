<style type="text/css">
      .product-thumb .price {
          text-align: center;
      }
      </style>    
    </div>
  </div>
</div>
<!-- end content-->   
  
  <!--Footer Start-->
  <footer id="footer">
    <div class="fpart-first">
      <div class="container">
        <div class="row">
          <div class="contact col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h5>Info Kontak</h5>
            <ul>
              <li class="address">
                
                  <p>Ukhwah Store</p>
                
              </li>
              <li class="email"><i class="fa fa-envelope"></i>Send email via our <a href="kontak-kami">Kontak Kami</a>
            </ul>
          </div>
          <div class="column col-lg-4 col-md-4 col-sm-3 col-xs-12">
            <div class="column col-md-12 col-sm-12 col-xs-12">
                <h5>Syarat &amp; Ketentuan</h5>
                <ul>
                  <li><a href="cara-pemesanan">Cara Pemesanan</a></li>
                  <!-- <li><a href="cara-gabung">Cara Gabung</a></li> -->
                </ul>
            </div>
            <div class="column col-md-12 col-sm-12 col-xs-12">
              <h5>Jasa Pengiriman </h5>
              
              <div class="delivery-service"> 
                <img data-toggle="tooltip" src="<?php echo base_url() ?>src/jasa_pengiriman/pos-indonesia.png" alt="POS INDONESIA" title="POS INDONESIA" data-original-title="Pos Indonesia" class="img-responsive">
              </div>
              
            </div>
          </div>
          <div class="column col-lg-4 col-md-4 col-sm-5 col-xs-12">
            <h5>Pembayaran Bank</h5>
            <div class="side-item">
            	
              <div class="product-thumb clearfix flex">
                <div class="image-bank"><img src="<?php echo base_url() ?>src/bank/Logo_Bank_Mandiri_Syariah_kecil.png" alt="MANDIRI SYARIAH" title="MANDIRI SYARIAH" class="img-responsive" /></div>
                <div class="caption">
                  <p class="price">No. Rek : 711 488 1141 </p>
                   <div class="rating"> A/N : Ukhwah Store</div>
                </div>
              </div>
            	
            </div>
          </div>
         
        </div>
      </div>
    </div>
    <div class="fpart-second">
      <div class="container">
        <div id="powered" class="clearfix">
          <div class="powered_text pull-left flip">
            <p>Ukhwah Store © <?php echo date('Y')?> </p>
          </div>
          <div class="social pull-right flip">
	          	<a href="www.twitter.com" target="_blank"> <img data-toggle="tooltip" src="https://img.icons8.com/color/48/000000/twitter.png" alt="Twitter" title="Twitter"></a>
	          	<a href="www.instagram.com" target="_blank"> <img data-toggle="tooltip" src="https://img.icons8.com/color/48/000000/instagram-new.png" alt="Instagram" title="Instagram"></a>
	          	<a href="www.facebook.com" target="_blank"> <img data-toggle="tooltip" src="https://img.icons8.com/color/48/000000/facebook.png" alt="Facebook" title="Facebook"></a>
          </div>
        </div>
      </div>
    </div>
    <div id="back-top"><a data-toggle="tooltip" title="Back to Top" href="javascript:void(0)" class="backtotop"><i class="fa fa-chevron-up"></i></a></div>
  </footer>
  <!--Footer End-->
</div>

<!-- JS Part Start-->
<script type="text/javascript" src="<?php echo base_url() ?>themes/marketshop/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>themes/marketshop/js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>themes/marketshop/js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>themes/marketshop/js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>themes/marketshop/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>themes/marketshop/js/jquery.elevatezoom.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>themes/marketshop/js/swipebox/lib/ios-orientationchange-fix.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>themes/marketshop/js/swipebox/src/js/jquery.swipebox.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>themes/marketshop/js/custom.js?v=02"></script>
<!-- toaster -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- toaster -->
<script type="text/javascript">
// Elevate Zoom for Product Page image
  $("#zoom_01").elevateZoom({
    gallery:'gallery_01',
    cursor: 'pointer',
    galleryActiveClass: 'active',
    imageCrossfade: true,
    zoomWindowFadeIn: 500,
    zoomWindowFadeOut: 500,
    lensFadeIn: 500,
    lensFadeOut: 500,
    loadingIcon: 'image/progress.gif'
    }); 
  //////pass the images to swipebox
  $("#zoom_01").bind("click", function(e) {
    var ez =   $('#zoom_01').data('elevateZoom');
    $.swipebox(ez.getGalleryList());
    return false;
  });
</script>
<!-- JS Part End-->
<script type="text/javascript">
(function(j){
  /* start Cart Js */

  /* update keranjang belanja */
  items_nav()

  j('.instock').html(function(){
    if( parseInt(j(this).html()) < 1 )
      j('#btn-cart').css("display","none");
  })

  /* masukan produk kedalam keranjang */
  j('#btn-cart').on('click',function(e){
    e.preventDefault();
    if ( cek_input_cart().stats==0 ) {
      toastr["warning"]( cek_input_cart().msg );
    } else {
      var _post= {};
      _post['id']= j('#id_produk').val();
      _post['quantity']= j('#input-quantity').val();

      j.post('<?php echo base_url() ?>cart/add',_post,function(data){
        toastr["success"]( data );

        /* update keranjang belanja */
        items_nav()

      })  
    }
  })

  /* hapus produk */
  j(document).on('click','.removeItemNav', function(e){
    e.preventDefault()
    j.post('<?php echo base_url() ?>cart/remove', { "rowid": $(this).attr('rowid') }, function(data){
      /* update keranjang belanja */
      items_nav()
      // console.log(data)

    })
  })

  /* update keranjang belanja */
  j(document).on( "click" ,".qtyBtnViewCart" ,function() {
    var quantity= $(this).closest('tr').find('.input-quantity');
    var stock= $(this).closest('tr').find('.stock');
    var rowid= $(this).closest('tr').find('.rowid').val();
		if($(this).hasClass("plus")){
      if ( quantity.val() < parseInt( stock.val() ) ) {
          var qty = quantity.val();
          qty++;
          quantity.val(qty);
          updateViewCart({
            "rowid" :rowid,
            "qty" :qty,
          })
      } else {
          toastr["warning"]( "Maaf Stok Sudah Limit" );
      }
		}else{
			var qty = quantity.val();
			qty--;
			if(qty>0){
        quantity.val(qty);
        updateViewCart({
          "rowid" :rowid,
          "qty" :qty,
        })
			}else {
        toastr["warning"]( "Maaf Jumlah Tidak Boleh lebih kecil dari 1" );
      }
    }
    

		return false;
  });
  
  /* update keranjang belanja */
  j(document).on('click','.removeItemViewCart', function(){
    var rowid= $(this).closest('tr').find('.rowid').val();
    updateViewCart({
      "rowid" :rowid,
      "qty" :0,
    })

  })

  j(document).on('click','.btnCheckout',function(e){
    e.preventDefault()
    if( j('.users').attr('stats')=='0' )
      toastr["warning"]( "Untuk Melanjutkan Pemesanan Silahkan Melakukan Login Terlebih Dahulu Jika Belum Punya Akun Bisa Memilih Menu Daftar" );
    else
    window.location.replace( j(this).attr('href') )
  })

  /* cek produk sebelum disimpan keranjang */
  function cek_input_cart(){
    var quantity= j('#input-quantity').val();
    
    return {
      "stats" :( quantity > 0 ) ? 1: 0,
      "msg" :( quantity > 0 ) ? '': 'Maaf Anda Belum Memasukan Jumlah',
      "quantity" :quantity,
    };
  }

  /* ambil data produk untuk keranjang navbar */
  function items_nav()
  {
    j.get('<?php echo base_url() ?>cart/items_nav',function(data){
      j('#cartTotal').html(data.items_total)
      j('#itemsNav').html(data.items)
      console.log(data)
    },'json')
  }

  /* update data Harga, Total, Sub total di keranjang belanja */
  function updateViewCart(get)
  {
    if (get.qty==0) {
      var _sub_total= j("input[value='"+get.rowid+"']").closest('tr').remove()
      
    } else {
      var _sub_total= j("input[value='"+get.rowid+"']").closest('tr').find('.subtotal');
      
    }
    var _total= j('.total');
    j.post('<?php echo base_url() ?>cart/update',get,function(data){
      _sub_total.html( data.subtotal )
      _total.html(  data.total )
    },'json')
    console.log(items_nav())
  }

  /* End Cart Js */

  /* Start Pelanggan Js */
    /* users */
    users()

    /* form login */
    j(document).on('click','.btnLogin',function(){
      j.get('<?php echo base_url() ?>login',function(data){
        j('#myModal').find('.modal-title').html(data.title)
        j('#myModal').find('.modal-body').html(data.form)
      },'json')
    })

    /* form daftar */
    j(document).on('click','.btnDaftar',function(){
      j.get('<?php echo base_url() ?>daftar',function(data){
        j('#myModal').find('.modal-title').html(data.title)
        j('#myModal').find('.modal-body').html(data.form)
      },'json')
    })

    /* cek login pelanggan */
    j(document).on('submit','#formLogin',function(e){
      e.preventDefault()
      var formData = new FormData(this);
      $.ajax({
          url: $(this).attr("action"),
          type: 'POST',
          data: formData,
          success: function (data) {
            if ( data.stats==1 ) {
              toastr["success"]( data.msg );
              $("#myModal").modal("hide");
              $('.users').attr('stats','1');
              users()
            } else {
              toastr["warning"]( data.msg );
            }
          },
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json'
      });
    })

    /* Register pelanggan */
    j(document).on('submit','#formDaftar',function(e){
      e.preventDefault()
      var formData = new FormData(this);
      $.ajax({
          url: $(this).attr("action"),
          type: 'POST',
          data: formData,
          success: function (data) {
            if ( data.stats==1 ) {
              toastr["success"]( data.msg );
              $("#myModal").modal("hide");
              $('.users').attr('stats','1');
              users()
            } else {
              toastr["warning"]( data.msg );
            }
          },
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json'
      });
    })

    function users()
    {
      j.get('<?php echo base_url() ?>users',function(data){
        j('.users').html(data.html)
      },'json')
    }
  /* End Pelanggan Js */
  
  /* config toastr */
  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  /* config toastr */

})(jQuery);


</script>
</body>
</html>