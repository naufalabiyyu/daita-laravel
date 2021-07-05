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
            <div class="rows">
                <div class="column" style="margin-right: -100px">
                    <a href="{{ route('home') }}" class="card-home credentialing">
                        <div class="overlay"></div>
                        <div class="circle">
                            <img src="{{ asset('public/images/tes/house.svg') }}">
                        </div>
                        <p>Back to Store</p>
                    </a>
                </div>
                <div class="column">
                    <a href="{{ route('dashboard-transactions') }}" class="card-home credentialing">
                        <div class="overlay"></div>
                        <div class="circle">
                            <img src="{{ asset('public/images/tes/transaction.svg') }}">
                        </div>
                        <p>My Transaction</p>
                    </a>
                </div>
                <div class="column" style="margin-left: -100px">
                    <a href="{{ route('dashboard-profile') }}" class="card-home credentialing">
                        <div class="overlay"></div>
                        <div class="circle">
                            <img src="{{ asset('public/images/tes/setting.svg') }}">
                        </div>
                        <p>My Profile</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

