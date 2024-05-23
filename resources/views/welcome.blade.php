@extends('layouts.main_landing')
@section('content')
<div class="hero" data-aos="fade-up">
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
    <div class="col-xxl-8 px-4 py-5" id="about" data-aos="fade-right">
        <div class="row flex-lg-row-reverse align-items-center justify-content-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="{{ asset('img/smk.jpg') }}" class="d-block mx-lg-auto img-fluid img-about"
                    alt="Taruna Bhakti vocational high school" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="lh-1 mb-3">StarLibrary</h1>
                <p class="lead">Introducing this StarLibrary a library website created by Adrian Baihaqi, Afif Medya
                    Wisnu, Daniel Hansel, Muhammad Haykal and Resti Nuriqwanti, This is the result of a project given by
                    our teacher at school, our school is called Taruna Bhakti Vocational High School.</p>
            </div>
        </div>
    </div>

    @include('partials.buku.borrow')

    {{-- Untuk Buku offline --}}
    <div id="book" class="mt-5 mb-5">
        <h1 class="text-center" data-aos="fade-up">Book</h1>
        <p class="text-center lead mb-4" data-aos="fade-up" data-aos-delay="100">Here are the books available on StarLibrary</p>

        <div class="row row-cols-2 row-cols-md-5 g-4">
            @foreach ($bukus as $buku)
            <div class="col" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card h-100 shadow-sm border-0" style="transition: transform .2s; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#peminjaman" data-buku-id="{{ $buku->id }}" data-title="{{ $buku->judul }}" data-author="{{ $buku->pengarang }}" data-stock="{{ $buku->stok_buku }}" data-thumbnail="{{ asset('storage/' . $buku->thumbnail) }}" data-description="{{ $buku->deskripsi ?? 'Tidak ada deskripsi di buku ini' }}" data-route="{{ route('borrow.book', $buku->id) }}">
                    <img src="{{ asset('storage/' . $buku->thumbnail) }}" class="card-img-top rounded-top" alt="..." style="height: 400px; object-fit: cover;">
                    <div class="card-body">
                        <p class="card-text">
                            @php
                                $rating = $buku->totalRating;
                                $whole = floor($rating);
                                $fraction = $rating - $whole;
                            @endphp

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $whole)
                                    <i class="fas star-total fa-star"></i>
                                @elseif ($fraction > 0 && $i == ($whole + 1))
                                    <i class="fas star-total fa-star-half-alt"></i>
                                @else
                                    <i class="far star-inactive fa-star"></i>
                                @endif
                            @endfor
                            {{ $buku->totalRating }}
                        </p>

                        <h5 class="card-title">{{ $buku->judul }}</h5>
                        <p class="card-text">Author: {{ $buku->pengarang }}</p>
                        <p class="card-text">Stock: {{ $buku->stok_buku }}</p>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    .card:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .card-img-top {
        height: 400px;
        object-fit: cover;
    }
    .card-body {
        background-color: #f8f9fa;
    }
    .card-title {
        font-weight: bold;
        font-size: 1.1rem;
    }
    .card-text {
        font-size: 0.9rem;
    }

    .star {
        font-size: 2rem;
        color: #ddd;
        cursor: pointer;
        transition: color 0.3s;
    }
    .star.selected, .star:hover{
        font-size: 2rem;
        color: #ffd700;
    }

    .star-inactive {
        font-size: 1rem;
        color: #ddd;
        cursor: pointer;
        transition: color 0.3s;
    }
    .star-total {
        font-size: 1rem;
        color: #ffd700;
        cursor: pointer;
        transition: color 0.3s;
    }
</style>


</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
<script>


    AOS.init();

    $('#peminjaman').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var bukuId = button.data('buku-id');
        var title = button.data('title');
        var author = button.data('author');
        var stock = button.data('stock');
        var thumbnail = button.data('thumbnail');
        var description = button.data('description') || 'Tidak ada deskripsi di buku ini';
        var route = button.data('route');

        var modal = $(this);
        modal.find('.modal-body #recipient-name').val(title);
        modal.find('.modal-body #author').val(author);
        modal.find('.modal-body #stock').val(stock);
        modal.find('.modal-body #thumbnail').attr('src', thumbnail);
        modal.find('.modal-body #description').val(description);
        modal.find('.modal-body #borrow-book-form').attr('action', route);
        modal.find('#add-to-favorite').data('buku-id', bukuId);
    });

    $(document).ready(function() {
        $('#borrow-book-form').submit(function(event) {
            event.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#peminjaman').modal('hide');
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('#add-to-favorite').click(function() {
            var bukuId = $(this).data('buku-id');
            $.ajax({
                url: '{{ route("add.to.favorite") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    buku_id: bukuId
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON.error || 'Terjadi kesalahan. Silakan coba lagi.';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage
                    });
                }
            });
        });



    });

    $(document).ready(function() {
    // Event handler untuk mengatur pemilihan bintang saat diklik
    $(document).ready(function() {
        $('#star-rating .star').on('click', function() {
            var rating = $(this).data('value');

            // Setel nilai rating pada input tersembunyi
            $('#rating').val(rating);

            // Hilangkan kelas 'selected' dari semua bintang
            $('#star-rating .star').removeClass('selected');

            // Tambahkan kelas 'selected' ke bintang yang dipilih dan semua bintang sebelumnya
            $(this).addClass('selected');
            $(this).prevAll('.star').addClass('selected');
        });
    });


    // Event handler untuk menangani pengiriman ulasan saat formulir dikirim
    $('#review-form').submit(function(event) {
        event.preventDefault(); // Mencegah pengiriman formulir secara default
        var form = $(this);
        var url = '{{ route("reviews.store") }}'; // URL untuk mengirim formulir
        var formData = form.serialize(); // Serialisasi data formulir

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.trigger('reset'); // Mengatur ulang formulir
                            $('#star-rating .star').removeClass('selected'); // Menghapus seleksi bintang
                            loadReviews(response.buku_id); // Muat ulasan untuk buku yang bersangkutan
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.'
                });
            }
        });
    });

    // Fungsi untuk memuat ulasan
    function loadReviews(bukuId) {
    $.ajax({
        type: 'GET',
        url: '{{ route("reviews.get", ["id" => ":id"]) }}'.replace(':id', bukuId),
        success: function(response) {
            var reviewsList = $('#reviews-list');
            reviewsList.empty(); // Mengosongkan ulasan sebelumnya

            // Menambahkan setiap ulasan ke dalam daftar ulasan
            response.reviews.forEach(function(review) {
                var listItem = $('<li class="list-group-item d-flex justify-content-between align-items-center p-3"></li>');
                var userComment = $('<p class="mb-0"><strong>' + review.user_name + ': </strong> ' + review.comment + ' - ' + generateStarRating(review.rating) + '</p>');
                listItem.append(userComment);
                reviewsList.append(listItem);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error loading reviews:', xhr.responseText);
        }
    });
}

function generateStarRating(rating) {
    var stars = '';
    for (var i = 0; i < rating; i++) {
        stars += '<i class="star-total fas fa-star"></i>';
    }
    for (var i = rating; i < 5; i++) {
        stars += '<i class="star-inactive far fa-star"></i>';
    }
    return stars;
}


    // Event modal yang akan dijalankan ketika modal ditampilkan
    $('#peminjaman').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var bukuId = button.data('buku-id');
        var modal = $(this);
        modal.find('#review-form input[name="buku_id"]').val(bukuId); // Mengatur nilai buku_id pada formulir ulasan
        loadReviews(bukuId); // Memuat ulasan saat modal ditampilkan
    });
});





</script>
@endpush
