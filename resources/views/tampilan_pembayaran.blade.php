<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Pembayaran</title>
</head>

<body>
    <h1>Form Pemesanan</h1>

    <form action="/postPembayaran" method="POST">
        @csrf 
        <label for="ID_SISWA">ID Siswa:</label>
        <input type="number" id="ID_SISWA" name="ID_SISWA" min="1000" required><br><br>

        <label for="JUMLAH_PEMBAYARAN">Jumlah Pembayaran:</label>
        <input type="number" id="JUMLAH_PEMBAYARAN" name="JUMLAH_PEMBAYARAN" step="0.01" min="0" required><br><br>

        <label for="KATEGORI">Kategori:</label>
        <select id="KATEGORI" name="KATEGORI">
            <option value="Pembayaran Siswa">Pembayaran Siswa</option>
        </select><br><br>
        
        <label for="TANGGAL_PEMBAYARAN">Tanggal Pembayaran:</label>
        <input type="date" id="TANGGAL_PEMBAYARAN" name="TANGGAL_PEMBAYARAN" required><br><br>
        
        <button type="submit">Submit</button>
    </form>
</body>

</html>
