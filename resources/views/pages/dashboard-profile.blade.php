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
                            <form action="">
                                <div class="form-row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" value="naufalabiyyu">
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" value="naufalabiyyu@gmail.com">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="addressOne">Address 1</label>
                                        <input type="text" class="form-control" id="addresOne" name="addressOne" value="Jl. Kahuripan Raya">
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="addressTwo">Address 2</label>
                                        <input type="text" class="form-control" id="addressTwo" name="addressTwo" value="Perumnas 3">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="province">Province</label>
                                        <select name="province" id="province" class="form-control">
                                            <option value="Banten">Banten</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label for="city">City</label>
                                        <select name="city" id="city" class="form-control">
                                            <option value="Tangerang">Tangerang</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Postal Kode</label>
                                        <input type="text" class="form-control" id="AddresOne" name="AddressOne" value="15138">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 ">
                                        <label for="">Country</label>
                                        <input type="text" class="form-control" id="AddresOne" name="AddressOne" value="Indonesia">
                                    </div>
                                    <div class="form-group pl-3 pl-lg-4 col-md-6">
                                        <label for="">Mobile</label>
                                        <input type="text" class="form-control" id="Mobile" name="Mobile" value="+628 5152 5354">
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-success px-5">
                                    Save Now
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



