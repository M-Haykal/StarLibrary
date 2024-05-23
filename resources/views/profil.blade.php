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
                                    <p class="text-muted mb-0">{{ auth()->user()->created_at }}</p>
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
                    </ul>
                    <div class="tab-content" id="pilihanTabContent">
                        <div class="tab-pane fade show active" id="pinjam" role="tabpanel" aria-labelledby="pinjam-tab">
                            <div class="row row-cols-2 row-cols-md-5 g-4">
                                @foreach ($peminjamans as $peminjaman)
                                    @if (Auth::user()->id == $peminjaman->siswa_id && $peminjaman->status != 'returned')
                                        <div class="col" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                                            <div class="card h-100 shadow-sm border-0" style="transition: transform .2s; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#datapeminjaman"
                                                data-title="{{ $peminjaman->judul }}"
                                                data-deskripsi="{{ $peminjaman->deskripsi }}"
                                                data-author="{{ $peminjaman->pengarang }}"
                                                data-peminjaman-id="{{ $peminjaman->id }}"
                                                data-status="{{ $peminjaman->status }}"
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
                                    @if (Auth::user()->id == $peminjaman->siswa_id && $peminjaman->status == 'returned')
                                        <div class="col" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                                            <div class="card h-100 shadow-sm border-0" style="transition: transform .2s; cursor: pointer;">
                                                <img src="{{ asset('storage/' . $peminjaman->thumbnail) }}" class="card-img-top rounded-top" alt="..." style="height: 400px; object-fit: cover;">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $peminjaman->judul }}</h5>
                                                    <p class="card-text">Author: {{ $peminjaman->pengarang }}</p>
                                                    <span class="badge rounded-pill" style="background-color: #6c757d">Returned</span>
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
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init();

    $('#datapeminjaman').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var title = button.data('title');
        var author = button.data('author');
        var status = button.data('status'); // Menambahkan data-status dari button
        var description = button.data('deskripsi'); // Menambahkan data-description dari button
        var peminjamanId = button.data('peminjaman-id');
        var thumbnail = button.data('thumbnail');
        var modal = $(this);
        modal.find('.modal-body #book-title').val(title);
        modal.find('.modal-body #book-author').val(author);
        modal.find('.modal-body #status').val(status); // Mengisi nilai input dengan status
        modal.find('.modal-body #description').text(description); // Mengisi nilai textarea dengan deskripsi
        modal.find('.modal-body #peminjaman_id').val(peminjamanId);
        modal.find('.modal-body #thumbnail').attr('src', thumbnail);

        var buttonContainer = modal.find('#button-container');
        buttonContainer.empty(); // Membersihkan kontainer tombol sebelum menambahkan tombol baru

        if (status == 'waiting') {
            // Jika statusnya adalah "waiting", tambahkan tombol "Batalkan Peminjaman"
            buttonContainer.append('<button class="btn btn-warning cancel-peminjaman" data-peminjaman-id="' + peminjamanId + '">Batalkan Peminjaman</button>');
        } else if (status == 'confirm') {
            // Jika statusnya adalah "confirm", tambahkan tombol "Return Book"
            buttonContainer.append('<button class="btn btn-danger return-book" data-peminjaman-id="' + peminjamanId + '">Return Book</button>');
        }
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
});

</script>
@endpush
