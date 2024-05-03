@extends('layouts.user.navbar')
@section('content')
    <div class="container">
        <div id="history-borrow" class="mt-5 mb-5">
            @include('buku.borrow')
            <div class="">
                <a class="btn btn-success" href="#" role="button" data-bs-toggle="modal" data-bs-target="#peminjaman">Add Book</a>
            </div>
            <div class="row row-cols-2 row-cols-md-5 g-4 p-3">
                <div class="col">
                    <div class="card h-100">
                        <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                            class="card-img-top" alt="...">
                        <div class="card-footer">
                            <small class="text-body-secondary">Return Date: </small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                            class="card-img-top" alt="...">
                        <div class="card-footer">
                            <small class="text-body-secondary">Return Date: </small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                            class="card-img-top" alt="...">
                        <div class="card-footer">
                            <small class="text-body-secondary">Return Date: </small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                            class="card-img-top" alt="...">
                        <div class="card-footer">
                            <small class="text-body-secondary">Return Date: </small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                            class="card-img-top" alt="...">
                        <div class="card-footer">
                            <small class="text-body-secondary">Return Date: </small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="https://i.pinimg.com/236x/10/dc/06/10dc06814790d2159ade8a25ac61fa24.jpg"
                            class="card-img-top" alt="...">
                        <div class="card-footer">
                            <small class="text-body-secondary">Return Date: </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
