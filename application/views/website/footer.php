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
  j('.instock').html(function(){
    if( parseInt(j(this).html()) < 1 )
      j('#btn-cart').css("display","none");
  })
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
        // console.log(data);
        // location.reload();
      })  
    }
  })
  function cek_input_cart(){
    var quantity= j('#input-quantity').val();
    
    return {
      "stats" :( quantity > 0 ) ? 1: 0,
      "msg" :( quantity > 0 ) ? '': 'Maaf Anda Belum Memasukan Jumlah',
      "quantity" :quantity,
    };
  }
  /* End Cart Js */
  j('[id=remove-product]').on("click",function(e) {
    // console.log(j(this).attr('data-id'));
    var rowid = j(this).attr('data-id');
    j.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>/cart/remove",
        data: {id: rowid},
        success: function(data) {
          location.reload();
          // j('#cart').reload(location.href + " #cart");
          console.log(rowid);
        },
    });
  });
  // remove product

  // update product
  j('.update-product').on("click",function(e) {
    var rowid   = j(this).attr('data-id'),
        valueid = j(this).closest('tr').find('input').val();
    
    if (valueid!=0) {
      j.ajax(
        {
          type: "POST",
          url: "<?php echo base_url() ?>/cart/update",
          data: {id: rowid, value: valueid},
          success: function(data){
            location.reload();
          },
        }
      );

    }else{
      toastr["warning"]("Jumlah Tidak Boleh Kosong");

    }
    
  });
  // update product

  // payment confirm
  j('.payment-confirm').on("click",function(e){
    var fullname    = j('#input-payment-fullname').val(),
        email       = j('#input-payment-email').val(),
        telephone   = j('#input-payment-telephone').val(),
        postcode    = j('#input-payment-postcode').val(),
        fulladdress = j('#input-payment-full-address').val();

    if (fullname=='') {
      toastr["warning"]("Maaf Nama Lengkap Tidak Boleh Kosong");

    }else if(email==''){
      toastr["warning"]("Maaf Email Tidak Boleh Kosong");

    }else if(telephone==''){
      toastr["warning"]("Maaf Nomor Telepon Tidak Boleh Kosong");

    }else if(postcode==''){
      toastr["warning"]("Maaf Kode Pos Tidak Boleh Kosong");

    }else if(fulladdress==''){
      toastr["warning"]("Maaf Alamat Tidak Boleh Kosong");

    }

    if (fullname!='' && email!='' && telephone!='' && postcode!='' && fulladdress!='') {
      if (j('#confirm_comment').val()!='')
      {
        var comment = j('#confirm_comment').val();

      }else{
        var comment = '';

      }
      // console.log('sukses');

      j.ajax(
        {
          type: "POST",
          url: "<?php echo base_url() ?>/cart/confirm",
          data: {payment_fullname: fullname, payment_email: email, payment_telephone: telephone, payment_postcode: postcode, payment_fulladdress: fulladdress, payment_comment: comment},
          success: function(data){
            window.location.href= "<?php echo base_url() ?>hasbuna-group?success=1";
          },
        }
      );

    }

  });
  // payment confirm
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
  // toastr config

  var url_string = window.location.href;
  var url = new URL(url_string);
  var c = url.searchParams.get("success");
  if (c==1) {
    checkout_success();
  }
  function checkout_success(){
    toastr["success"]("Pemesanan Telah Berhasil Dikirim Silahkan Cek Email Anda Untuk Melakukan Pembayaran .<br /><br /><button type='button' class='btn clear'>Ok</button>", 'Info');
  }

  // confirm contact
  j(".confirm-contact").on("submit", function(e) {
    var fullname  = j('#input-fullname').val(),
        email     = j('#input-email').val(),
        enquiry   = j('#input-enquiry').val();

    if (fullname=='') {
      toastr["warning"]("Maaf Nama Lengkap Tidak Boleh Kosong");
    }else if(email==''){
      toastr["warning"]("Maaf Email Tidak Boleh Kosong");
    }else if(enquiry==''){
      toastr["warning"]("Maaf Isi Pesan Tidak Boleh Kosong");
    }

    if (fullname!='' && email!='' && enquiry!='') {
      e.preventDefault();
      j.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>kontak-kami/message",
          data: j(this).serialize(),
          success: function(data) {
            j('#contact-form').load(location.href+' #contact-form');
            toastr["success"]("Pesan Telah Dikirim, Terimakasih Telah Menghubungi kami.");
            // console.log(data);
          },
      });

    }
     
  }); 
  // confirm contact

})(jQuery);


</script>
</body>
</html>