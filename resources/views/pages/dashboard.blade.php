@extends('layouts.dashboard')

@section('title')
    Daita Skincare &#8211; Pancarkan Pesona Cantikmu 
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Dashboard</h2>
                <p class="dashboard-subtitle">Look what you have made today!</p>
            </div>
            {{-- <div class="dashboard-content">
                <div class="row mt-5">
                    <div class="col-12 mt-2">
                        <h5 class="mb-3">Recent Transaction</h5>
                        @foreach ($transaction_data as $transaction)
                        <a href="{{ route('dashboard-transaction-details', $transaction->id) }}" class="card card-list d-block">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}" class="w-100">
                                    </div>
                                    <div class="col-md-4">
                                        {{ $transaction->product->name ?? '' }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ $transaction->created_at ?? '' }}
                                    </div>
                                    <div class="col-md-3 {{ $transaction->transaction->transaction_status == 'SUCCESS' ? 'text-success' : ($transaction->transaction->transaction_status == 'SHIPPING' ? 'text-warning' : 'text-danger') }}">
                                    {{ $transaction->transaction->transaction_status ?? '' }}
                                    </div>
                                    <div class="col-md-1 d-none d-md-block">
                                        <img src="{{ asset('images/drawable-mdpi/dashboard-row-right.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach 
                    </div>
                </div>
            </div> --}}   
            <div class="rows">
                <div class="column" style="margin-right: -100px">
                    <a href="{{ route('home') }}" class="card-home credentialing">
                        <div class="overlay"></div>
                        <div class="circle">
                            <img src="images/tes/house.svg">
                        </div>
                        <p>Back to Store</p>
                    </a>
                </div>
                <div class="column">
                    <a href="{{ route('dashboard-transactions') }}" class="card-home credentialing">
                        <div class="overlay"></div>
                        <div class="circle">
                            <img src="images/tes/transaction.svg">
                        </div>
                        <p>My Transaction</p>
                    </a>
                </div>
                <div class="column" style="margin-left: -100px">
                    <a href="{{ route('dashboard-profile') }}" class="card-home credentialing">
                        <div class="overlay"></div>
                        <div class="circle">
                            <img src="images/tes/setting.svg">
                        </div>
                        <p>My Profile</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

