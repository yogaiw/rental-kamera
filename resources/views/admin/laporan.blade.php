<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <div class="row mb-4">
            <h4>Laporan Reservasi dan Pemasukan</h4>
            <small>from <b>{{ date('D, d M Y', strtotime(request('dari'))) }}</b> to <b>{{ date('D, d M Y', strtotime(request('sampai'))) }}</b></small>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Reservasi</th>
                        <th>Alat</th>
                        <th>Penyewa</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('D, d M Y', strtotime($item->tanggal)) }}</td>
                        <td>{{ $item->nama_alat }}</td>
                        <td>{{ $item->name }}</td>
                        <td style="text-align: right"><b>@money($item->harga)</b></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"></td>
                        <td style="text-align: right"><b>@money($total)</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        window.print()
    </script>
</body>
</html>
