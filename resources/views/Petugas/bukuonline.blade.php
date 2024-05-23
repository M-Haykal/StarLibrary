@extends('layouts.main_index_petugas')

@section('main_index')
    <div class="container-fluid py-4">
        <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createBukuOnline">
            Buat Buku Online
        </button>

        @include('partials.buku.create_buku_online')

        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>List Buku Online</h6>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Judul Buku</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Penerbit</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Penulis</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Kategori</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Deskripsi</th> <!-- Tambahkan kolom Deskripsi -->
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Gambar</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">PDF</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($bukuOnlines as $bukuOnline)
                                        <tr>
                                            <td>{{ $bukuOnline->judul }}</td>
                                            <td>{{ $bukuOnline->penerbit }}</td>
                                            <td>{{ $bukuOnline->pengarang }}</td>
                                            <td>
                                                @if($bukuOnline->category)
                                                    {{ $bukuOnline->category->name }}
                                                @else
                                                    Tidak ada kategori
                                                @endif
                                            </td>
                                            <td>
                                                <div class="description-container">
                                                    @if($bukuOnline->deskripsi)
                                                        <span class="description-short">{{ Str::limit($bukuOnline->deskripsi, 30) }}</span>
                                                        <span class="description-full" style="display:none;">{{ $bukuOnline->deskripsi }}</span>
                                                        <button type="button" class="btn btn-link p-0 description-toggle" style="color:blue;">Read more</button>
                                                    @else
                                                        <span class="description-short">Tidak ada deskripsi di buku ini</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <!-- Display Thumbnail -->
                                            <td>
                                                @if($bukuOnline->thumbnail)
                                                    <img src="{{ asset('storage/' . $bukuOnline->thumbnail) }}" alt="Thumbnail" style="max-width: 100px;">
                                                @else
                                                    No thumbnail available
                                                @endif
                                            </td>
                                            <td>
                                                @if($bukuOnline->pdf_file)
                                                    <a href="{{ asset('storage/' . $bukuOnline->pdf_file) }}" target="_blank">READ</a>
                                                @else
                                                    No PDF available
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <!-- Edit Button on the Left -->
                                                    <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal"
                                                            data-bs-target="#editBukuOnline_{{ $bukuOnline->id }}" data-book-id="{{ $bukuOnline->id }}">
                                                        Edit Buku Online
                                                    </button>
                                                    @include('partials.buku.edit_buku_online')

                                                    <!-- Delete Button on the Right -->
                                                    <form action="{{ route('buku_online.delete', $bukuOnline->id) }}" method="POST">
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
