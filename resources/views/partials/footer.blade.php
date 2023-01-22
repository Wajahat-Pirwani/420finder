




@if (!request()->routeIs('desktop-map'))

    <a href=""><img class="mdn" style="width: 100%" src="{{asset('images/1663675847803_bottombanner_find420faster_420finderapp_desktop.jpg')}}" alt=""></a>
    <a href=""><img class="destopnone" style="width: 100%" src="{{asset('images/1663675844496_bottombanner_find420faster_420finderapp_mobile.jpeg')}}" alt=""></a>

    <a href="{{route('signup')}}"><img class="mdn" style="width: 100%" src="{{asset('images/web-2.png')}}" alt=""></a>
    <a href="{{route('signup')}}"><img class="destopnone" style="width: 100%" src="{{asset('images/mobile_2.png')}}" alt=""></a>

    <a href="{{route('business1')}}"><img class="mdn" style="width: 100%" src="{{asset('images/web-3.png')}}" alt=""></a>
    <a href="{{route('business1')}}"><img class="destopnone" style="width: 100%" src="{{asset('images/mobile-3.png')}}" alt=""></a>

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
          <div class="row">
              <div class="col-lg-3 col-md-6 footer-newsletter destopnone">
                  <div class="footer-bg" style="margin-bottom: 30px;" >
                      <h4 class="footer-h">420 FINDER BUSINESS</h4>
                      <div class="d-grid">
                          <a style="font-size: 16px !important;" class="footer-link text-white" href="{{ route('business1') }}">LEARN MORE <i class="fa fa-circle" style="font-size: 7px;"></i></a>
                          <a style="font-size: 16px !important;" class="footer-link text-white" href="{{ route('addabusiness') }}">ADD A BUSINESS <i class="fa fa-circle" style="font-size: 7px;"></i></a>
                          <a href="https://dispensaries.420finder.net/" target="_blank" class="footer-link text-white">Login as Dispensary Retailer <i class="fa fa-circle" style="font-size: 7px;"></i></a>
                          <a href="https://deliveries.420finder.net/" target="_blank" class="footer-link text-white">Login as Delivery Service <i class="fa fa-circle" style="font-size: 7px;"></i></a>
                          <a href="https://brands.420finder.net/" class="text-white footer-link pb-2">Login as Verified Brands <i class="fa fa-circle" style="font-size: 7px;"></i></a>
                      </div>
                  </div>
              </div>
          </div>
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3><img src="{{ asset('assets/img/logo.png') }}" alt="" style="width: 200px;"></h3>
            <p class="pt-2">
              Rate, Review, And Improve your Cannabis Community one bud at a time <br><br>
              <strong>Phone:</strong> (424) 501-9610<br>
              <strong>Email:</strong> support@420finder.net<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('index') }}">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('deals') }}">Deals</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('termsofuse') }}">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('privacypolicy') }}">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('dispensaries') }}" target="_blank">Dispensaries</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('deliveries') }}">Deliveries</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('desktop-map') }}">Maps</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('brands') }}">Brands</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('products.index') }}">Products</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Legal</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('termsofuse') }}">Terms of Use</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('privacypolicy') }}">Privacy Policy</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('cookiepolicy') }}">Cookie Policy</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('referalprogram') }}">Referral Program</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter mdn">
            <div class="footer-bg" >
              <h4 class="footer-h">420 FINDER BUSINESS</h4>
              <div class="d-grid">
                  <a style="font-size: 16px !important;" class="footer-link text-white" href="{{ route('business1') }}">LEARN MORE <i class="fa fa-circle" style="font-size: 7px;"></i></a>
                  <a style="font-size: 16px !important;" class="footer-link text-white" href="{{ route('addabusiness') }}">ADD A BUSINESS <i class="fa fa-circle" style="font-size: 7px;"></i></a>
                  <a href="https://dispensaries.420finder.net/" target="_blank" class="footer-link text-white">Login as Dispensary Retailer <i class="fa fa-circle" style="font-size: 7px;"></i></a>
                  <a href="https://deliveries.420finder.net/" target="_blank" class="footer-link text-white">Login as Delivery Service <i class="fa fa-circle" style="font-size: 7px;"></i></a>
                  <a href="https://brands.420finder.net/" class="text-white footer-link pb-2">Login as Verified Brands <i class="fa fa-circle" style="font-size: 7px;"></i></a>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>420finder</span></strong>. All Rights Reserved.
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  @endif

  <!-- <div id="preloader"></div> -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  @if (empty(session('latitude')) AND empty(session('longitude')))
    <script type="text/javascript">
        localStorage.removeItem('currentlocation');
        localStorage.setItem('currentlocation', 'Los Angeles, California, USA');
    </script>
  @endif

  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8"></script>

{{--  @yield('star-rating')--}}
  {{-- VUE --}}
  <?php
  if(!request()->routeIs('maps') && !request()->routeIs('mapfilter')) {
  ?>
  <script type="application/javascript" src="{{ asset('assets/js/star-rating/jquery.star-rating-svg.js') }}"></script>
{{--  <script>--}}
{{--      $(".index-rating").starRating({--}}
{{--          readOnly: true,--}}
{{--          totalStars: 5,--}}
{{--          starSize: 18,--}}
{{--          emptyColor: 'lightgray',--}}
{{--          activeColor: '#f8971c',--}}
{{--          useGradient: false--}}
{{--      });--}}
{{--  </script>--}}
  <script src="{{ asset('js/app.js') }}"></script>

  <?php }
  ?>


 @stack('scripts')

  {{-- <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javasciprt" src="{{ asset('assets/js/stripe-script.js') }}"></script> --}}

  <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>

  <script>

    $(document).ready(function() {
      $("#news-slider1").owlCarousel({
          items : 5,
          itemsDesktop:[1199,3],
          itemsDesktopSmall:[980,2],
          itemsMobile : [600,2],
          navigation:true,
          navigationText:["<i class='bi bi-chevron-left'></i>","<i class='bi bi-chevron-right'></i>"],
          pagination:true,
          autoPlay:true
      });
      $("#news-slider2").owlCarousel({
          items : 5,
          itemsDesktop:[1199,3],
          itemsDesktopSmall:[980,2],
          itemsMobile : [600,2],
          navigation:true,
          navigationText:["<i class='bi bi-chevron-left'></i>","<i class='bi bi-chevron-right'></i>"],
          pagination:true,
          autoPlay:true
      });
      $("#news-slider3").owlCarousel({
          items : 5,
          itemsDesktop:[1199,3],
          itemsDesktopSmall:[980,2],
          itemsMobile : [600,2],
          navigation:true,
          navigationText:["<i class='bi bi-chevron-left'></i>","<i class='bi bi-chevron-right'></i>"],
          pagination:true,
          autoPlay:true
      });
        $("#news-slider4").owlCarousel({
            items : 5,
            itemsDesktop:[1199,3],
            itemsDesktopSmall:[980,2],
            itemsMobile : [600,2],
            navigation:true,
            navigationText:["<i class='bi bi-chevron-left'></i>","<i class='bi bi-chevron-right'></i>"],
            pagination:true,
            autoPlay:true
        });

    });
  </script>

  {{-- <script src="https://cdn.ckeditor.com/4.14.0/basic/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');
  </script> --}}

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/toast.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('.select2').select2();
    });
  </script>
  <script>
      toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
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
  </script>
  <script>

      @if(Session::has('success'))
          toastr.success("{{ Session::get('success') }}");
      @endif

      @if(Session::has('info'))
          toastr.info("{{ Session::get('info') }}")
      @endif

      @if(Session::has('warning'))
          toastr.warning("{{ Session::get('warning') }}")
      @endif

      @if(Session::has('error'))
          toastr.error("{{ Session::get('error') }}")
      @endif

  </script>

  <!-- Edit Profile -->

  <script type="text/javascript">

    $(document).ready(function(){

      $("#savename").click(function(){

        var name = $("#editname").val();

        if (name == '') {
          alert('Name should not be empty');
        } else {
          $("#savename").addClass('disabled');
          $("#savename .spinner-border").css('display', 'inherit');

          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ route('savename') }}",
            method:"POST",
            data:{name:name},
              success:function(data) {

                var response = JSON.parse(data);

                if (response.statuscode == 200) {
                  $("#savename .spinner-border").css('display', 'none');
                  $("#savename").removeClass('disabled');
                  toastr.info(response.message);
                  location.reload();
                } else {
                  $("#savename").removeClass('disabled');
                  $("#savename .spinner-border").css('display', 'none');
                  toastr.error(response.message);
                }


              }
          });

        }

      });

      $("#savephonenumber").click(function(){

        var phone_number = $("#editphonenumber").val();

        if (phone_number == '') {
          alert('Name should not be empty');
        } else {
          $("#savephonenumber").addClass('disabled');
          $("#savephonenumber .spinner-border").css('display', 'inherit');

          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ route('savephonenumber') }}",
            method:"POST",
            data:{phone_number:phone_number},
              success:function(data) {

                var response = JSON.parse(data);

                if (response.statuscode == 200) {
                  $("#savephonenumber .spinner-border").css('display', 'none');
                  $("#savephonenumber").removeClass('disabled');
                  toastr.info(response.message);
                  location.reload();
                } else {
                  $("#savephonenumber").removeClass('disabled');
                  $("#savephonenumber .spinner-border").css('display', 'none');
                  toastr.error(response.message);
                }


              }
          });

        }

      });

      $("#savedateofbirth").click(function(){

        var dateofbirth = $("#editdateofbirth").val();

        if (dateofbirth == '') {
          alert('Name should not be empty');
        } else {
          $("#savedateofbirth").addClass('disabled');
          $("#savedateofbirth .spinner-border").css('display', 'inherit');

          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ route('savedateofbirth') }}",
            method:"POST",
            data:{dateofbirth:dateofbirth},
              success:function(data) {

                var response = JSON.parse(data);

                if (response.statuscode == 200) {
                  $("#savedateofbirth .spinner-border").css('display', 'none');
                  $("#savedateofbirth").removeClass('disabled');
                  toastr.info(response.message);
                  location.reload();
                } else {
                  $("#savedateofbirth").removeClass('disabled');
                  $("#savedateofbirth .spinner-border").css('display', 'none');
                  toastr.error(response.message);
                }


              }
          });

        }

      });

      $("#savedeliveryaddress").click(function(){

        var delivery_address = $("#editdeliveryaddress").val();

        if (delivery_address == '') {
          alert('Delivery Address should not be empty.');
        } else {
          $("#savedeliveryaddress").addClass('disabled');
          $("#savedeliveryaddress .spinner-border").css('display', 'inherit');

          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ route('savedeliveryaddress') }}",
            method:"POST",
            data:{delivery_address:delivery_address},
              success:function(data) {

                var response = JSON.parse(data);

                if (response.statuscode == 200) {
                  $("#savedeliveryaddress .spinner-border").css('display', 'none');
                  $("#savedeliveryaddress").removeClass('disabled');
                  toastr.info(response.message);
                  location.reload();
                } else {
                  $("#savedeliveryaddress").removeClass('disabled');
                  $("#savedeliveryaddress .spinner-border").css('display', 'none');
                  toastr.error(response.message);
                }


              }
          });

        }

      });

      $("#saveabout").click(function(){

        var about = $("#editabout").val();

        if (about == '') {
          alert('Delivery Address should not be empty.');
        } else {
          $("#saveabout").addClass('disabled');
          $("#saveabout .spinner-border").css('display', 'inherit');

          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ route('saveabout') }}",
            method:"POST",
            data:{about:about},
              success:function(data) {

                var response = JSON.parse(data);

                if (response.statuscode == 200) {
                  $("#saveabout .spinner-border").css('display', 'none');
                  $("#saveabout").removeClass('disabled');
                  toastr.info(response.message);
                  location.reload();
                } else {
                  $("#saveabout").removeClass('disabled');
                  $("#saveabout .spinner-border").css('display', 'none');
                  toastr.error(response.message);
                }


              }
          });

        }

      });

    });

    $(".addtocartdispensary").click(function(){

var dispensory_product_id = $(this).attr('rel');
var bId = $(this).attr('b');
var qty = parseInt($('#product-single-qty-input').val());

      if(qty < 1) {
        qty = 1;
      }

$.ajax({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url:"{{ route('addtocartdispensary') }}",
  method:"POST",
  data:{
    dispensory_product_id:dispensory_product_id,
    retailer_id: bId,
    qty: qty
    },
    success:function(data) {

      var response = JSON.parse(data);

      if (response.statuscode == 200) {
        $('.cart-count').text(response.cartCount);
        toastr.info(response.message);
      } else if(response.statuscode == 201) {
        toastr.error(response.message);
      } else if(response.statuscode == 202) {
        $("#differentCart").modal('show');
        $(".alertmsg").html(response.message);
        $(".newcartproductid").attr('rel', dispensory_product_id);

          $(".newcartproductid").on('click', function(){

            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url:"{{ route('removedcartadddelivery') }}",
              method:"POST",
              data:{dispensory_product_id:dispensory_product_id, retailer_id: bId, qty: qty},
                success:function(data) {

                  var response = JSON.parse(data);

                  if (response.statuscode == 200) {
                    $("#differentCart").modal('hide');
                    toastr.info(response.message);
                    $('.cart-count').text(response.cartCount);
                  } else {
                    toastr.error(response.message);
                  }

                }
            });

          });

      } else {
        toastr.error(response.message);
      }


    }
});

});

    $(".product-single-delivery-cart").click(function(){

      var dispensory_product_id = $(this).attr('rel');
      var bId = $(this).attr('b');
      var qty = parseInt($('#product-single-qty-input').val());

      if(qty < 1) {
        qty = 1;
      }

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('addtocartdelivery') }}",
        method:"POST",
        data:{
          dispensory_product_id: dispensory_product_id,
          retailer_id: bId,
          qty: qty
          },
          success:function(data) {

            var response = JSON.parse(data);

            if (response.statuscode == 200) {
              $('.cart-count').text(response.cartCount);
              toastr.info(response.message);
            } else if(response.statuscode == 201) {
              toastr.error(response.message);
            } else if(response.statuscode == 202) {
              $("#diffdeliverycart").modal('show');
              $(".alertmsg").html(response.message);
              $(".newcartproductid").attr('rel', dispensory_product_id);

                $(".newcartproductid").on('click', function(){

                  $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('removedcartadddelivery') }}",
                    method:"POST",
                    data:{
                        dispensory_product_id:dispensory_product_id, retailer_id: bId,
                        qty: qty
                    },
                      success:function(data) {
                        var response = JSON.parse(data);
                        if (response.statuscode == 200) {
                          $("#diffdeliverycart").modal('hide');
                          toastr.info(response.message);
                          $('.cart-count').text(response.cartCount);
                        } else {
                          toastr.error(response.message);
                        }

                      }
                  });

                });

            } else {
              toastr.error(response.message);
            }


          }
      });

    });

    $(".favbrand").click(function(){

      var brand_id = $(this).attr('rel');

      var fav_type = 'Brand';

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('favoritebrand') }}",
        method:"POST",
        data:{
          brand_id:brand_id,
          fav_type:fav_type
          },
          success:function(data) {
            var response = JSON.parse(data);

            if (response.statuscode == 200) {
              $(".favbrand i").removeClass('far');
              $(".favbrand i").addClass('fas');
              $(".favbrand i").css('color', '#f8971c');
              toastr.info(response.message);
            } else {
              toastr.error(response.message);
            }

          }
      });

    });

    $(".favbrandproduct").click(function(){

      var brand_product_id = $(this).attr('rel');

      var fav_type = 'Brand Product';

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('favbrandproduct') }}",
        method:"POST",
        data:{
          brand_product_id:brand_product_id,
          fav_type:fav_type
          },
          success:function(data) {
            var response = JSON.parse(data);

            if (response.statuscode == 200) {
              $(".favbrandproduct i").removeClass('far');
              $(".favbrandproduct i").addClass('fas');
              $(".favbrandproduct i").css('color', '#f8971c');
              toastr.info(response.message);
            } else {
              toastr.error(response.message);
            }

          }
      });

    });

    $(".favdispensary").click(function(){

      var dispensary_id = $(this).attr('rel');

      var fav_type = 'Dispensary';

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('favdispensary') }}",
        method:"POST",
        data:{
          dispensary_id:dispensary_id,
          fav_type:fav_type
          },
          success:function(data) {
            var response = JSON.parse(data);

            if (response.statuscode == 200) {
              $(".favdispensary i").removeClass('far');
              $(".favdispensary i").addClass('fas');
              $(".favdispensary i").css('color', '#f8971c');
              toastr.info(response.message);
            } else {
              toastr.error(response.message);
            }

          }
      });

    });

    $(".favretailerproduct").click(function(){

      var retailer_id = $(this).attr('rel');

      var fav_type = $("#retailer_id").val().charAt(0).toUpperCase() + $("#retailer_id").val().slice(1) + " Product";

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('favretailerproduct') }}",
        method:"POST",
        data:{
          retailer_id:retailer_id,
          fav_type:fav_type
          },
          success:function(data) {
            var response = JSON.parse(data);

            if (response.statuscode == 200) {
              $(".favretailerproduct i").removeClass('far');
              $(".favretailerproduct i").addClass('fas');
              $(".favretailerproduct i").css('color', '#f8971c');
              toastr.info(response.message);
            } else {
              toastr.error(response.message);
            }

          }
      });

    });

    $(".favdelivery").click(function(){

      var delivery_product_id = $(this).attr('rel');
      var fav_type = $(this).attr('data');

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('favdelivery') }}",
        method:"POST",
        data:{
          delivery_product_id:delivery_product_id,
          fav_type:fav_type
          },
          success:function(data) {
            var response = JSON.parse(data);

            if (response.statuscode == 200) {
                $('#addfavourites').hide();
                // show delete button
                $('#deletefavourite').show();

              // $(".favdelivery i").removeClass('far');
              // $(".favdelivery i").addClass('fas');
              $(".favdelivery i").css('color', '#f8971c');
              toastr.info(response.message);
            } else {
              toastr.error(response.message);
            }

          }
      });

    });
    $(".unfavdelivery").click(function(){

        var delivery_product_id = $(this).attr('rel');
        var fav_type = $(this).attr('data');
        // console.log(product_id)

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ route('unfavdelivery') }}",
            method:"POST",
            data:{
                delivery_product_id:delivery_product_id,
                fav_type:fav_type
            },
            success:function(data) {
                var response = JSON.parse(data);

                if (response.statuscode == 200) {

                    $('#addfavourites').show();
                    // show delete button
                    $('#deletefavourite').hide();

                    // $(".favdelivery i").removeClass('fa');
                    // $(".favdelivery i").addClass('far');
                    // $(".favdelivery i").css('color', '#f8971c');
                    toastr.info(response.message);
                } else {
                    toastr.error(response.message);
                }

            }
        });

    });
  </script>


  <script>

    $(".search_input").click(function(){

      $(".search_input").val('');

    });

    $("#mobile_search_input").click(function(){

        $("#mobile_search_input").val('');

    });


    function changeLocation() {

      $(".addLocation").click(function(){
        // alert('hi');
        $(".addLocation").hide();

        $("#locationBox").show();

      });

    }

    function mobileChangeLocation() {

        $(".addLocation").click(function(){
        // alert('hi');
         $(".addLocation").hide();

         $("#mobileLocationBox").show();

        });

    }

    <?php
      if (!empty(session('latitude')) AND !empty(session('longitude'))) {
    ?>

    $(document).ready(function(){

      if (localStorage.getItem("currentlocation") == null) {
        changeLocation();
        mobileChangeLocation();
      } else {
        $('.addLocation').hide();
        // $("#locationBox").hide();
        let content = localStorage.getItem("currentlocation");

        // $("#currentLocation").append(localStorage.getItem("currentlocation"));
        // $('#mobileCurrentLocation').append(localStorage.getItem("currentlocation"));
        $('#search_input').val(content);
        $("#mobile_search_input").val(content);
        $(".mobile-search-location-input").val(content);

        changeLocation();
        mobileChangeLocation();

      }

    });

    <?php
      }
    ?>

    var x = document.getElementById("getcurrentlocation");

    function getLocation() {

      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      }

    }

  </script>

  <!-- Google Map Search Locations -->

  <script>
    var searchInput = 'search_input';

    $(document).ready(function () {
        var autocomplete;

        autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
            types: ['geocode'],
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function () {

          var near_place = autocomplete.getPlace();

          document.getElementById('loc_lat').value = near_place.geometry.location.lat();
          document.getElementById('loc_long').value = near_place.geometry.location.lng();

          console.log("near place : " + near_place.geometry.location);
          var lat = near_place.geometry.location.lat();
          var lon = near_place.geometry.location.lng();

          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ route('getlocationforcurrentuser') }}",
            method:"POST",
            data:{
              lat:lat,
              lon:lon
              },
              success:function(data) {
                 console.log(data);
                var response = JSON.parse(data);

                if (response.statuscode == 200) {

                  changeLocation();
                  // console.log(response.message);
                  $("#locationBox").hide();
                  localStorage.removeItem("currentlocation");
                  localStorage.setItem("currentlocation", response.message);

                  location.reload();
                  // toastr.info(response.message);
                } else {
                  toastr.error(response.message);
                }

              }
          });

        });
    });

     $(document).on('change', '#'+searchInput, function () {
      $("#latitude_input").val('');
      $("#longitude_input").val('');
      $("#latitude_view").val('');
      $("#longitude_view").val('');
    });


  </script>
  <!-- End Google Map Search Locations -->

  <script>

    $("#claimDeal").click(function(){

      $("#dealSingle").addClass('loader');

      var deal_id = $("#claimDeal").attr('rel');

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('claimdeal') }}",
        method:"POST",
        data:{
          deal_id: deal_id,
          empty: false
          },
          success: function(data) {

            var response = JSON.parse(data);

            if(response.data.status == 500) {
                $("#dealSingle").removeClass('loader');
                $('#dealPopup').modal('show');
                $('.dealPopupMsg').text(response.data.message);
            } else {

                if (response.data.statuscode == 200) {

                    $("#dealSingle").removeClass('loader');
                    $("#claimDeal").addClass('btn-disabled');

                    window.location.href = response.data.redirectUrl;
                    toastr.info(response.data.message);

                    } else {

                    $("#dealSingle").removeClass('loader');
                    toastr.error(response.data.message);

                }

            }

          }
      });

    });

    $(".viewbusinessdetail").click(function(){

      var business_id = $(this).attr('rel');

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('getbusinessdetails') }}",
        method:"POST",
        data:{business_id:business_id},
          success:function(data) {
            // console.log(data);
            var response = JSON.parse(data);

            if (response.statuscode == 200) {

              if (response.data.profile_picture != null) {
                $("#businessPicture").attr('src', response.data.profile_picture);
              }

              if (response.data.business_name == '') {
                $("#businessname").text(response.data.business_type);
              } else {
                $("#businessname").text(response.data.business_name);
              }

              $("#business_type").text(response.data.business_type);

              $("#businesscontact").attr('href', 'tel:' + response.data.phone_number);
              $("#businessemail").attr('href', 'mailto:' + response.data.email);

              var dispensary_url = "/dispensaries/" + response.data.business_name + "/" + response.data.id;
              var delivery_url = "/deliveries/" + response.data.business_name + "/" + response.data.id;

              if (response.data.business_type == 'Delivery') {
                $("#businessreviews").attr('href', delivery_url);
                $("#viewbusinessmenu").attr('href', delivery_url);
              } else {
                $("#businessreviews").attr('href', dispensary_url);
                $("#viewbusinessmenu").attr('href', dispensary_url);
              }

              $(".opening_time").text(response.data.opening_time);
              $(".closing_time").text(response.data.closing_time);

            } else {

              $("#dealSingle").removeClass('loader');
              toastr.error(response.data.message);

            }

          }
      });


      $(".mainbusinesslistings").hide();
      $("#businessdetailbox").show();

    });
    $("#backtoresults").click(function(){

      $("#businessdetailbox").hide();
      $(".viewbusinessdetail").show();
      $(".mainbusinesslistings").show();

    });

  </script>

  <!-- Dispensary -->
  <div class="modal fade" id="differentCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center p-5">
          <i class="fas fa-shopping-cart" style="font-size: 30px;border: 1px solid silver;border-radius: 50%;padding: 22px;text-align: center;box-shadow: 0px 4px 12px #e9e9e9;margin-bottom: 20px;"></i>
          <h3>Start a new cart?</h3>
          <div class="text-black-50 alertmsg"></div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('cart') }}" class="btn btn-warning text-white w-100 mb-3">Complete previous order</a>
            </div>
            <div class="col-md-12">
              <a rel="" class="btn btn-info text-white w-100 mb-3 newcartproductid">Start a new cart</a>
            </div>
            <div class="col-md-12">
              <button type="button" class="btn btn-dark w-100" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Delivery -->
  <div class="modal fade" id="diffdeliverycart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center p-5">
          <i class="fas fa-shopping-cart" style="font-size: 30px;border: 1px solid silver;border-radius: 50%;padding: 22px;text-align: center;box-shadow: 0px 4px 12px #e9e9e9;margin-bottom: 20px;"></i>
          <h3>Start a new cart?</h3>
          <div class="text-black-50 alertmsg"></div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('cart') }}" class="btn btn-warning text-white w-100 mb-3">Complete previous order</a>
            </div>
            <div class="col-md-12">
              <a rel="" class="btn btn-info text-white w-100 mb-3 newcartproductid">Start a new cart</a>
            </div>
            <div class="col-md-12">
              <button type="button" class="btn btn-dark w-100" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Deal -->
  <div class="modal fade" id="dealPopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center p-5">
          <i class="fas fa-shopping-cart" style="font-size: 30px;border: 1px solid silver;border-radius: 50%;padding: 22px;text-align: center;box-shadow: 0px 4px 12px #e9e9e9;margin-bottom: 20px;"></i>
          <h3>Start a new cart?</h3>
          <div class="text-black-50 dealPopupMsg"></div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('cart') }}" class="btn btn-warning text-white w-100 mb-3">Complete previous order</a>
            </div>
            <div class="col-md-12">
              <a rel="" class="btn btn-info text-white w-100 mb-3 startNewDealCart">Start a new cart</a>
            </div>
            <div class="col-md-12">
              <button type="button" class="btn btn-dark w-100" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
    $(function() {
        $(".startNewDealCart").on('click', function() {

        $("#dealSingle").addClass('loader');

        var deal_id = $("#claimDeal").attr('rel');

        $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('claimdeal') }}",
        method:"POST",
        data:{
        deal_id:deal_id,
        empty: true
        },
        success: function(data) {

            var response = JSON.parse(data);

            if(response.data.status == 500) {
                $("#dealSingle").removeClass('loader');
                $('#dealPopup').modal('show');
            } else {

                if (response.data.statuscode == 200) {

                    $("#dealSingle").removeClass('loader');
                    $("#claimDeal").addClass('btn-disabled');

                    window.location.href = response.data.redirectUrl;
                    toastr.info(response.data.message);

                    } else {

                    $("#dealSingle").removeClass('loader');
                    toastr.error(response.data.message);

                }

            }

        }
        });

        });
    });

</script>
  <script>
      $('img').on('error', function (){
          $(this).attr('src', 'https://420finder.net/assets/img/logo01.png');
      });
      // $('img').on('load', function (){
      //     $(this).attr('src', 'https://420finder.net/assets/img/logo.png');
      // });

      $("img").on('load', function() {
          if($(this).src === "https://images.weedmaps.com/original/image_missing.jpg"){
              $(this).attr('src', 'https://420finder.net/assets/img/logo01.png');
          }
      })
          .on('error', function() {
              $(this).attr('src', 'https://420finder.net/assets/img/logo01.png');
          })
          .each(function() {
              if(this.complete) {
                  $(this).load();
              } else if(this.error) {
                  $(this).error();
              }
          });
  </script>
@guest
@if(!Cookie::get('age18'))
      <script>
          $(document).ready(function(){
              $("#agelimit").modal('show');
          });
      </script>
@endif
@endguest
  <script>
      function setCookieless() {
          location.reload();
      }
  </script>
@yield('scripts')
