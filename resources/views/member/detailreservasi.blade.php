@extends('member.main')
@section('container')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <a href="{{ route('order.show') }}"><i class="fas fa-arrow-left"></i></a>
                <b>Detail Reservasi</b>
                @if ($paymentStatus == 1)
                    <span class="badge bg-warning">Sedang Ditinjau</span>
                @elseif ($paymentStatus == 2)
                    <span class="badge bg-info">Belum Bayar</span>
                @elseif ($paymentStatus == 3)
                    <span class="badge bg-success">Sudah Bayar</span>
                @elseif ($paymentStatus == 4)
                    <span class="badge bg-secondary">Selesai</span>
                @endif
            </div>
        </div>
        <div class="card-body" style="overflow: auto">
            @if ($paymentStatus == 3)
                <div class="alert alert-success">Silakan melakukan pengambilan alat pada tanggal yang tertera</div>
            @endif
            <b>Tanggal Pengambilan :</b> {{ date('d M Y H:i', strtotime($detail->first()->starts)) }} <br>
            <b>No. Invoice :</b> {{ $detail->first()->payment->no_invoice }}
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Alat</th>
                        <th>Pengembalian</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detail as $item)
                        <tr class="{{ ($item->status == 3) ? 'table-danger' : '' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex justify-content-between"></div>
                                <a class="link-dark" href="{{ route('home.detail',['id' => $item->alat->id]) }}">{{ $item->alat->nama_alat }}</a>
                                <span class="badge bg-warning">{{ $item->alat->category->nama_kategori }}</span>
                                <span class="badge bg-secondary">{{ $item->durasi }} Jam</span>
                                @if ($item->status === 3)
                                    <span class="badge bg-danger">Ditolak</span>
                                @elseif ($item->status === 2)
                                    <span class="badge bg-success">ACC</span>
                                @endif
                            </td>
                            <td>{{ date('d M Y H:i', strtotime($item->ends)) }}</td>
                            <td style="text-align: right"><b>@money($item->harga)</b></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2"></td>
                        <td style="text-align: right"><b>Total</b></td>
                        <td style="text-align: right"><b>@money($total)</b></td>
                    </tr>
                </tbody>
            </table>
            @if ($paymentStatus == 1)
                <form action="{{ route('cancel',['id' => $detail->first()->payment->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" onclick="javascript: return confirm('Anda yakin akan membatalkan reservasi?');" class="btn btn-danger" style="float: right">Cancel Reservasi</button>
                </form>
            @endif
            @if ($paymentStatus == 2)
                <div class="alert {{ ($detail->first()->payment->bukti == NULL) ? 'alert-primary' : 'alert-success'}}">
                    @if ($detail->first()->payment->bukti == NULL)
                        Reservasi anda telah disetujui, silakan bayar sesuai dengan total yang tertera dengan cara transfer ke
                        <h4><b>BNI xxxxxxxxxx</b></h5>
                        <h6><b>a.n Dendra Kurnianto</b></h6>
                        lalu upload bukti bayar dengan menekan tombol dibawah.
                    @else
                        Bukti pembayaran telah di upload, silakan tunggu konfirmasi dari Admin
                    @endif
                    <form action="">
                        <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#bayarModal">Bukti Pembayaran</a>
                    </form>
                </div>
            @endif
            @if ($paymentStatus == 3 || $paymentStatus == 4)
                <h5>Bukti Pembayaran :</h5>
                <img src="{{ url('') }}/images/evidence/{{ $bukti }}" alt="" width="500px">
            @endif
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="bayarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Bayar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{ route('bayar',['id' => $paymentId]) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <input type="file" name="bukti" class="form-control mb-2" required>
            <button type="submit" class="btn btn-success">Upload</button>
        </form>
        <h5 class="mt-2">Bukti Bayar</h5>
        <img src="{{ url('') }}/images/evidence/{{ $bukti }}" alt="" width="500px">
    </div>
    </div>
</div>
@endsection
