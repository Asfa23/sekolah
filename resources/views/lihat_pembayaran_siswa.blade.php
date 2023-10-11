<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Pembayaran Siswa</title>
</head>

<body>
    <h1>Data Pembayaran Siswa</h1>

    <table border="1">
        <tr>
            <th>ID Pembayaran</th>
            <th>ID Siswa</th>
            <th>Jumlah Pembayaran</th>
            <th>Kategori</th>
            <th>Tanggal Pembayaran</th>
            <th>Aksi</th> <!-- Kolom untuk tombol aksi -->
        </tr>

        @foreach ($pembayaranSiswa as $pembayaran)
        <tr>
            <td>{{ $pembayaran->ID_PEMBAYARAN }}</td>
            <td>{{ $pembayaran->ID_SISWA }}</td>
            <td>{{ $pembayaran->JUMLAH_PEMBAYARAN }}</td>
            <td>{{ $pembayaran->KATEGORI }}</td>
            <td>{{ $pembayaran->TANGGAL_PEMBAYARAN }}</td>
            <td>
                <a href="{{ url('/edit/'.$pembayaran->ID_PEMBAYARAN) }}">Edit</a>
                <a href="{{ url('/delete/'.$pembayaran->ID_PEMBAYARAN) }}">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>

    <a href="{{ url('/pembayaran') }}">Tambah Pembayaran</a>

</body>

</html>

