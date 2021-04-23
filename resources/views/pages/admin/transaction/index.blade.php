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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-md-4">
                                <form method="get" action="/rekap">
                                    @csrf
                                    <div class="row mb-5 text-center">
                                      <div class="col-sm-3">
                                        <label>Dari tanggal: </label>
                                        <input id="date-dari" width="270" name="dari" value=""/>
                                      </div>
                                      <div class="col-sm-3">
                                        <label>Hingga tanggal: </label>
                                        <input id="date-ke" width="270" name="ke" value=""/>
                                      </div>
                                    
                                      <div class="row">
                                        <div class="col-sm-3 mr-3">
                                            <button type="submit" class="btn btn-primary px-3" name="button">Filter Tanggal</button>
                                          </div>
                                          <div class="col-sm-3">
                                            <a href="" class="btn btn-success px-4">Ekspor Excel</a> 
                                        </div>
                                      </div>
                                    </div>
                                      
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Status</th>
                                                <th>Dibuat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
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
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script>
    $(document).ready(function () {
        
        $('#date-dari').datepicker();


        $('#date-ke').datepicker();
    });
    </script>
   <script>
       var datatable = $('#crudTable').DataTable({
           processing: true,
           serverSide: true,
           ordering: true,
           ajax: {
               url: '{!! url()->current() !!}',
           },
           columns: [
               { data: 'id', name: 'id'},
               { data: 'user.name', name: 'user.name'},
               { data: 'total_price', name: 'total_price'},
               { data: 'transaction_status', name: 'transaction_status'},
               { data: 'created_at', name: 'created_at'},
               {
                   data: 'action',
                   name: 'action',
                   orderable: false,
                   searcable: false,
                   width: '15%'
               },
           ]
       })
    </script> 
@endpush

