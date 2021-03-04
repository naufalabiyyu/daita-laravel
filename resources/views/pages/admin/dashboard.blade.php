@extends('layouts.admin')

@section('title')
    Daita Skincare &#8211; Pancarkan Pesona Cantikmu 
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard</h2>
                <p class="dashboard-subtitle">this is daita skincare admin page!</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Customer
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $customer }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Revenue
                                </div>
                                <div class="dashboard-card-subtitle">
                                   Rp {{ $revenue }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Transaction
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $transaction }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 mt-2">
                    <h5 class="mb-3">Recent Transaction</h5>
                    <a href="/dashboard-transaction-details-admin.html" class="card card-list d-block">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="/images/drawable-mdpi/dashboard-icon-product-1.png" alt="">
                                </div>
                                <div class="col-md-4">
                                    Brightening Facial Foam
                                </div>
                                <div class="col-md-3">
                                    17 November, 2020
                                </div>
                                <div class="col-md-3 action-process">
                                    Process
                                </div>
                                <div class="col-md-1 d-none d-md-block">
                                    <img src="/images/drawable-mdpi/dashboard-row-right.png" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/dashboard-transaction-details-admin.html" class="card card-list d-block">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="/images/drawable-mdpi/dashboard-icon-product-2.png" alt="">
                                </div>
                                <div class="col-md-4">
                                    Brightening Night Cream
                                </div>
                                <div class="col-md-3">
                                    10 November, 2020
                                </div>
                                <div class="col-md-3 action-success">
                                    Success
                                </div>
                                <div class="col-md-1 d-none d-md-block">
                                    <img src="/images/drawable-mdpi/dashboard-row-right.png" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/dashboard-transaction-details-admin.html" class="card card-list d-block">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="/images/drawable-mdpi/dashboard-icon-product-3.png" alt="">
                                </div>
                                <div class="col-md-4">
                                    Brightening Day Cream
                                </div>
                                <div class="col-md-3">
                                    08 Oktober, 2020
                                </div>
                                <div class="col-md-3 action-success">
                                    Success
                                </div>
                                <div class="col-md-1 d-none d-md-block">
                                    <img src="/images/drawable-mdpi/dashboard-row-right.png" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/dashboard-transaction-details-admin.html" class="card card-list d-block">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <img src="/images/drawable-mdpi/dashboard-icon-product-4.png" alt="">
                                </div>
                                <div class="col-md-4">
                                    Baby Face Serum
                                </div>
                                <div class="col-md-3">
                                    11 Agustus, 2020
                                </div>
                                <div class="col-md-3 action-success">
                                    Success
                                </div>
                                <div class="col-md-1 d-none d-md-block">
                                    <img src="/images/drawable-mdpi/dashboard-row-right.png" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection

