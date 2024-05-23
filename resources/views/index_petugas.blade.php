
@extends('layouts.main_index_petugas')

@section('main_index')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="rounded d-flex align-items-center p-4" style="background-color: #191c24;">
                <div class="me-3">
                    <i class="fa fa-book fa-3x text-primary"></i>
                </div>
                <div class="text-start">
                    <p class="mb-2" style="color: white;">Jumlah Buku</p>
                    <h6 class="mb-0">{{ $jumlahBuku }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="rounded d-flex align-items-center p-4" style="background-color: #191c24;">
                <div class="me-3">
                    <i class="fa fa-book fa-3x text-primary"></i>
                </div>
                <div class="text-start">
                    <p class="mb-2" style="color: white;">Jumlah Buku online</p>
                    <h6 class="mb-0">{{ $bukuOnlines }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="rounded d-flex align-items-center p-4" style="background-color: #191c24;">
                <div class="me-3">
                    <i class="fa fa-list-alt fa-3x text-primary"></i>
                </div>
                <div class="text-start">
                    <p class="mb-2" style="color: white;">Jumlah Kategori</p>
                    <h6 class="mb-0">{{ $jumlahKategori }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="rounded d-flex align-items-center p-4" style="background-color: #191c24;">
                <div class="me-3">
                    <i class="fa fa-book-reader fa-3x text-primary"></i>
                </div>
                <div class="text-start">
                    <p class="mb-2" style="color: white;">Jumlah Buku yang Dipinjam</p>
                    <h6 class="mb-0">{{ $jumlahPeminjaman }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
