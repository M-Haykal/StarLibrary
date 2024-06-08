<!DOCTYPE html>
<html>
<head>
    <title>Daftar Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Daftar Peminjaman</h2>
    <table>
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Judul Buku</th>
                <th>Author</th>
                <th>Created At</th>
                <th>Confirmed At</th>
                <th>Returned At</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $peminjaman)
                <tr>
                    <td>{{ $peminjaman->siswa_id }}</td>
                    <td>{{ $peminjaman->siswa->nama }}</td>
                    <td>{{ $peminjaman->judul }}</td>
                    <td>{{ $peminjaman->pengarang }}</td>
                    <td>{{ $peminjaman->created_at }}</td>
                    <td>{{ $peminjaman->confirmed_at }}</td>
                    <td>{{ $peminjaman->returned_at }}</td>
                    <td>{{ $peminjaman->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
