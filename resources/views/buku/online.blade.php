@extends('layouts.user.navbar')
@section('content')
    <div class="container">
        <div id="category" class="mb-5">
            <h1 class="text-center mt-3 mb-3">Category</h1>
            <div class="row row-cols-1 row-cols-md-3 g-3">
                <a href="" href="">
                    <div class="col">
                        <div class="card text-center mb-3">
                            <img src="https://i.pinimg.com/236x/f7/81/42/f781421d3e8b0760ce43a19b98ba331c.jpg" alt="..."
                                srcset="" class="card-img-top">
                            <div class="card-footer">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" href="">
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
                <a href="" href="">
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
        <div class="card bg-body-secondary mb-3">
            <div class="search p-3 mt-3">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                            <button class="btn btn-default bg-white border border-2" type="submit">
                                <i class="bi bi-search text-dark"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            @include('buku.detail')
            <div id="book" class="mb-5 p-3">
                <p class="text-start lead mb-4">Book List</p>
                <div class="row row-cols-3 row-cols-md-5 g-4 p-3">
                    <div class="col">
                        <a href="" data-bs-toggle="modal" data-bs-target="#detail">
                            <div class="card h-100">
                                <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                                    class="card-img-top" alt="...">
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="" data-bs-toggle="modal" data-bs-target="#detail">
                            <div class="card h-100">
                                <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                                    class="card-img-top" alt="...">
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="" data-bs-toggle="modal" data-bs-target="#detail">
                            <div class="card h-100">
                                <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                                    class="card-img-top" alt="...">
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="" data-bs-toggle="modal" data-bs-target="#detail">
                            <div class="card h-100">
                                <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                                    class="card-img-top" alt="...">
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="" data-bs-toggle="modal" data-bs-target="#detail">
                            <div class="card h-100">
                                <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                                    class="card-img-top" alt="...">
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
