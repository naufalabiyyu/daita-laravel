@extends('layouts.dashboard')

@section('title')
    Daita Skincare &#8211; Pancarkan Pesona Cantikmu 
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">My Profile</h2>
                <p class="dashboard-subtitle">Update your current profile</p>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-list p-3">
                        <div class="card-body">
                            <form id="locations" action="{{ route('dashboard-settings-redirect','dashboard-profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="address_one">Address 1</label>
                                        <input type="text" class="form-control" id="address_one" name="address_one" value="{{ $user->address_one }}">
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="address_two">Address 2</label>
                                        <input type="text" class="form-control" id="address_two" name="address_two" value="{{ $user->address_two }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="provinces_id">Province</label>
                                        {{-- <select name="provinces_id" id="provinces_id" class="form-control" v-model="provinces_id" v-if="provinces">
                                            <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                                        </select>
                                        <select v-else class="form-control"></select> --}}
                                        <select name="province_to" class="form-control">
                                            <option value="" holder>Pilih Provinsi</option>
                                            @foreach ($provinsi as $result)
                                            <option value="{{ $result->id }}">{{ $result->province }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="regencies_id">City</label>
                                          {{-- <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id" v-if="regencies">
                                            <option v-for="regency in regencies" :value="regency.id">@{{regency.name }}</option>
                                          </select>
                                          <select v-else class="form-control"></select> --}}
                                          <select name="destination" class="form-control">
                                            <option value="" holder>Pilih Kota</option>
                                        </select>
                                        </div>
                                      </div>
                                    <div class="form-group col-md-4">
                                        <label for="phone_numbergi">Postal Kode</label>
                                        <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $user->zip_code }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 ">
                                        <label for="phone_number">Country</label>
                                        <input type="text" class="form-control" id="country" name="country" value="{{ $user->country }}">
                                    </div>
                                    <div class="form-group pl-3 pl-lg-4 col-md-6">
                                        <label for="phone_number">Mobile</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">
                                        Save Now
                                    </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
          this.getProvincesData();
        },
        data: {
          provinces: null,
          regencies: null,
          provinces_id: null,
          regencies_id: null,
        },
        methods: {
          getProvincesData() {
            var self = this;
            axios.get('{{ route('api-provinces') }}')
              .then(function (response) {
                  self.provinces = response.data;
              })
          },
          getRegenciesData() {
            var self = this;
            axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
              .then(function (response) {
                  self.regencies = response.data;
              })
          },
        },
        watch: {
          provinces_id: function (val, oldVal) {
            this.regencies_id = null;
            this.getRegenciesData();
          },
        }
      });
    </script>
    <script>
        $('select[name="province_to"]').on('change', function () {
            var cityId = $(this).val();
            if (cityId) {
                $.ajax({
                    url: 'getCity/' + cityId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="destination"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="destination"]').append(
                                '<option value="' +
                                key + '">' + value + '</option>');
                        });
                    }
                });
                $('#couriers').attr("disabled", false); 
            } else {
                $('select[name="destination"]').empty();
                $('#couriers').attr("disabled", true); 
            }
        });
    </script>
@endpush



