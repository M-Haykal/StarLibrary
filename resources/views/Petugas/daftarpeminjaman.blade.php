@extends('layouts.main_index_petugas')

@section('main_index')
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>List Buku</h6>
                    </div>
                    <a href="{{ route('peminjaman.download-pdf') }}" class="btn btn-primary">Download PDF</a>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Customer ID</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Customer Name</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Judul Buku</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Author</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Status</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Created At</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Confirmed At</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Returned At</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($peminjamans as $peminjaman)
                                        <tr>
                                            <td>{{ $peminjaman->siswa_id }}</td>
                                            <td>{{ $peminjaman->siswa->nama }}</td>
                                            <td>{{ $peminjaman->judul }}</td>
                                            <td>{{ $peminjaman->pengarang }}</td>
                                            <td>{{ $peminjaman->status }}</td>
                                            <td>{{ $peminjaman->created_at }}</td>
                                            <td>{{ $peminjaman->confirmed_at }}</td>
                                            <td>{{ $peminjaman->returned_at }}</td>
                                            <td>
                                                @if($peminjaman->status == 'waiting')
                                                    <form class="confirm-form" id="confirm-form-{{ $peminjaman->id }}" action="{{ route('peminjaman.confirm', $peminjaman->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success">Konfirmasi</button>
                                                    </form>
                                                @elseif($peminjaman->status == 'confirm')
                                                    <form class="return-form" id="return-form-{{ $peminjaman->id }}" action="{{ route('peminjaman.return', $peminjaman->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-warning">Kembalikan</button>
                                                    </form>
                                                @endif
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
    <!-- Tambahkan SweetAlert dan Axios CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const confirmForms = document.querySelectorAll('.confirm-form');
            confirmForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const formId = form.getAttribute('id');
                    const formData = new FormData(form);
                    const action = form.getAttribute('action');

                    axios.put(action, formData)
                        .then(response => {
                            if (response.data.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.data.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: response.data.message,
                                });
                            }
                        })
                        .catch(error => {
                            let errorMessage = 'Terjadi kesalahan saat mengkonfirmasi peminjaman.';
                            if (error.response && error.response.data && error.response.data.message) {
                                errorMessage = error.response.data.message;
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: errorMessage,
                            });
                        });
                });
            });

            const returnForms = document.querySelectorAll('.return-form');
            returnForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const formId = form.getAttribute('id');
                    const formData = new FormData(form);
                    const action = form.getAttribute('action');

                    axios.post(action, formData)
                        .then(response => {
                            if (response.data.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.data.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: response.data.message,
                                });
                            }
                        })
                        .catch(error => {
                            let errorMessage = 'Terjadi kesalahan saat mengembalikan buku.';
                            if (error.response && error.response.data && error.response.data.message) {
                                errorMessage = error.response.data.message;
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: errorMessage,
                            });
                        });
                });
            });
        });
    </script>
@endsection
