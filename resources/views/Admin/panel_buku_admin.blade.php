@extends('layouts.main_index_admin')

@section('main_index')
    <div class="container-fluid py-4">
        <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createBuku">
            Buat Buku
        </button>

        @include('partials.buku.create_buku')

        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>List Buku</h6>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Judul Buku</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Penerbit</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Penulis</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Stok Buku</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Kategori</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Deskripsi</th> <!-- Tambahkan kolom Deskripsi -->
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Gambar</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($bukus as $buku)
                                        <tr>
                                            <td>{{ $buku->judul }}</td>
                                            <td>{{ $buku->penerbit }}</td>
                                            <td>{{ $buku->pengarang }}</td>
                                            <td>{{ $buku->stok_buku }}</td>
                                            <td>
                                                @if($buku->category)
                                                    {{ $buku->category->name }}
                                                @else
                                                    Tidak ada kategori
                                                @endif
                                            </td>
                                            <td>
                                                <div class="description-container">
                                                    @if($buku->deskripsi)
                                                        <span class="description-short">{{ Str::limit($buku->deskripsi, 30) }}</span>
                                                        <span class="description-full" style="display:none;">{{ $buku->deskripsi }}</span>
                                                        <button type="button" class="btn btn-link p-0 description-toggle" style="color:blue;">Read more</button>
                                                    @else
                                                        <span class="description-short">Tidak ada deskripsi di buku ini</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <!-- Display Thumbnail -->
                                            <td>
                                                @if($buku->thumbnail)
                                                    <img src="{{ asset('storage/' . $buku->thumbnail) }}" alt="Thumbnail" style="max-width: 100px;">
                                                @else
                                                    No thumbnail available
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <!-- Edit Button on the Left -->
                                                    <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal"
                                                            data-bs-target="#editBuku_{{ $buku->id }}" data-book-id="{{ $buku->id }}">
                                                        Edit Buku
                                                    </button>
                                                    @include('partials.buku.edit_buku')

                                                    <!-- Delete Button on the Right -->
                                                    <form action="{{ route('buku.delete', $buku->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.description-toggle').forEach(function (button) {
            button.addEventListener('click', function () {
                var descriptionContainer = this.closest('.description-container');
                var shortDescription = descriptionContainer.querySelector('.description-short');
                var fullDescription = descriptionContainer.querySelector('.description-full');

                if (fullDescription.style.display === 'none') {
                    fullDescription.style.display = 'inline';
                    shortDescription.style.display = 'none';
                    this.textContent = 'Show less';
                } else {
                    fullDescription.style.display = 'none';
                    shortDescription.style.display = 'inline';
                    this.textContent = 'Read more';
                }
            });
        });
    });
</script>
@endsection

