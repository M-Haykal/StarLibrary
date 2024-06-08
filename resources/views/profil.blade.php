@extends('layouts.main_profile')
@section('content')
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4" data-aos="fade-right">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            @if(auth()->user()->profile_picture)
                                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture" class="rounded-circle img-fluid" style="width: 150px; height: 150px">
                            @else
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="Default Profile Picture" class="rounded-circle img-fluid" style="width: 150px;">
                            @endif

                            <h5 class="my-3">{{ auth()->user()->nama }}</h5>

                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-left">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Role</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ auth()->user()->kelas }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Join date</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        @if(auth()->user()->created_at)
                                            {{ auth()->user()->created_at->format('M d, Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.buku.data')
            <div class="row">
                <div class="col">
                    <ul class="nav nav-tabs mb-3 justify-content-center" id="pilihanTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pinjam-tab" data-bs-toggle="tab" data-bs-target="#pinjam" type="button" role="tab" aria-controls="pinjam" aria-selected="true">Daftar Buku Yang Di Pinjam</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="favorite-tab" data-bs-toggle="tab" data-bs-target="#favorite" type="button" role="tab" aria-controls="favorite" aria-selected="false">Favorite Book</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab" aria-controls="history" aria-selected="false">History Peminjaman</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="bermasalah-tab" data-bs-toggle="tab" data-bs-target="#bermasalah" type="button" role="tab" aria-controls="bermasalah" aria-selected="false">Peminjaman Bermasalah</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pilihanTabContent">
                        <div class="tab-pane fade show active" id="pinjam" role="tabpanel" aria-labelledby="pinjam-tab">
                            <div class="row row-cols-2 row-cols-md-5 g-4">
                                @foreach ($peminjamans as $peminjaman)
                                    @if (Auth::user()->id == $peminjaman->siswa_id && $peminjaman->status != 'returned' && $peminjaman->status != 'cancelled' && $peminjaman->status != 'hilang' && $peminjaman->status != 'telat' && $peminjaman->status != 'rusak')
                                        <div class="col" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                                            <div class="card h-100 shadow-sm border-0" style="transition: transform .2s; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#datapeminjaman"
                                                data-title="{{ $peminjaman->judul }}"
                                                data-deskripsi="{{ $peminjaman->deskripsi }}"
                                                data-author="{{ $peminjaman->pengarang }}"
                                                data-peminjaman-id="{{ $peminjaman->id }}"
                                                data-status="{{ $peminjaman->status }}"
                                                data-denda="{{ $peminjaman->denda }}"
                                                data-thumbnail="{{ asset('storage/' . $peminjaman->thumbnail) }}">
                                                <img src="{{ asset('storage/' . $peminjaman->thumbnail) }}" class="card-img-top rounded-top" alt="..." style="height: 400px; object-fit: cover;">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $peminjaman->judul }}</h5>
                                                    <p class="card-text">Author: {{ $peminjaman->pengarang }}</p>
                                                    <span class="badge rounded-pill" style="background-color: {{ $peminjaman->status === 'waiting' ? '#FFD55C' : ($peminjaman->status === 'confirm' ? '#28A745' : '#6c757d') }}">{{ $peminjaman->status }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade" id="favorite" role="tabpanel" aria-labelledby="favorite-tab">
                            <div class="row row-cols-2 row-cols-md-5 g-4">
                                @foreach (auth()->user()->favoriteBooks as $favoriteBook)
                                <div class="col" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                                    <div class="card h-100 shadow-sm border-0" style="transition: transform .2s; cursor: pointer;">
                                        <img src="{{ asset('storage/' . $favoriteBook->thumbnail) }}" class="card-img-top rounded-top" alt="..." style="height: 400px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $favoriteBook->judul }}</h5>
                                            <p class="card-text">Author: {{ $favoriteBook->pengarang }}</p>
                                            <form action="{{ route('favorite.remove', ['buku_id' => $favoriteBook->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Hapus dari Favorite</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                            <div class="row row-cols-2 row-cols-md-5 g-4">
                                @foreach ($peminjamans as $peminjaman)
                                @if (Auth::user()->id == $peminjaman->siswa_id && ($peminjaman->status == 'returned' || $peminjaman->status == 'cancelled'))
                                    <div class="col" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                                        <div class="card h-100 shadow-sm border-0" style="transition: transform .2s; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#datapeminjaman"
                                            data-title="{{ $peminjaman->judul }}"
                                            data-deskripsi="{{ $peminjaman->deskripsi }}"
                                            data-author="{{ $peminjaman->pengarang }}"
                                            data-buku-id="{{ $peminjaman->buku_id }}"
                                            data-peminjaman-id="{{ $peminjaman->id }}"
                                            data-status="{{ $peminjaman->status }}"
                                            data-thumbnail="{{ asset('storage/' . $peminjaman->thumbnail) }}">
                                            <img src="{{ asset('storage/' . $peminjaman->thumbnail) }}" class="card-img-top rounded-top" alt="..." style="height: 400px; object-fit: cover;">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $peminjaman->judul }}</h5>
                                                <p class="card-text">Author: {{ $peminjaman->pengarang }}</p>
                                                @if ($peminjaman->status == 'returned')
                                                    <span class="badge rounded-pill" style="background-color: #6c757d">Di Kembalikan</span>
                                                @elseif ($peminjaman->status == 'cancelled')
                                                    <span class="badge rounded-pill" style="background-color: #dc3545">Di Batalkan</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade" id="bermasalah" role="tabpanel" aria-labelledby="bermasalah-tab">
                            <div class="row row-cols-2 row-cols-md-5 g-4">
                                @foreach ($peminjamans as $peminjaman)
                                    @if (Auth::user()->id == $peminjaman->siswa_id && in_array($peminjaman->status, ['hilang', 'telat', 'rusak']))
                                        <div class="col" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                                            <div class="card h-100 shadow-sm border-0" style="transition: transform .2s; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#datapeminjaman"
                                                data-title="{{ $peminjaman->judul }}"
                                                data-deskripsi="{{ $peminjaman->deskripsi }}"
                                                data-author="{{ $peminjaman->pengarang }}"
                                                data-buku-id="{{ $peminjaman->buku_id }}"
                                                data-peminjaman-id="{{ $peminjaman->id }}"
                                                data-status="{{ $peminjaman->status }}"
                                                data-denda="{{ $peminjaman->denda }}"
                                                data-thumbnail="{{ asset('storage/' . $peminjaman->thumbnail) }}">
                                                <img src="{{ asset('storage/' . $peminjaman->thumbnail) }}" class="card-img-top rounded-top" alt="..." style="height: 400px; object-fit: cover;">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $peminjaman->judul }}</h5>
                                                    <p class="card-text">Author: {{ $peminjaman->pengarang }}</p>
                                                    @if ($peminjaman->status == 'rusak')
                                                        <span class="badge rounded-pill" style="background-color: #6c757d">Buku Rusak</span>
                                                    @elseif ($peminjaman->status == 'hilang')
                                                        <span class="badge rounded-pill" style="background-color: #dc3545">Buku Hilang</span>
                                                    @elseif ($peminjaman->status == 'telat')
                                                        <span class="badge rounded-pill" style="background-color: #FFD55C">Telat Dikembalikan</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Konten modal untuk mengedit profil -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('edit_profile', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Formulir untuk mengedit profil -->
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ auth()->user()->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)">
                            <img id="preview" src="#" alt="Profile Picture" style="display: none; max-width: 100%; margin-top: 10px;">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .nav-link {
        transition: background-color .2s, color .2s;
    }
    .nav-link:hover {
        background-color: #f8f9fa;
        color: #007bff;
    }
    .card-img-top {
        height: 400px;
        object-fit: cover;
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
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
<script>
    AOS.init();

    // Script to handle the modal and form submission
// Script to handle the modal and form submission
$('#datapeminjaman').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var author = button.data('author');
    var status = button.data('status');
    var denda = button.data('denda');
    var description = button.data('deskripsi');
    var peminjamanId = button.data('peminjaman-id');
    var bukuId = button.data('buku-id');
    var thumbnail = button.data('thumbnail');
    var modal = $(this);

    modal.find('.modal-body #book-title').val(title);
    modal.find('.modal-body #book-author').val(author);
    modal.find('.modal-body #status').val(status);
    modal.find('.modal-body #denda').val(denda);
    modal.find('.modal-body #description').text(description);
    modal.find('.modal-body #peminjaman_id').val(peminjamanId);
    modal.find('.modal-body #thumbnail').attr('src', thumbnail);

    var buttonContainer = modal.find('#button-container');
    buttonContainer.empty();

    var reviewForm = modal.find('#review-form');
    reviewForm.addClass('d-none'); // Hide the review form by default

    if (status == 'waiting') {
        buttonContainer.append('<button class="btn btn-warning cancel-peminjaman" data-peminjaman-id="' + peminjamanId + '">Batalkan Peminjaman</button>');
    } else if (status == 'returned') {
        reviewForm.removeClass('d-none'); // Show the review form
        reviewForm.find('input[name="buku_id"]').val(bukuId); // Set the buku_id in the review form
        reviewForm.find('input[name="peminjaman_id"]').val(peminjamanId); // Set the peminjaman_id in the review form
    }
});

// Star rating functionality
$('#rating-stars i').on('click', function() {
    var value = $(this).data('value');
    $('#rating').val(value);

    // Highlight stars up to the clicked one
    $('#rating-stars i').each(function() {
        if ($(this).data('value') <= value) {
            $(this).addClass('text-warning');
        } else {
            $(this).removeClass('text-warning');
        }
    });
});

// Handle form submission
$('#review-form').on('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting normally
    var formData = $(this).serialize(); // Get the form data

    $.ajax({
        type: 'POST',
        url: '{{ route("reviews.store") }}', // Update with your actual route
        data: formData,
        success: function(response) {
            if(response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#datapeminjaman').modal('hide'); // Hide the modal
                        // Optionally, you can refresh the reviews list or update it dynamically here
                        loadReviews(response.buku_id);
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.message
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error submitting review:', xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'There was an error submitting your review.'
            });
        }
    });
});


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



    // Event listener untuk tombol "Batalkan Peminjaman"
    $(document).on('click', '.cancel-peminjaman', function(e) {
        e.preventDefault();
        var peminjamanId = $(this).data('peminjaman-id');

        $.ajax({
            url: '{{ route("peminjaman.cancel", ":id") }}'.replace(':id', peminjamanId),
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Tindakan setelah berhasil membatalkan peminjaman
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload(); // Refresh halaman
                    }
                });
            },
            error: function(xhr) {
                // Tindakan jika terjadi kesalahan
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan. Silakan coba lagi.'
                });
            }
        });
    });

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview');
            output.style.display = 'block';
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    $(document).ready(function() {
    $('.remove-from-favorite').on('click', function() {
        var bukuId = $(this).data('buku-id');

        $.ajax({
            type: 'DELETE',
            url: '/favorite-books/' + bukuId,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Hapus item buku dari tampilan setelah berhasil dihapus dari daftar favorit
                $(this).closest('.col').remove();

                // Tampilkan pesan sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Tampilkan pesan error jika terjadi kesalahan
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan. Silakan coba lagi.'
                });
            }
        });
    });

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
});

</script>
@endpush
