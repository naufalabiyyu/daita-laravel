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
            {{-- <div class="dashboard-content">
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
            </div> --}}
            <div class="rows">
                <div class="column" style="margin-right: -100px">
                    <a href="{{ url('admin/user') }}" class="card-admin credentialing">
                        <div class="overlay"></div>
                        <div class="circle">
                            <img src="images/tes/testimonials.svg">
                        </div>
                        <p>Customer</p>
                        <h2>{{ $customer }}</h2>
                    </a>
                </div>
                <div class="column">
                    <a href="{{ url('/admin/transaction') }}" class="card-admin credentialing">
                        <div class="overlay"></div>
                        <div class="circle">
                            <img src="images/tes/money.svg">
                        </div>
                        <p>Revenue</p>
                        <h3>Rp {{ $revenue }}</h3>
                    </a>
                </div>
                <div class="column" style="margin-left: -100px">
                    <a href="{{ url('/admin/transaction') }}" class="card-admin credentialing">
                        <div class="overlay"></div>
                        <div class="circle">
                            <img src="images/tes/deal.svg">
                        </div>
                        <p>Transaction</p>
                        <h2>{{ $transaction }}</h2>
                    </a>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
@endsection

