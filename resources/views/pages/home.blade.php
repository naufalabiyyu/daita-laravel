@extends('layouts.app')

@section('title')
    Daita Skincare &#8211; Pancarkan Pesona Cantikmu 
@endsection

@section('content')
  <div class="page-content pages-home">
    <section class="store-carousel">
      <div class="slider-area slider-fashion-4-plr slider-mt-5">
          <div class="container-fluid">
              <div class="slider-active-1 nav-style-1 dot-style-1">
                  <div class="single-slider bg-light-green-3">
                      <div class="row">
                          <div class="col-12">
                              <div class="slider-content-10 text-center slider-animated-1">
                                  <h1 class="animated">Skin</h1>
                                  <h2 class="animated">Care</h2>
                                  <img class="animated" src="{{ asset('images/fashion-4-slider-1.png')}}" alt="slider">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="single-slider bg-light-green-3">
                      <div class="row">
                          <div class="col-12">
                              <div class="slider-content-10 text-center slider-animated-1">
                                  <h1 class="animated">Skin</h1>
                                  <h2 class="animated">Care</h2>
                                  <img class="animated" src="{{ asset('images/fashion-4-slider-1.png') }}" alt="slider">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="social-icon-2">
              <a href="# "><i class="fab fa-facebook-f " ></i></a>
              <a href="# "><i class="fab fa-twitter" ></i></a>
              <a href="# "><i class="fab fa-google-plus-g" ></i></a>
              <a href="# "><i class="fab fa-youtube" ></i></a>
          </div>
      </div>
    </section>
	  
	  	{{-- MY PRODUCT --}}
    <section class="store-products" style="margin-top: 50px;">
      <div class="container px-5">
          <div class="row">
              <div class="col-12 my-5 text-center" data-aos="fade-up">
                  <h2 style="font-weight: bold;">You May Also Like</h2>
              </div>
          </div>
          <div class="row">
            
            @forelse ($products as $product)
            <div class="col-6 col-md-4 col-lg-3 mb-5" data-aos="fade-up" data-aos-delay="100">
              <div class="product-area pb-155">
                  <div class="container">
                      <div class="product-slider-active-4">
                          <div class="product-wrap-plr-1">
                              <div class="product-wrap" style="box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.16); border-radius: 11px;">
                                  <div class="product-img product-img-zoom mb-25">
                                      <a href="{{ route('detail', $product->slug) }}">
                                        @if ($product->galleries->count())
                                        <img src="{{ Storage::url($product->galleries->first()->photos) }}" alt="">
                                        @else
                                        <img src="{{ asset('images/product/no-img.jpg')}}" alt="">
                                        @endif 
                                      </a>
                                  </div>
                                  <div class="product-content mt-3 px-3 pb-2 ">
                                      <h4><a href="{{ route('detail', $product->slug) }}" class="">{{ $product->name }}</a></h4>
                                      <div class="product-price">
                                          <span class="text-danger">Rp {{ number_format($product->prices) }}</span>
                                          <!-- <span class="old-price">$ 130</span> -->
                                      </div>
                                  </div>
                                  <div class="product-action-position-1 text-center">
                                      <div class="product-content">
                                          <h4><a href="{{ route('detail', $product->slug) }}">{{ $product->name }}</a></h4>
                                          <div class="product-price">
                                              <span class="text-danger">Rp {{ number_format($product->prices) }}</span>
                                              <!-- <span class="old-price">$ 130</span> -->
                                          </div>
                                      </div>
                                      <div class="product-action-wrap">
                                          <div class="product-action-cart">
                                              <a href="{{ route('detail', $product->slug) }}" class="btn btn-dark text-white rounded-0 py-1 px-4" style="font-size: 14px" >details</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
             </div>
            @empty
            <div class="col-12 text-center py-5" data-aos = "fade-up" data-aos-delay="100">
                No Product Found							  	
            </div>
            @endforelse     
          </div>
          <div class="row">
            <div class="col-12 mt-4">
              {{ $products->links() }}
            </div>
          </div>
      </div>
    </section>
		
		{{-- ABOUT --}}
		<section class="about mt-5" style="margin-top: 125px; background-color: #ECF2E7;" id="about-section">
      <div class="container">
        <div class="row">
            <!-- desktop version -->
            <div class="d-none d-lg-flex col-12 col-md-6 mt-5 mb-5" data-aos="fade-right" data-aos-delay="500">
                <img src="{{ asset('images/gallery.png')}}" alt="" style="width: 500px; height: 360px;">
            </div>
            <div class="d-none d-lg-block col-lg-6 mt-5 " data-aos="fade-left" data-aos-delay="600">
                <h2 class="mb-3">Benefits of This Products</h2>
                <img src="{{ asset('images/dot.png')}}" style="width: 35px; height: 35px;" class="mr-2 p-2">Menghilangkan Flek Hitam Menahun<br>
                <img src="{{ asset('images/dot2.png')}}" style="width: 35px; height: 35px;" class="mr-2 p-2">Menghilangkan Bekas Jerawat<br>
                <img src="{{ asset('images/dot.png')}}" style="width: 35px; height: 35px;" class="mr-2 p-2">Mencerahkan Wajah<br>
                <img src="{{ asset('images/dot2.png')}}" style="width: 35px; height: 35px;" class="mr-2 p-2">Menghilangkan Jerawat<br>
                <img src="{{ asset('images/dot.png')}}" style="width: 35px; height: 35px;" class="mr-2 p-2">Mencegah Penuaan Dini<br>
                <img src="{{ asset('images/dot2.png')}}" style="width: 35px; height: 35px;" class="mr-2 p-2">Menghilangkan Jerawat
            </div>
            <!-- mobile version -->
            <div class="d-lg-none col-12 col-md-6 mt-5 mb-5 text-center">
                <img src="{{ asset('images/gallery.png')}}" alt="" style="width: 300px; height: 230px;">
            </div>
            <div class="d-lg-none col-lg-6 mb-5 " data-aos="fade-up" data-aos-delay="600">
                <h2 class="mb-3">Benefits of This Products</h2>
                
                <img src="{{ asset('images/dot.png')}}" style="width: 35px; height: 35px;" class="mr-2 p-2">Menghilangkan Flek Hitam Menahun<br>
                <img src="{{ asset('images/dot2.png')}}" style="width: 35px; height: 35px;" class="mr-2 p-2">Menghilangkan Bekas Jerawat<br>
                <img src="{{ asset('images/dot.png')}}" style="width: 35px; height: 35px;" class="mr-2 p-2">Mencerahkan Wajah<br>
                <img src="{{ asset('images/dot2.png')}}" style="width: 35px; height: 35px;" class="mr-2 p-2">Menghilangkan Jerawat<br>
                <img src="{{ asset('images/dot.png')}}" style="width: 35px; height: 35px;" class="mr-2 p-2">Mencegah Penuaan Dini<br>
                <img src="{{ asset('images/dot2.png')}}" style="width: 35px; height: 35px;" class="mr-2 p-2">Menghilangkan Jerawat
            </div>
        </div>
    </div>      
    </section>
    <section class="instagram" style="margin-top: 125px;">
      <div class="instagram-area mega-fashion-instagram pt-160 pb-1100">
          <div class="container-fluid">
              <div class="row grid">
                  <div class="col-lg-3 col-md-6 col-sm-6 grid-item">
                      <div class="section-title-9 mega-fashion-instagram-title" data-aos="fade-up" data-aos-delay="500">
                          <h2 class="font-weight-bolder">Follow Us On <br> Instagram</h2>
                          <span class="mrg-dec">@daitacosmeticofficial</span>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 grid-item">
                      <div class="single-instafeed mb-3" data-aos="fade-up" data-aos-delay="200">
                          <a href="https://www.instagram.com/p/BuS0K_-hM3v/" target="_blank"><img src="{{ asset('images/gallery/gallery-2.jpg') }}" alt=""></a>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6 grid-item">
                      <div class="single-instafeed mb-4" data-aos="fade-up" data-aos-delay="200">
                          <a href="https://www.instagram.com/p/BtzvAhChQDC/" target="_blank"><img src="{{ asset('images/gallery/gallery-3.jpg') }}" alt=""></a>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6 grid-item">
                      <div class="single-instafeed mb-3" data-aos="fade-up" data-aos-delay="200">
                          <a href="https://www.instagram.com/p/BtumCdOBvE5/" target="_blank"><img src="{{ asset('images/gallery/gallery.jpg') }}" alt=""></a>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6 grid-item" style="margin-top: 10px;">
                      <div class="single-instafeed mb-3" data-aos="fade-up" data-aos-delay="200">
                          <a href="https://www.instagram.com/p/BtPt8sRhohb/" target="_blank" s><img src="{{ asset('images/gallery/gallery-4.jpg') }}" alt=""></a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
@endsection

@push('addon-script')
    <script src="{{ asset('vendor/slick.js ')}}"></script>
    <script src="{{ asset('vendor/images-loaded.js ')}}"></script>
    <script src="{{ asset('vendor/instafeed.js ')}}"></script>
    <script src="{{ asset('vendor/isotope.js ')}}"></script>
    <script src="{{ asset('vendor/scrollup.js')}}"></script>
    <script>
      (function($) {
          /*--------------------------------
          Slider active 1
          -----------------------------------*/
          $('.slider-active-1').slick({
              slidesToShow: 1,
              slidesToScroll: 1,
              fade: true,
              loop: true,
              dots: false,
              arrows: true,
              prevArrow: '<span class="slider-icon slider-icon-prev "><i class="fas fa-chevron-left "></i></span>',
              nextArrow: '<span class="slider-icon slider-icon-next "><i class="fas fa-chevron-right "></i></span>',
              responsive: [{
                  breakpoint: 1500,
                  settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1,
                  }
              }, {
                  breakpoint: 1199,
                  settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1,
                  }
              }, {
                  breakpoint: 991,
                  settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1,
                  }
              }, {
                  breakpoint: 767,
                  settings: {
                      autoplay: false,
                      slidesToShow: 1,
                      slidesToScroll: 1,
                  }
              }]
          });
        /*--------------------------------
          Slider active 2
        -----------------------------------*/
          $('.slider-active-2').slick({
              slidesToShow: 1,
              slidesToScroll: 1,
              fade: true,
              loop: true,
              dots: true,
              arrows: false,
              prevArrow: '<span class="slider-icon slider-icon-prev "><i class="fas fa-chevron-left "></i></span>',
              nextArrow: '<span class="slider-icon slider-icon-next "><i class="fas fa-chevron-right "></i></span>',
              responsive: [{
                  breakpoint: 1500,
                  settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1,
                  }
              }, {
                  breakpoint: 1199,
                  settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1,
                  }
              }, {
                  breakpoint: 991,
                  settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1,
                  }
              }, {
                  breakpoint: 767,
                  settings: {
                      autoplay: false,
                      slidesToShow: 1,
                      slidesToScroll: 1,
                  }
              }]
          });

          /*--
              Slider active 3
          -----------------------------------*/
          $('.slider-active-3').slick({
              arrows: false,
              infinite: true,
              slidesToShow: 1,
              dots: true,
              fade: true,
              autoplay: false,
              autoplaySpeed: 5000,
              customPaging: function(slider, i) {
                  var thumb = $(slider.$slides[i]).data('thumb');
                  return '<button class="overlay "><img src=" ' + thumb + ' "></button>';
              },
              responsive: [{
                  breakpoint: 767,
                  settings: {
                      dots: true,
                      autoplay: false,
                      autoplaySpeed: 5000,
                  }
              }]
          });


          /*--------------------------------
              slider active 4
          -----------------------------------*/
          $('.slider-active-4').slick({
              slidesToShow: 1,
              slidesToScroll: 1,
              fade: true,
              loop: true,
              dots: true,
              arrows: false,
              prevArrow: '<span class="slider-icon slider-icon-prev "><i class="fas fa-chevron-left "></i></span>',
              nextArrow: '<span class="slider-icon slider-icon-next "><i class="fas fa-chevron-right "></i></span>',
              responsive: [{
                  breakpoint: 1500,
                  settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1,
                  }
              }, {
                  breakpoint: 1199,
                  settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1,
                  }
              }, {
                  breakpoint: 991,
                  settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1,
                  }
              }, {
                  breakpoint: 767,
                  settings: {
                      autoplay: false,
                      slidesToShow: 1,
                      slidesToScroll: 1,
                  }
              }]
          });

          /*--------------------------------
              Slider active 5
          -----------------------------------*/
          $('.slider-active-5').slick({
              slidesToShow: 1,
              slidesToScroll: 1,
              fade: true,
              loop: true,
              dots: true,
              arrows: false,
              prevArrow: '<span class="slider-icon slider-icon-prev "><i class="fas fa-chevron-left "></i></span>',
              nextArrow: '<span class="slider-icon slider-icon-next "><i class="fas fa-chevron-right "></i></span>',
          });

          // Isotope active
          $('.grid').imagesLoaded(function() {
              // init Isotope
              var $grid = $('.grid').isotope({
                  itemSelector: '.grid-item',
                  percentPosition: true,
                  layoutMode: 'masonry',
                  masonry: {
                      // use outer width of grid-sizer for columnWidth
                      columnWidth: '.grid-item',
                  }
              });
          });

          /*--------------------------
              Isotope active
          ---------------------------- */

          $('.grid-2').imagesLoaded(function() {
              // init Isotope
              $('.grid-2').isotope({
                  itemSelector: '.grid-item-2',
                  percentPosition: true,
                  layoutMode: 'masonry',
                  masonry: {
                      // use outer width of grid-sizer for columnWidth
                      columnWidth: '.grid-sizer',
                  }
              });
          });
          /*--------------------------
              Isotope active
          ---------------------------- */

          $('.grid-3').imagesLoaded(function() {
              // init Isotope
              $('.grid-3').isotope({
                  itemSelector: '.grid-item-3',
                  percentPosition: true,
                  layoutMode: 'masonry',
                  masonry: {
                      // use outer width of grid-sizer for columnWidth
                      columnWidth: 1,
                  }
              });
          });
          /*------------
              ScrollUp
          ------------------ */
          $.scrollUp({
              scrollText: '<i class="fas fa-arrow-up"></i>',
              easingType: 'linear',
              scrollSpeed: 900,
              animation: 'fade'
          });
      })(jQuery);
    </script>
@endpush