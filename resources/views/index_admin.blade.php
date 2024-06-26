@extends('layouts.main_index_admin')
@section('main_index')

@include("partials.siswa.create_modal")
<div class="col-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Siswa Manager</h6>
        <a data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-primary">Tambah Akun</a>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">NAMA</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">ACTION</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswas as $siswa)
                    <tr>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->email }}</td>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn btn-warning me-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal_{{ $siswa->id }}"
                                        data-book-id="{{ $siswa->id }}">
                                    Edit
                                </button>
                                @include("partials.siswa.edit_modal")
                                <form action="{{ route('siswa.delete', $siswa->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data siswa</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
