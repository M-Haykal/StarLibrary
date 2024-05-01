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
        <div id="category" class="mb-5">
            <h1 class="text-center mt-3 mb-3">Category</h1>
            <div class="row row-cols-1 row-cols-md-3 g-3">
                <a href="" class="text-decoration-none">
                    <div class="col">
                        <div class="card text-center mb-3">
                            <img src="https://i.pinimg.com/236x/f7/81/42/f781421d3e8b0760ce43a19b98ba331c.jpg"
                                alt="..." srcset="" class="card-img-top">
                            <div class="card-footer">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="text-decoration-none">
                    <div class="col">
                        <div class="card text-center mb-3">
                            <img src="https://i.pinimg.com/236x/f7/81/42/f781421d3e8b0760ce43a19b98ba331c.jpg"
                                alt="..." srcset="" class="card-img-top">
                            <div class="card-footer">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="text-decoration-none">
                    <div class="col">
                        <div class="card text-center mb-3">
                            <img src="https://i.pinimg.com/236x/f7/81/42/f781421d3e8b0760ce43a19b98ba331c.jpg"
                                alt="..." srcset="" class="card-img-top">
                            <div class="card-footer">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="book" class="mt-5 mb-5">
            <h1 class="text-center">Book</h1>
            <p class="text-center lead mb-4">Here are the books available on StarLibrary</p>
            <div class="card">
                <div class="row row-cols-1 row-cols-md-5 g-4 p-3">

                    <div class="col">
                        <div class="card h-100">
                            <a href="" class="text-decoration-none"><img
                                    src=""
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Nama Buku</h5>
                                </div>
                                <div class="card-footer">
                                    <a class="icon-link" href="#">
                                        Favorites
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                        </svg>
                                    </a>
                                </div>
                            </a>

                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <a href="" class="text-decoration-none"><img
                                    src=""
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Nama Buku</h5>
                                </div>
                                <div class="card-footer">
                                    <a class="icon-link" href="#">
                                        Favorites
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                        </svg>
                                    </a>
                                </div>
                            </a>

                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <a href="" class="text-decoration-none"><img
                                    src=""
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Nama Buku</h5>
                                </div>
                                <div class="card-footer">
                                    <a class="icon-link" href="#">
                                        Favorites
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                        </svg>
                                    </a>
                                </div>
                            </a>

                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <a href="" class="text-decoration-none"><img
                                    src=""
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Nama Buku</h5>
                                </div>
                                <div class="card-footer">
                                    <a class="icon-link" href="#">
                                        Favorites
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                        </svg>
                                    </a>
                                </div>
                            </a>

                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <a href="" class="text-decoration-none"><img
                                    src=""
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Nama Buku</h5>
                                </div>
                                <div class="card-footer">
                                    <a class="icon-link" href="#">
                                        Favorites
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                        </svg>
                                    </a>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="card-body mt-3">
                    <div class="d-grid gap-2 d-flex">
                        <a class="btn btn-success" type="button" role="button"
                            href="{{ route('offline') }}">Offline</a>
                        <a class="btn btn-warning" type="button" role="button" href="{{ route('online') }}">Online</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
