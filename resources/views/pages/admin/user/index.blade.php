@extends('layouts.admin')

@section('title')
    Daita Skincare &#8211; Pancarkan Pesona Cantikmu 
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard</h2>
                <p class="dashboard-subtitle">This is daita skincare admin page!</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-md-4">
                                <a href="{{ route('user.create') }}" class="btn btn-success mb-3">
                                    + Add New User
                                </a>
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Roles</th>
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
    <script>
        var self = this; 
        
        const dataTable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                { data: 'id', name: 'id'},
                { data: 'name', name: 'name'},
                { data: 'email', name: 'email'},
                { data: 'phone_number', name: 'phone_number'},
                { data: 'roles', name: 'roles'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%'
                },
            ]
        })
    

        function refreshDataTable() {
            // Hapus baris
            dataTable.rows().remove().draw();
            // Isi baris
            dataTable;
        }

        $(function() {
            dataTable;
        });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        $("#crudTable tbody").on("click", "#delete", function () {
            let dataTable = $("#crudTable").DataTable();
            let data = dataTable.row($(this).parents("tr")).data();
            let itemId = $(this).attr("itemId");

            Swal.fire({
                title: 'Konfirmasi',
                text: "Yakin ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#34a0a4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let CSRFToken = "{{ csrf_token() }}"
                        $.ajax({
                            url: "{{ url('admin/user/') . '/' }}" + itemId,
                            type: "POST",
                            data: {
                                _method: "DELETE",
                                _token: CSRFToken
                            },
                            success: function () {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Berhasil di hapus!'
                                });
                                self.refreshDataTable(); // oh buat ini nih
                                // coba lagi 
                            }
                        });
                    }
                })
        });

    </script>
@endpush

