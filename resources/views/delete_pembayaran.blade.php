<!-- delete_pembayaran.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Hapus Pembayaran</title>
</head>

<body>
    <h1>Konfirmasi Hapus Pembayaran</h1>

    <p>Apakah kamu yakin akan menghapus data :</p>
    
    <div>
        ID Pembayaran: {{ $pembayaran->ID_PEMBAYARAN }}
    </div>
    
    <div>
        ID Siswa: {{ $pembayaran->ID_SISWA }}
    </div>
    
    <div>
        Jumlah Pembayaran: {{ $pembayaran->JUMLAH_PEMBYARAN }}
    </div>
    <div>
        Kategori: {{ $pembayaran->KATEGORI }}
    </div>

    <div>
        Tanggal Pembayaran: {{ $pembayaran->TANGGAL_PEMBAYARAN }}
    </div>

    <!-- Tombol YES dan NO -->
    <div>
        <form action="{{ url('/delete_pembayaran/'.$pembayaran->ID_PEMBAYARAN) }}" method="POST">
            @csrf
            @method('POST')
            <button type="submit">YES</button>
        </form>

        <a href="{{ url('/lihat_pembayaran_siswa') }}"><button>NO</button></a>
    </div>

</body>

</html>
