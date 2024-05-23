@extends('layouts.main_landing')
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

        <div id="book" class="mb-5 p-3">
            <p class="text-start lead mb-4">Book List</p>
            <div class="row row-cols-3 row-cols-md-5 g-4 p-3">
                @foreach($bukuOnlines as $bukuOnline)
                <div class="col">
                    <a href="" data-bs-toggle="modal" data-bs-target="#detail_{{ $bukuOnline->id }}">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $bukuOnline->thumbnail) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $bukuOnline->judul }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Modal -->
                <div class="modal" id="detail_{{ $bukuOnline->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Book</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xl-3">
                                        <div class="card mb-4 mb-xl-0">
                                            <img class="img-account-profile" src="{{ asset('storage/' . $bukuOnline->thumbnail) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xl-9">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Title: </p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $bukuOnline->judul }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Category</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $bukuOnline->category->name }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Created</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">{{ $bukuOnline->created_at->format('d-m-Y') }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                {{-- Isi Buku --}}
                                                <div class="row">
                                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                                    Baca
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                                <div class="accordion-body overflow-x">
                                                                    {{-- Masukkan object PDF --}}
                                                                    <object data="{{ asset('storage/' . $bukuOnline->pdf_file . '#toolbar=0&view=FitH') }}" type="application/pdf" width="100%" height="600px">
                                                                        <p>Konten PDF tidak dapat ditampilkan. <a href="{{ asset('storage/' . $bukuOnline->pdf_file) }}">Unduh PDF</a> untuk melihatnya.</p>
                                                                    </object>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- Tambahkan item accordion lainnya di sini --}}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Bagian Review --}}
                                <div class="row">
                                    <h1>Review</h1>
                                    <div class="col-xl-8">
                                        <div class="card mb-4 mt-3 mb-lg-0">
                                            <div class="card-body p-0">
                                                <ul class="list-group list-group-flush rounded-3">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                                                        <p class="mb-0">Name User: </p>
                                                        <p class="mb-0">Ulasan</p>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                                                        <p class="mb-0">Name User: </p>
                                                        <p class="mb-0">Ulasan</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="card mt-3 mb-lg-0">
                                            <div class="card-header">
                                                <h3>Review</h3>
                                            </div>
                                            <form action="" method="post" class="p-2">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Comentar</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                                </div>
                                                <div class="d-grid gap-2 d-md-block">
                                                    <button class="btn btn-success" type="submit">Send Review</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{-- ketika button add to favorite diklik maka buku yang difavoritkan akan muncul di halaman favorite di file favorite --}}
                                <button type="button" class="btn btn-success disabled">Add To Favorite</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
