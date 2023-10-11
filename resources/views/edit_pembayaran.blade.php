<!-- edit_pembayaran.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembayaran</title>
</head>

<body>
    <h1>Edit Pembayaran</h1>

    <form action="{{ url('/update_pembayaran/' . $pembayaran->ID_PEMBAYARAN) }}" method="POST">
        @csrf
        <label for="id_siswa">ID Siswa:</label>
        <input type="text" name="ID_SISWA" value="{{ $pembayaran->ID_SISWA }}" required><br>

        <label for="jumlah_pembayaran">Jumlah Pembayaran:</label>
        <input type="number" name="JUMLAH_PEMBAYARAN" value="{{ $pembayaran->JUMLAH_PEMBAYARAN }}" required><br>

        <label for="kategori">Kategori:</label>
        <input type="text" name="KATEGORI" value="{{ $pembayaran->KATEGORI }}" required><br>

        <label for="tanggal_pembayaran">Tanggal Pembayaran:</label>
        <input type="date" name="TANGGAL_PEMBAYARAN" value="{{ $pembayaran->TANGGAL_PEMBAYARAN }}" required><br>

        <button type="submit">Update Pembayaran</button>
    </form>

    <a href="{{ url('/lihat_pembayaran_siswa') }}">Kembali ke Data Pembayaran</a>

</body>

</html>
