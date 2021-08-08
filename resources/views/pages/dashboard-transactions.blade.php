@extends('layouts.dashboard')

@section('title')
    Daita Skincare &#8211; Pancarkan Pesona Cantikmu 
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Transaction</h2>
                <p class="dashboard-subtitle">Big result start from the small one</p>
            </div>
            <div class="dashboard-content">
                <div class="row mt-5">
                    <div class="col-12 mt-2">
                        <h5 class="mb-3">Recent Transaction</h5>
                        @foreach ($transactions as $transaction)
                            <a href="{{ route('dashboard-transaction-details', $transaction->id_transaction_detail) }}" class="card card-list d-block">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}" class="w-75">
                                    </div>
                                    <div class="col-md-4">
                                        {{ $transaction->product->name ?? '' }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ $transaction->created_at ?? '' }}
                                    </div>
                                    <div class="col-md-3 {{ $transaction->transaction->transaction_status == 'SUCCESS' ? 'text-success' : ($transaction->transaction->transaction_status == 'SHIPPING' ? 'text-warning': ($transaction->transaction->transaction_status == 'PROCESS' ? 'text-warning' : 'text-danger'))  }}">
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
            </div>
        </div>
    </div>
@endsection

