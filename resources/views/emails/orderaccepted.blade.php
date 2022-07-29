<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            body {
                background-color: grey;
            }
            .header {
                margin-top: 5px;
                background-color: white;
                align-content: center;
                justify-content: center;
            }
            .body {
                background-color: white;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h3>Reservasi Anda telah Disetujui!</h3>
        </div>
        <div class="body">
            <p>Alat anda telah dikonfirmasi oleh admin, langkah selanjutnya lakukan upload bukti pembayaran pada website</p><br>
            <small>Rincian reservasi :</small><br>
            <b>Tanggal Pengambilan Alat : {{ $payment->order->first()->starts }}</b>
            <table>
                <tr>
                    <td>Alat</td>
                    <td>Durasi</td>
                    <td>Tanggal Pengembalian</td>
                </tr>
                @foreach($payment->order->all() as $item)
                <tr>
                    <td>{{ $item->alat->nama_alat }}</td>
                    <td>{{ $item->durasi }} Jam</td>
                    <td>{{ date('d M Y H:i', strtotime($item->ends))  }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </body>
</html>
