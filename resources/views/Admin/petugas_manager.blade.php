@extends('layouts.main_index_admin')
@section('main_index')
{{-- <button class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createPetugasModal">
    Tambah Akun Petugas
</button> --}}
@include("partials.petugas.create_modal")
<div class="col-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Daftar Petugas</h6>
        <a data-bs-toggle="modal" data-bs-target="#createPetugasModal" class="btn btn-primary">Tambah Akun</a>
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
                    @forelse ($petugas as $ptg)
                    <tr>
                        <td>{{ $ptg->nama }}</td>
                        <td>{{ $ptg->email }}</td>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn btn-warning me-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editPetugasModal_{{ $ptg->id }}"
                                        data-book-id="{{ $ptg->id }}">
                                    Edit
                                </button>
                                @include("partials.petugas.edit_modal")
                                <form action="{{ route('petugas.delete', $ptg->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data petugas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
