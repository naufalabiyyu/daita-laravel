@extends('layouts.app')

@section('title')
    Daita Skincare &#8211; Pancarkan Pesona Cantikmu 
@endsection

@section('content')
    <div class="page-content page-details">
        <section class="store-breadcrumbs " data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-gallery" id="gallery">
            <div class="container ">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="jarak col-lg-7 " data-aos="zoom-in">
                                <transition name="slide-fade" mode="out-in">
                                    <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image" alt="">
                                </transition>
                                <!-- Desktop Version -->
                                <div class="d-none d-lg-flex ">
                                    <div class="d-inline-flex" v-for="(photo, index) in photos" :key="photo.id" data-aos="fade-up" data-aos-delay="200">
                                        <a href="#" @click="changeActive(index)">
                                            <img :src="photo.url" class="thumbnail-image" style="width: 191px;" :class="{ active: index == activePhoto }" alt="">
                                        </a>
                                    </div>
                                </div>
                                <!-- Mobile Version -->
                                <div class="d-lg-none ">
                                    <div class="d-inline-flex" v-for="(photo, index) in photos" :key="photo.id" data-aos="zoom-in" data-aos-delay="200">
                                        <a href="#" @click="changeActive(index)">
                                            <img :src="photo.url" class="thumbnail-image" style="width: 130px;" :class="{ active: index == activePhoto }" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="store-info col-lg-5" data-aos="fade-left" data-aos-delay="200">
                                <span>Daita</span>
                                <h1 style="margin-bottom: 15px;">{{ $product->name }}</h1>
                                <div class="price">Rp {{ number_format($product->prices) }} </div>
                                {!! $product->description !!}
                                <span class="quantity-title">Quantity: </span>
                                <div class="product-quantity d-flex flex-wrap align-items-center">
                                    <form action="#">
                                        <div class="quantity d-flex mb-3">
                                            <button type="button" data-quantity="minus" data-field="quantity"><i class="fas fa-minus"></i></button>
                                            <input type="number" id="quantity" value="1"/>
                                            <button type="button" data-quantity="plus" data-field="quantity"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </form>
                                </div>
                                @auth
                                    <form action="{{ route('detail-add', $product->id_product) }}" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="quantity" value="1" />
                                    @csrf
                                        <button type="submit" class="btn btn-success text-white mt-3 pd-cart">
                                            ADD TO CART
                                        </button> 
                                    </form>
                                @else 
                                    <a href="{{ route('login') }}" class="btn btn-success text-white mt-3 pd-cart">
                                        SIGN IN TO ADD
                                    </a>
                                @endauth
                            </div>
                        </div>
                        <div class="jarak store-description">
                            <div class="row">
                                <div class="col-lg-10">
                                    <section class="section-penggunaan" data-aos="fade-up" data-aos-delay="200">
                                        <h3>Cara Penggunaan</h3>
                                        {!! $product->how_to_use !!}
                                    </section>
                                    <section class="section-bahan" data-aos="fade-up" data-aos-delay="400">
                                        <h3 class="mt-4">Bahan - Bahan</h3>
                                        {!! $product->ingredients !!}
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        </div>
@endsection

@push('addon-script')
    <script src="{{ asset('vendor/vue/vue.js') }}"></script>
        <script>
            var gallery = new Vue({
                el: "#gallery",
                mounted() {
                    AOS.init();
                },
                data: {
                    activePhoto: 0,
                    photos: [
                        @foreach($product->galleries as $gallery)
                         {
                             id: {{ $gallery->id_gallery }},
                             url: "{{ Storage::url($gallery->photos) }}",
                         },
                         @endforeach
                    ],
                },
                methods: {
                    changeActive(id) {
                        this.activePhoto = id;

                    }
                }
            });
        </script>
        <script>
            const stock = '{{ $product->stock }}'
            jQuery(document).ready(function() {
                let quantity = 0;

                // This button will increment the value
                $('[data-quantity="plus"]').click(function(e) {
                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    fieldName = $(this).attr('data-field');
                    // Get its current value
                    var currentVal = parseInt($('input[id=' + fieldName + ']').val());
                    // If is not undefined
                    if (!isNaN(currentVal)) {
                        // Increment
                        quantity = currentVal + 1;
                        if (quantity > stock){
                            quantity = stock
                        }
                        $('input[id=' + fieldName + ']').val(quantity);
                        $('input[name=' + fieldName + ']').val(quantity);
                    } else {
                        // Otherwise put a 0 there
                        $('input[id=' + fieldName + ']').val(0);
                        $('input[name=' + fieldName + ']').val(0);
                    }
                });
                // This button will decrement the value till 0
                $('[data-quantity="minus"]').click(function(e) {
                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    fieldName = $(this).attr('data-field');
                    // Get its current value
                    var currentVal = parseInt($('input[id=' + fieldName + ']').val());
                    // If it isn't undefined or its greater than 0
                    if (!isNaN(currentVal) && currentVal > 0) {
                        // Decrement one
                        quantity = currentVal - 1;
                        $('input[id=' + fieldName + ']').val(quantity);
                        $('input[name=' + fieldName + ']').val(quantity);
                    } else {
                        // Otherwise put a 0 there
                        $('input[id=' + fieldName + ']').val(0);
                        $('input[name=' + fieldName + ']').val(0);
                    }
                });
            });

            $("#quantity").change(function() {
                const angka = parseInt($(this).val())
                
                if (angka > stock){
                    $(this).val(stock)
                    $('input[name=quantity]').val(stock);
                } else {
                    $('input[name=quantity]').val(angka);
                }
            });
        </script>
@endpush