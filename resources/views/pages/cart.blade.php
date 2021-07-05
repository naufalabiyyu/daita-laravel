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
                                            <th>PRICE/PCS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $totalPrice = 0 @endphp
                                        @foreach ($carts as $index=>$cart)
                                        <tr>
                                            <td style="width: 25%;">
                                                @if ($cart->product->galleries)
                                                    <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}" alt="" class="cart-image">
                                                @endif
                                            </td>
                                            <td style="width: 25%;">
                                                <div class="product-title items">{{ $cart->product->name }}</div>
                                            </td>
                                            <td style="width: 25%;" class="align-middle">
                                                <form action="#">
                                                <input type="hidden" value="{{ csrf_token() }}" id="quantityToken">
                                                    <div class="quantity">
                                                        <button type="button" data-quantity="minus" data-field="formInput{{ $index }}" data-stock="{{ $cart->product->stock }}" data-productId="{{ $cart->id }}" data-productPrice="{{ $cart->product->prices }}"><i class="fas fa-minus"></i></button>
                                                        <input type="text" data-formQuantity="quantity" name="formInput{{ $index }}" id="quantity{{ $index }}" value="{{ $cart->quantity }}" data-stock="{{ $cart->product->stock }}" data-productId="{{ $cart->id }}" data-productPrice="{{ $cart->product->prices }}"/>
                                                        <button type="button" data-quantity="plus" data-field="formInput{{ $index }}" data-stock="{{ $cart->product->stock }}" data-productId="{{ $cart->id }}" data-productPrice="{{ $cart->product->prices }}"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td style="width: 25%;">
                                                {{-- <div class="product-title">Rp {{ number_format($cart->product->prices ) }}</div> --}}
                                                <div class="product-title" id="productPrice{{ $index }}" >{{ $cart->product->prices }}</div>
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
                                <div class="form-row pl-3">
                                    <div class="form-group col-lg-7 ">
                                        <h2>Shipping Information</h2>
                                    </div>
                                    <div class="form-group col-lg-5 text-right">
                                        <a href="{{ route('dashboard-profile') }}" class="mx-3 btn btn-success mt-3">Edit Shipping</a>
                                    </div>
                                    
                                </div>
                                <div class="form-group  col-lg-12">
                                    <label for="address_one">Address 1<p style="color: #F32355; display: inline;"> *</p> </label>
                                    <input type="text" class="form-control" id="address_one" name="address_one" value="{{ $user->address_one }}" readonly>
                                </div>
                                <div class="form-group  col-lg-12 ">
                                    <label for="address_two">Address 2<p style="color: #F32355; display: inline;"> *</p></label>
                                    <input type="text" class="form-control" id="address_two" name="address_two" value="{{ $user->address_two }}" readonly>
                                </div>

                                <div class="form-row pl-3 pr-3">
                                    <div class="form-group col-lg-6">
                                        <label for="provinces_id">Province<p style="color: #F32355; display: inline;"> *</p></label>
                                        {{-- <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id" >
                                            <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                                        </select> --}}
                                        {{-- <input type="text" class="form-control" value="{{ $provinsi->id }}" readonly> --}}
                                        <select name="provinces_id" class="form-control" disabled style="appearance: none;">
                                            <option value="" holder></option>
                                            @foreach ($provinsi as $result)
                                            <option value="{{ $result->id }}" @php if ($user->provinces_id == $result->id) { echo "selected"; } @endphp  >{{ $result->province }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 ">
                                        <label for="regencies_id">City<p style="color: #F32355; display: inline;"> *</p></label>
                                        {{-- <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies" v-model="regencies_id">
                                            <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                                        </select> --}}
                                        <select name="regencies_id" class="form-control" disabled style="appearance: none;"> </select>
                                    </div>
                                </div>
                                <div class="form-row pl-3 pr-3">
                                    <div class="form-group col-lg-6">
                                        <label for="zip_code">Postal Kode<p style="color: #F32355; display: inline;"> *</p></label>
                                        <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $user->zip_code }}" readonly>
                                    </div>
                                    <div class="form-group col-lg-6 ">
                                        <label for="country">Country<p style="color: #F32355; display: inline;"> *</p></label>
                                        <input type="text" class="form-control" id="country" name="country" value="{{ $user->country }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group  col-lg-12">
                                    <label for="phone_number">Mobile<p style="color: #F32355; display: inline;"> *</p></label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5" data-aos="fade-left" data-aos-delay="500">
                            <div class="card card-details card-right">
                                <h2 class="">Payment Details</h2>
                                <select name="couriers" id="couriers" class="form-control mt-3 mb-2" disabled required>
                                    <option value="" holder>Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS Indonesia</option>
                                </select>
                                <select name="services" id="services" class="form-control mt-3 mb-2">
                                </select>
                                <table class="pay-info">
                                </tr>
                                    <td width="50% " >Sub total</td>
                                     <td width="50% " class="text-right" style="color: green;" id="subTotal"></td>
                                </tr>
                                <tr>
                                    <td width="50% " >Pajak</td>
                                        <td width="50% " class="text-right ">10%</td>
                                </tr>
                                <tr>
                                    <td width="50%">Ongkir</td>
                                    <input type="hidden" name="ongkir">
                                    <td width="50% " class="text-right" id="ongkir">Rp 0</td>
                                </tr>
                                    <td width="50% " >Total</td>
                                     <td width="50% " class="text-right" style="color: green;" id="totalBiaya"></td>
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
    <script src="{{ asset('vendor/vue/vue.js')}}"></script>
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
                    cities: null,
                    selectedCity: null,
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
                    getCity: function() {
                        axios.get('getCity/' + {{ $user->provinces_id ? $user->provinces_id : 0 }})
                        .then(function (response) {
                            cities = response.data
                            console.log(cities)
                        })
                     }
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
                let province_id = "{{ $user->provinces_id }}"
                if (province_id != "") {
                    console.log("jalan")
                    $.ajax({
                        url: 'getCity/' + {{ $user->provinces_id ? $user->provinces_id : 0 }},
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $.each(data, function (key, value) {
                                $('select[name="regencies_id"]').append(
                                    '<option value="' +
                                    value.id + '">' + value.city_name + '</option>');
                            });
                            $('select[name="regencies_id"]').val({{ $user->regencies_id }})
                            $('#couriers').attr("disabled", false); 
                        }
                    });
                }

                let totalBiayaValue = 0;

                const jumlahItems = document.querySelectorAll(".items");
                const subTotal = document.getElementById('subTotal')
                const totalBiaya = document.getElementById('totalBiaya')
                let productPriceShow;
                let totalHarga = 0;
                let hargaPajak = 0;

                for(i = 0; i < jumlahItems.length; i++){
                    const firstQuantity = document.getElementById('quantity' + i).value
                    let hargaProduk = document.getElementById('productPrice' + i).innerHTML
                    productPriceShow = document.getElementById('productPrice' + i)
                    const firstHargaProduk = hargaProduk * firstQuantity

                    totalHarga += firstHargaProduk;
                    hargaPajak = (10 / 100) * totalHarga;
                    
                    productPriceShow.innerText = 'Rp. ' + parseFloat(hargaProduk, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()
                    subTotal.innerText = 'Rp. ' + parseFloat(totalHarga, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()
                    totalBiaya.innerText = 'Rp. ' + parseFloat(totalHarga + hargaPajak, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()
                    totalBiayaValue = totalHarga + hargaPajak
                }

                // Ketika quantity diganti manual tanpa klik tombol
                let currenValueInput = 0;
                $("[data-formQuantity='quantity' ] ").on('focusin', function(e) {
                    currenValueInput = parseInt($(this).val());
                });
                
                $("[data-formQuantity='quantity' ] ").change(function(e) {
                    let quantity = 0
                    let stockBerubah = 0
                    const angka = parseInt($(this).val())
                    const stock = $(this).attr('data-stock');
                    const hargaProduk = $(this).attr('data-productPrice');
                    
                    if (angka > stock){
                        quantity = stock
                        $(this).val(stock)
                        $('input[name=quantity]').val(quantity);
                    } else {
                        quantity = angka
                        $('input[name=quantity]').val(quantity);
                    }

                    // Update Produk Price
                    if (currenValueInput < quantity) {
                        updateHarga = hargaProduk * (quantity - currenValueInput)
                        totalHarga += updateHarga;
                    } else {
                        updateHarga = hargaProduk * (currenValueInput - quantity)
                        totalHarga -= updateHarga;
                    }

                    hargaPajak = (10 / 100) * totalHarga;

                    subTotal.innerText = 'Rp. ' + parseFloat(totalHarga, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()
                    totalBiaya.innerText = 'Rp. ' + parseFloat(totalHarga + hargaPajak, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()
                    totalBiayaValue = totalHarga + hargaPajak

                    // Update quantity 
                    let productId = $(this).attr('data-productId');
                    let CSRFToken = document.getElementById("quantityToken").value

                    $.ajax({
                        url: `cart/${productId}`,
                        type: 'post',
                        data: {
                            _token: CSRFToken,
                            quantity: quantity
                        },
                    });
                });
            
                // This button will increment the value
                $("[data-quantity='plus' ] ").click(function(e) {
                    const hargaProduk = $(this).attr('data-productPrice');
                    let quantity;
                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    fieldName = $(this).attr('data-field');
                    // Get stock
                    stock = $(this).attr('data-stock');
                    // Get its current value
                    var currentVal = parseInt($('input[name=' + fieldName + ']').val());
                    // If is not undefined
                    if (!isNaN(currentVal)) {
                        // Increment
                        quantity = currentVal + 1;
                        if (quantity > stock) {
                            quantity = stock
                        }
                        $('input[name=' + fieldName + ']').val(quantity);
                    } else {
                        // Otherwise put a 0 there
                        quantity = 0;
                        $('input[name=' + fieldName + ']').val(quantity);
                    }

                    // Update Produk Price
                    updateHarga = hargaProduk * (quantity - currentVal )
                    totalHarga += updateHarga;
                    hargaPajak = (10 / 100) * totalHarga;
                    subTotal.innerText = 'Rp. ' + parseFloat(totalHarga, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()
                    totalBiaya.innerText = 'Rp. ' + parseFloat(totalHarga + hargaPajak, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()
                    totalBiayaValue = totalHarga + hargaPajak

                    // Update quantity 
                    let productId = $(this).attr('data-productId');
                    let CSRFToken = document.getElementById("quantityToken").value

                    $.ajax({
                        url: `cart/${productId}`,
                        type: 'post',
                        data: {
                            _token: CSRFToken,
                            quantity: quantity
                        },
                    });
                });

                // This button will decrement the value till 0
                $("[data-quantity='minus' ] ").click(function(e) {
                    const hargaProduk = $(this).attr('data-productPrice');
                    let quantity;

                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    fieldName = $(this).attr('data-field');
                    // Get its current value
                    var currentVal = parseInt($('input[name=' + fieldName + ']').val());
                    // If it isn't undefined or its greater than 0
                    if (!isNaN(currentVal) && currentVal > 0) {
                        // Decrement one
                        quantity = currentVal - 1;
                        $('input[name=' + fieldName + ']').val(quantity);
                    } else {
                        // Otherwise put a 0 there
                        quantity = 0;
                        $('input[name=' + fieldName + ']').val(quantity);
                    }

                    updateHarga = hargaProduk * (currentVal - quantity)
                    totalHarga -= updateHarga;
                    hargaPajak = (10 / 100) * totalHarga;
                    subTotal.innerText = 'Rp. ' + parseFloat(totalHarga, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()
                    totalBiaya.innerText = 'Rp. ' + parseFloat(totalHarga + hargaPajak, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()
                    totalBiayaValue = totalHarga + hargaPajak

                    // Update quantity 
                    let productId = $(this).attr('data-productId');
                    let CSRFToken = document.getElementById("quantityToken").value

                    $.ajax({
                        url: `cart/${productId}`,
                        type: 'post',
                        data: {
                            _token: CSRFToken,
                            quantity: quantity
                        },
                    });
                });

                $('#services').hide();
    
                $('select[name="couriers"]').on('change', function () {
                    var courier = $(this).val();
                    const ongkirShow = document.getElementById("ongkir")
                    const CSRFToken = '{{csrf_token()}}'
                    const dataRequest = {
                        destination: $('select[name=regencies_id] option').filter(':selected').val(),
                        courier: courier,
                    }
                    $.ajax({
                        url: 'getOngkir',
                        type: "POST",
                        dataType: "json",
                        data: {
                            request: dataRequest,
                            _token: CSRFToken
                        },
                        success: function (data) {
                            $('#services').show();
                            $('select[name="services"]').empty();

                            // Reset ongkir
                            ongkirShow.innerText = 'Rp. ' + parseFloat(0, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()

                            $('select[name="services"]').append("<option value='0'>Pilih Layanan</option>");

                            data.map(item => {
                                $('select[name="services"]').append(
                                    '<option value="' + item.service + ' - ' + ' est ' + item.cost[0].etd + ' hari'
                                        + '" ongkir="' + item.cost[0].value + '">' + item.service + ' - ' + ' est ' + item.cost[0].etd + ' hari' + '</option>');
                            })
                        }
                    });
                });

                $('select[name="services"]').on('change', function () {
                    let hargaOngkir = parseInt($('option:selected', this).attr('ongkir'))
                    let ongkirShow = document.getElementById("ongkir")
                    let totalBiaya = document.getElementById('totalBiaya')

                    $('input[name=ongkir]').val(hargaOngkir)
                    
                    totalBiaya.innerText = 'Rp. ' + parseFloat(totalBiayaValue + hargaOngkir, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()

                    ongkirShow.innerText = 'Rp. ' + parseFloat(hargaOngkir, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()
                });

            });
        </script>
@endpush
