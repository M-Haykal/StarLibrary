@extends('layouts.user.navbar')
@section('content')
    <div class="hero">
        <div class="hero-body text-center" id="home">
            <h1 class="fw-bolder">Welcome</h1>
            <h1 class="fw-bolder">To</h1>
            <h1 class="fw-bolder">StarLibrary</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">A library in Taruna Bhakti vocational high school</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a class="btn btn-light btn-lg px-4" href="#content" role="button">Get Started</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="content">
        <div class="col-xxl-8 px-4 py-5" id="about">
            <div class="row flex-lg-row-reverse align-items-center justify-content-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="{{ asset('img/smk.jpg') }}" class="d-block mx-lg-auto img-fluid img-about"
                        alt="Taruna Bhakti vocational high school" width="700" height="500" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="lh-1 mb-3">StarLibrary</h1>
                    <p class="lead">Introducing this StarLibrary a library website created by Adrian Baihaqi, Apip Medya
                        Wisnu, Daniel Hansel, Muhammad Haykal and Resti Nuriqwanti, This is the result of a project given by
                        our teacher at school, our school is called Taruna Bhakti Vocational High School.</p>
                </div>
            </div>
        </div>

        @include('buku.borrow')

        {{-- Untuk Buku offline --}}
        <div id="book" class="mt-5 mb-5">
            <h1 class="text-center">Book</h1>
            <p class="text-center lead mb-4">Here are the books available on StarLibrary</p>
            <div class="row row-cols-2 row-cols-md-5 g-4">
                <div class="col">
                    <div class="card h-100" data-bs-toggle="modal" data-bs-target="#peminjaman">
                        <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                            class="card-img-top" alt="...">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name Book: <span>Naruto</span></li>
                            <li class="list-group-item">Genre: </li>
                            <li class="list-group-item">Stock: </li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100" data-bs-toggle="modal" data-bs-target="#peminjaman">
                        <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                            class="card-img-top" alt="...">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name Book: <span>Naruto</span></li>
                            <li class="list-group-item">Genre: </li>
                            <li class="list-group-item">Stock: </li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100" data-bs-toggle="modal" data-bs-target="#peminjaman">
                        <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                            class="card-img-top" alt="...">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name Book: <span>Naruto</span></li>
                            <li class="list-group-item">Genre: </li>
                            <li class="list-group-item">Stock: </li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100" data-bs-toggle="modal" data-bs-target="#peminjaman">
                        <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                            class="card-img-top" alt="...">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name Book: <span>Naruto</span></li>
                            <li class="list-group-item">Genre: </li>
                            <li class="list-group-item">Stock: </li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100" data-bs-toggle="modal" data-bs-target="#peminjaman">
                        <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                            class="card-img-top" alt="...">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name Book: <span>Naruto</span></li>
                            <li class="list-group-item">Genre: </li>
                            <li class="list-group-item">Stock: </li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100" data-bs-toggle="modal" data-bs-target="#peminjaman">
                        <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                            class="card-img-top" alt="...">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name Book: <span>Naruto</span></li>
                            <li class="list-group-item">Genre: </li>
                            <li class="list-group-item">Stock: </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
