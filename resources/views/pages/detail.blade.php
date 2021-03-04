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
                                {!! $product->description !!}
                                <div class="price">Rp {{ number_format($product->prices) }} </div>
                                @auth
                                    <form action="{{ route('detail-add', $product->id) }}" method="POST" enctype="multipart/form-data">
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
    <script src="/vendor/vue/vue.js"></script>
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
                             id: {{ $gallery->id }},
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
@endpush