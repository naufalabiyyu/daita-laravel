@extends('layouts.dashboard')

@section('title')
    Daita Skincare &#8211; Pancarkan Pesona Cantikmu 
@endsection

@section('content')
   <div class="section-content section-dashboard-home" data-aos="fade-up">
                    <div class="container-fluid">
                        <div class="dashboard-heading">
                            <h2 class="dashboard-title">Facial Foam</h2>
                            <p class="dashboard-subtitle">Product Details</p>
                        </div>
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="col-12">
                                    <form action="">
                                        <div class="card card-list p-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Product Name</label>
                                                            <input type="text" class="form-control" value="Facial Foam">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Price</label>
                                                            <input type="number" class="form-control" value="35.000">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Description</label>
                                                            <textarea name="editor">Pembersih wajah yang diformulasikan khusus untuk membersihkan kulit wajahmu hingga tuntas sampai ke pori-pori dan mencerahkan kulit yang kusam. Mengandung Vitamin C yang dapat membantu mencerahkan kulit wajah, serta dilengkapi dengan Niacinamide Personal Care/ Vit B3 untuk membantu menghilangkan noda hitam pada kulit wajah.</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Cara Penggunaan</label>
                                                            <textarea name="howtouse" id cols="30" rows="4" class="form-control">Basahi wajah, busakan foam pada telapak tangan, usapkan pada wajah dengan pijatan lembut lalu bilas. Untuk mendapatkan hasil yang baik, gunakan setiap hari.</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Bahan - bahan</label>
                                                            <textarea name="ingredients" id cols="30" rows="4" class="form-control">Aqua, Glycerin, Stearic Acid, Potassium, Hydroxide, Lauric Acid, Myristic Acid, Peg-150 distearate, Niacinamide, Ethyl ascorbic acid, Fragrance ( Parfum) Components and Finished Fragrances, Disodium EDTA, BHT.</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 text-right">
                                                        <button type="submit" class="btn btn-success btn-block px-5">
                                                    Save Now
                                                    </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="card card-list">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="gallery-container">
                                                        <img src="/images/drawable-xhdpi/product-card-7.png" alt="" class="w-100">
                                                        <a href="#" class="delete-gallery">
                                                            <img src="/images/icon-delete.svg" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="gallery-container">
                                                        <img src="/images/drawable-xhdpi/product-card-8.png" alt="" class="w-100">
                                                        <a href="#" class="delete-gallery">
                                                            <img src="/images/icon-delete.svg" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="gallery-container">
                                                        <img src="/images/drawable-xhdpi/product-card-9.png" alt="" class="w-100">
                                                        <a href="#" class="delete-gallery">
                                                            <img src="/images/icon-delete.svg" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <input type="file" id="file" style="display: none;" multiple>
                                                    <button class="btn btn-secondary btn-block mt-2" onclick="thisFileUpload()">
                                                        Tambah Foto
                                                    </button>
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
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
        function thisFileUpload() {
            document.getElementById('file').click();
        }
    </script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endpush



