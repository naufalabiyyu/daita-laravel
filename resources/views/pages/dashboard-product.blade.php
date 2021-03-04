@extends('layouts.dashboard')

@section('title')
    Daita Skincare &#8211; Pancarkan Pesona Cantikmu 
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">My Products</h2>
                <p class="dashboard-subtitle">Manage it well and get money</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <a href="/dashboard-create-product.html" class="btn btn-success">Add New Product</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="#" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/drawable-xxhdpi/product-card-6.png" alt="" class="w-100 mb-2">
                                <div class="myproduct-title ">Baby Face Serum</div>
                                <div class="product-price text-danger">Rp 255.000</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="#" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/drawable-xxhdpi/product-card-5.png" alt="" class="w-100 mb-2">
                                <div class="myproduct-title ">Night Cream</div>
                                <div class="product-price text-danger">Rp 100.000</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="#" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/drawable-xxhdpi/product-card-4.png" alt="" class="w-100 mb-2">
                                <div class="myproduct-title ">Day Cream</div>
                                <div class="product-price text-danger">Rp 80.000</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="#" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/drawable-xxhdpi/product-card-3.png" alt="" class="w-100 mb-2">
                                <div class="myproduct-title ">Facial Foam</div>
                                <div class="product-price text-danger">Rp 35.000</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="#" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/drawable-xxhdpi/product-card-2.png" alt="" class="w-100 mb-2">
                                <div class="myproduct-title ">Paket Reguler</div>
                                <div class="product-price text-danger">Rp 200.000</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="#" class="card card-dashboard-product d-block">
                            <div class="card-body">
                                <img src="/images/drawable-xxhdpi/product-card-1.png" alt="" class="w-100 mb-2">
                                <div class="myproduct-title ">Paket Premium</div>
                                <div class="product-price">Rp 455.000</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



