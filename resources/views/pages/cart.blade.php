@extends('layouts.app')

@section('title')
    Daita Skincare &#8211; Pancarkan Pesona Cantikmu 
@endsection

@section('content')
    <!-- page content -->
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>


        <section class="store-cart" >
            <div class="container">
                <div class="card card-details " data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body">
                        <div class="row" data-aos="fade-up" data-aos-delay="100">
                            <div class="col-12 table-responsive">
                                <table class="table table-borderless table-cart">
                                    <thead>
                                        <tr>
                                            <th>IMAGE</th>
                                            <th>PRODUCT NAME</th>
                                            <th>QUANTITY</th>
                                            <th>PRICE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $totalPrice = 0 @endphp
                                       @foreach ($carts as $cart)
                                        <tr>
                                            <td style="width: 25%;">
                                                @if ($cart->product->galleries)
                                                    <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}" alt="" class="cart-image">
                                                @endif
                                            </td>
                                            <td style="width: 25%;">
                                                <div class="product-title">{{ $cart->product->name }}</div>
                                            </td>
                                            <td style="width: 25%;" class="align-middle">
                                                <form action="#">
                                                    <div class="quantity">
                                                        <button type="button" data-quantity="minus" data-field="quantity"><i class="fas fa-minus"></i></button>
                                                        <input type="text" name="quantity" value="1" />
                                                        <button type="button" data-quantity="plus" data-field="quantity"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td style="width: 25%;">
                                                <div class="product-title">Rp {{ number_format($cart->product->prices) }}</div>
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn"><i class="fas fa-times fa-2x" style="color: #F32355;"></i></button>
                                                </form>
                                            </td>
                                        </tr> 
                                        @php $totalPrice += $cart->product->prices @endphp                                          
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('checkout') }}" id='locations' enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-lg-7 " data-aos="fade-right" data-aos-delay="500">
                            <div class="card card-details  ">
                                <div class="form-group  col-lg-12">
                                    <h2 class="">Shipping Address</h2>
                                </div>                               
                                <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                                <div class="form-group  col-lg-12">
                                    <label for="address_one">Address 1</label>
                                    <input type="text" class="form-control" id="address_one" name="address_one" value="Jl. Kahuripan Raya">
                                </div>
                                <div class="form-group  col-lg-12 ">
                                    <label for="address_two">Address 2</label>
                                    <input type="text" class="form-control" id="address_two" name="address_two" value="Perumnas 3">
                                </div>

                                <div class="form-row pl-3 pr-3">
                                    <div class="form-group col-lg-6">
                                        <label for="provinces_id">Province</label>
                                        <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id" >
                                            <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                                        </select>
                                        <select v-else class="form-control"></select>
                                    </div>
                                    <div class="form-group col-lg-6 ">
                                        <label for="regencies_id">City</label>
                                        <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies" v-model="regencies_id">
                                            <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row pl-3 pr-3">
                                    <div class="form-group col-lg-6">
                                        <label for="zip_code">Postal Kode</label>
                                        <input type="text" class="form-control" id="zip_code" name="zip_code" value="15138">
                                    </div>
                                    <div class="form-group col-lg-6 ">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="country" name="country" value="Indonesia">
                                    </div>
                                </div>
                                <div class="form-group  col-lg-12">
                                    <label for="phone_number">Mobile</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="628 5152 5354">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-5" data-aos="fade-left" data-aos-delay="500">
                            <div class="card card-details card-right">
                                <h2 class="">Payment Information</h2>
                                <table class="pay-info">
                                <tr>
                                        <td width="50%">ID transaction</td>
                                        <td class="text-right" style="color: #B1B1B1;">#DA280800</td>
                                </tr>
                                </tr>
                                    <td width="50% " >Sub total</td>
                                     <td width="50% " class="text-right" style="color: green;">Rp {{ number_format($totalPrice 
                                     ?? 0) }}</td>
                                </tr>
                                <tr>
                                    <td width="50% " >Pajak</td>
                                        <td width="50% " class="text-right ">10%</td>
                                </tr>
                                <tr>
                                        <td width="50% " >Ongkir</td>
                                    <td width="50% " class="text-right ">Rp10.000</td>
                                </tr>
                                    <td width="50% " >Total Biaya</td>
                                     <td width="50% " class="text-right" style="color: green;">Rp {{ number_format($totalPrice+10000 ?? 0) }}</td>
                                </tr>
                                
                            </table>
                            <hr>
                            <p class="payment-instruction ">
                                Please complete the payment before you <br> continue shopping
                            </p>
                            <button type="submit" class="btn btn-success text-white mt-3 pd-cart ">Checkout Now</button>
                        </div>
                    </div>
                </div>
            </form>
           
            
            
            </div>
        </section>
        </div>
        </section>




    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script>
            var locations = new Vue({
                el: "#locations",
                mounted() {
                    AOS.init();
                    this.getProvincesData();
                },
                data: {
                    provinces: null,
                    regencies: null,
                    provinces_id: null,
                    regencies_id: null,
                },
                methods: {
                    getProvincesData(){
                        var self = this;
                        axios.get('{{ route('api-provinces') }}')
                            .then(function(response){
                                self.provinces = response.data;
                            })
                    },
                    getRegenciesData(){
                        var self = this;
                        axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                            .then(function(response){
                                self.regencies = response.data;
                            })
                    }, 
                },
                watch: {
                    provinces_id: function(val, oldVal) {
                        this.regencies_id = null;
                        this.getRegenciesData();
                    },
                }
            });
        </script>
        <script>
            jQuery(document).ready(function() {
                // This button will increment the value
                $("[data-quantity='plus' ] ").click(function(e) {
                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    fieldName = $(this).attr('data-field');
                    // Get its current value
                    var currentVal = parseInt($('input[name=' + fieldName + ']').val());
                    // If is not undefined
                    if (!isNaN(currentVal)) {
                        // Increment
                        $('input[name=' + fieldName + ']').val(currentVal + 1);
                    } else {
                        // Otherwise put a 0 there
                        $('input[name=' + fieldName + ']').val(0);
                    }
                });
                // This button will decrement the value till 0
                $("[data-quantity='minus' ] ").click(function(e) {
                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    fieldName = $(this).attr('data-field');
                    // Get its current value
                    var currentVal = parseInt($('input[name=' + fieldName + ']').val());
                    // If it isn't undefined or its greater than 0
                    if (!isNaN(currentVal) && currentVal > 0) {
                        // Decrement one
                        $('input[name=' + fieldName + ']').val(currentVal - 1);
                    } else {
                        // Otherwise put a 0 there
                        $('input[name=' + fieldName + ']').val(0);
                    }
                });
            });
            
        </script>
@endpush