@extends('layouts.main_index')
@section('main_index')

<div class="col-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Borrowed Books</h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">JUDUL</th>
                        <th scope="col">PENERBIT</th>
                        <th scope="col">PENGARANG</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjamans as $peminjaman)
                        @if (Auth::user()->id == $peminjaman->siswa_id)
                            <tr>
                                <td>{{ $peminjaman->id }}</td>
                                <td>{{ $peminjaman->judul }}</td>
                                <td>{{ $peminjaman->penerbit }}</td>
                                <td>{{ $peminjaman->pengarang }}</td>
                                <td>
                                    <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST"
                                        class="ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ml-3">Return Book</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
