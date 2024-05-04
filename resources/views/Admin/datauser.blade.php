@extends('layouts.admin.template')

@section('title', 'Data Pengguna')

@section('content')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Data Pengguna</h1>
        </div>
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tanggal Bergabung</th>
                    </tr>
                </thead>
            </table>
        </div>

        <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
    </main>
@endsection