@extends('layouts.main_index')
@section('main_index')

<div class="col-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Responsive Table</h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">JUDUL</th>
                        <th scope="col">PENERBIT</th>
                        <th scope="col">PENGARANG</th>
                        <th scope="col">STOK TERSISA</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bukus as $buku)
                    <tr>
                        <td>{{ $buku->id }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penerbit }}</td>
                        <td>{{ $buku->pengarang }}</td>
                        <td>{{ $buku->stok_buku }}</td>
                        <td>
                            <form action="{{ route('borrow.book', $buku->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning m-2">Pinjam</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
