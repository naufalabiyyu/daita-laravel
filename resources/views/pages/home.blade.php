@extends('layouts.app')

@section('title')
    Daita Skincare &#8211; Pancarkan Pesona Cantikmu 
@endsection

@section('content')
    <div class="page-content pages-home">
      <section class="store-carousel">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12" data-aos="zoom-in">
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/images/Mask Group 1.svg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="/images/Mask Group 1.svg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="/images/Mask Group 1.svg" class="d-block w-100" alt="...">
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
	  
	  	{{-- MY PRODUCT --}}
        <section class="store-products mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Our Product</h5>
                    </div>
                </div>
                <div class="row">
					@php $incrementProduct = 0 @endphp
                    @forelse ($products as $product)
                        <div class="col-6 col-md-4 col-lg-3" 
                             data-aos="fade-up" 
                             data-aos-delay="{{ $incrementProduct+= 100 }}">
								<a href="{{ route('detail', $product->slug) }}" class="component-favorites d-block">
									<div class="products-thumbnail">
										<div class="products-image" 
										style="
											@if($product->galleries->count()) 
												background-image: url('{{ Storage::url($product->galleries->first()->photos) }}')
											@else 
												background-color: #eee
											@endif 
											">
										</div>
									</div>
									<div class="products-text">{{ $product->name }}</div>
								</a>
                          </div>
					@empty
						  <div class="col-12 text-center py-5"
								 data-aos = "fade-up"
								 data-aos-delay="100">
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
		<section class="about mt-5  bg-light" id="about-section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 mt-5 " data-aos="fade-right" data-aos-delay="500">
                        <img src="/images/gallery.png" alt="" style="width: 500px; height: 360px;">
                    </div>
                    <div class="col-lg-6 mt-5 " data-aos="fade-left" data-aos-delay="600">
                        <h2 class="mb-3">Benefits of This Products</h2>
                        <img src="/images/dot.png" style="width: 35px; height: 35px;" class="mr-2 p-2">Menghilangkan Flek Hitam Menahun<br>
                        <img src="/images/dot2.png" style="width: 35px; height: 35px;" class="mr-2 p-2">Menghilangkan Bekas Jerawat<br>
                        <img src="/images/dot.png" style="width: 35px; height: 35px;" class="mr-2 p-2">Mencerahkan Wajah<br>
                        <img src="/images/dot2.png" style="width: 35px; height: 35px;" class="mr-2 p-2">Menghilangkan Jerawat<br>
                        <img src="/images/dot.png" style="width: 35px; height: 35px;" class="mr-2 p-2">Mencegah Penuaan Dini<br>
                        <img src="/images/dot2.png" style="width: 35px; height: 35px;" class="mr-2 p-2">Menghilangkan Jerawat

                    </div>
                </div>
            </div>
        </section>
        </div>
@endsection