@extends('layouts.admin')

@section('title')
    Daita Skincare &#8211; Pancarkan Pesona Cantikmu 
@endsection

@section('content')
   <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">#DA280800</h2>
                <p class="dashboard-subtitle">Transactions Details</p>
            </div>
            <div class="dashboard-content" id="transactionDetails">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-list mt-3">
                            <div class="card-body p-md-5">
                                <div class="col-12 col-md-12">
                                    <div class="row">
                                        <!-- Image Mobile Version -->
                                        <div class="col-12 d-lg-none mb-3 mt-3">
                                            <img src="/images/drawable-mdpi/product-details-dashboard.png" alt="">
                                        </div>
                                        <!-- End -->
                                        <div class="col-12 col-md-3">
                                            <div class="product-title">ID Transaction</div>
                                            <div class="product-subtitle">#DA280800</div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="product-title">Product Name</div>
                                            <div class="product-subtitle">Brightening Facial Foam</div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="product-title">Total Amount</div>
                                            <div class="product-subtitle">Rp. 35.000</div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="product-title">Customer Name</div>
                                            <div class="product-subtitle">naufalabiyyu</div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="product-title">Date of Transaction</div>
                                            <div class="product-subtitle">17 November, 2020</div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="product-title">Payment Status</div>
                                            <div class="product-subtitle text-success">Success</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-4 mb-3">
                                            <h5>Shipping Information</h5>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Address 1</div>
                                                    <div class="product-subtitle">Jl. Kahuripan Raya</div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Address 2</div>
                                                    <div class="product-subtitle">Perumnas 3</div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Province</div>
                                                    <div class="product-subtitle">Banten</div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">City</div>
                                                    <div class="product-subtitle">Tangerang</div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Postal Kode</div>
                                                    <div class="product-subtitle">15138</div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">Country</div>
                                                    <div class="product-subtitle">Indonesia</div>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <div class="product-title ">Mobile</div>
                                                    <div class="product-subtitle ">+628 5152 5354</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Image Desktop Version -->
                                        <div class="col-12 col-md-6 d-none d-lg-flex">
                                            <img src="/images/drawable-mdpi/product-details-dashboard.png" alt="">
                                        </div>
                                        <!-- End -->
                                        <div class="col-12 col-md-3">
                                            <div class="product-title">Status</div>
                                            <select name="status" id="status" class="form-control" v-model="status">
                                                        <option value="UNPAID">UNPAID</option>
                                                        <option value="PENDING">PENDING</option>
                                                        <option value="SHIPPING">SHIPPING</option>
                                                        <option value="SUCCESS">SUCCESS</option>
                                            </select>
                                        </div>
                                        <template v-if="status == 'SHIPPING' "> 
                                            <div class=" col-md-4">
                                                <div class="product-title">Input Resi</div>
                                                <input type="text" class="form-control" name="resi" v-model="resi" > 
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-success px-3 mt-4">Update Resi</button>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-5">
                                            <a href="/dashboard-transaction.html" class="btn btn-success px-5">Save Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var transactionDetails = new Vue({
            el: '#transactionDetails',
            data: {
                status: "SHIPPING",
                resi: "CGK2H03789568816",
            },
        })
    </script>
@endpush

